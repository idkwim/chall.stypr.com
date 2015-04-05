<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~static/true/chall.php @ 2015-04-05
     **/

    error_reporting(0);
    if(TEMPLATE === "TEMPLATE") exit;   
?>
                    <div class="row">
                        <form role="form" action="javascript:check_flag()" method="post" id="auth-form" autocomplete="off">
                            <div class="col-md-6 col-md-offset-2">
                                  <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">flag{</div>
                                        <input type="text" name="flag" class="form-control" style="text-align:center;"<?if(check_login()==false){?> disabled value="YOU MUST LOGIN TO CONTINUE!!!"<?}?>>
                                        <div class="input-group-addon">}</div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info" style="width:100%;"<?if(check_login()==false){?> disabled<?}?>>AUTH</button>
                            </div>
                        </form>
                    </div>
                    <hr style="border:0;">
                    <center><hr style="width:100px;"></center>
                    <hr style="border:0;"><br>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
<?php
    $q = mysql_query("SELECT * FROM chal ORDER BY score ASC, solved DESC");
    while($r = mysql_fetch_array($q)){
        $k++;
        $t = mysql_fetch_assoc(mysql_query("SELECT * FROM auth WHERE username='".filter_string($_SESSION['username'], "sql")."' AND challenge='".$r['name']."'"));
        if($t){ $solved = true; } else { $solved = false; }
?>
                        <div class="col-md-2">
                            <button <?if($solved){?>class="btn btn-success" disabled<?}else{?>class="btn btn-danger"<?}?> style="width:100%; height:80px;" onclick="window.open('<?=$r['description']?>');" <?if(check_login()===false || $r['status'] == 1){?> disabled<?}?>>
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
                    <script>
                        function check_flag(){
                            $.post("?auth", $("#auth-form").serialize()).done(function(msg){
                                if(msg=="correct"){
                                    alert('Correct!');
                                    document.location.href='?chall';
                                }else{
                                    alert('Wrong flag. Try again!'); 
                                }
                            });
                        }
                    </script>
