<?php

      require_once "config.php";

      $nameErr=$lnameErr=$userErr=$passwordErr=$pswdcnfErr="";
      $name=$lname=$username=$password=$pswdcnf="";

      if(isset($_POST["signup"])) {
        if (empty($_POST["firstName"])) {
          $nameErr = "This field is required";
        }
        else {
        $name=test_input($_POST["firstName"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
          $nameErr = "<br>Only letters and white space allowed";
        }
        }

        if (empty($_POST["lastName"])) {
            $lnameErr = "This field is required";
          }
          else {
          $lname=test_input($_POST["lastName"]);
          if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
            $lnameErr = "Only letters and white space allowed";
          }
        }

        if(!empty($nameErr)||!empty($lnameErr)){
           $nameErr="<br>Only letters and white spaces allowed";
        }

        if (empty($_POST["username"])) {
          $userErr = "This field is required";
        } else {
          $username=test_input($_POST["username"]);
          $sql = "SELECT * FROM person WHERE UserName='$username'";
          $result = mysqli_query($db, $sql);
          $countRow = mysqli_num_rows($result);

          if($countRow>0){
            $userErr="<br>Username already exists";
          }

        }


        if (empty($_POST["password"])) {
          $passwordErr = "This field is required";
        } else {
        $password=test_input($_POST["password"]);}
	 if(strlen($_POST["password"])<6){
           $pswdcnfErr="<br>Password should contain at least 6 characters";
         }
	 else if($_POST["password"]!=$_POST["pswdcnf"]){
            $pswdcnfErr="<br>Passwords do not match";
      	}
        if($nameErr=="" && $lnameErr=="" && $userErr=="" && $passwordErr=="" && $pswdcnfErr==""){
            $sql="INSERT INTO person VALUES ('$name','$lname','$username','$password');";
	    mysqli_query($db,$sql);
            $new="CREATE TABLE $username(Book varchar(100),Author varchar(50));";
            mysqli_query($db,$new);
            header("Location: success.php");
            exit();
        }
      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
     ?>



<html>
  <head>
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="row">
    <div class="col4" style="width: 38%;"></div>
    <div class="col4" style="width: 25%;">
    <form style="text-align: left" class="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <fieldset>
        <legend><h2>Setup Your Account</h2></legend>
        Name <br> <input style="border: 2px solid;" type="text" placeholder="First" name="firstName" value="<?php echo $name;?>" required><tr>
        <br>
        <input type="text" style="border: 2px solid;" placeholder="Last" name="lastName" value="<?php echo $lname;?>" required>
        <span class="invalid"><?php echo $nameErr;?></span><br>
        Username<br> <input type="text" style="border: 2px solid;"  placeholder="Username" name="username" value="<?php echo $username;?>" required>
        <span class="invalid"><?php echo $userErr;?></span><br>
        Password<br>
        <input type="password" style="border: 2px solid;" name="password" value="<?php echo $password;?>" required><br>
        Confirm Password<br>
        <input type="password" style="border: 2px solid;" name="pswdcnf" value="<?php echo $pswdcnf;?>" required>
        <span class="invalid"><?php echo $pswdcnfErr;?></span><br><br>
        <input style="border: none;width: 80px;height: 30px;margin-left: 100px;" type="submit" name="signup" value="Sign Up">
      </fieldset>
    </form>
    </div>
    <div class="col4"></div>
    </div>
  </body>

</html>
