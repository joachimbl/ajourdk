<?php

header('Location: http://ajour.dk');
die();

define('DB_NAME', 'ajourdk');
define('DB_USER', 'ajourdk');
define('DB_PASSWORD', 'ruoja');
define('DB_HOST', 'Localhost');

$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
$db = mysql_select_db(DB_NAME);


$q = mysql_query("select * from test order by id");
while($o = mysql_fetch_object($q)) {
	$title[$o->id] = $o->title;
}



$q = mysql_query("select * from ajour_posts where post_title='' AND post_parent=''");
while($o = mysql_fetch_object($q)) {
	print $o->ID . " - " . $o->post_parent . " - " . $o->post_title . "\n";

	//print $o->ID . " - " . $title[$o->post_parent] . "\n";
	//mysql_query("UPDATE ajour_posts SET post_title='" . $title[$o->post_parent] . "' WHERE ID='" . $o->ID . "'");
}

