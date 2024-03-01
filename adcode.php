<link href="css/bootstrap.css" rel="stylesheet">

<?php
if(isset($_POST['userid']) && isset($_POST['password'])){

    $adServer = "ldap://msc-dc01.iccu.com";
	
    $ldap = ldap_connect($adServer);
    $username = $_POST['userid'];
    $password = $_POST['password'];

    $ldaprdn = 'ICCU1' . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=ICCU,dc=COM",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            session_start();
            //$username = $info[$i]["givenname"][0] . ' ' . $info[$i]["sn"][0];
            $_SESSION["agentname"] = $_POST['userid'];
            header('Location: MCCSurvey.php');                        
        }
        @ldap_close($ldap);
        
    } else {        

        ?>
        

    <div class="panel panel-primary" style="width:25%; margin: 0 auto;">
        <div class="panel-heading">MCC Survey<br></div>
            <div class="panel-body">
                <form action="#" method="POST">            
                    <input class="form-control" id="userid" type="text" name="userid" placeholder="Username" />
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" /> <br>      
                    <input class="btn btn-primary"style="width:100%; margin:0 auto;" type="submit" name="submit" value="Login" />
                </form>
            </div>
    </div>
        
        <?php
        
        //echo $msg;
    }
       
} else{

?>

    <br><br><br><br><br><br>
    <div class="panel panel-primary" style="width:25%; margin: 0 auto;">
        <div class="panel-heading">MCC Survey<br></div>
            <div class="panel-body">
                <form action="#" method="POST">            
                    <input class="form-control" id="userid" type="text" name="userid" placeholder="Username" />
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" /> <br>      
                    <input class="btn btn-primary"style="width:100%; margin:0 auto;" type="submit" name="submit" value="Login" />
                </form>
            </div>
    </div>
    
<?php } ?> 