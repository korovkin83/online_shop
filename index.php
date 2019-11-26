<?php
include($_SERVER['DOCUMENT_ROOT'].'/conf.php');
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
	<!--top-header-->
	<div class="top-header">
	<div class="container">
		<div class="top-header-main">

			<div class="col-md top-header-middle">
				<a href="index.html"><img src="logo.png" alt="" /></a>
			</div>

			<div class="clearfix"></div>
		</div>
	</div>
</div>
<!--top-header-->






	<!--start-shoes-->
	<div class="shoes">
		<div class="container">
			<div class="product-one">


        <?php
        $result = mysqli_query($link, 'SELECT * FROM tovars');
        while( $row = mysqli_fetch_assoc($result) ){

        printf("
        <div class='col-md-3 product-left'>
          <div class='p-one simpleCart_shelfItem'>
              <a href='add.php?id=%s'>
                <img width='150' height='200' src='%s' alt='' />
                <div class='mask'>
                  <span>Заказать</span>
                </div>
              </a>
            <h4> %s </h4>
            <p><a class='item_add' href='#'><i></i> <span class=' item_price'> %s </span></a></p>
          </div> <br>
        </div>
        ",$row['id'], $row['logo'], $row['name'], $row['price']);
        }
        ?>




				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!--end-shoes-->

</body>
</html>
