<?php
    /**
        Stereotyped Challenges
        https://chall.stypr.com/
        index.php @ 2015-04-04
    **/
    error_reporting(0);
    require("init.php");
    if(TEMPLATE === "TEMPLATE") exit;

    if($_POST){
        switch($query){
            case "logout":
                logout();
                break;
            case "login":
                if(check_login() == false && $_POST) process_login($_POST);
                break;
            case "register":
                if(check_login() == false && $_POST) process_register($_POST);
                break;
            case "auth":
                if(check_login() == true && $_POST) process_auth($_POST);
                break;
        }
    }else{
        import_page("header");
        switch($query){
            case "login":
                if(check_login() == false){
                    import_page("login");
                }else{
                    goto load_intro;
                }
                break;
            case "register":
                if(check_login() == false){
                    import_page("register");
                }else{
                    goto load_intro;
                }
                break;
            case "intro":
                import_page("intro");
                break;
            case "memo":
                import_page("memo");
                break;
            case "chall":
                import_page("chall");
                break;
            case "rank":
                import_page("rank");
                break;
            default:
                load_intro:
                import_page("intro");
        }
        import_page("footer");
    }
?>