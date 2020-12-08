<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>E-mart</title>
  @include('layouts.partial.style')
</head>
<body>

	<div class="wrapper">
@include('layouts.partial.nav')
@yield('content')



		
	</div>
@include('layouts.partial.script')

	</body>
</html>
