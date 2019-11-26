<?php
include($_SERVER['DOCUMENT_ROOT'].'/conf.php');

if (!isset($_GET['id'])) {
  exit("404");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Авто-Магазин</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,300,400,500,700,800,900,100italic,300italic,400italic,500italic,700italic,800italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
	<div class="top-header">
	<div class="container">
		<div class="top-header-main">

			<div class="col-md top-header-middle">
				<a href="index.html"><img src="logo.png" alt="" /></a>
			</div>
		</div>
	</div>
</div>


	<!--start-shoes-->
	<div class="shoes">
		<div class="container">
			<div class="product-one">

<center>
        <?php
        $id = $_GET['id'];
        $row_sql = mysqli_query($link, "SELECT * FROM tovars WHERE id='$id'");
        $row = mysqli_fetch_assoc($row_sql);
        printf("
        	<div style='width: 605px;'>
        	    <img src='' style='vertical-align: middle;' width=%s hspace=0/>
        	    <span style='vertical-align: middle; display: inline-block; width: 400px;'>
        				<h2> %s </h2>
        			%s
        			  </span>
        	</div>

              <br><br><br>
          <form arction='' method='POST'>
          <input type='text' name='name' placeholder='Имя'>
          <input type='text' name='email' placeholder='E-MAil'>
          <br> <br>
          <textarea placeholder='Напшите информацию как с вами свзяться для оплаты и получения товара' name='info' rows='10' cols='%s'></textarea>
          <br> <br>
          <input type='submit' name='btn_add' value='Оформить заказ'>
          </form>
        ", '26%', $row['name'], $row['info'], '70');

  if (isset($_POST['name'], $_POST['email'] ) ) {
$id = $_GET['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$info = $_POST['info'];

if ($name === "") {  exit('Укажите логин!'); }
if ($email === "") {  exit('Укажите логин!'); }
if ($info === "") {  exit('Укажите логин!'); }
mysqli_query($link, "INSERT INTO orders(id_tovar,name,email,info) VALUES ('$id', '$name', '$email', '$info')");
exit('Заказ успешно дбавлен!');

  }
        ?>
</center>




				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--end-shoes-->

</body>
</html>
