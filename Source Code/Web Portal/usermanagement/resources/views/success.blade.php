@section('content')
@extends('layouts.app')
@section('title', 'Success')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        /* Center the box both horizontally and vertically */


        /* Style the Thank You box */
        .center {
  			margin: auto;
  			width: 60%;
  			padding: 10px;
		}
		.text{
			text-align: center;
		}
        body {
            overflow: hidden;
            background-image: url("{{url('/build/assets/img/testlogo.jpg')}}");
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
        }

        body {
            background-size: 100% 100%;
        }
    </style>
</head>

<body>
    <div class="center">
        <h1 class="text">Thank You!</h1>
        <p class="text">You are registered successfully</p>
        <p class="text-center">click here to <a class="loginLink" style="color:#FFC850;" href="{{ route('login') }}"> Login</a></p>

    </div>
</body>
@endsection
