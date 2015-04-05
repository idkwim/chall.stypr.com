<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~static/true/header.php @ 2015-04-05
     **/

    error_reporting(0);
    if(TEMPLATE === "TEMPLATE") exit;

    $logo = array("'", "*", "O", "@");
    $logo = $logo[array_rand($logo, 1)];

    $avatar = md5(strtolower(trim($_SESSION['username'])));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="content-type">
        <meta charset="utf-8">
        <title>Stereotyped Challenges</title>
        <meta content="width=1000, user-scalable=no" name="viewport">
        <link href="./static/boot.css" rel="stylesheet">
        <link href="./static/true.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar" style="margin-top:-20pt;">
                        <li><center>
                            <img src="./static/logo.png" width=190>
                            <p class="logo_face"><center><?=$logo?>__________<?=$logo?></center></p>
                            <h4 class="logo_name">stypdchall<sup>+</sup></h4>
                            <p class="logo_description">https://chall.stypr.com/</p>
                        </center></li>
                    </ul>
                    <hr>
                    <ul class="nav nav-sidebar" style="text-align:right; font-size:13pt;">
                        <li <? if($query==="intro" || !$query){ ?> class="active"<?}?>><a href="?intro">NOTICE</a></li>
                        <li <? if($query==="chall"){ ?> class="active"<?}?>><a href="?chall">CHALLENGE</a></li>
                        <li <? if($query==="score"){ ?> class="active"<?}?>><a href="?score">SCOREBOARD</a></li>
                        <li <? if($query==="memo"){ ?> class="active"<?}?>><a href="?memo">MEMO</a></li>
                        <li><a href="?logout">LOGOUT</a></li>
                    </ul>
                    <hr>
                    <ul class="nav nav-sidebar" style="font-size:9pt;">
                        <li>
                        <div class="row" style="width:100%;">
                            <div class="col-md-12" style="text-align:right; margin-left:10px;">
                                <img src="//www.gravatar.com/avatar/<?php echo $avatar; ?>?d=<?php echo urlencode("https://github.com/identicons/" . rand(1, 100) . ".png"); ?>&s=120" class="side_avatar" onclick="document.location.href='?profile&<? echo $_SESSION['nickname']; ?>';">&nbsp;<b style="font-size: 15pt"><?php echo $_SESSION['nickname']; ?></b><br>
                                #<?php echo get_rank($_SESSION['nickname']); ?> with a total of <?php echo get_score(); ?>pt.
                            </div>
                        </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
