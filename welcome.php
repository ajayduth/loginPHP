<?php


  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: login.php");
    exit;
  }
?>


<?php
require_once "config.php";
if(isset($_POST["add"])){
$table=$_SESSION["username"];
$book=$_POST["book"];
$author=$_POST["author"];
$sql="INSERT INTO $table VALUES('$book','$author');";
mysqli_query($db,$sql);
}
if(isset($_POST["remove"])){
$table=$_SESSION["username"];
$book=$_POST["book"];
$author=$_POST["author"];
$sql="DELETE FROM $table WHERE Book='$book' AND Author='$author';";
mysqli_query($db,$sql);

}
?>
<html>
<head>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
<a class="top-right" href="logout.php"><input style="width: 80px; height: 50px;" type="button" value="Log Out"></a>
<div class="container">
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10 goodtogo">
<h2><?php echo "Welcome ".$_SESSION["name"];?></h2>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2>Bucket List</h2>
        <img src="images/book1.jpeg" style="width: 60px">
        <input type="text" placeholder="Enter Bookname here" name="book" required>
        <img src="images/author.png" style="width: 50px">
        <input type="text" placeholder="Enter Authorname here" name="author" required>
        <input style="border: none;width: 80px;height: 30px;" type="submit" name="add" value="Add">
        <input style="border: none;width: 80px;height: 30px;" type="submit" name="remove" value="Remove">
    </form>
<?php
       $table=$_SESSION["username"];
       $sql="SELECT * FROM $table;";
       $result=mysqli_query($db,$sql);
?>

<table style="width: 100%">
<tr><th>Book Name</th><th>Author</th>
</tr>
<?php
  while($name=$result->fetch_assoc()){
  echo "<tr>"."<td>".$name["Book"]."</td>"."<td>".$name["Author"]."</td>"."</tr>";
 }
?>
</table>
</div>
<div class="col-md-1"></div>
</div>
</div>
</body>
</html>


