<?php
if(!defined('LOGGEDIN'))
{ 
	header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
	echo "<h1>403 Forbidden<h1><h4>எங்க ஏரியா உள்ளே வராதே .</h4>";
	echo '<hr/>'.$_SERVER['SERVER_SIGNATURE'];
	exit(1);
}
session_start();
mysql_connect("localhost","deltanit_tamil","paramesh");
mysql_select_db("deltanit_tamil");
function parse_path() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);

    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    $path['call_parts'] = explode('/', $path['call']);

    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
  }
return $path;
}

$level=0;

		//$_SESSION['level']=0;
		$_SESSION['try0']=0;$_SESSION['try1']=0;$_SESSION['try2']=0;$_SESSION['try3']=0;$_SESSION['try4']=0;$_SESSION['try5']=0;$_SESSION['try6']=0;$_SESSION['try7']=0;$_SESSION['try8']=0;

if(!isset($_SESSION['details']) || $_SESSION['renew']==1){
$_SESSION['renew']=0;
	$res=mysql_query("SELECT * FROM `tamil_users` WHERE `id` = '$_SESSION[userId]'");
	while($row=mysql_fetch_assoc($res)){
		$_SESSION['details']=1;
		$_SESSION['userid']=$row['id'];
		$_SESSION['name']=$row['name'];
		$_SESSION['email']=$row['email'];
		$_SESSION['type']=$row['type'];
		$_SESSION['level']=$row['level'];
$res1=mysql_query("SELECT * FROM `tamil_questions` WHERE `level` = '$row[level]'");
while($row1=mysql_fetch_assoc($res1)){$levelname=$row1['levelname'];}
		$_SESSION['levelname']=$levelname;		$_SESSION['try0']=$row['0'];$_SESSION['try1']=$row['1'];$_SESSION['try2']=$row['2'];$_SESSION['try3']=$row['3'];$_SESSION['try4']=$row['4'];$_SESSION['try5']=$row['5'];$_SESSION['try6']=$row['6'];$_SESSION['try7']=$row['7'];$_SESSION['try8']=$row['8'];
	}
}else {
		$name=$_SESSION['name'];
		$email=$_SESSION['email'];
		$type=$_SESSION['type'];
		$level=$_SESSION['level'];
		$levelname=$_SESSION['levelname'];
$try0=$_SESSION['try0'];$try1=$_SESSION['try1'];$try2=$_SESSION['try2'];$try3=$_SESSION['try3'];$try4=$_SESSION['try4'];$try5=$_SESSION['try5'];$try6=$_SESSION['try6'];$try7=$_SESSION['try7'];$try8=$_SESSION['try8'];	
}
if(isset($_SESSION['level']))$level=$_SESSION['level'];
else $_SESSION['level']=$level;
//unset($_SESSION['details']);
$path_info = parse_path();
//echo $levelname;
if($path_info['call_utf8']=='' && $path_info['call_utf8']!=$levelname){
if(!isset($_POST['answer']));
//header("location: /tamil/$levelname");
echo "<script>window.location='/tamil/$levelname';</script><noscript>Please enable Javascript to PLay Game</noscript>";
}


//print_r($_SESSION);
if(isset($_SESSION['details']))$userid=$_SESSION['userid'];else $userid=$_SESSION['userId'];
if($level==0)$levelstring="பயிற்சி";
if($level==1)$levelstring="முதல்";
if($level==2)$levelstring="இரண்டாம்";
if($level==3)$levelstring="மூன்றாம்";
if($level==4)$levelstring="நான்காம்";
if($level==5)$levelstring="ஐந்தாம்";
if($level==6)$levelstring="ஆறாம்";
if($level==7)$levelstring="ஏழாம்";
if($level>7)$levelstring=$level."'ஆம்";
if(!isset($_POST['answer']))
{
if($level<10){
	$res=mysql_query("SELECT * FROM `tamil_questions` where `level` = '$level'");
	while($row=mysql_fetch_assoc($res)){
		$question=$row['question'];$images=$row['images'];
	}
	$images=explode(',',$images);
	$imagelist="<tr><td style='text-align:center'>";
	if(count($images)==1)$imagelist.= "<img src='upload/$images[0]' style='float:center;margin-left:20px;height:350'/>";	
	if(count($images)==2)foreach($images as $i)$imagelist.= "<img src='upload/$i' style='float:left;margin-left:20px;height:300'/>";	
	if(count($images)==3)foreach($images as $i)$imagelist.= "<img src='upload/$i' style='float:left;margin-left:20px;height:250'/>";	
	if(count($images)==4)foreach($images as $i)$imagelist.= "<img src='upload/$i' style='float:left;margin-left:15px;height:220'/>";	
	if(count($images)==6)foreach($images as $i)$imagelist.= "<img src='upload/$i' style='float:left;margin-left:10px;height:200'/>";	

	$imagelist.="</td></tr>";
	$html=<<<HTML
<html>
<head>
<title>வலைபாயுதே</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<a style='position:absolute;right:10%' href='$_SESSION[logout]'>LOGOUT</a>
<span style='position:absolute;right:50%'>வணக்கம் $_SESSION[name]</span>

<table style="padding:15px;border:1px solid grey;width:95%;">
<tr><td><h2>$levelstring பாகம்</h2></td><td></td><td></td></tr>
<tr><td colspan='3' style='text-align:center'><h2>$question</h2></td></tr>
$imagelist
<tr style='padding-top:50px;'><td colspan='3' style='text-align:center'>
<form action='./' method='POST'>
<label>	
உங்கள் பதில் ?</label><input type='text' name='answer'>
<input type='submit' name='submit' value='submit'>
</form>
</td></tr>
</table>
</html>
HTML;
	echo $html;
	} else {	
	echo '
<title>வலைபாயுதே</title>
<a style="position:absolute;right:10%" href="'.$_SESSION[logout].'">LOGOUT</a>
<span style="position:absolute;right:50%">வணக்கம் '.$_SESSION["name"].'</span>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<h1 style="position:absolute;left:30%;top:40%;font-size:2em;">	வெற்றி ! வெற்றி !! வெற்றி !!!</h1>
<h1 style="position:absolute;left:30%;top:50%;font-size:2em;">போட்டி மேலாளர்கள் உங்களுக்கு மின் அஞ்சல் அனுப்புவார்கள். </h1>
';
}
}else{
	//mysql_query("INSERT INTO `tamil_questions`(`answer`) VALUES('$_POST[answer]')");
	$res=mysql_query("SELECT * FROM `tamil_users` WHERE `id` = '$userid'");
	while($row=mysql_fetch_assoc($res)){
		$userid=$row['id'];
		$name=$row['name'];
		$email=$row['email'];
		$type=$row['type'];
		$level=$row['level'];
		$try0=$row['0'];$try1=$row['1'];$try2=$row['2'];$try3=$row['3'];$try4=$row['4'];$try5=$row['5'];$try6=$row['6'];$try7=$row['7'];$try8=$row['8'];
	}

	$res=mysql_query("SELECT * FROM `tamil_questions` WHERE `level` = '$level' AND `answer` = '".mysql_real_escape_string($_POST[answer])."'");
	if(mysql_error())die(mysql_error());
	echo "
<html>
<head>
<title>வலைபாயுதே</title>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
</head><div style='position:absolute;left:30%;top:30%'><h1>";
	if(mysql_num_rows($res)>0){
		echo "$_POST[answer] என்பது  சரியான பதில்.";
$_SESSION['renew']=1;
$correctans=1;
		echo "<script>
		setTimeout(function(){window.location='/tamil/';},2500);
		</script><noscript>Please enable Javascript to PLay Game</noscript>";
		$_SESSION['level']=$level+1;
		mysql_query("UPDATE `tamil_users` SET `level` = '".($level+1)."' WHERE `email` = '$email' ");
$userid=$_SESSION['userid'];

$res1=mysql_query("SELECT * FROM `tamil_questions` WHERE `level` = '".($level+1)."'");
while($row1=mysql_fetch_assoc($res1)){$levelname=$row1['levelname'];}
		$_SESSION['levelname']=$levelname;		

//	echo $email;	
//echo "UPDATE `tamil_users` SET `level` = '".($level+1)."' , `$level` = '".(${"try$level"}+1)."' WHERE `email` = '$email' ";
	}
	else {
		echo "தவறான பதில். முயற்சி திருவினை ஆக்கும்.மீண்டும் முயற்சி செய் ";
$correctans=0;
				echo "<script>
		setTimeout(function(){window.location='/tamil/';},2500);
		</script><noscript>Please enable Javascript to PLay Game</noscript>";

		mysql_query("UPDATE `tamil_users` SET `$level` = '".(${"try$level"}+1)."' WHERE `name` = '$name' ");
	}
		mysql_query("INSERT INTO `tamil_submits` VALUES('$userid','$level',NOW(),'$correctans')");
//	echo $_POST['answer'].($_POST['answer']);
	echo "</h1></div></html>";
}

?>