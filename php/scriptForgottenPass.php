<?php
    function mailPass(){
        require("bdd.php");
        if(isset($_POST["mail"]))
        $token=randomPassword();
        $mail= inputSecure($_POST['mail']);
        $req = $bdd->prepare('UPDATE `user` SET `token`=:token WHERE `email`=:mail');
        $req->execute(array(
        'mail' => $mail,
        'token'=>$token
        ));
        $headers = 'From: noreply-bde@mail.com';
        mail($mail,"Password reset","Votre mot de passe temporaire : ".$token,$headers);
    }
    function resetPass(){
        require("bdd.php");
        $password= inputSecure($_POST["passR"]);
        $passwordC= inputSecure($_POST["passC"]);
        if (preg_match("/^(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{2,}$/",$password)){
            if($password==$passwordC){
                $req = $bdd->prepare('UPDATE `user` SET `password`=:pass,`token`=NULL WHERE `email`=:mail');
                $req->execute(array(
                    'pass'=> password_hash($password,PASSWORD_BCRYPT),
                    'mail'=> inputSecure($_POST['mailS'])
                ));
                header("Location: login.php");
            }
        }
    }
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
?>