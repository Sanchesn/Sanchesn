<?php
    require('./functions.php');
    init();
    if (is_login()) header('Location: /');
    if (isset($_POST['login'], $_POST['password'])) {
        if (enter($_POST['login'], $_POST['password'])) {
            header('Location: /');
        } else {
            $error = "Введенo не верное имя пользователя или пароль!";
        }
    }
?>
<?=get_header('Вход');?>
<?=get_nav();?>

<section>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-5">
                <small class="text-danger"><?=isset($error)?$error:'';?></small>
                <form action="enter.php" method="post">
                    <input type="text" name="login" placeholder="Логин">
                    <input type="password" name="password" placeholder="Пароль">
                    <input type="submit" value="Вход">
                </form>
            </div>
        </div>
    </div>
</section>

<?=get_footer();?>