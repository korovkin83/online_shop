<?php

//if ( !isset($_COKKIE['admin_id'] $_COKKIE['login'], $_COKKIE['pass'] ) ) {
if (isset($_COOKIE['admin_id'], $_COOKIE['login'], $_COOKIE['pass']))   {
    header('Location: users.php?page=lists');
}

echo "
<form action='' method='POST'>
<input type='text' name='login' placeholder='Логин'>
<input type='text' name='pass' placeholder='Пароль'>
<input type='submit' value='Войти'>
</form>
";
if (isset($_POST['login'], $_POST['pass'] ) ) {



$login = $_POST['login'];
$pass = $_POST['pass'];

if ($login === "") {  exit('Укажите логин!'); }
if ($pass === "") {  exit('Укажите пароль!'); }


include($_SERVER['DOCUMENT_ROOT'].'/conf.php');

$res = mysqli_query($link, "SELECT COUNT(*) FROM admins WHERE login='$login' ");
$row = mysqli_fetch_row($res);
$total = $row[0]; // всего записей

if ($total === 0) {
  echo "Нет такого пользователя";
  mysqli_close($link);
  exit();
}

$data_sql  = mysqli_query($link, "SELECT * FROM admins WHERE login='$login'");
$data = mysqli_fetch_array($data_sql);

    if ($data['pass'] === $pass) {

            //setcookie("color","red");

            setcookie("admin_id", $data['id']);
            setcookie("login", $data['login']);
            setcookie("pass", $data['pass']);


            header('Location: users.php?page=lists');
            exit("YES IN LOIGIN");
    } {
      //error password
      echo "Неверный пароль";
      exit();
    }

}
?>
