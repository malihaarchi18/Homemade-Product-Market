<?php

namespace App\Http\Controllers;

use DB;
use App\Cart;
use App\Order;
use App\OrderDetails;
use App\Product;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {   
 $carts=Cart::where('user_ip',request()->ip())->where('user_id',Auth::id())->latest()->get();

 $total=Cart::all()->where('user_ip',request()->ip())->where('user_id',Auth::id())->sum(function($t){
    return $t->price*$t->quantity;
  });

        return view('exampleEasycheckout',compact('carts','total'));
    }

   
   
   public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        
        $requestData= (array) json_decode($request->cart_json);
        $post_data = array();
        $post_data['total_amount'] = $requestData['amount'];
         $post_data['delivery_charge'] = $requestData['delivery'];
        // $post_data['coupon_discount'] = $requestData['discount']; # You cant not pay less than 10
        $post_data['user_id']=Auth::id();
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] =  $requestData['cus_name'];
        $post_data['cus_email'] = $requestData['cus_email'];
        $post_data['cus_add1'] =  $requestData['cus_addr1'];
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $requestData['cus_phone'];
        $post_data['cus_fax'] = "";
        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'user_id'=>$post_data['user_id'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'delivery' => $post_data['delivery_charge'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);
           
    return redirect()->route('transaction.complete')->with('a','Transacton is succesfully completed');
                

            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transaction validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                return redirect()->route('transaction.failed')->with('b','Validation fail');
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
           return redirect()->route('transaction.complete')->with('a','Transacton is succesfully completed');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
             return redirect()->route('transaction.failed')->with('c','Invalid transaction');
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
             return redirect()->route('transaction.failed')->with('d','Transaction is failed');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
             return redirect()->route('transaction.complete')->with('e','Transaction is already successful');
        } else {
            return redirect()->route('transaction.failed')->with('c','Invalid transaction');
        }



    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            return redirect()->route('transaction.failed')->with('f','Transaction is cancel');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
return redirect()->route('transaction.complete')->with('e','Transaction is already successful');
        } else {
           return redirect()->route('transaction.failed')->with('c','Invalid transaction');
        }


    }

    public function ipn(Request $request,$cart_id)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check Transaction id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);
                     
 return redirect()->route('transaction.complete')->with('a','Transacton is succesfully completed');

                } else {
                    /*
                    That means IPN worked, but Transaction validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

      return redirect()->route('transaction.failed')->with('b','Validation fail');
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

return redirect()->route('transaction.complete')->with('e','Transaction is already successful');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
    return redirect()->route('transaction.failed')->with('c','Invalid transaction');
            }
        } else {
   return redirect()->route('transaction.failed')->with('g','Invalid data');
        }
       
    }


    public function complete(Request $request)
    {  
       //
        
       $carts=Cart::where('user_id',Auth::id())->latest()->get();
       $o=Order::where('user_id',Auth::id())->orderBy('id','desc')->first();
      
      
         foreach($carts as $cart)
        OrderDetails::insert([
          'order_no' => $o->id,
          'user_id' => Auth::id(),
          'product_id' => $cart->product_id ,
        'quantity' => $cart->quantity,
        'price' => $cart->price,
        'sale' => $cart->sale,
    
           


       


       ]);
     
     foreach($carts as $cart){
    $update_product = DB::table('products')
                        ->where('id', $cart->product_id)
                        ->update(['quantity' => $cart->product->quantity - $cart->quantity]);
                    }
        
        Db::table('carts')->where('user_id',Auth::id())->delete();
        return view('Transaction.success');


     

       
    }

    public function failed()
    {  
      
       return view('Transaction.fail');
    }

}