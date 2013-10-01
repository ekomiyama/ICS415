<!DOCTYPE html>
<html>
<head>
<style type="text/css">
#commentSection {
  padding-top: 20px;
}

#comments {
  width:33%;
  background-color: #3399FF;


}

</style>
</head>

<body>
<h1> COMMENTS </h1>
<div id="comments">
<?PHP
  if(! isset($_POST['submit'])) {
  $formFile = "formSubmissions.txt";
  $line = "";
  if(! file_exists($formFile)) {
	return;
  }
  
  $file = fopen($formFile, "r");
  
  while(! feof($file)) {
   
	$line = fgets($file);
	if($line != "") {
	echo $line."<br><br>____________________________________________________<br><br>";
	}
  
  }
  
  fclose($file);
  } else if(isset($_POST['submit'])) {

  $submission = $_POST['inputArea'];
  $formFile = "formSubmissions.txt";
  $line = "";
  $file;
  if(! file_exists($formFile) || ($submission == "")) {
	return;
  }
  $submission = $submission."\n";
  $file = fopen($formFile, "a+");
  fwrite($file, $submission);
  fclose($file);
  
  $formFile = "formSubmissions.txt";
  $line = "";
  if(! file_exists($formFile)) {
	return;
  }
  
  $file = fopen($formFile, "r");
  
  while(! feof($file)) {
	$line = fgets($file);
	if($line != "") {
	echo $line."<br><br>____________________________________________________<br><br>";
	}
  }
  fclose($file);
  }
?>

</div>

<div id="commentSection">
<form method="post" action="<?PHP echo $_SERVER['PHP_SELF'];?>">
<textarea rows="10" cols="50" name="inputArea"></textarea>
<input type="submit" name="submit" value="Submit">
</form>
</div>

</body>

</html>
