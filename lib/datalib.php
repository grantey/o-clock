<?php
require_once('config.php');
function init_connection() 
{
	global $CFG;
	mysql_connect($CFG->host, $CFG->user, $CFG->password) or die("Failed to connect: ".mysql_error());
	mysql_select_db($CFG->database) or die("Failed to choose db: ".mysql_error());
	mysql_query("set names 'cp1251'") or die(mysql_error());
}
?>

<?php 
function get_search_listing($filter2,$limit) 
{
	if (isset($filter2) || strlen($filter2) != 0)
	{
		$query = "SELECT * FROM clocks WHERE name LIKE '%$filter2%' ORDER BY name $limit";
		$rs = mysql_query($query);
	}
	$result = array();
	while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) 
	{
		$item = new stdClass;
		$item->id= $row["id"];
		$item->name = $row["name"];
		$item->mechanism = $row["mechanism"];
		$item->body = $row["body"];
		$item->handover = $row["handover"];
		$item->glass = $row["glass"];
		$item->sex = $row["sex"];
		$item->img = $row["img"];
		$item->price = $row["price"];
		$item->count = $row["count"];
		$result []= $item;
	}
	return $result;
}
?>

<?php 
function get_bigsearch_listing($label, $sex, $handover, $mechanism, $glass, $body, $limit, $min, $max)
{
	if (strlen($min)!=0 and strlen($max)!=0)
	{
		$query = "SELECT * FROM clocks WHERE mark='$label' and sex LIKE '%$sex%' and handover LIKE '%$handover%' and mechanism LIKE '%$mechanism%' and glass LIKE '%$glass%' and body LIKE '%$body%' and price between '$min' and '$max' order by name $limit";
	}
	else
	{
		$query = "SELECT * FROM clocks where mark='$label' and sex LIKE '%$sex%' and handover LIKE '%$handover%' and mechanism LIKE '%$mechanism%' and glass LIKE '%$glass%' and body LIKE '%$body%' order by name $limit";
	}
	$rs = mysql_query($query);
	$result = array();
	while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) 
	{
		$item = new stdClass;
		$item->id= $row["id"];
		$item->name = $row["name"];
		$item->mechanism = $row["mechanism"];
		$item->body = $row["body"];
		$item->handover = $row["handover"];
		$item->glass = $row["glass"];
		$item->sex = $row["sex"];
		$item->img = $row["img"];
		$item->price = $row["price"];
		$item->count = $row["count"];
		$result []= $item;
	}
	return $result;
}
?>










