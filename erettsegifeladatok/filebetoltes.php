<?php
//ize.txt
$myfile = fopen("ize.txt", "r") or die("Unable to open file!");
//echo fread($myfile,filesize("ize.txt"));
echo "<br>*********<br>";
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
?>