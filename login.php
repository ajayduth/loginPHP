<?php

    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]===true){
      header("Location: welcome.php");
      exit;
    }

    require_once "config.php";
    $err="";
    if(isset($_POST['login']))
    {
      $username=$_POST['userName'];
      $pswd=$_POST['password'];
      if( !empty($_POST['userName']) && !empty($_POST['password'])){
        $sql="SELECT FirstName FROM person WHERE UserName='$username' and Password='$pswd';";
	      $result=mysqli_query($db,$sql);
        $countRow=mysqli_num_rows($result);
        if($countRow>0){
              $name1=$result->fetch_assoc();
                session_start();
                $_SESSION["loggedin"]=true;
                $_SESSION["name"]=$name1["FirstName"];
                $_SESSION["username"]=$username;
	        header("Location: welcome.php");
          exit();
        }
        else{
           $err="Invalid Username or Password";
        }
      }
    }
?>


<html>
  <head>
   <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="row">
    <div class="col4"></div>
    <div class="col4">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <fieldset>
       <legend> <h2>LOGIN</h2></legend>
        <img src="images/user.png" style="width:40">
        <input type="text" placeholder="Enter Username" name="userName" required> <br>
        <br> <img src="images/password.png" style="width:40">
        <input type="password" placeholder="Enter Password" name="password" required> <br>
        <span class="invalid"><?php echo $err."<br>";?></span>
        <br>
        <input style="border: none;width: 80px;height: 30px;" type="submit" name="login" value="Log In">
      </fieldset>

      <br><a href="signup.php"><img src="images/signup1.jpg" style="width:100px; align: center"></a></p>
    </form>
    </div>
    <div class="col4"></div>
    </div>
  </body>

</html>

