<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~wechall/userscore.php @ 2015-04-04
     * Usage: /~wechall/userscore.php?authkey=blah&username=stypr
     * Valid Output: username:rank:score:maxscore:challssolved:challcount:usercount
     **/


    error_reporting(0);
    require("../init.php");
    if(TEMPLATE === "TEMPLATE") exit;
    define("RANK_PREFIX", "`RANK_VAR`");

	$authkey   = filter_string($_REQUEST['authkey']);
	$username  = filter_string($_REQUEST['username']);
	if($authkey !== __WECHALL__) die("access denied..");

    $s = mysql_fetch_assoc(mysql_query("SELECT nickname, score FROM user WHERE nickname='" . filter_string($username, "sql") . "'"));
    if($s['nickname'] === $username){
        $statistics = "SELECT concat(nickname, ':". RANK_PREFIX .":', 
                                   score, ':', 
                                   (select SUM(score) FROM chal), ':',
                                   (select COUNT(*) from auth WHERE username=user.username), ':', 
                                   (select COUNT(score) FROM chal), ':', 
                                   (SELECT COUNT(username) FROM user)) AS result 
                       FROM user WHERE nickname='" . filter_string($username, "sql") . "'";
		$statistics = mysql_fetch_assoc(mysql_query($statistics));
		$statistics = $statistics['result'];
		$current_rank = "SELECT @rank := @rank + 1 AS rank, nickname FROM user p, (SELECT @rank := 0) r ORDER BY score DESC, last_solved ASC";
		$current_rank = mysql_query($current_rank);
		while($user = mysql_fetch_array($current_rank)){
			if($user['nickname'] === $username){
				$statistics = str_replace(RANK_PREFIX, $user['rank'], $statistics);
				break;
			}
		}
		die($statistics);
	}
?>