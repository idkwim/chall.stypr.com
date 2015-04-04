<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~wechall/validatemail.php @ 2015-04-04
     * Usage: /~wechall/validatemail.php?authkey=blah&username=stypr&email=stypr7@gmail.com
     **/
    error_reporting(0);
    require("../init.php");
    if(TEMPLATE === "TEMPLATE") exit;

	$authkey   = filter_string($_REQUEST['authkey']);
	$username  = filter_string($_REQUEST['username']);
	$email	   = filter_string($_REQUEST['email']);
	if($authkey !== __WECHALL__) die("access denied..");

	$statistics = mysql_fetch_assoc(mysql_query("SELECT nickname FROM user WHERE nickname='" . filter_string($username, "sql") . "' AND username='" . filter_string($email, "sql") . "'"));

	if($statistics['nickname'] === $username){
		echo("1");
		exit;
	}else{
		echo("0");
		exit;
	}
?>