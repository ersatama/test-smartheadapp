<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background: #fff;
            padding: 30px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 340px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        input:focus {
            border-color: #2d6cdf;
            outline: none;
            box-shadow: 0 0 4px rgba(45,108,223,0.2);
        }

        button {
            width: 100%;
            padding: 10px 0;
            background: #2d6cdf;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        button:hover {
            background: #1f54c0;
        }

        .error {
            color: #d33;
            margin-bottom: 12px;
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>
<body>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <h2>Вход</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first('email') }}</div>
    @endif

    <input type="email" name="email" placeholder="Email" required autofocus>
    <input type="password" name="password" placeholder="Пароль" required>

    <button type="submit">Войти</button>
</form>
</body>
</html>
