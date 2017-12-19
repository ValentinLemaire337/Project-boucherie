<?php

    /**
     * --------------------------------TEST UNITAIRE---------------------------------
     * 
     * $toto = verifParam(Array("email" => "22", "password" => "22"), Array("email", "password"));
     * var_dump($toto);
     * 
     * verifEmailSyntaxe();
     * 
     */
    
     

    function verifEmailSyntaxe($email)
    {
        return(filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false ;
    }
    

    function verifParam($data, $array)
    {

        if(count($data) != count($array))  // Verification du nombre d'éléments dans les deux tableaux de données
        {
            return false;

            foreach($array as $valeur)  // 1ere boucle - permet de parcourir les elements obligatoires 
            {

                $retour = false; 

                foreach($data as $key => $valData) // 2nde boucle - parcourir les données envoyées par le formulaire ($_POST)
                {
                        $retour = ($valeur == $key && !empty(trim($valData))) ? true : $retour; // ternaire                    
                }
                if($retour != true) // si la valeur change ( suite à la condition dans le second foreach), il return false
                    return false;
            }
            return true;
        }
    }


?>