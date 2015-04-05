<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~static/false/login.php @ 2015-04-05
     **/

    error_reporting(0);
    if(TEMPLATE === "TEMPLATE") exit;
?>
            <hr style="width:80px;">
            <center>
                <section id="login">
                    <div class="container">
                        <div class="row">
                            <div class="authbox">
                                <div class="form-wrap">
                                    <form role="form" action="javascript:auth()" method="post" id="login-form" autocomplete="off">
                                        <div class="form-group">
                                            <label for="email" class="sr-only">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" maxlength=100 placeholder="niko@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="key" class="sr-only">Password</label>
                                            <input type="password" name="password" id="key" class="form-control" maxlength=100 placeholder="Password">
                                        </div>
                                        <div class="checkbox">
                                            <span class="character-checkbox" onclick="showPassword()"></span>
                                            <span class="label">Show password</span>
                                        </div>
                                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                                    </form>
                                    <hr>
                                    <a href="?register" class="submenu">Register your account</a>
                                </div>
                            </div> <!-- /.col-xs-12 -->
                        </div> <!-- /.row -->
                    </div> <!-- /.container -->
                </section>
            </center>
            <script>
                function showPassword() {
                    var key_attr = $('#key').attr('type');
                    if(key_attr != 'text') {
                        $('.checkbox').addClass('show');
                        $('#key').attr('type', 'text');
                    } else {
                        $('.checkbox').removeClass('show');
                        $('#key').attr('type', 'password');
                    }
                }
                function auth(){
                    $.post("?login", $("#login-form").serialize()).done(function(msg){
                        if(msg=="success"){
                            document.location.href='./';
                        }else{
                            alert('Your credentials are incorrect. Please try again.');   
                        }
                    });
                }
            </script>
