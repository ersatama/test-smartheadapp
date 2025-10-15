<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обратная связь</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: sans-serif; padding: 20px; }
        input, textarea { display: block; width: 100%; margin: 8px 0; padding: 8px; }
        button { padding: 10px 20px; background: #2d6cdf; color: white; border: none; cursor: pointer; }
        #message { margin-top: 10px; }
    </style>
</head>
<body>
<h2>Отправить заявку</h2>

<form id="feedbackForm" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Ваше имя" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="tel" name="phone" placeholder="+77001234567" required pattern="^\+[1-9]\d{1,14}$">
    <input type="text" name="subject" placeholder="Тема" required>
    <textarea name="text" placeholder="Сообщение" required></textarea>
    <input type="file" name="files[]" multiple>
    <button type="submit">Отправить</button>
</form>

<div id="message"></div>

<script>
    document.getElementById('feedbackForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const response = await fetch('/api/tickets', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        const messageBox = document.getElementById('message');
        messageBox.innerText = result.message ?? 'Ошибка при отправке';
        messageBox.style.color = response.ok ? 'green' : 'red';
    });
</script>
</body>
</html>