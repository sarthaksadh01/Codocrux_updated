<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
function connect_to_database()
{
    $link = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","b2935a1eb069ef","aee5efc4","heroku_cd87107b3c6ab97");
    if(mysqli_error($link))
    {
      die("Failed connecting to databse.. Please try again!");
    }
    else return $link;
}

function check_if_login(){
    if(isset($_SESSION['email'])){
        return 1;
    }
    else return 0;
}


function get_s_e(){
    $link = connect_to_database();
$query = "SELECT * FROM `time` WHERE id ='1'";
  $result = mysqli_query($link,$query);

  if($result){

    $row = mysqli_fetch_assoc($result);


    $st=$row['s_time'];
    $et=$row['e_time'];
    $sj=$row['start_time'];
    $ej=$row['end_time'];
  $s = strtotime(".$st.");
 $e = strtotime(".$et.");
 $ar =array(
     "s"=>$s,
     "e"=>$e,
     "sj"=>$sj,
     "ej"=>$ej

     );
 return $ar;
}
else("Error....");
}
function send_otp($email,$name)

{

  $otp = mt_rand(111111, 999999);


  $to = $email;
$subject = "Codocrux Otp!";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
  <h2>Hey ".$name." ! your <b>Otp</b> for Codocrux registration is :".$otp." </h2>
  <h1>Codocrux-Rules!</h1>
  •	The contest comprises of 10 questions in total. The duration of the contest is 3 hours.<br><br>

  •	The participants can move to the next question only if they have answered the current question correctly.<br><br>


  •	Leaderboard rankings will be decided based on the time taken by the participants to complete the contest.<br><br>

  •     Hints for various questions will be disclosed on the infoxpression facebook page.
  <h2>For any queries</h2>
  <p>Avik Pandey : 9910758350</p>
  <p>Bhanuja Aggarwal   : 9871332989</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <codocrux.infoxpression.in>' . "\r\n";





  if(mail($to,$subject,$message,$headers))
  {
    return $otp;
  }

  else return 0;




}

function get_current_q(){
    $email = $_SESSION['email'];
  $link = connect_to_database();
  $query = "SELECT prob FROM `users` WHERE email = '$email'";
  $result =mysqli_query($link,$query);
  if($result){
      $row = mysqli_fetch_assoc($result);
      return $row['prob'];
  }
  else return 0;


}

function get_candy(){
    $email = $_SESSION['email'];
  $link = connect_to_database();
  $query = "SELECT candy FROM `users` WHERE email = '$email'";
  $result =mysqli_query($link,$query);
  if($result){
      $row = mysqli_fetch_assoc($result);
      return $row['candy'];
  }
  else return -1;


}

function load_q(){

  $q_no =get_current_q();
  $link = connect_to_database();
  $query = "SELECT * FROM `questions` WHERE id = '$q_no'";
  $result = mysqli_query($link,$query);
  if($result){
    $row = mysqli_fetch_assoc($result);
    $question = array(
      "qno"=>$row['id'],
      "qtext"=>$row['text'],
      "qtype"=>$row['qtype'],
      "qcontent"=>$row['qcontent']
    );
    header('Content-type: application/json');
    echo json_encode($question);

  }
  else echo "Error Loading QUESTION: ";


}


function get_q(){
    $qno = get_q_no();
    if($qno == 0){
        die("Error Connecting.. please try again!");
    }

    else{
        $link = connect_to_database();
        $query = "SELECT * FROM `questions` WHERE id = '$qno'";
        $result = mysqli_query($link,$query);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $qdata = array(
                "qno"=>$row['id'],
                "qtype"=>$row['qtype'],
                "qcontent"=>$row['qcontent'],
                "qtext"=>$row['text']

                );
                return $qdata;
        }
        else  die("Error Connecting.. please try again!");
    }
}

function get_q_no(){
    $email = $_SESSION['email'];
    $link = connect_to_database();
    $query = "SELECT prob FROM `users` WHERE email = '$email'";
    $result = mysqli_query($link,$query);
    if($result){
        $row=mysqli_fetch_assoc($result);
        return $row['prob'];

    }
    else{
        return 0;
    }


}



function get_status(){
  $email = $_SESSION['email'];
  $link = connect_to_database();
  $query = "SELECT status FROM `users` WHERE email = '$email'";
  $result = mysqli_query($link,$query);
  if($result){
    $row = mysqli_fetch_assoc($result);
    if($row['status']=="yes"){
      return 1;
    }
    else{
      return 0;
    }
  }
  die("Error connecting...");
}

function completed($email){
   $link = connect_to_database();
  $query = "UPDATE `users` SET completed = 'yes' WHERE email = '$email'";
  $result = mysqli_query($link,$query);
  if($result){
    return "Completed";
  }
  else return "Disqualified";
}



function get_time(){

     $link = connect_to_database();
  $query = "UPDATE `users` SET completed = 'yes' WHERE email = '$email'";
  $result = mysqli_query($link,$query);
  if($result){
    return "Completed";
  }
  else return "Disqualified";

}


function get_completed()
{
    $link=connect_to_database();
    $email=$_SESSION['email'];
    $query="SELECT completed FROM `users` WHERE email='$email'";
     $result = mysqli_query($link,$query);
     if($result){
     $row=mysqli_fetch_assoc($result);
     if($row['completed']=="yes"){
        return 1;
     }
     else
     {
         return 0;
     }


     }
     else
   {
       die("Error connnecting.....");
   }

}









if(isset($_POST['signup']))

{
    $link = connect_to_database();
     $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
      $name= strip_tags($name);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
     $email=strip_tags($email);
 $password =filter_var($_POST['password'], FILTER_SANITIZE_STRING);
     $colg = filter_var($_POST['colg'], FILTER_SANITIZE_STRING);
     $crs = filter_var($_POST['crs'], FILTER_SANITIZE_STRING);
     $prob =1;

     $query = "INSERT INTO `users` (name,email,password,colg,prob,completed,course,status,candy,year)
      VALUES('$name','$email','$password','$colg',1,'no','$crs','no',1,'0')";
$result = mysqli_query($link,$query);
     if($result)
     {

      session_destroy();
      echo "Success!";
    }
    else echo "Unkown error occured ";

}



if(isset($_POST['login']))
{


  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$email = strip_tags($email);
$password=filter_var($_POST['password'], FILTER_SANITIZE_STRING);
  $link = connect_to_database();
  $query ="SELECT * FROM `users` WHERE email = '$email'";
  $result =mysqli_query($link,$query);
  if($result){

    if(mysqli_num_rows($result)>0)

    {
        $row=mysqli_fetch_assoc($result);
      if($password==$row['password']){
         $_SESSION['email']=$email;
         echo 'success';

      }
       else {
      echo 'Invalid credentials!';
    }

    }
    else{
        echo 'user does not exist';
    }


  }
  else echo 'Connection Error!';

}

// submit  question and verify..!

if(isset($_POST['attempt']))

{


  if(isset($_SESSION['email'])){
    // date_default_timezone_set("Asia/Calcutta");
    $t=time();




    $ar = get_s_e();
    $s = $ar['s'];
    $e = $ar['e'];
    if($t>=$s && $t<=$e){



      $ans = $_POST['ans'];
    $email = $_SESSION['email'];
   $link = connect_to_database();
    $qno = get_current_q();
    $query2 = "SELECT * FROM `questions` WHERE id = '$qno'";
    $result2 = mysqli_query($link,$query2);
    if($result2) {
      $row2 = mysqli_fetch_assoc($result2);
      if($row2['answer']==$ans)
      {
        if($qno!=10){



        $query3 = "UPDATE `users` SET prob = prob+1  WHERE email ='$email'";
        }
        else
        {
        $query3 = "UPDATE `users` SET prob = prob+1,  completed = 'yes' WHERE email ='$email'";
        }
        $result3 = mysqli_query($link,$query3);
        if($result3){
          if($qno==10){
              echo "Completed";
          }

           else echo "Correct Answer!";
        }
        else echo "Error occured try again!";

      }

      else echo "Wrong Answer";

    }

    else echo "Error!";
  }


  else{
    echo "Completed";
  }
}


  else echo "User Not Logged in!";




}

if(isset($_POST['skip']))

{

  $email = $_SESSION['email'];
  $link = connect_to_database();
    $qno = get_current_q();
    $candy =get_candy();
    if($candy>0){
        $time = time();
      if($qno!=10)
      $query = "UPDATE `users` SET prob = prob+1,candy=candy-1 WHERE email ='$email'";
      else
      $query = "UPDATE `users` SET completed = 'yes',candy=candy-1 WHERE email ='$email'";
      $result = mysqli_query($link,$query);
      if($result){
        if($qno==10)echo "Completed!";
        else echo "Correct Answer!";
      }
      else echo "Error occured try again!";

    }
    else echo "No Candy Left!";



}

if(isset($_POST['nq'])){
     load_q();

}



if(isset($_POST['status'])){

  $t = time();
  $arr = get_s_e();
  if($t>=$arr['s']&& $t<=$arr['e']){
  $email = $_SESSION['email'];
  $link = connect_to_database();
  $query = "UPDATE `users` SET status = 'yes' WHERE email ='$email'";
  $result = mysqli_query($link,$query);
  if($result){
    echo 'Completed!';

  }
   else echo"Unkown Error Occured!";
  }
  else echo "Please check your device time and date";




}

if(isset($_POST['win'])){
  $t=time();
  $arr = get_s_e();
  $e=$arr['e'];
  if($t>$e){
    $com=completed($email);
    echo $com;
  }
  else {
    $email = $_SESSION['email'];
    $link = connect_to_database();
    $query = "SELECT prob FROM `users` WHERE email ='$email'";
    $result=mysqli_query($link,$query);
    if($result){
      $row = mysqli_fetch_assoc($result);
      if($row['prob']==11){
        $com=completed($email);
        echo $com;
      }
      else echo "Error connecting!";
    }
  }


}

?>
