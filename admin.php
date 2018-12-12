<?php
    require('./functions.php');
    init();


    if (!is_login() or !is_admin()) header('Location: /');
    
    if (isset($_POST['name'], $_POST['kol'], $_POST['summ'], $_POST['sklad'], $_FILES['photo'])) {
        if (create_product($_POST['name'], $_POST['kol'], $_POST['summ'], $_POST['sklad'], $_FILES['photo'])) {
            $error = "Товар успешно добавлен!";
        } else {
            $error = "Что-то пошло не так";
        }
    }
?>
<?=get_header('Админ панель');?>
<h3>Добавление товара</h3>

<small class="text-danger"><?=isset($error)?$error:'';?></small>
<form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Название товара" required>
    <input type="text" name="kol" placeholder="Количество товара" required>
    <input type="text" name="summ" placeholder="Цена товара" required>
    <input type="text" name="sklad" placeholder="Номер на складе" required>
    <input type="file" name="photo" required>
    <input type="submit" value="Добавить">
</form>