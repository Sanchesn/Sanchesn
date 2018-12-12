<?php
require('./functions.php');
init();
if ( isset( $_GET['id'] ) ) {
  // Здесь $id номер изображения
  $id = (int)$_GET['id'];
  if ( $id > 0 ) {
    $query = "SELECT * FROM Tovar WHERE id=".$id;
    // Выполняем запрос и получаем файл
    $result = mysqli_query($GLOBALS['config']['dbSession'], $query);
    if ( mysqli_num_rows( $result ) == 1 ) {
      $image = mysqli_fetch_array($result);
      // Отсылаем браузеру заголовок, сообщающий о том, что сейчас будет передаваться файл изображения
      header("Content-type: image/*");
      // И  передаем сам файл
      echo $image['image'];
    }
  }
}