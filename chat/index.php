<?php 
    session_start();

    if (!isset($_SESSION['userid'])): 
?>

<!DOCTYPE html>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <!-- Description of MovieNow -->
  <meta name="description" content="Chat with your friends" />
  <!-- Author or Authors of MovieNow -->
  <meta name="author" content="Not Me" />
  <!-- Keywords (recognized by certain search engines -->
  <meta name="keywords" content="text, chat" />
  <!-- favicon -->
  <link rel="shortcut icon" href="/h_favicon.ico" type="image/x-icon">
	<link rel="icon" href="/h_favicon.ico" type="image/x-icon">
    
    <title>HolaChat</title>
    
    <link rel="stylesheet" type="text/css" href="main.css" />
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2" type="text/javascript"></script>
    <script type="text/javascript" src="http://www.holaspot.com/chat/check.js"></script>
</head>

<body>

    <div id="page-wrap"> 
    
    	<div id="header">
        	<h1><a href="../index.html">HolaSpot</a></h1>
        </div>
        
    	<div id="section">
        	<form method="post" action="jumpin.php">
            	<label>Desired Username:</label>
                <div>
                	<input type="text" id="userid" name="userid" />
                    <input type="submit" value="Check" id="jumpin" />
            	</div>
            </form>
        </div>
        
        <div id="status">
        	<?php if (isset($_GET['error'])): ?>
        		<!-- Display error when returning with error URL param? -->
        	<?php endif;?>
        </div>
        
    </div>
    
</body>

</html>

<?php 
    else:
        require_once("http://www.holaspot.com/chat/chatrooms.php");
    endif; 
?>