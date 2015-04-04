<?php
    /**
     * Stereotyped Challenges
     * https://chall.stypr.com/
     * init.php @ 2015-04-04
     **/


    // Initial Config
    define("SQL_HOST", "localhost");    // MySQL_host
    define("SQL_USER", "stypr");        // MySQL_username
    define("SQL_PASS", "stypr");        // MySQL_password
    define("SQL_NAME", "stypr");        // Database Name
    define("__WECHALL__", "wechall");   // WECHALL CODE
    define("TEMPLATE", "./~static/");   // template dir.


    // Global Functions
    error_reporting(0);
    header("Content-Type: text/html; charset=utf-8");
    session_name("stypr");
    session_start();
    $db = mysql_connect(SQL_HOST, SQL_PASS, SQL_PASS);
    if(!$db) die("err");
    mysql_select_db(SQL_NAME);
    $query = filter_string($_SERVER['QUERY_STRING']);
    function filter_string($str, $type){
        /* filter any valid inputs */
        switch($type){
            case "url":
                return preg_replace("/[^a-zA-Z0-9-_&=]/", "", $str);
                break;
            default:
                return preg_replace("/[^a-zA-Z0-9-_!@#$.%^&*()가-힣]/", "", $str);
                break;
        }
    }
    function import_page($page){
        /* Import page by require() */
        global $query;
        require(TEMPLATE . filter_string($page, "url") . ".php");
    }
    function check_login(){
        /* Check authentication */
        if(sha1(sha1($_SESSION['username']) . sha1($_SESSION['ip'])) === $_SESSION['session']){
            return true;
        }
        return false;
    }
    function logout(){
        /* Destroy the session */
        session_destroy();
        $_SESSION = array();
        header("Location: /");
    }
    function get_score(){
        $q = mysql_fetch_assoc(mysql_query("SELECT score FROM user WHERE username='" . filter_string($_SESSION['username'], "sql") . "'"));
        return $q['score'];
    }


    // Challenge Functions
    function process_login($data){
        /* login based on user input */
        if($data['email'] && $data['password']){
            $email = filter_string($data['email']);
            $password = filter_string($data['password']);
            if(strlen($email) < 5 || strlen($email) > 100){
                die("error");
            }
            if(strlen($password) < 4 || strlen($password) > 100){
                die("error");
            }
            $q = @mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE username='" . filter_string($email, "sql") . "'"));
            if($q['username'] === $email && $q['password'] === sha1(md5($password))){
                $_SESSION['username'] = $email;
                $_SESSION['nickname'] = $q['nickname'];
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['session'] = sha1(sha1($_SESSION['username']) . sha1($_SESSION['ip']));
                @mysql_query("UPDATE user SET login_ip='".$_SESSION['ip']."', login_date=NOW() WHERE username='" . filter_string($email, "sql") . "'");
                die("success");
            }
        }
        die("error");
    }
    function process_register($data){
        /* register based on user input */
        if($data['email'] && $data['password'] && $data['nickname']){
            $email = filter_string($data['email']);
            $password = filter_string($data['password']);
            $nickname = filter_string($data['nickname']);
            if(strlen($email) < 5 || strlen($email) > 100){
                die("error");
            }
            if(strlen($password) < 4 || strlen($password) > 100){
                die("error");
            }
            if(strlen($nickname) < 2 || strlen($nickname) > 20){
                die("error");
            }
            $q = @mysql_fetch_assoc(mysql_query("SELECT username FROM user WHERE username='" . filter_string($email, "sql") . "' OR nickname='" . mysql_real_escape_string($email, "sql") . "'"));
            if($q){
                die("already");
            }else{
                $q = @mysql_query("INSERT INTO user VALUES(NULL, '" . filter_string($email, "sql") . "', '".filter_string(sha1(md5($password)), "sql")."', '".filter_string($nickname, "sql")."', 0, NOW(), NULL, '" . filter_string($_SERVER['REMOTE_ADDR'], "sql") . "', NULL, NULL)");
                if($q){
                    die("success");
                }else{
                    die("critical");
                }
            }
        }
        die("error");
    }
    function process_auth($data){
        /* auth based on user input */
        $flag = "flag{" . filter_string($data['flag']) . "}";
        $q = mysql_fetch_assoc(mysql_query("SELECT * FROM chal WHERE flag='" . filter_string($flag, "sql") . "'"));
        if($q['flag'] === $flag){
            $chall_name  = $q['name'];
            $chall_score = $q['score'];
            $k = mysql_fetch_assoc(mysql_query("SELECT * FROM auth WHERE username='" . filter_string($_SESSION['username'], "sql") . "' and challenge='".filter_string($chall_name, "sqli")."'"));
            if($k['username']){
                die("wrong");
            }
            mysql_query("UPDATE chal SET solved=solved+1 WHERE name='" . filter_string($chall_name, "sql") . "'");
            mysql_query("UPDATE user SET score=score+" . intval($chal_score) . ", last_solved=NOW() WHERE username='".filter_string($_SESSION['username'], "sqli")."'");
            mysql_query("INSERT INTO auth VALUES(NULL, '" . filter_string($_SESSION['username'], "sqli") . "', '". filter_string($chall_name, "sqli")."', NOW())");
            die("correct");
        }
        die("wrong");
    }
?>