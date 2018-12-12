<?php
    require('./functions.php');
    init();
    if (is_login()) header('Location: /');
    if (isset($_POST['login'], $_POST['password'], $_POST['fio'])) {
        if (register($_POST['login'], $_POST['password'], $_POST['fio'])) {
            header('Location: /');
        } else {
            $error = "Что-то пошло не так!";
        }
    }
?>
<?=get_header('Регистрация');?>
<?=get_nav();?>

<section>
    <div class="container">
        <div class="row justify-content-around">
            <div class="col-5">
            <small class="text-danger"><?=isset($error)?$error:'';?></small>
                <form action="register.php" method="post">
                    <input type="text" name="login" placeholder="Логин" required>
                    <input type="password" name="password" placeholder="Пароль" required>
                    <input type="text" name="fio" placeholder="Ваше имя" required>
                    <input type="submit" value="Вход">
                </form>
            </div>
        </div>
    </div>
</section>

<?=get_footer();?>