<?php
	require("system.class.php"); 

$sys = new GamesSystem();
if(isset($_GET['act']) && isset($_GET['id']) && $_GET['act'] == 'play'){
	$sys->addPlay($_GET['id']);
}
$sys->Load(); 
?>
<!DOCTYPE HTML>  
<html>
<!--- I did not code this page, I just implemented in my website and modified some lines --->
<head>
	<META http-equiv=Content-Type content="text/html; charset=utf-8">
	<title><? echo $siteTitle; ?></title>
	<meta content='<? echo $metaTagDescription; ?>' name='Description'>
	<meta content='<? echo $metaTagKeywords; ?>' name='keywords'>
	<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
<!-- favico -->
  <link rel="shortcut icon" href="/h_favicon.ico" type="image/x-icon">
	<link rel="icon" href="/h_favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="site.css">
	<script type="text/javascript" src="js/pulldownchanger.js"></script>
</head>
<body>
	<div class="wrapper">
	<div class="head">
	<div class="top" style="height: auto !important; height: 100%">
		<table border="0" cellspacing="0" style="border-collapse: collapse" width="800">
			<tr>
				<td width="300"><a href="<? echo $siteURL; ?>"><img src="http://www.holaspot.com/chat/images/logo.jpg" border="0" alt="<? echo $siteTitle; ?>" title="<? echo $siteTitle; ?>"></a></td>
				<td width="440" class="headertext">Welcome to <? echo $logo; ?>, Free online games. Including arcade games, action games, sports games, puzzle games, flash games and more. NO DOWNLOADING needed - Updated every week with lots of new games!</td>
			</tr>
		</table>
	<div class="clear"></div>
	</div>
	<div class="menu">
	<div style="float: left;margin-top: 3px;margin-left: 5px;">
		<?php
			$plays = $sys->getPlaysToday();
			if($plays != ''){
		?>
		There have been <?php echo $plays; ?> games played today.
		<?php
		} ?>
	</div>
	<div style="float:right">
		<select name="games" id="games" onchange="switchme()">
		<option selected>Select a Game</option>
		<option class="headname" value="<?php echo $_SERVER['PHP_SELF']; ?>">Games List</option>
		<?php
		// makes list of options
			echo $sys->makeOptionList();
		?>
		</select>
	</div>
	<div class="clear"></div>
	</div>
	</div>
	<div class="body">
	<div class="core">
		<?php
			if(!isset($_GET['act']) || $_GET['act'] != 'play'){
			echo $sys->makeGamesList();
			} else {
			if(isset($_GET['id'])){
			echo $sys->makeGameHtml($_GET['id'], $_GET['cid']);
			} else {
			echo '<div style="margin: 30px;">
			<strong>Error: </strong>Invalid Input<br><br>
			<a href="'.$_SERVER['PHP_SELF'].'">Click here to return Home</a>
			</div>';
			}
		}
		?>
	</div>
<div class="right">
		<?php
			echo $sys->doMostPlayed();
		/* for most played, you can also use
		echo $sys->doMostPlayed(x);
		Where x = the ammount of games you wish to display.
		This same methods works for doNewestGames()
		Default for these functions is 10
		*/
			echo $sys->doNewestGames();
		?>
		<p>
		<a href="http://validator.w3.org/check?uri=referer"><img class="w3c" src="http://www.w3.org/Icons/valid-html401-blue" alt="Valid HTML 4.01 Transitional" height="31" width="88"></a>
		</p>
	</div>
	<div class="clear"></div>
	</div>

	</div>
</body>
</html>