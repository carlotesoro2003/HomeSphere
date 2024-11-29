<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            background-color: #ffffff;
            color: #764ba2;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background-color: #764ba2;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-5xl font-bold mb-6">Welcome to Our App!</h1>
        <p class="text-xl mb-6">Get started by logging into your account.</p>
        <a href="{{ route('login') }}" class="btn">Login</a>
    </div>
</body>
</html>
