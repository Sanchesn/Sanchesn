<?php
    require('./functions.php');
    init();
    if (isset($_POST['text']) && is_login()) {
        if (create_comment($_SESSION['auth'], $_POST['text'])) {
            $error = "Комментарий добавлен!";
        } else {
            $error = "Что-то пошло не так!";
        }
    }
?>
<?=get_header('Контакты');?>
<?=get_nav();?>

<section>
    <div class="container-fluid">
        <div class="row justify-content-around mb-5">
            <div class="col-6">
              <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A425f88bb2a58a78bc423c19dd1ce43bcbfa1b68bcfeeb4f301d1c06be93d8644&amp;width=758&amp;height=551&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
            <div class="col-6">
                <h3>Панарин Александр Владимирович</h3>
                <h3>Телефон: <a href="tel:890999970372">+7 (909) 997-03-72</a></h3>
                <h3>Адрес: г.Москва улица 2-ая Владимирская д 38/18 </h3>
            </div>
        </div>
<?php
if (is_login()):
?>
        <div class="col-12 my-5">
        <small class="text-danger"><?=isset($error)?$error:'';?></small>
            <form action="contacts.php" method="post">
                <textarea name="text" resize="no" cols="50" rows="3"></textarea>
                <input type="submit" value="Отправить">
            </form>
        </div>
<?php
endif;
?>
        <div class="row justify-content-around my-5">
            <div class="col-12">
                <div class="jumbotron">

                    <?php
                        $comments = get_comments();
                        if ($comments->num_rows == 0) echo '<h3>Комментариев нет!</h3>';
                        else
                        foreach ($comments as $comment):
                    ?>
                        <div>
                            <h3><?=$comment['author'];?> <small><?=date("H:i Y.m.d", strtotime($comment['date']));?></small></h3>
                            <p>
                                <?=$comment['text'];?>
                            </p>
                        </div>

                        <hr>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?=get_footer();?>
