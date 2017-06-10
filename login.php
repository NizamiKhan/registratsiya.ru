<?php

require 'db.php';
$data = $_POST;
if (isset($data['do_login'])) {
    $errors = array();
    $user = R::findOne('users', 'login=?', array($data['login']));
    if ($user) {
        if (password_verify($data['password'], $user->password)) {

            $_SESSION['logged_user'] = $user;
            echo '<div style="color: green;">вы авторизованы</div><hr>';
            echo '<a href="index.php">вы можете перейти на главную</a>';
        } else {
            $errors[] = 'неверно введен пароль';
        }
    } else {
        $errors[] = 'Пользователь не найден с таким логином';
    }
    if (!empty($errors)) {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
}
?>

<form action="login.php" method="post">
    <p><strong>Логин</strong></p>
    <p><input type="text" name="login" value="<?= $data['login']; ?>"></p>
    <p><strong>Пароль</strong></p>
    <p><input type="password" name="password" value="<?= $data['password']; ?>"></p>
    <p>
        <button type="submit" name="do_login">Войти</button>
    </p>
</form>
