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
$mysqli = mysqli_connect("localhost","ics415", "","ics415");

if(! mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS Comments(CommentNo int NOT NULL AUTO_INCREMENT, Comment varchar(255), PRIMARY KEY (CommentNo));")) {
 echo "ERROR: create table 'Comments' failed";
} else {
//Do Nothing
}

if(! isset($_POST['submit'])) {
$res = $mysqli->query("SELECT * FROM Comments");
While($row = $res->fetch_assoc()) {
  echo $row['Comment']."<br><br>____________________________________________________<br><br>";
}
}else if(isset($_POST['submit'])) {

 $submission = $_POST['inputArea'];
 
 mysqli_query($mysqli, "INSERT INTO Comments(Comment) VALUES('$submission');");
 
$res = $mysqli->query("SELECT * FROM Comments"); 

While($row = $res->fetch_assoc()) {
  echo $row['Comment']."<br><br>____________________________________________________<br><br>";
}
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

</html
