<?php session_start();?>
<?php  
   $kor=$_GET['kor'];
   if ($kor!="") {
   if (!isset($_SESSION['korzina'])) {
	$_SESSION['korzina'] = array();
	        }
            $_SESSION['korzina'] []= $kor;
	        }?>
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
        <p style="padding-top:20px; text-decoration:none;" class="text3"><font size="+1">Оформление заказа:</font></p>
        <p class="text">Если Вы нашли нужную модель часов и хотите оформить заказ, Вам надо добавить товар в корзину, нажав на ссылку "добавить" - она расположена рядом с фото часов. Эта модель будет добавлена в Вашу корзину. Если нужны не одни часы, Вы можете добавить в корзину еще несколько разных моделей. После этого перейдите на страницу оформления заказа и введите Ваши контактные данные.</p>
        <p class="text">После того, как Вы оформили заказ, с Вами свяжется наш оператор-консультант по электронной почте или по телефону для уточнения деталей, времени и места доставки, а так же возможные условия оплаты.</p>
        <p style="text-decoration:none;" class="text3"><font size="+1">Доставка:</font></p>
        <p class="text">Доставка по Санкт-Петербургу и Москве производится бесплатно на следующий или через день с 10.00 до 18.00 часов по будням.</p>
        <p class="text">В другие города сроки доставки составляют от 1 до 7 рабочих дней:</p>
        <p>Областные центры 190-790 рублей<br>
        Остальные города России	требует уточнения (от 100 до 1300 руб.)</p>
        <p style="text-decoration:none;" class="text3"><font size="+1">Оплата:</font></p>
        <p class="text">1. Оплата возможна "наличными" курьеру при получении заказа и всех соответствующих документов. Такой вариант доступен в городах:</p>
        <p>Санкт-Петербург, Москва, Волгоград, Иваново, Казань + область, Киров, Н.Новгород + область, Ростов-на-Дону + область, Рязань + область, Самара + область, Тверь.</p>
        <p class="text">2. Через Сбербанк России. В этом случае Вам будут высланы реквизиты для оплаты.</p>
        <p style="text-decoration:none;" class="text3"><font size="+1">Гарантия:</font></p>
        <p class="text">Абсолютно все модели часов являются оригинальными, имеют сертификат соответствия РФ, инструкцию использования на русском языке, а также фирменные гарантийные талоны.</p>
        <p class="text">Гарантия на часы является действительной только при наличии правильно и полностью заполненного гарантийного талона. В нем должно быть указано - модель, серийный номер если он есть, дата продажи часов, гарантийный срок. Также на талоне должна стоять четкая печать организации-продавца.</p>
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
