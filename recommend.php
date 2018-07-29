<?php
$title = $_REQUEST["title"];
$clust = $_REQUEST["cluster"];

$hostname=
$username =
$passwd =
$dbname =
    
$connect = mysql_connect($hostname,$username,$passwd)or die("Failed");
$result = mysql_select_db($dbname,$connect);
    
mysql_query("set names utf8");
$recquery="INSERT INTO recommend (clust,title) VALUES ('".$clust."', '".$title."')";
mysql_query($recquery,$connect);

$sqlrec = "SELECT * FROM recommend";
$mysql_rec = mysql_query($sqlrec,$connect);
$lastrecid=0;
$recid=0;
echo "<ol>";
while($inforec=mysql_fetch_array($mysql_rec)){
	if($inforec["clust"]==$clust){
		echo "<li>".$inforec["title"]."</li>";
	}
}
echo "</ol>";

mysql_close($connect);
?>
