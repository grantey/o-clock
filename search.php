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

            $filter2 = '';
			$filter2=$_GET['filter2'];
            if (isset($_POST['filter2'])) $filter2 = $_POST['filter2'];

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

		    $query = "SELECT count(*) FROM clocks where name LIKE '%$filter2%'";
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
			

            $searchs = get_search_listing($filter2,$limit);
			?>

          <?php 
		  if (strlen($filter2) == 0){
				echo "<p align='center'><font color='#300000' size='+1'>Вы не ввели данные для поиска</font></p>";
			}else{

		  echo"<p align='center'>";
			if ($pageno == 1) {
              echo " ";
            }else{ if($pageno != 0){
              echo "<a href='search.php?pageno=1&amp;filter2=$filter2' class='li4'>FIRST</a> ";
              $prevpage = $pageno-1;
              echo " <a href='search.php?pageno=$prevpage&amp;filter2=$filter2' class='li4'>PREV</a> ";
            }}
            echo " (Page $pageno of $lastpage) ";
            if ($pageno == $lastpage) {
              echo " ";
            }else{
              $nextpage = $pageno+1;
              echo "<a href='search.php?pageno=$nextpage&amp;filter2=$filter2' class='li4'>NEXT</a> ";
              echo "<a href='search.php?pageno=$lastpage&amp;filter2=$filter2' class='li4'>LAST</a> ";
            }
			echo "</p>";
            $error_count="Нет в наличии";
            foreach ($searchs as $search) {
			echo "<div class='item'>";
			  echo "<div class='dimg'>";
			  echo "<img src='img/clocks/$search->img' alt='image'>";
			  echo "</div>"; 
			  $id=$search->id;
              echo "<font><strong>{$search->name}</strong></font><br>";
			  echo "<p class='text2'><strong>Механизм:</strong> $search->mechanism<br>";
			  echo "<strong>Корпус:</strong> $search->body<br>";
			  echo "<strong>Тип браслета:</strong> $search->handover<br>";
			  echo "<strong>Стекло:</strong> $search->glass<br>";
			  echo "<strong>Пол:</strong> $search->sex</p>";
			  if ($search->count!=0){
			    $found = FALSE;
				if ($_SESSION['korzina']) foreach ($_SESSION['korzina'] as $value) {
				if ($value == $id) {
				$found = TRUE;
	            break;
	              }
	            }  
				if ($found){
				  echo "<strong>Цена:</strong> $search->price Руб.";
		          echo "<p><font color='#300000'>Добавлены в корзину</font></p>";
	            }else{
				  echo "<strong>Цена:</strong> $search->price Руб.";
				  echo "<p><a href='search.php?kor=$id&amp;filter2=$filter2&amp;pageno=$pageno' class='li2'>Добавить в корзину</a></p>";
				}
				}else{
			      echo "<p><font color='red'>$error_count</font></p>";
				}
			  echo "</div>"; 
			  }
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