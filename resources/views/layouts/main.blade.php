<!DOCTYPE html>
<html>
<head>
	<title>#farina</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
</head>
<body>
    <div class="navigation">
      @section('navigation')
        <ul class="nav nav-tabs">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('tweets') }}">Tweets</a></li>
            <li><a href="{{ url('graficas') }}">Gráficas</a></li>
        </ul>
      @show
    </div>
    <div class="container">
    @yield('content')
    </div>
</body>
</html>