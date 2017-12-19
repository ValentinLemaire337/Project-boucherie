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
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <!-- Mike -->
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" id="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <!-- Mike -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                <div style=" text-align: center; margin: 10% 0% 0% 0%; ">
                                    <a href="register.php">Register</a>
                                    <div id="message"></div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require("page_include/footer.php"); ?>
    
    <script>
        $("form").submit(function(e){

            e.preventDefault();
            $("#message").html("");
            let error = false;

            if($("#email").val().trim() == ""){
                $("#message").append("<p>Veillez remplir votre email</p>");
                error = true;
            }
            if($("#password").val().trim() == ""){
                $("#message").append("<p>Veillez remplir votre password</p>");
                error = true;
            }
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(!re.test($("#email").val().trim().toLowerCase())){
                $("#message").append("<p>Veillez remplir un email correct</p>");
                error = true;
            }

            if(!error){
                var request = $.ajax({
                    url: "http://localhost/Mike/php/Dashboard/pages/include/api.php",
                    method: "POST",
                    data: $("form").serialize(),
                    dataType: "json"
                })
                .done(function( user ) {
                    if(user.error)
                        console.warn(user.message)
                    else
                        console.info(user)
                })
                .fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });
            }
        })
    </script>

</body>

</html>