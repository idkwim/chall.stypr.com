<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~static/true/profile.php @ 2015-04-05
     **/

    error_reporting(0);
    if(TEMPLATE === "TEMPLATE") exit;

    $check = mysql_fetch_assoc(mysql_query("SELECT username, nickname FROM user WHERE nickname='".filter_string(filter_string($param), "sql")."'"));
    if($check['nickname'] !== $param){
        echo "<script>document.location.href='./';</script>";
        exit;
    }

    $nickname = $check['nickname'];
    $check = $check['username'];
    $domain = explode("@", $check);
    $domain = $domain[1];
    $avatar = md5(strtolower(trim($check)));    
?>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-2" style="text-align:left; padding-top:10px;">
                                <h1><?php echo $nickname; ?></h1>
                                <span style="font-size:8pt;">#<?php echo get_rank($nickname);?> with a total of <?php echo get_score($check);?>pt.<br>
                                ....@<?php echo $domain; ?></span>
                            </div>
                            <div class="col-md-2" style="text-align:right;">
                                <img src="//www.gravatar.com/avatar/<?php echo $avatar; ?>?s=120&d=<?php echo urlencode("https://github.com/identicons/" . rand(1, 100) . ".png"); ?>&s=120" class="avatar" width=100%><br>
                            </div>
                        </div>
                        <hr  style="border:0;">
                        <hr  style="border:0;">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <textarea class="authlog" disabled>
<?php
    $loglist = mysql_query("SELECT time, challenge FROM auth WHERE username='". filter_string($check, "sql") . "' ORDER BY time DESC");
    while($log = mysql_fetch_array($loglist)){
        $authlog .= "[" . $log['time'] . "] " . $param . " solved " . $log['challenge'] . ".\n";
    }
    if($authlog){
        echo rtrim($authlog, "\n");
    }else{
        echo "Nothing solved yet! :)";   
    }
?>
                                </textarea>
                            </div>
                        </div>
                        <hr  style="border:0;">
                        <div class="row">
                            <div class="col-md-2">&nbsp;</div>
<?php
    $q = mysql_query("SELECT * FROM chal ORDER BY score ASC, solved DESC");
    while($r = mysql_fetch_array($q)){
        $k++;
        $t = mysql_fetch_assoc(mysql_query("SELECT * FROM auth WHERE username='". filter_string($check, "sql") . "' AND challenge='".$r['name']."'"));
        if($t){ $solved = true; } else { $solved = false; }
?>
                                <div class="col-md-2">
                                    <button <?if($solved){?>class="btn btn-success"<?}else{?>class="btn btn-danger"<?}?> disabled style="width:100%;" onclick="window.open('<?=$r['description']?>');" <?if(check_login()==false || $r['status'] == 1){?> disabled<?}?>>
                                        <b><?=$r['name']?></b><sup>[<?=$r['score']?>pt]</sup><br>
                                        <sub>solved by <?=$r['solved']?> ppl</sub></button>
                                </div>
<?php
        if($k % 4 == 0){
?>
                            <div class="col-md-2">&nbsp;</div>
                            <hr style="border:0;">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-2">&nbsp;</div>
<?php
        }
    }
?>
                        </div>
                    </div>
