<?php

    /*
        --------------------------- Test Unitair ---------------------------------
    */

        /*
            Function verifParam
        */
        // $toto = verifParam(Array("email"=>"22","password"=>"22"), Array("email","password"));
        // var_dump($toto);

        /*
            Function verifEmailSyntaxe
        */
        // $toto = verifEmailSyntaxe("Afcd656@e.e");
        // var_dump($toto);

    /*
        ---------------------------------------------------------------------------
    */

    function verifEmailSyntaxe($email){
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false ;
    }



    function verifParam($data, $array){

        if(count($data) != count($array)) // Vérification du nombre d'élèments dans les deux tableuax de données
            return false;

        foreach($array as $valeur){ // 1er Boucle - Parcourir les elements obligatoirs
            
            $retour = false;

            foreach($data as $key => $valData){ // 2eme Boucle - Parcourir les donnée evoyez par le formulaire ($_POST)

                $retour = ($valeur == $key && !empty(trim($valData))) ? true : $retour; // Ternaire

            }

            if($retour != true) // Si la valeur change (Suite à la condition dans le second foreach), il return false;
                return false;
        }

        return true;
        
    }
