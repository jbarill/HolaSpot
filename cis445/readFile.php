<?php
$myfile = fopen("http://web.calstatela.edu/faculty/pthomas/CIS320/DDS/nyt3.csv", "r") or die("Unable to open file!");
// Output one character until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) <br>;
}
fclose($myfile);
?> 


