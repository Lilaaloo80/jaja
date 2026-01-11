<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/login" method="post">
    <?= csrf_field() ?>

    <label>Username
        <input type="text" name="Username">
    </label>

    <label>Password
        <input type="password" name="Password">
    </label>

    <button type="submit">Login</button>
</form>

</body>
</html>