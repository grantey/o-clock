<?php session_start();?>
<?php	

	if (isset ($_POST['fio'])) {$fio =$_POST['fio']; if ($fio == '') {unset($fio);} }
        if (isset ($_POST['tel1'])) {$tel1 =$_POST['tel1']; if ($tel1 == '') {unset($tel1);}}
        if (isset ($_POST['tel2'])) {$tel2 =$_POST['tel2']; if ($tel2 == '') {unset($tel2);}}
        if (isset ($_POST['email'])) {$email =$_POST['email']; if ($email == '') {unset($email);}}
        if (isset ($_POST['city'])) {$date =$_POST['city']; if ($city == '') {unset($city);}}
		if (isset ($_POST['adress'])) {$adress =$_POST['adress']; if ($adress == '') {unset($adress);}}
		if (isset ($_POST['another'])) {$another =$_POST['another']; if ($another == '') {unset($another);}}
		
        if (isset ($_POST['next']))
          {	
          $fio=$_POST['fio'];	
          $tel1=$_POST['tel1'];
          $tel2=$_POST['tel2'];
          $email=$_POST['email'];
          $city=$_POST['city'];
		  $adress=$_POST['adress'];
		  $another=$_POST['another'];
          $success=true;
            if ($fio=="" or $tel1=="" or $email=="" or $city=="")
              {
	          $success=FALSE;
	          $error='Заполните все необходимые поля';
              }

          if ($success==true){
            header ("location:confirmation.php?fio=$fio&tel1=$tel1&tel2=$tel2&email=$email&city=$city&adress=$adress&another=$another");}
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
	
           if  (isset($_SESSION['korzina'])){
	      echo "<form action='order.php' method='post' class='zakaz'>";
		  echo "<p align='center'><font color=red size='+1'>$error</font></p>";
		  echo "<p><label>ФИО (полностью): <font color=red>*</font></label>";
		  echo "<input name='fio' type='text' size='35' value='$fio'></p>";
		  
		  echo "<p><label>Контактный телефон: <font color=red>*</font></label>";
		  echo "<input name='tel1' type='text' size='31' value='$tel1'></p>";
		  
		  echo "<p><label>Дополнительный телефон: </label>";
		  echo "<input name='tel2' type='text' size='27' value='$tel2'></p>";
		  
		  echo "<p><label>E-mail: <font color=red>*</font></label>";
		  echo "<input name='email' type='text' size='47' value='$email'></p>";
		  
		  echo "<p><label>Город: <font color=red>*</font></label>";
		  echo "<input name='city' type='text' size='47' value='$city'></p>";
		  
		  echo "<p><label>Адрес доставки: </label>";
		  echo "<input name='adress' type='text' size='38' value='$adress'></p>";
		  
		  echo "<p><label>Ваши пожелания по оплате и доставке: </label><br>";
		  echo "<textarea name='another' cols='55' rows='8'></textarea></p>";
		  
		  echo "<p><font color=red size='-1'>Строки помеченные * обязательны к заполнению.</font></p>";
		  echo "<p align='center'><input name='next' type='submit' value='Далее' class='button'></p>";
		  echo"</form>";
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