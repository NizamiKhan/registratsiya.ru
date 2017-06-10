<?php
require "db.php";
$data = $_POST;
if (isset($data['do_signup'])) {
    $errors = array();
    if (trim($data['login']) == '') {
        $errors[] = 'Введите логин';
    }
    if (trim($data['email']) == '') {
        $errors[] = 'Введите email';
    }
    if (($data['password']) == '') {
        $errors[] = 'Введите пароль';
    }
    if (($data['password2']) != $data['password']) {
        $errors[] = 'Введите пароль, неверно!';
    }
    if (R::count('users',"login=?",array($data['login']))>0) {
        $errors[] = 'Пользователь с таким логином существует!';
    }
    if (R::count('users',"email=?",array($data['email']))>0) {
        $errors[] = 'Пользователь с таким email существует!';
    }
    if (empty($errors)) {
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div style="color: green;">вы зареганы</div><hr>';
    } else {
        echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
    }
}
?>

<form action="signup.php" method="post">
    <p><strong>Ваш логин</strong></p>
    <p><input type="text" name="login" value="<?= $data['login']; ?>"></p>
    <p><strong>Ваш email</strong></p>
    <p><input type="email" name="email" value="<?= $data['email']; ?>"></p>
    <p><strong>Ваш пароль</strong></p>
    <p><input type="password" name="password" value="<?= $data['password']; ?>"></p>
    <p><strong>Ваш пароль еще раз</strong></p>
    <p><input type="password" name="password2" value="<?= $data['password2']; ?>"></p>
    <p>
        <button type="submit" name="do_signup">Зарегаться</button>
    </p>
</form>