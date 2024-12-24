<?php
function checkCredentials($username, $password) {
    $filename = 'users.txt'; 
    if (!file_exists($filename)) {
        return false;
    }
    $users = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($users as $user) {
        list($storedUsername, $storedPassword) = explode(':', $user);
        if ($username === $storedUsername && $password === $storedPassword) {
            return true;
        }
    }
    return false;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (checkCredentials($username, $password)) {
        $message = 'Ви увійшли!';
    } else {
        $message = 'Невірний логін або пароль.';
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма входу</title>
</head>
<body>

<h2>Форма входу</h2>

<?php if (isset($message)): ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="username">Логін:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">Увійти</button>
</form>

</body>
</html>
