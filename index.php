<?php session_start();?>
<?php
echo 'site under construction123';

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
<meta name="description" content="� ����� ������ �������� ������������ ������ �������� ����� ����������� �����, ������, ����������� ��� ������ �������� ��������� �������, � ����� ���� �� ���� ������ �����.">
<meta name="keywords" content="����, ��������-�������, �������, ������������ ����">
<title>��������-������� �����</title>
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
        <p class="text">��������� ����������! �������� ������� ����� ������������� � ������� ������������ ����, ����������� � ������ ������ ����� ����������� ��������������. ����� �������� ���� ��������, ��� ��� ����, ����������� � ����� ��������-��������, ����� ���������� ���������� ������������, ���������� �� ������� �����, � ����� ��������� ����������� ������.</p>
        <p class="text">� ����� ������ �������� ������������ ������ �������� ����� ����������� �����, ������, ����������� ��� ������ �������� ��������� �������, � ����� ���� �� ���� ������ �����.</p>
        <p  class="text">������ ��������� ������ ����� ����� ������ ����� ����� "�������" ��� ���������� � ���������-������������� �������� ����� �������� �� ������� ��������.</p>
        <div class="label"><font size="+1"><strong>��������� �����������</strong></font></div>
          <?php 

		   $rs=mysql_query("select * from clocks order by id desc limit 2");// or die(mysql_error());  
			$error_count="��� � �������";      
            while ($row=mysql_fetch_array($rs)){
			$id=$row['id'];
        	echo "<div class='item'>";
			  echo "<div class='dimg'>";
			  echo "<img src='img/clocks/$row[img]' alt='image'>";
			  echo "</div>"; 
              echo "<font><strong>$row[name]</strong></font><br>";
			  echo "<p class='text2'><strong>��������:</strong> $row[mechanism]<br>";
			  echo "<strong>������:</strong> $row[body]<br>";
			  echo "<strong>��� ��������:</strong> $row[handover]<br>";
			  echo "<strong>������:</strong> $row[glass]<br>";
			  echo "<strong>���:</strong> $row[sex]</p>";
                if ($row['count']!=0){
				  $found = FALSE;
				  if ($_SESSION['korzina']) foreach ($_SESSION['korzina'] as $value) {
				  if ($value == $id) {
				  $found = TRUE;
	              break;
	              }
	              }  
				  if ($found){
				  echo "<strong>����:</strong> $row[price] ���.";
		          echo "<p><font color='#300000'>��������� � �������</font></p>";
	              }
				  else{
				  echo "<strong>����:</strong> $row[price] ���.";
				  echo "<p><a href='index.php?kor=$id' class='li2'>�������� � �������</a></p>";  //onclick='callFunction(); return false;' 
				}
				}else{
			      echo "<p><font color='red'>$error_count</font></p>";
				  }
			echo "</div>";	
			}
		  ?>
        <div class="label" style="margin-top:250px;"><font size="+1"><strong>�����!</strong></font></div>
	<p  class="text">�� ����������� ������ ����� ���.</p>
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