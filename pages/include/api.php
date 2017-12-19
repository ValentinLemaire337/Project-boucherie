<?php
    header("Access-Control-Allow-Origin: *");
    require "function-crud.php";
    
    if(!empty($_POST)){
        if( isset($_POST["email"]) && isset($_POST["password"])){

            $retour = Array("error" => true);

            $user = connectUser(trim($_POST["email"]), trim($_POST["password"]));

            if($user == -1)
                $retour["message"] = "Utilisateur invisible!!!";

            elseif($user == -2)
                $retour["message"] = "Password / Email error !!! Ta soeur";

            else{
                $retour["error"] = false;
                $retour["user"] = $user;
            }

            echo json_encode($retour);
        }
    }