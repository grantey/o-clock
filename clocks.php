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
        <?php 
            	$kor=$_GET['kor'];
		$id2=$_GET['mark'];
		      if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
              }else{
                $pageno = 1;
              }

            if ($kor!="") {
            if (!isset($_SESSION['korzina'])) {
	        $_SESSION['korzina'] = array();
	        }
            $_SESSION['korzina'] []= $kor;
	        }

          $rs2=mysql_query("select * from labels where id='$id2'");
	      $row2=mysql_fetch_array($rs2);

		    $query = "SELECT count(*) FROM clocks where mark='$id2'";
            $result = mysql_query($query);
            $query_data = mysql_fetch_row($result);
            $numrows = $query_data[0];
		    $rows_per_page = 4;
            $lastpage = ceil($numrows/$rows_per_page);
		    $pageno = (int)$pageno;
            if ($pageno > $lastpage) {
              $pageno = $lastpage;
            }
            if ($pageno < 1) {
              $pageno = 0;
            }else{
		    $limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page;}
			?>
		  <div class="label"><font size="+1"><strong>Часы <?php echo $row2['label'];?></strong></font></div>
          <?php 
		  if ($pageno > 0){
		    echo"<p align='center'>";
			if ($pageno == 1) {
              echo " ";
            }else{if($pageno != 0){
              echo "<a href='clocks.php?pageno=1&amp;mark=$id2' class='li4'>FIRST</a> ";
              $prevpage = $pageno-1;
              echo " <a href='clocks.php?pageno=$prevpage&amp;mark=$id2' class='li4'>PREV</a> ";
            }}
            echo " (Page $pageno of $lastpage) ";
            if ($pageno == $lastpage) {
              echo " ";
            }else{
              $nextpage = $pageno+1;
              echo "<a href='clocks.php?pageno=$nextpage&amp;mark=$id2' class='li4'>NEXT</a> ";
              echo "<a href='clocks.php?pageno=$lastpage&amp;mark=$id2' class='li4'>LAST</a> ";
            }}
			echo"</p>";
          ?>
          <form action="clocks.php" method="post"> 
          <?php
			$rs=mysql_query("select * from clocks where mark='$id2' order by name $limit");  
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
				  echo "<p><a href='clocks.php?kor=$id&amp;mark=$id2&amp;pageno=$pageno' class='li2'>Добавить в корзину</a></p>";
				  }
				}else{
			      echo "<p><font color='red'>$error_count</font></p>";
				  }
			echo "</div>";	
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



