<td width="17%" valign="top">     
<form class="form">
<?php
$rs = mysql_query( "select categories.id, categories.name as name, labels.id as lab from categories LEFT JOIN labels ON categories.id=labels.category group by categories.id");

while ($row = mysql_fetch_array($rs,MYSQL_ASSOC)) {
$c_name=$row["name"];
$id=$row["id"];

echo "<font size='+1'><strong>$c_name</strong></font><br>";

$rs2 = mysql_query( "select id, label from labels where category=$id order by label") or die(mysql_error());
    
while ($row2 = mysql_fetch_array($rs2,MYSQL_ASSOC)) {
$label=$row2["label"];
$id2=$row2["id"];
echo "<a class='li' href='clocks.php?mark=$id2'>$label</a><br>";
}
echo"<br>";
}
?>
</form>
</td>