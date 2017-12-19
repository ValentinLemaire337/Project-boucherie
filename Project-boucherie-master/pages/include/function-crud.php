<?php

    /*
        --------------------------- Test Unitair ---------------------------------
    */

        /*
            Function emailExiste
        */

            // require_once "../include/config.php";
            // $remi = emailExiste("azertyuip@poiuytreza.fr");
            // var_dump($remi);

        /*
            Function cryptPassword
        */
            // echo cryptPassword("Mike");

    /*
        ---------------------------------------------------------------------------
    */
    
    $message = false;
    
    $bdd = connectToDataBase();

    function connectToDataBase(){
        try{
            $bdd = new PDO('mysql:host='.DATABASE_HOST.';dbname='.DATABASE_NAME, DATABASE_USER, DATABASE_PASS); // Création d'une instance de connection à la base de donnée
            return $bdd;
        }catch (PDOException $e) {
            $GLOBALS["message"] = "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function emailExiste($email){
        
        $sql = "SELECT COUNT(*) as Nb FROM `clients` WHERE `email` = ?"; // Init la requete (Renvoi le nombre de client dont l'email est egal à $email)
        
        $request = $GLOBALS["bdd"]->prepare($sql); // Preparation de la requete avant execusion
        
        $request->execute(Array($email)); // Execute la requete en remplacant les ? par les data tu tableau
        
        $array = $request->fetchAll(PDO::FETCH_ASSOC); // Trie des données
        
        return (bool)$array[0]["Nb"];

    }

    function registerClient($client){
        $sql = "INSERT INTO `clients`(`firstname`, `lastname`, `email`, `encrypte`, `phone`) 
        VALUES (:firstname, :lastname, :email, :encrypte, :phone)";

        $request = $GLOBALS["bdd"]->prepare($sql);
      
        $array = Array(
         ":lastname" => $client["lastname"],
         ":email" => $client["email"], 
         ":firstname" => $client["firstname"], 
         ":phone" => $client["phonenumber"], 
         ":encrypte" => cryptPassword($client["password"])
        );

        $request->execute($array);

        return $GLOBALS["bdd"]->lastInsertId();
    }

    function cryptPassword($password){
        $crypt = sha1(rand(11, 22)."Mike".uniqid()."Mike".rand(11, 22));
        return crypt($password, $crypt);
    }

    function comparePassword($hashed_password, $paswword){
        return (hash_equals($hashed_password, crypt($paswword, $hashed_password))) ? true : false;
    }
