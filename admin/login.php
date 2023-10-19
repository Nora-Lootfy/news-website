<?php

session_start();


if (isset($_SESSION["logged"]) and $_SESSION["logged"]) {
    header("Location: users.php") or die();
}

require_once "../includes/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["login_form"])) {
        try {
            $username = $_POST["login_form"]["username"];
            $password = $_POST["login_form"]["password"];

            $sql = "SELECT * from `news_db`.`users` WHERE `username`  = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username]);

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $hashed_password = $row["password"];
                $active = $row["active"];
                $password_verified  = password_verify($password, $hashed_password);

                if ($password_verified and $active) {
                    $_SESSION["logged"] = true;
                    $_SESSION["user"] = [
                        "fullname" => $row["fullname"],
                        "id" => $row["id"],
                        "supervisor" => $row["supervisor"]
                    ];
                    header("Location: users.php") or die();
                } else {
                    echo "There is a problem in login. It maybe in username or password. 
                    If you are sure about username and password, try to contact the admin to solve the problem ";
                }

            }else {
                echo "No such a username or password";
            }
        } catch (PDOException $e) {
            echo "Error in posting loginform handling login.php: " . $e->getMessage();
        }
    } elseif (isset($_POST["signup_form"])) {
        try {
            $fullname = $_POST["signup_form"]["fullname"];
            $username = $_POST["signup_form"]["username"];
            $email = $_POST["signup_form"]["email"];
            $password = password_hash($_POST["signup_form"]["password"], PASSWORD_DEFAULT);

            $sql = "INSERT INTO `news_db`.`users` (`fullname`, `username`, `email`, `password`) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fullname, $username, $email, $password]);

//           echo "Inserted Successfully";
        } catch (PDOException $e) {
            echo "Error in posting singupform handling login.php: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>News Admin | Login/Register</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?= $_SERVER["PHP_SELF"]?>" method="POST"  id="login_form">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required name="login_form[username]" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required  name="login_form[password]"/>
              </div>
              <div>
                <a class="btn btn-default submit" href="javascript:document.getElementById('login_form').submit();">Log in</a>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-newspaper-o"></i></i> News Admin</h1>
                  <p>©2016 All Rights Reserved. News Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="<?= $_SERVER["PHP_SELF"]?>" method="POST" id="signup_form">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Fullname" required name="signup_form[fullname]" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Username" required name="signup_form[username]" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required name="signup_form[email]" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required name="signup_form[password]"/>
              </div>
              <div>
                <a class="btn btn-default submit" href="javascript:document.getElementById('signup_form').submit();">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-newspaper-o"></i></i> News Admin</h1>
                  <p>©2016 All Rights Reserved. News Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
