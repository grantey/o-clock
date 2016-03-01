<?php session_start();?>
<?php   $kor=$_GET['kor'];
   if ($kor!="") {
   if (!isset($_SESSION['korzina'])) {
	$_SESSION['korzina'] = array();
	        }
            $_SESSION['korzina'] []= $kor;
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
        <p class="text" style="padding-top:20px;">Для заказа часов, а также по всем вопросам и пожеланиям, связанным с работой нашего интернет-магазина просьба обращаться по телефонам:</p>
        <p class="text3">в Москве +7 (495) 217-63-13</p>
        <p class="text3">в Санкт-Петербурге +7 (812) 346-19-84</p>
        <p class="text">Звонки принимаются 7 дней в неделю с 9-00 до 21-00 по московскому времени.</p>
        <p class="text">Также вы можете связаться с нами по электронной почте:</p>
        <p align="center"><a href="mailto:sales@oclock.ru"  class="text3">sales@oclock.ru</a> 
        <p class="text">Юр. адрес: 125009, Россия, Москва, Романов пр., 3.
        <p class="text3" style="text-decoration:none;"><font size="+1">О Компании</font></p>
        <p><img src="img/333.gif" style="float:LEFT; width:300px;" class="img" alt="image"></p>
        <p class="text">Компания O'Clock! – основана в 2007 году и является Интернет-магазином официального поставщика швейцарских и японских часовых брендов. Мы продаем только подлинные часы ведущих мировых производителей. На все часы есть официальная гарантия и сертификат соответствия. </p>
        <p class="text">На данный момент мы осуществляем продажи в Москве, Санкт-Петербурге и регионах России. Необходимо отметить, что количество заказов дорогих часов из регионов России растет. Региональные продажи составляют уже 35% от оборота Интернет-магазина. </p>
        <p class="text">Эксклюзивное сотрудничество с производителями часов "напрямую", без посредников, даёт возможность представлять в Интернет-магазине максимально разнообразные, подчас уникальные модели швейцарских, японских и дизайнерских моделей часов, а также регулярно обновлять коллекции.</p>
        <p class="text">Многолетний опыт работы и знание часового рынка позволяют предложить нашим покупателям актуальный и разнообразный модельный ряд от ведущих мировых производителей часов, таких как: Charmex, Hugo Boss, Kolber, Valentino, Chronotech, Roberto Cavalli, Anne Klein.</p>
        <p class="text3" style="text-decoration:none;"><font size="+1">Корпоративным клиентам</font></p>
        <p class="text">В нашем Интернет-магазине вы можете подобрать как часы известных Домов Моды, так и классические модели швейцарских часов, которые хотели бы получить в подарок ваши сотрудники! Мы можем предложить корпоративным клиентам как дополнительные скидки при заказе от 5 корпусов, так и обеспечить гарантированную доставку в течение суток, а профессиональные консультанты помогут вам определиться с ассортиментом.</p>
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
