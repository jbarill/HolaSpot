<?php
$url = $_SERVER['HTTP_HOST']; // do not change

$logo = "HolaSpot"; // This is the text that makes the logo
$siteTitle = "HolaSpot's Games"; // Website Title
$siteURL = "http://www.holspot.com/index.php"; // MUST add trailing slash / - for a subfolder/sub domain install use www.mywebsite.com/folder/to/site or http://arcade.mysite.com
$metaTagDescription = "HolaSpot Games free for play"; // This is for SEO (Search Engine Optimization) ex : <meta content='YOUR DESCRIPTION WILL DO HERE' name='Description'>
$metaTagKeywords = "HolaSpot, Games, news, Words"; // This is for SEO (Search Engine Optimization) ex : <meta content='YOUR, KEYWORDS, GO HERE' name='keywords'> - NOTE : Seprate each work with a comma, <
$adminEmail = "admin@holaspot.com"; // This is the FROM/REPLY TO email address people see when someone sends them books of the bible

// Settings to the mysql datbase infomation
$host = 'localhost';  // hostname to mysql server
$db = 'holaspot_games';  //  mysql Database name
$user = 'holaspot_user'; // mysql Database Username
$pass = 'p@ssw0rd'; // mysql Database password

@mysql_connect($host,$user,$pass);
@mysql_select_db($db);
?>