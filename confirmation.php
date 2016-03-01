<?php session_start();?>
<?php
        
          $fio=$_GET['fio'];	
          $tel1=$_GET['tel1'];
          $tel2=$_GET['tel2'];
          $email=$_GET['email'];
          $city=$_GET['city'];
		  $adress=$_GET['adress'];
		  $another=$_GET['another'];  
		  $price = 0;
		  
		  if (isset($_POST['cansel']))
          {
          header ("location:index.php");
          die;
          }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="icon" type="image/x-icon" href="img/favicon.gif">
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.gif">

<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Интернет-магазин часов</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php 
require_once('lib/datalib.php');
init_connection();
?>
<table width=1240px border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="table">
      <tr>
        <?php include("blocks/top.php");?>
      </tr>
    </table>
  </tr>
  <tr>
    <?php include ("blocks/menu.php");?>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <?php include("blocks/left.php");?>
        <td width="65%" valign="top">
          <div class="label"><font size="+1"><strong>Оформление заказа</strong></font></div>
        <?php
		  
		  if (isset($_POST['buy'])){
			  
		  $fio=$_POST['fio'];	
          $tel1=$_POST['tel1'];
          $tel2=$_POST['tel2'];
          $email=$_POST['email'];
          $city=$_POST['city'];
		  $adress=$_POST['adress'];
		  $another=$_POST['another'];
		  foreach ($_SESSION['korzina'] as $value){
			$rs= mysql_query ("select name, price from clocks where id='$value'");
 		    $row=mysql_fetch_array($rs);
            mysql_query ("insert into orders (fio, tel1, tel2, email, city, adress, another, price, clocks) values('$fio', '$tel1', '$tel2', '$email', '$city', '$adress', '$another', '$row[price]', '$row[name]')");
		  }
            unset($_SESSION['korzina']);
			echo "<p align='center'><font color='600000'>Ваш заказ принят. С Вами свяжется оператор. Спасибо за покупку.</font></p>";
		  }
		  
        if  (isset($_SESSION['korzina'])){ 
	      echo "<form action='confirmation.php' method='post' class='zakaz'>";
		  echo "<p align='center'><font size='+1'><strong>Ваш заказ:</strong></font></p>";
		    foreach ($_SESSION['korzina'] as $value){
			  $rs= mysql_query ("select name, price, sum(price) as price from clocks where id='$value'");
 		      $row=mysql_fetch_array($rs);
			  $price=$price + $row['price'];
          echo "<strong>Часы марки: </strong> $row[name] <strong>Цена: </strong>$row[price] Руб. <br>";}
		  echo "<p><strong>Итого: </strong> $price Руб. </p>";
		  echo "<p align='center'><font size='+1'><strong>Контактные данные:</strong></font></p>";
		  echo "<p align='center'>$fio</p>";
          echo "<p align='center'>$tel1</p>";
		  echo "<p align='center'>$tel2</p>";
		  echo "<p align='center'>$email</p>";
		  echo "<p align='center'>г.$city<br>";
		  echo "$adress</p>";
		  echo "<p align='center'>$another</p>";
		  
		  echo "<input name='fio' type='hidden' value='$fio'>";
		  echo "<input name='tel1' type='hidden' value='$tel1'>";
		  echo "<input name='tel2' type='hidden' value='$tel2'>";
		  echo "<input name='email' type='hidden' value='$email'>";
		  echo "<input name='city' type='hidden' value='$city'>";
		  echo "<input name='adress' type='hidden' value='$adress'>";
		  echo "<input name='another' type='hidden' value='$another'>";
		  echo "<input name='price' type='hidden' value='$price'>";
		  echo "<input name='clocks' type='hidden' value='$row[name]'>";
		  
	      echo "<p align='center'><input name='cansel' type='submit' value='Отмена' class='button'> ";
		  echo "<input name='buy' type='submit' value='Оформить' class='button'></p>";
		  echo "</form>";
		  }
		  
		  if  (!isset($_SESSION['korzina']) and !isset($_POST['buy'])){
		  echo "<p align='center'><font color='#300000' size='+1'>Корзина пуста, добавьте товар</font></p>";}
        ?>
        </td>
          <?php include("blocks/right.php");?>
      </tr>
    </table> 
    </td>
  </tr>
  <tr>
    <?php include("blocks/bottom.php");?>
  </tr>
</table>
</body>
</html>