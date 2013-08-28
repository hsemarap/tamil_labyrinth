<!-- ---------------------------------------------------------------------------------------
   IdiotMinds - http://idiotminds.com
   -----------------------------------------------------------------------------------------
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login with Facebook</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/oauthpopup.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#facebook').click(function(e){
        $.oauthpopup({
            path: 'fblogin.php',
			width:600,
			height:300,
            callback: function(){
                window.location.reload();
            }
        });
		e.preventDefault();
    });
});


</script>
</head>

<body>
<?php 
session_start();
mysql_connect("localhost","paramesh","pass");
mysql_select_db("labyrinth");
if(isset($_GET['action']) && $_GET['action']=='logout'){
session_destroy();
die("Logged out");
}
if(!isset($_SESSION['User']) && empty($_SESSION['User']))   { 
if(sizeof($_POST)>0 && isset($_POST['newuser'])){
$query="SELECT * FROM `tamil_users` where `email` = '".mysql_real_escape_string($_POST['email'])."'";
$res=mysql_query($query);
if(mysql_num_rows($res)>0)echo "Email already registered,register with new Email id";
else{
$name=mysql_real_escape_string($_POST['name']);
$email=mysql_real_escape_string($_POST['email']);
$phone=mysql_real_escape_string($_POST['phone']);
$pass=mysql_real_escape_string($_POST['pass']);$pass=md5($pass);
$query="INSERT INTO `tamil_users`(`name`,`email`,`phone`,`pass`) VALUES('$name','$email','$phone','$pass')";
mysql_query($query);
echo "User registered.Login Now";
}
}
if(sizeof($_POST)>0 && isset($_POST['login'])){
$email=mysql_real_escape_string($_POST['email']);
$pass=mysql_real_escape_string($_POST['pass']);$pass=md5($pass);
$query="SELECT * FROM `tamil_users` where `email` = '$email' and `pass` = '$pass' ";
$res=mysql_query($query);
if(mysql_num_rows($res)>0)
while($row=mysql_fetch_assoc($res)){
$_SESSION['User']=$row['name'];$_SESSION['userId']=$row['id'];$_SESSION['type']='app';
$_SESSION['logout']="login.php?action=logout";
header("location:index.php");
}
else echo "Wrong Password/Email";
}
?>
<br><br><br>

<div style='float:center;margin-left:30%;width:60%'>
<img src="images/facebook.png" id="facebook"  style="cursor:pointer;float:left;" /><br><br>
<span style=''>
or Login Here:
<br><br>
<form action="" method='post'>
<input type='hidden' name='login' value='1' />
Email:<input type='text' name='email' /><br><br>Password:<input type='password' name='password' />
<br><br><input value='login' style='margin-left:20%' type='submit' >
</form>
</span>
</div>
<div style='float:right;margin-right:10%;>
<span style=''>
New User ? Sign Up
<br><br>
<form action="" method='post'>
<input type='hidden' name='newuser' value='1' />
Name:<input type='text' name='name' /><br><br>
Email:<input type='email' name='email' /><br><br>
Password:<input type='password' name='password' />
Phone:<input type='number' name='phone' /><br><br>
<br><br><input value='login' style='margin-left:20%' type='submit' >
</form>
</span>
</div>
<?php  }  else{
// echo '<img src="https://graph.facebook.com/'. $_SESSION['User']['id'] .'/picture" width="30" height="30"/><div>'.$_SESSION['User']['name'].'</div>';	
	echo '<a href="'.$_SESSION['logout'].'">Logout</a>';
}
	?>

</body>
</html>
