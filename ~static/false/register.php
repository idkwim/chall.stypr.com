<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * /~static/false/register.php @ 2015-04-05
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
                                    <textarea class="tos" disabled>
Please contact directly to "root&#64;stypr.com" for any account assisstance.

Our website is under review on wechall, and you are required to enter a valid e-mail address for user verification.

Please DO NOT DDOS or bruteforce any challenges for a long period of time.

The challenge server is run by corporates(notice the plural), and I have privileges to receive spam traffics. 

There&#39;s no exception for any spam traffics; I will just send spam-related packets to the police. Be nice and let others enjoy the challenge!

P.S: The website encrypts password without any salt. however, it does a double hash encryption with sha1() and md5(). Please try to use long passwords for your credential.                                        

Have fun! :)
- stypr                             </textarea>
                                    <br>
                                    <form role="form" action="javascript:register()" method="post" id="register-form" autocomplete="off">
                                        <div class="form-group">
                                            <label for="email" class="sr-only">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" maxlength=100 placeholder="niko@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="key" class="sr-only">Password</label>
                                            <input type="password" name="password" id="key" class="form-control" maxlength=100 placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="key" class="sr-only">Nickname</label>
                                            <input type="nickname" name="nickname" id="nick" class="form-control" maxlength=20 placeholder="Nickname (e.g. stypr, geohot, etc.)">
                                        </div>
                                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                                    </form>
                                    <hr>
                                    <a href="?login" class="submenu">Sign in with your account</a>
                                </div>
                            </div> <!-- /.col-xs-12 -->
                        </div> <!-- /.row -->
                    </div> <!-- /.container -->
                </section>
            </center>
            <script>
                function register(){
                    $.post("?register", $("#register-form").serialize()).done(function(msg){
                        if(msg=="success"){
                            alert('Registration Complete!');
                            document.location.href='./';
                        }
                        if(msg=="already"){
                            alert('Your e-mail / nickname already exists.');
                        }
                        if(msg=="error"){
                            alert('Please enter your information correctly.');   
                        }
                    });
                }
            </script>