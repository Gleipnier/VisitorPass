<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Wallet App - Login</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
        }
        .container {
            min-height: 100vh;
            background-color: #166534;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 20px;
            box-sizing: border-box;
        }
        .content {
            width: 100%;
            max-width: 400px;
        }
        .title-container {
            position: relative;
            margin-bottom: 20px;
            text-align: center;
        }
        .title-glow {
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background-color: rgba(250, 204, 21, 0.2);
            filter: blur(30px);
            border-radius: 50%;
        }
        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .card {
            background-color: #15803d;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .button {
            background-color: #facc15;
            color: #166534;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #fde047;
        }
        .logo-container {
            width: 120px;
            height: 120px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .logo-container img {
            max-width: 100%;
            max-height: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .register-link a {
            color: #facc15;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="title-container">
                <div class="title-glow"></div>
                <h1>Visitor Pass</h1>
            </div>
            <div class="card">
                <div class="logo-container">
                    <img src="images/logo.png" alt="Bodoland Logo">
                </div>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="button">Log In</button>
                </form>
                <div class="register-link">
                    <a href="{{ route('register') }}">Create an account</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>