<!doctype html>
<?php
ob_start();
$con = mysql_connect("localhost", "root", "");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }else{
  $db_selected = mysql_select_db("ledatabase",$con);
}
  ?>