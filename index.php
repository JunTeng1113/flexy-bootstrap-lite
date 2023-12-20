<!DOCTYPE html>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />

    <!--====== Title ======-->
    <title>eCommerce HTML | Login</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/png"
    />

    <!--====== Tiny Slider CSS ======-->
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css" />

    <!--====== Material Design Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <!--====== gLightBox CSS ======-->
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />

    <!--====== nouiSlider CSS ======-->
    <link rel="stylesheet" href="assets/css/nouislider.min.css" />

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/css/default.css" />

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/style.min.css" />
  </head>

  <body>

<?php
    if(isset($_REQUEST['email']))
    {
      $email=$_REQUEST['email'];
      $password=$_REQUEST['password'];

      echo "email=$email password=$password";

      include("connectdb.php");
      include("basic.php");
      $sql = "SELECT seq,username,role,gender FROM user where email='$email' and password='$password'";
      $result =$connect->query($sql);

      if($row = $result->fetch_assoc())
      {
        $seq=$row['seq'];
        $username=$row['username'];
        $role=$row['role'];
        $gender=$row['gender'];      
        
        echo "role=$role gender=$gender username =$username  seq=$seq";
        session_start();
        $_SESSION['seq'] =$seq;
        $_SESSION['role']=$role;
        $_SESSION['gender']=$gender;
        $_SESSION['email']=$email;
        $_SESSION['username']=$username;

        switchto("home.php");

      
      }
      else  echo "login fail!";


    }


?>
    


    <!--====== Navbar White Page Banner Part Ends ======-->

    <!--====== Login Part Start ======-->

    <section class="login-registration-wrapper pt-50 pb-100">
      <div class="container">
        <div class="row">
        <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <div class="login-registration-style-1 mt-50">
              <h1 class="heading-4 font-weight-500 title">
                Login to your account
              </h1>
              <ul>
                <li>
                  <a href="#0" class="facebook-login-registration"
                    ><i class="lni lni-facebook-original"></i>
                    <span>Login with Facebook</span></a
                  >
                </li>
                <li>
                  <a href="#0" class="google-login-registration"
                    ><img src="assets/images/google-logo.svg" alt="" />
                    <span>Login with Google</span></a
                  >
                </li>
              </ul>
              <p class="account">or Log In with Email</p>
              <div class="login-registration-form pt-10">
                <form action="index.php" method='post'>
                  <div class="single-form form-default form-border">
                    <label>Email Address</label>
                    <div class="form-input">
                      <input type="email" name='email' placeholder="user@email.com" />
                      <i class="mdi mdi-email"></i>
                    </div>
                  </div>
                  <div class="single-form form-default form-border">
                    <label>Choose Password</label>
                    <a class="forget" href="#0">Forget Password?</a>
                    <div class="form-input">
                      <input name='password'   id="password"   type="password"    placeholder="Password"/>
                      <i class="mdi mdi-lock"></i>
                      <span
                        toggle="#password-1"
                        class="mdi mdi-eye-outline toggle-password"
                      ></span>
                    </div>
                  </div>
                  <div class="single-checkbox checkbox-style-3">
                    <input type="checkbox" id="login-1" />
                    <label for="login-1"><span></span> </label>
                    <p>Remember Me</p>
                  </div>
                  <div class="single-form">
                    <button class="main-btn primary-btn">Signin</button>
                  </div>
                </form>
              </div>
              <p class="login">
                Don’t have an account? <a href="#0">Sign up</a>
              </p>
            </div>
          </div>