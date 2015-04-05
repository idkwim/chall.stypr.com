<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~static/false/header.php @ 2015-04-05
     **/

    error_reporting(0);
    if(TEMPLATE === "TEMPLATE") exit;

    $logo = array("'", "*", "O", "@");
    $logo = $logo[array_rand($logo, 1)];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="content-type">
        <meta charset="utf-8">
        <title>Stereotyped Challenges</title>
        <meta content="width=1000, user-scalable=no" name="viewport">
        <link href="./static/boot.css" rel="stylesheet">
        <link href="./static/false.css" rel="stylesheet">
    </head>
    <body>
        <div class="content">
            <div class="logo">
                <img src="./static/logo.png" width=190>
                <p class="logo_face"><center><?=$logo?>__________<?=$logo?></center></p>
                <h4 class="logo_name">stypdchall<sup>+</sup></h4>
                <p class="logo_description">
                    + this wargame contains extremely hardcore webhack challenges.<br>
                    You may suffer from repetitive illusions and mental breakdown.
                </p>
            </div>
