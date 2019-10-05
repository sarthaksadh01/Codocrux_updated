<?php
session_start();
if(isset($_SESSION['email'])){
  header("Location:begin.php");
}
?>



<html>
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <?php include("frontend/seo.php");?>

<link rel="stylesheet" href="frontend/css/login.css">
<script src="https://codepen.io/fbrz/pen/9a3e4ee2ef6dfd479ad33a2c85146fc1.js"></script>
<script src="frontend/js/jquery.js"></script>
<script src = "frontend/js/login.js"></script>
<title>Infox | Codocrux-login</title>
<style>
    .info{
        background: url();
    }
</style>
</head>

<body>

    <div id="loader-wrapper">
  <div id="loader"></div>

  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>

</div>
<div class="signupSection"  id="signup"  >


  <div class="info" >
    <h1><strong ><bold>CODOCRUX</bold></strong></h2>
    <h4>Oct 8, 2019 | 9:30PM-12AM</h4>


    <p id="crypt" style="text-align:center;font-size:20px;padding-top:50px;">
        For all the dynamic millenials out there !!!
        <br><br>
        It's time to bring light your logical and thinking skills. The event includes crossword ,quiz and ofcourse coding so come and join this mystifying experience.
        <br><br>
        <h2><bold>GOOD LUCK!</bold></h2>

</p>
  </div>
  <form   style="background:#001133" class="signupForm" name="signupform">
    <h2>Sign Up</h2>
    <ul class="noBullet">
      <li>
        <label for="username"></label>
        <input type="text" class="inputFields" id="name" name="username" placeholder="Name *" value="" />
      </li>
      <li>
        <label for="email"></label>
        <input type="email" class="inputFields" id="email" name="email" placeholder="Email *" value="" required/>
      </li>


<li>
        <label for="college"></label>
        <input type="text" class="inputFields" id="colg" name="college" placeholder="College/School" value="" required/>
      </li>


      <li>
        <label for="Course Year"></label>
        <input type="text" class="inputFields" id="crs" name="year" placeholder="Course/Class" value=""/>
      </li>
      <li>
        <label for="password"></label>
        <input type="password" class="inputFields" id="password" name="password" placeholder="Password *" value=""/>
      </li>
      <li  id="otp" style="display:none;">
        <label for="otp"></label>
        <input type="password" class="inputFields" id="otp2" name="otp" placeholder="OTP" value=""/>
      </li>



      <li id="center-btn" style=" padding-left:130px;" class="otps">
       <span> <h5 class="snd" type="" style="width:40px;" id="join-btn" name="join" alt="Join" value=""><span>join</span></h5></span>
               </li>
      <li id="center-btn" class="circle" style="display:none;             padding-left:150px;">

       <h5 class="loading" type="" style="width:30px;" id="join-btn" name="join" alt="Join" value=""><img src="Rolling-1s-28px.gif"></h5>
      </li>
      <li id="center-btn" class="otpr" style="display:none; width:30px;padding-left:150px;">
        <h4  type="submit" style="width:30px;" class="rotp" id="join-btn" name="join" alt="Join" value="">Verify</h4>
      </li>


    </ul>
    <h4 id="al" onclick="login();">Already joined! login here</h4>
    <a href="team.php" target="_blank" style="color:#fff;"><strong>For any queries Click here!</strong></a><br><br>
     <a href="https://infoxpression.in/" target="_blank" style="color:#fff;">*INFOXPRESSION 2019</a>
     <br><br>
    <a href="https://www.facebook.com/infoxpression/" target="_blank" style="color:#fff;">* LIKE OUR PAGE FOR UPDATES </a>
  </form>
</div>
<div class="signupSection" style="display:none;" id="login" >

<div class="info">
<h2>Codocrux-Rules!</h2>
    <i class="icon ion-ios-ionic-outline" aria-hidden="true"></i>
    <p style="text-align:left">

•	The contest comprises of 9 questions in total. The duration of the contest is 2.5 hours.<br><br>
•	The participants can move to the next question only if they have answered the current question correctly. <br><br>
•	Leaderboard rankings will be decided based on the time taken by the participants to complete the contest.<br>
</p>
  </div>

<form action="#" method="POST"  style="background:#001133" class="signupForm" name="signupform">
    <br><br>
    <h2>Login here</h2>
    <br><br>
    <ul class="noBullet">
    <li>
        <label for="email"></label>
        <input type="email" class="inputFields" id="email1" name="email" placeholder="Email" value="" required/>
      </li>
        <label for="password"></label>
        <input type="password" class="inputFields" id="password1" name="password" placeholder="Password" value=""  required/>
      </li>
      <li id="center-btn" style=" padding-left:150px;"  class="monga">
        <h5 type="submit" class="log" style="width:50px" id="join-btn" name="join" alt="Join" value="">Log in</h5>
      </li>
       <li id="center-btn" class="circle" style="display:none;             padding-left:150px;">

       <h5 class="loading" type="" style="width:30px;" id="join-btn" name="join" alt="Join" value=""><img src="Rolling-1s-28px.gif"></h5>
      </li>
    </ul>
    <h4 id="al" onclick="signup()">Want to join! Click here</h4>
     <a href="team.php" target="_blank" style="color:#fff;"><strong>For any queries Click here!</strong></a>
<br><br>
    <a href="https://infoxpression.in/" target="_blank" style="color:#fff;">*INFOXPRESSION 2019</a><br><br>
    <a href="https://www.facebook.com/infoxpression/" target="_blank" style="color:#fff;">* LIKE OUR PAGE FOR UPDATES </a>

  </form

</div>







</body>
</html>
