<?php session_start();?>
<?php
            $kor=$_GET['kor'];
            if ($kor!="") {
            if (!isset($_SESSION['korzina'])) {
	        $_SESSION['korzina'] = array();
	        }
            $_SESSION['korzina'] []= $kor;
		header("location: index.php");
	        }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="icon" type="image/x-icon" href="img/favicon.gif">
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.gif">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta name="description" content="В нашем онлайн каталоге представлены модели наручных часов швейцарских марок, модные, выпускаемые под маркой всемирно известных брендов, а также часы из ряда других стран.">
<meta name="keywords" content="Часы, Интернет-магазин, дешевые, качественные часы">
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
        <p class="text">Уважаемые покупатели! Интернет магазин часов предоставляет к продаже оригинальные часы, поступающие в Россию только через официальных дистрибьютеров. Также обращаем Ваше внимание, что все часы, продаваемые в нашем Интернет-магазине, имеют Российский сертификат соответствия, инструкцию на русском языке, а также фирменные гарантийные талоны.</p>
        <p class="text">В нашем онлайн каталоге представлены модели наручных часов швейцарских марок, модные, выпускаемые под маркой всемирно известных брендов, а также часы из ряда других стран.</p>
        <p  class="text">Купить выбранную модель часов можно сделав заказ через "Корзину" или связавшись с продавцом-консультантом магазина любым способом из раздела Контакты.</p>
        <div class="label"><font size="+1"><strong>Последние поступления</strong></font></div>
          <?php 

		   $rs=mysql_query("select * from clocks order by id desc limit 2");// or die(mysql_error());  
			$error_count="Нет в наличии";      
            while ($row=mysql_fetch_array($rs)){
			$id=$row['id'];
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
                if ($row['count']!=0){
				  $found = FALSE;
				  if ($_SESSION['korzina']) foreach ($_SESSION['korzina'] as $value) {
				  if ($value == $id) {
				  $found = TRUE;
	              break;
	              }
	              }  
				  if ($found){
				  echo "<strong>Цена:</strong> $row[price] Руб.";
		          echo "<p><font color='#300000'>Добавлены в корзину</font></p>";
	              }
				  else{
				  echo "<strong>Цена:</strong> $row[price] Руб.";
				  echo "<p><a href='index.php?kor=$id' class='li2'>Добавить в корзину</a></p>";  //onclick='callFunction(); return false;' 
				}
				}else{
			      echo "<p><font color='red'>$error_count</font></p>";
				  }
			echo "</div>";	
			}
		  ?>
        <div class="label" style="margin-top:250px;"><font size="+1"><strong>Акции!</strong></font></div>
	<p  class="text">На сегодняшний момент акций нет.</p>
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