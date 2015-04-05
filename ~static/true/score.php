<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~static/true/score.php @ 2015-04-05
     **/

    error_reporting(0);
    if(TEMPLATE === "TEMPLATE") exit;
    $q = mysql_query("SELECT * FROM user WHERE score > 0 ORDER BY score DESC, last_solved ASC, nickname ASC LIMIT 50");
?>
                <div class="row">
                    <div class="col-md-12">
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td align=center width=80>#</td>
                                    <td align=center >username</td>
                                    <td align=center width=120>score</td>
                                    <td align=center width=240>last_solved</td>
                                </tr>
                            </thead>
                            <tbody>

<?php
    while($r = mysql_fetch_array($q)){
        $k++;
        if($r['nickname'] === $_SESSION['nickname']) $you = true;
	if($r['nickname'] == "stypr") goto bye;
?>
                                <tr<?if($k<=3 && $r['score'] != 0){?> class="success"<?}?> style="cursor:pointer;" onclick="document.location.href='?profile&<?php echo $r['nickname'] ?>';">
                                    <td align=center><?if($k<=3 && $r['score'] != 0){?><b>OP!</b><?}else{?><?=$k?><?}?></td>
                                    <td align=center><?=$r['nickname']?></td>
                                    <td align=center><?=$r['score']?></td>
                                    <td align=center><?=$r['last_solved']?></td>
                                </tr>
<?php
	bye:
    }
?>
                            </tbody>
                        </table>
                    </div>
                </div>
<?php
    if(check_login() == true && $you == false){
        $q = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE username='".mysql_real_escape_string($_SESSION['username'])."'"));
?>
                <center>....<br><br></center>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="warning">
                                    <td align=center width=80><?=get_rank($q['nickname'])?></td>
                                    <td align=center ><?=$q['nickname']?></td>
                                    <td align=center width=120><?=$q['score']?></td>
                                    <td align=center width=240><?=$q['last_solved']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
<?php
    }
?>
