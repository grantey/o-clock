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
        <td width="800px" valign="top">
          <form action="katalog.php" method="post">
            <?php

   $kor=$_GET['kor'];
   if ($kor!="") {
   if (!isset($_SESSION['korzina'])) {
	$_SESSION['korzina'] = array();
	        }
            $_SESSION['korzina'] []= $kor;}

              $rs = mysql_query( "select categories.id, categories.name as name, labels.id as lab from categories LEFT JOIN labels ON categories.id=labels.category group by categories.id");

              while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
              $c_name=$row["name"];
              $id=$row["id"];

              echo "<p><font size='+2' color='#663300'><strong>$c_name</strong></font></p>";

              $rs2 = mysql_query("select * from labels where category=$id order by label") or die(mysql_error());
    
              while ($row2 = mysql_fetch_array($rs2,MYSQL_ASSOC)) {

              $img=$row2['img'];
			  $id2=$row2['id'];
              echo "<a href='clocks.php?mark=$id2'><img src='img/labels/$img' class='img' alt='image'></a>";
              }
			  echo"<br>";
			  }
		    ?>
          </form>  
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