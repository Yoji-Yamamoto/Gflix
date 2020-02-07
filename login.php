<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitize.php");
require_once("includes/classes/Constant.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

    if(isset($_POST['submitButton'])){
        $username = FormSanitize::sanitaizeFormUsername($_POST['username']);
        $password = FormSanitize::sanitaizeFormPassword($_POST['password']);

        $success = $account->login($username,$password);
            
            if($success){
                //store session
                $_SESSION['userLoggedIn'] = $username;
                header("Location: index.php");
            }  
    }

    function getInputData($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/stylesheets/style.css">
    <title>welcome to Gflix</title>
</head>
<body>
    <div class="singinContainer">
        <div class="column">
                <div class="header">
                    <img src="assets/images/logo.png" alt="siteLogo" class="logo">
                    <h3>Log in</h3>
                </div>
            <form action="" method="POST">
                <?php echo $account->getError(Constant::$loginFailed); ?>         

                <input type="text" name="username" required class="inputField"
                value="<?php getInputData("username"); ?>">
                <input type="password" name="password" required class="inputField"
                value="<?php getInputData("password"); ?>">
                <input type="submit" name="submitButton" class="submit-button" required>
            </form>

            <a href="register.php" class="signIn">new user? please sign up</a>
        </div>
    </div>
</body>
</html>