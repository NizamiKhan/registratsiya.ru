<?php
require "db.php";
?>

<?php if (isset($_SESSION['logged_user'])): ?>
    Авторизован!<br>
    Привет, <?php echo $_SESSION['logged_user']->login; ?>!
    <hr>
    <a href="/logout.php">выйти</a>
<?php else : ?>
    Вы не авторизованы!<br>
    <a href="login.php">Авторизоваться</a><br>
    <a href="signup.php">ЗАрегаться</a>
<?php endif; ?>