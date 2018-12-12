<?php
    require('./functions.php');
    init();
?>
<?=get_header('Главная');?>
<?=get_nav();?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="jumbotron">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 text-left">
                                <h2>Реклама</h2>
                                <p>
                                    Текст рекламы
                                </p>
                            </div>
                            <div class="col-6 text-right">
                                <h2>Реклама</h2>
                                <p>
                                    Текст рекламы
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?=get_footer();?>
