<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>வலைபாயுதே</title>
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
<div id="fb-root" style='margin-left:30%;width:60%'></div>
<h2 align='center'>வலைபாயுதே</h2>
<h3 align='center'>வணக்கம் !!!</h3>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '493564590729179', // App ID
    channelUrl : '//www.festember.com/tamil/channel.html', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses the JavaScript SDK to
  present a graphical Login button that triggers the FB.login() function when clicked.

  Learn more about options for the login button plugin:
  /docs/reference/plugins/login/ -->

<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>
<?php 
session_start();
mysql_connect("localhost","deltanit_tamil","paramesh");
mysql_select_db("deltanit_tamil");
echo mysql_error();
if(isset($_GET['action']) && $_GET['action']=='logout'){
session_destroy();
die("Logged out<script>window.location='/tamil/'</script><noscript>Please enable Javascript to PLay Game</noscript>");
}

require_once("fb.php");

$config = array();
$config[‘appId’] = '493564590729179';
$config[‘secret’] = '50a0f4d9eacd7d6498cc5a71814762e3';
$config[‘fileUpload’] = false; // optional

$facebook = new Facebook($config);
try {
    $user_profile = $facebook->api('/me','GET');
    $user_name = $user_profile['name'];
    $user_email = $user_profile['email'];
echo $user_name.$user_email."HELLO";

} catch(FacebookApiException $e) {

    // If the user is logged out, you can have a 
    // user ID even though the access token is invalid.
    // In this case, we'll get an exception, so we'll
    // just ask the user to login again here.
}
if(isset($_SESSION['userId']))
header("location:/tamil/");


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
$query="INSERT INTO `tamil_users`(`id`,`name`,`email`,`phone`,`pass`) VALUES('','$name','$email','$phone','$pass')";
mysql_query($query);

echo "User registered.Login Now";
}
}
if(sizeof($_POST)>0 && isset($_POST['login'])){
$email=mysql_real_escape_string($_POST['email']);
$pass=mysql_real_escape_string($_POST['pass']);$pass=md5($pass);
$query="SELECT * FROM `tamil_users` where `email` = '$email' and `pass` = '$pass' ";
$res=mysql_query($query);
echo mysql_error();
if(mysql_num_rows($res)>0)
while($row=mysql_fetch_assoc($res)){
$_SESSION['User']=$row['name'];$_SESSION['userId']=$row['id'];$_SESSION['type']='app';
                $_SESSION['userid']=$row['id'];
		$_SESSION['name']=$row['name'];
		$_SESSION['email']=$row['email'];
		$_SESSION['type']=$row['type'];
		$_SESSION['level']=$row['level'];
$_SESSION['logout']="login.php?action=logout";
echo "Logged In successfully";
echo "<script>window.location='/tamil/'</script><noscript>Please enable Javascript to PLay Game</noscript>";
}
else echo "Wrong Password/Email";
}
?>
<div style='position:absolute;right:8%;width:60%;top:30%;display:none'>
<table>
<form action="" method='post'>
<input type='hidden' name='login' value='1' />
<tr><td>Email:</td><td><input type='text' name='email' /></td></tr>
<tr><td>Password:</td><td><input type='password' name='password' /></td></tr>
<tr><td></td><td><input value='login' style='margin-left:20%' type='submit' ></td></tr>
</form>
</table>
</div>
<div style='position:absolute;right:40%;top:20%;'>
<table>
<tr><td colspan='2'>
Use Facebook Login or Login Here:
</td></tr>
<tr><td>
<form action="" method='post'>
<input type='hidden' name='login' value='1' />
Email:</td><td><input type='text' name='email' /></td></tr>
<tr><td>Password:</td><td><input type='password' name='password' /></td></tr>
<tr><td></td><td><input value='login' style='margin-left:20%' type='submit' ></form></td></tr>
<tr style='height:50px'><td></td><td></td></tr>
<tr><td colspan='2'> New User ? Sign Up</td></tr>
<tr><td><form action="" method='post'><input type='hidden' name='newuser' value='1' />
Name:</td><td><input type='text' name='name' /></td></tr>
<tr><td>Email:</td><td><input type='email' name='email' /></td></tr>
<tr><td>Password:</td><td><input type='password' name='password' /></td></tr>
<tr><td>Phone:</td><td><input type='number' name='phone' /></td></tr>
<tr><td></td><td><input value='login' style='margin-left:20%' type='submit' ></form>
</td></tr>
</table>
</div>
<?php  }  else{
// echo '<img src="https://graph.facebook.com/'. $_SESSION['User']['id'] .'/picture" width="30" height="30"/><div>'.$_SESSION['User']['name'].'</div>';	
	echo '<a href="'.$_SESSION['logout'].'">Logout</a>
<script>window.location="/tamil/";</script><noscript>Please enable Javascript to PLay Game</noscript>';
}
	?>

</body>
</html>