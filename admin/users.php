<?php
if (!isset($_COOKIE['admin_id'], $_COOKIE['login'], $_COOKIE['pass']))   {
  exit('Вы не вошли!');
}


if (!isset($_GET['page'])) {
  header('Location: users.php?page=lists');
}

$html = "
  <center>
      <h2>Админ панель</h2>
      <a href='tovars.php?page=lists'>Товары</a>
      <a href='order.php?page=lists'>Заказы</a>
      <a href='users.php?page=lists'>Список админов</a>
      <a href='users.php?page=add'>Создать админа</a>
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

  $result = mysqli_query($link, 'SELECT * FROM admins');
  while( $row = mysqli_fetch_assoc($result) ){
  	//	printf("%s (%s)\n", $row['name'], $row['price']);
      printf("<center>
        Логин: %s <br> Имя: %s <br>
        <a href='users.php?page=edit&id=%s'>Редактировать</a>
        <a href='users.php?page=delete&id=%s'>Удалить</a>
        </center> <hr>",
        $row['login'], $row['name'], $row['id'], $row['id']);
  }

  break;

  case 'add':
  echo "
  <center>
  <form arction='' method='POST'>
  <input type='text' name='name' placeholder='Имя'>
  <input type='text' name='login' placeholder='Логин'>
  <input type='text' name='pass' placeholder='Пароль'>
  <input type='submit' name='btn_add' value='Создать'>
  </form>
  </center>
  ";
  if (isset($_POST['btn_add'] ) ) {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $pass = $_POST['pass'];

     mysqli_query($link, "INSERT INTO admins(name,login,pass) VALUES ('$name', '$login', '$pass')");
     exit('<center>Пользователь успешно добавлен!</center>');
   }
  break;

  case 'edit':
  if ( !isset($_GET['id']) ) {
    exit('Вы не вошли!');
  }

  $id = $_GET['id'];
  $row_sql = mysqli_query($link, "SELECT * FROM admins WHERE id='$id'");
  $row = mysqli_fetch_assoc($row_sql);
  printf ("
  <center>
  <form arction='' method='POST'>
  <input type='text' name='name' placeholder='Имя' value='%s'>
  <input type='text' name='login' placeholder='Логин' value='%s'>
  <input type='text' name='pass' placeholder='Пароль' value='%s'>
  <input type='submit' name='btn_add' value='Обновить'>
  </form>
  </center>
  ", $row['name'], $row['login'], $row['pass']);
  if (isset($_POST['btn_add'] ) ) {
    $name = $_POST['name'];
    $login = $_POST['login'];
    $pass = $_POST['pass'];
//UPDATE Customers SET rating = 200 WHERE snum = 1001;
     mysqli_query($link, "UPDATE admins SET name='$name', login='$login', pass='$pass' WHERE id='$id' ");
     exit('<center>Пользователь успешно обновлен!</center>');
   }
  break;

 case 'delete':
 if ( !isset($_GET['id']) ) {
   exit('Вы не вошли!');
 }
 $id = $_GET['id'];
 mysqli_query($link, "DELETE FROM admins WHERE id='$id'");
 exit('<center>Успешно удаленно</center>');
 break;

}
