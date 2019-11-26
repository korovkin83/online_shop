<?php
if (!isset($_COOKIE['admin_id'], $_COOKIE['login'], $_COOKIE['pass']))   {
  exit('Вы не вошли!');
}

if (!isset($_GET['page'])) {
  header('Location: order.php?page=lists');
}

$html = "
  <center>
      <h2>Админ панель</h2>
      <a href='tovars.php?page=lists'>Товары</a>
      <a href='users.php?page=lists'>Пользователи</a>
      <a href='order.php?page=lists'>Список товаров</a>
  </center>
  <hr> <br>
";

echo "<title>Админ Панель</title>".$html;
/* Подключение к серверу MySQL */
include($_SERVER['DOCUMENT_ROOT'].'/conf.php');

if (!$link) {
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
   exit;
}

$page = $_GET['page'];

switch($page) {

case 'lists':

$result = mysqli_query($link, 'SELECT * FROM orders');
while( $row = mysqli_fetch_assoc($result) ){
  //	printf("%s (%s)\n", $row['name'], $row['price']);
    printf("<center>
        ID товара: %s <br>
        Имя: %s <br>
        Инфо: %s <br>
      <a href='order.php?page=delete&id=%s'>Удалить</a>
      </center> <hr>",
      $row['id_tovar'], $row['name'], $row['info'], $row['id']);
}

break;

case 'delete':
$id = $_GET['id'];
mysqli_query($link, "DELETE FROM admins WHERE id='$id'");
exit('<center>Успешно удаленно</center>');
break;


}
