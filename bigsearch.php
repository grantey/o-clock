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
          <div class="label"><font size="+1"><strong>Поиск часов</strong></font></div>
          <?php 	  
			$min=$_GET['minprice'];
			$max=$_GET['maxprice'];
			$sex=$_GET['sex'];
			$label=$_GET['label'];
			$handover=$_GET['handover'];
			$mechanism=$_GET['mechanism'];
			$body=$_GET['body'];
			$glass=$_GET['glass'];
			
			if (isset($_POST['sex']))$sex =$_POST['sex'];
    		        if (isset($_POST['label']))$label =$_POST['label'];
			if (isset($_POST['handover']))$handover =$_POST['handover'];
			if (isset($_POST['mechanism']))$mechanism =$_POST['mechanism'];
			if (isset($_POST['body']))$body =$_POST['body'];
			if (isset($_POST['glass']))$glass =$_POST['glass'];
			if (isset($_POST['minprice']))$min =$_POST['minprice'];
			if (isset($_POST['maxprice']))$max =$_POST['maxprice'];
			
            $kor=$_GET['kor'];
            if ($kor!="") {
            if (!isset($_SESSION['korzina'])) {
	        $_SESSION['korzina'] = array();
	        }
            $_SESSION['korzina'] []= $kor;
	        }

		    if (isset($_GET['pageno'])) {
              $pageno = $_GET['pageno'];
            }else{
              $pageno = 1;
            }
            
			if (strlen($min)!=0 and strlen($max)!=0){
		    $query = "SELECT count(*) FROM clocks where mark='$label' and sex LIKE '%$sex%' and handover LIKE '%$handover%' and mechanism LIKE '%$mechanism%' and glass LIKE '%$glass%' and body LIKE '%$body%' and price between '$min' and '$max'";
			}else{
			$query = "SELECT count(*) FROM clocks where mark='$label' and sex LIKE '%$sex%' and handover LIKE '%$handover%' and mechanism LIKE '%$mechanism%' and glass LIKE '%$glass%' and body LIKE '%$body%'";}
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
			
            $bigsearchs = get_bigsearch_listing($label, $sex, $handover, $mechanism, $glass, $body, $limit, $min, $max);
			?>

          <?php 
		  echo"<p align='center'>";
			if ($pageno == 1) {
              echo " ";
            }else{ if($pageno != 0){
              echo "<a href='bigsearch.php?pageno=1&amp;label=$label&amp;handover=$handover&amp;sex=$sex&amp;mechanism=$mechanism&amp;body=$body&amp;glass=$glass&amp;minprice=$min&amp;maxprice=$max' class='li4'>FIRST</a>";
              $prevpage = $pageno-1;
              echo " <a href='bigsearch.php?pageno=$prevpage&amp;label=$label&amp;handover=$handover&amp;sex=$sex&amp;mechanism=$mechanism&amp;body=$body&amp;glass=$glass&amp;minprice=$min&amp;maxprice=$max' class='li4'>PREV</a> ";
            }}
            echo " (Page $pageno of $lastpage) ";
            if ($pageno == $lastpage) {
              echo " ";
            }else{
              $nextpage = $pageno+1;
              echo "<a href='bigsearch.php?pageno=$nextpage&amp;label=$label&amp;handover=$handover&amp;sex=$sex&amp;mechanism=$mechanism&amp;body=$body&amp;glass=$glass&amp;minprice=$min&amp;maxprice=$max' class='li4'>NEXT</a> ";
              echo "<a href='bigsearch.php?pageno=$lastpage&amp;label=$label&amp;handover=$handover&amp;sex=$sex&amp;mechanism=$mechanism&amp;body=$body&amp;glass=$glass&amp;minprice=$min&amp;maxprice=$max' class='li4'>LAST</a> ";
            }
			echo "</p>";
            $error_count="Нет в наличии";
            foreach ($bigsearchs as $bigsearch) {
			echo "<div class='item'>";
			  echo "<div class='dimg'>";
			  echo "<img src='img/clocks/$bigsearch->img' alt='image'>";
			  echo "</div>"; 
			  $id=$bigsearch->id;
              echo "<font><strong>{$bigsearch->name}</strong></font><br>";
			  echo "<p class='text2'><strong>Механизм:</strong> {$bigsearch->mechanism}<br>";
			  echo "<strong>Корпус:</strong> {$bigsearch->body}<br>";
			  echo "<strong>Тип браслета:</strong> {$bigsearch->handover}<br>";
			  echo "<strong>Стекло:</strong> {$bigsearch->glass}<br>";
			  echo "<strong>Пол:</strong> {$bigsearch->sex}</p>";
			  if ($bigsearch->count!=0){
			    $found = FALSE;
				if ($_SESSION['korzina']) foreach ($_SESSION['korzina'] as $value) {
				if ($value == $id) {
				$found = TRUE;
	            break;
	              }
	            }  
				if ($found){
				  echo "<strong>Цена:</strong> {$bigsearch->price} Руб.";
		          echo "<p><font color='#300000'>Добавлены в корзину</font></p>";
	            }else{
				  echo "<strong>Цена:</strong> {$bigsearch->price} Руб.";
				  echo "<p><a href='bigsearch.php?kor=$id&amp;label=$label&amp;handover=$handover&amp;sex=$sex&amp;mechanism=$mechanism&amp;body=$body&amp;glass=$glass&amp;minprice=$min&amp;maxprice=$max&amp;pageno=$pageno' class='li2'>Добавить в корзину</a></p>";
				}
				}else{
			      echo "<p><font color='red'>$error_count</font></p>";
				}
			  echo "</div>"; 
			  }
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