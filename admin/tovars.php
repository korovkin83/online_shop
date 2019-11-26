<?php
if (!isset($_COOKIE['admin_id'], $_COOKIE['login'], $_COOKIE['pass']))   {
  exit('Вы не вошли!');
}


if (!isset($_GET['page'])) {
  header('Location: tovars.php?page=lists');
}

$html = "
  <center>
      <h2>Админ панель</h2>
      <a href='users.php?page=lists'>Пользователи</a>
      <a href='order.php?page=lists'>Заказы</a>
      <a href='tovars.php?page=lists'>Список товаров</a>
      <a href='tovars.php?page=add'>Создать товар</a>
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

switch ($page) {
  case 'lists':

$result = mysqli_query($link, 'SELECT * FROM tovars');
while( $row = mysqli_fetch_assoc($result) ){
	//	printf("%s (%s)\n", $row['name'], $row['price']);
  printf("<center>
            Имя: %s Цена: %s <br>
            <a href='%s'>Просмотреть фото</a>
            <a href='tovars.php?page=edit&id=%s'>Редактировать</a>
            <a href='tovars.php?page=delete&id=%s'>Удалить</a>
          </center> <hr>
    ", $row['name'], $row['price'], $row['id'], $row['id'], $row['id']);
}

  break;

  case 'add':

echo "
<center>
<form arction='' method='POST'>
<input type='text' name='name' placeholder='Имя'>
<input type='text' name='price' placeholder='Цена'>
<input type='text' name='img' placeholder='ссылка на изобращение'>
<br> <br>
<textarea placeholder='описание' name='info' rows='10' cols='70%'></textarea>
<br> <br>
<input type='submit' name='btn_add' value='Создать'>
</form>
</center>
";
if (isset($_POST['btn_add'] ) ) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $info = $_POST['info'];
  $img = $_POST['img'];

   mysqli_query($link, "INSERT INTO tovars(name,info,price) VALUES ('$name', '$info', '$price')");
   exit('<center>Товар успешно добавлен!</center>');
}

    break;

    case 'edit':

    if ( !isset($_GET['id']) ) {
      exit('Это так не работает!');
    }

    $id = $_GET['id'];
    $row_sql = mysqli_query($link, "SELECT * FROM tovars WHERE id='$id'");
    $row = mysqli_fetch_assoc($row_sql);
    printf("
    <center>
    <form arction='' method='POST'>
    <input type='text' name='name' valu='Имя' value='%s'>
    <input type='text' name='price' placeholder='Цена' value='%s'>
    <input type='text' name='img' placeholder='Изображение' value='%s'>
    <br><br>
    <textarea placeholder='описание' name='info' rows='10' cols='70'>%s</textarea>
    <br><br>
    <input type='submit' name='btn_add' value='Изменить'>
    </form>
    <center>
    ", $row['name'], $row['price'], $row['id'], $row['info']);

      break;

      case 'delete':
      if (!isset($_GET['id'])) {
        exit('Это так не работает!');
      }
      $id = $_GET['id'];
      mysqli_query($link, "DELETE FROM tovars WHERE id='$id'");
      exit('<center>Успешно удаленно!</center>');
      break;

  default:
    // code...
    break;
}

?>
