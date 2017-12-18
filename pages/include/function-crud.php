<?php

    /**
     * $message = false;
     * require_once "../include/config.php";
     * $remi = connectToDatabase();
     * var_dump($remi);
     */
    $message = false;
    
    require_once "../include/config.php";
    $remi = connectToDatabase();
    var_dump($remi);
     

    function connectToDatabase()
    {
        try
        {
            $bdd = new PDO('mysql:host'.DATABASE_HOST.':dbname='.DATABASE_NAME, DATABASE_USER, DATABASE_PASS); // Création d'une instance de connection à la base de donnée
            return $bdd;
        }
        catch(PDOException $e)
        {
            $GLOBALS["message"] = "Erreur ! :" . $e->getMessage()."<br />";
            die();
        }
    }

    function emailExiste($email)
    {
        
        $sql = "SELECT COUNT(*) AS Nb FROM `clients` WHERE `email` = ?";  // initialisation de la requete ( renvois le nombre de clients dont l'email est égal à $email
        
        $request = $bdd->prepare($sql);   // préparation de la requete avec execution
        
        $request->execute(Array($email));   // execute la requete en remplacant les '?' par les datas du tableau ( les mails)
        
        $array = $request->fetchAll(PDO::FETCH_ASSOC); // trie les données
        
        var_dump($array[0]["Nb"]);
        
        return (bool)$array[0]["Nb"];    
    }       

    function registerClient()
    {
        $sql = "INSERT INTO `clients` (`firstname`,`lastname`,`email`,`encrypte`,`phonenumber`) VALUES (:firstname, :lastname, :email, :encrypte, :phonenumber)";

        $request = $GLOBALS["bdd"]->prepare($sql);
        $array = Array(
            ":lastname" => $clients["lastname"],
            ":email" => $clients["email"], 
            ":firstname" => $clients["firstname"],
            ":phonenumber" => $clients["phonenumber"],
            ":encrypte" => $clients["password"]
        );

        $request>execute($array);

        return $GLOBALS["bdd"]->lastIn
    }

    
    


?>