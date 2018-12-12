<?php
    require('./functions.php');
    init();
?>
<?=get_header('Продукция');?>
<?=get_nav();?>

<section>
    <div class="container-fluid">
        <div class="row justify-content-around">

            <?php
            $products = get_products();
            if ($products->num_rows == 0) echo '<h3>На витрине пусто!</h3>';
            else
            foreach ($products as $product):
            ?>
                <div class="col-3">
                    <img src="/images.php?id=<?=$product['id'];?>" alt="<?=$product['Naim_tovar'];?>">
                    <h3><?=$product['Naim_tovar'];?></h3>
                    <h4>Количество: <?=$product['Kol_tovar'];?></h4>
                    <h5> Сумма товара: <?=$product['Summ'];?></h5>
                </div>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</section>

<?=get_footer();?>
