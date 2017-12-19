<?php
    require "include/config.php";
    $message = "";
    
    if(!empty($_POST)){

        // Require Function
        require("include/function-form.php");
        require("include/function-crud.php");

        $dataToVerif = Array("firstname", "lastname", "password", "phonenumber", "email");

        if(!verifParam($_POST, $dataToVerif)):
            $message .= "<p> Erreur d'envoi d'information. </p>";
        
        elseif(!verifEmailSyntaxe($_POST["email"])):
            $message .= "<p> Votre adresse e-mail est invalide </p>";
        
        else:

            $retour = true;

            if( strlen($_POST["firstname"]) > 70 ) {
                $message .= "<p> Votre Prenom doit etre compris entre 2 et 70 caractere </p>";
                $retour = false;
            }

            if( strlen($_POST["lastname"]) > 70 ){
                $message .= "<p> Votre Nom doit etre compris entre 2 et 70 caractere </p>";
                $retour = false;
            }

            $_POST["phonenumber"] = str_replace(" ", "", $_POST["phonenumber"]);
            $_POST["phonenumber"] = str_replace(".", "", $_POST["phonenumber"]);
            $_POST["phonenumber"] = str_replace(",", "", $_POST["phonenumber"]);
            $_POST["phonenumber"] = str_replace("-", "", $_POST["phonenumber"]);

            if( strlen($_POST["phonenumber"]) > 10 ){
                $message .= "<p> Votre numero de telephone doit etre faire 10 caractere et doit etre des chiffres</p>";
                $retour = false;
            }

            if(emailExiste($_POST["email"])){
                $message = "<p> Deja inscrit, <a href='login.php' >Connecter-vous</a></p>";
                $retour = false;
            }


            if($retour == true){
                $toto = registerClient($_POST);
                var_dump($toto);
                // header('Location: index.html');
                // exit;
            }
            
        endif;
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <?php require("page_include/head.php"); ?>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign Up</h3>
                    </div>
                    <div class="panel-body">
                        <!-- Mike -->
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Firstname" name="firstname" type="firstname" value="<?= (isset($_POST["firstname"])) ? $_POST["firstname"] : ""  ?>" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Lastname" name="lastname" type="lastname" value="<?= (isset($_POST["lastname"])) ? $_POST["lastname"] : ""  ?>" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?= (isset($_POST["email"])) ? $_POST["email"] : ""  ?>" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="0668005129" name="phonenumber" type="phonenumber" value="<?= (isset($_POST["phonenumber"])) ? $_POST["phonenumber"] : ""  ?>" autofocus>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!-- Mike -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Register</button>
                                <div style=" text-align: center; margin: 10% 0% 0% 0%; ">
                                    <a href="login.php">Login</a>
                                    <?= $message ?>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>