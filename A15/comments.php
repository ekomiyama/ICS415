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

<script>
$(document).ready(function() {
	$('#submit').click(function() {
		location.reload();
	});

	$('#logout').click(function() {
		location.reload();
	});

});

</script>

<table id="comments">
<?PHP
$mysqli = mysqli_connect("localhost","ics415", "","ics415");

if(! mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS Comments(CommentNo int NOT NULL AUTO_INCREMENT,User varchar(255), Comment varchar(255), PRIMARY KEY (CommentNo));")) {
 echo "ERROR: create table 'Comments' failed";
} else {
//Do Nothing
}

if(isset($_POST['logout'])) {

setcookie('CurrentUser', '', time()-3600);

$res = $mysqli->query("SELECT * FROM Comments"); 

While($row = $res->fetch_assoc()) {
  echo "<tr><td>".$row['User']."<br><br>___________________</br></br></td><td>".$row['Comment']."<br><br>__________________________</br></br></td></tr>";
}

}else if(isset($_POST['submit'])) {

  if(! isset($_COOKIE['CurrentUser'])) {
    setcookie('CurrentUser', $_POST['username'], time()+3600);
	$user = $_POST['username'];
  }else {
	$user = $_COOKIE['CurrentUser'];
  }

 $submission = $_POST['inputArea'];
 
 
 mysqli_query($mysqli, "INSERT INTO Comments(User, Comment) VALUES('$user','$submission');");
 
$res = $mysqli->query("SELECT * FROM Comments"); 

While($row = $res->fetch_assoc()) {
  echo "<tr><td>".$row['User']."<br><br>___________________</br></br></td><td>".$row['Comment']."<br><br>__________________________</br></br></td></tr>";
}
}else if(! isset($_POST['submit'])) {
$res = $mysqli->query("SELECT * FROM Comments");
While($row = $res->fetch_assoc()) {
  echo "<tr><td>".$row['User']."<br><br>___________________</br></br></td><td>".$row['Comment']."<br><br>__________________________</br></br></td></tr>";
}
}

?>

</table>

<div id="commentSection">
<form method="post" action="<?PHP echo $_SERVER['PHP_SELF'];?>">
<?PHP 
if(! isset($_COOKIE['CurrentUser'])) {
	echo "<div>Username: <input type='text' name='username'></div>";
}else {
	echo "<div>Welcome, ".$_COOKIE['CurrentUser']."!</div>";
}
?>
<textarea rows="10" cols="50" name="inputArea"></textarea>
<input type="submit" name="submit" id="submit" value="Submit">
<?PHP
if(isset($_COOKIE['CurrentUser'])) {
echo "<input type='submit' name='logout' id='logout' value='Logout'>";
}
?>
</form>
</div>
<table>
<?PHP
$index = 0;
$nameArray = array();
$countArray = array();

$res = $mysqli->query("SELECT * FROM Comments"); 
While($row = $res->fetch_assoc()) {
	$isUsed = 0;
	$index = 0;
	foreach($nameArray as $name) {
		if($row['User'] == $name) {
			$isUsed = 1;
			$countArray[$index] = $countArray[$index] + 1;
		}
		$index = $index + 1;
	}
	
	if($isUsed != 1) {
		$nameArray[count($nameArray)] = $row['User'];
		$countArray[count($countArray)] = 1;
	}
}

$count = 0;
echo "<tr><td>"Name"</td><td>"Msg '#'"</td><tr>";
while($count < count($nameArray)) {
echo "<tr><td>".$nameArray[$count]."</td><td>".$countArray[$count]."</td><tr>";
$count = $count + 1;
}
?>
</table>
</body>

</html
