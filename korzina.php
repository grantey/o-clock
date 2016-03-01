<?php session_start();?>
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
          <div class="label"><font size="+1"><strong>Корзина</strong></font></div>
        <?php

		  if ($_POST['clear']){
	      unset($_SESSION['korzina']);
	      }
          if  (isset($_SESSION['korzina'])){
			echo "<div align='center'><form action='korzina.php' method='post'>";
            echo "<p><input name='clear' type='submit' value='Очистить корзину' class='button'></p>";
            echo "</form></div>";
	      foreach ($_SESSION['korzina'] as $value) {
		    $rs= mysql_query ("select * from clocks where id='$value'");
 		    $row=mysql_fetch_array($rs);
		    echo "<div class='item'>";
			  echo "<div class='dimg'>";
			  echo "<img src='img/clocks/$row[img]' alt='image'>";
			  echo "</div>"; 
              echo "<font><strong>$row[name]</strong></font><br>";
			  echo "<p class='text2'><strong>Механизм:</strong> $row[mechanism]<br>";
			  echo "<strong>Корпус:</strong> $row[body]<br>";
			  echo "<strong>Тип браслета:</strong> $row[handover]<br>";
			  echo "<strong>Стекло:</strong> $row[glass]<br>";
			  echo "<strong>Пол:</strong> $row[sex]</p>";
			  echo "<strong>Цена:</strong> $row[price] Руб.";
			echo "</div>";
	        }
          }else{
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