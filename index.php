<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * index.php @ 2015-04-04
     **/


    error_reporting(0);
    require("init.php");
    if(TEMPLATE === "TEMPLATE") exit;

    if($_POST){ # action query
        switch($query){
            case "login":
                if(check_login() === false && $_POST) process_login($_POST);
                break;
            case "register":
                if(check_login() === false && $_POST) process_register($_POST);
                break;
            case "auth":
                if(check_login() === true && $_POST)  process_auth($_POST);
                break;
        }
    }else{ # load query
        if(check_login() == false){
            import_page("false/header");
            switch($query){
                case "register":
                    import_page("false/register");
                    break;
                default:
                    import_page("false/login");
                    break;
            }
            import_page("false/footer");
        }else{
            import_page("true/header");
            switch($query){
                case "profile":
                    import_page("true/profile");
                    break;
                case "intro":
                    import_page("true/intro");
                    break;
                case "memo":
                    import_page("true/memo");
                    break;
                case "chall":
                    import_page("true/chall");
                    break;
                case "score":
                    import_page("true/score");
                    break;
                case "logout":
                    logout();
                    break;
                default:
                    import_page("true/intro");
            }
            import_page("true/footer");
        }
    }
?>