<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
        
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            font-size: 14px;
        }
        @media (max-width: 600px) {
           
            .login-container {
                padding: 15px;
            }
            input, button {
                font-size: 14px;
            }

        }
    </style>
        
</head>
<body>
    <div class="login-container">
        <h1>E-commers</h1>
        <h2>Login</h2>
        @if ($errors->any())

            <div class="error">
                <strong>Error!</strong> {{$errors->first()}}
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" id= "email" name="email" require values="{{old('email')}}" placeholder="Email">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        </form>
    </div>
</body>
</html>