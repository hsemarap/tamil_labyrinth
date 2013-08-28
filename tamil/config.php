<?php
/* -----------------------------------------------------------------------------------------
   IdiotMinds - http://idiotminds.com
   -----------------------------------------------------------------------------------------
*/
session_start();
//Facebook App Id and Secret
$appID='Your App Id';
$appSecret='Your App Secret';

//URL to your website root
if($_SERVER['HTTP_HOST']=='localhost'){
$base_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}else{
$base_url='http://'.$_SERVER['HTTP_HOST'];	
}
?>