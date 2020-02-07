<?php
    require_once("includes/config.php");
    require_once("includes/classes/FormSanitize.php");
    require_once("includes/classes/Constant.php");
    require_once("includes/classes/Account.php");

    $account = new Account($con);

    if(isset($_POST['submitButton'])){
        $firstName = FormSanitize::sanitaizeFormString($_POST['firstName']);
        $lastName = FormSanitize::sanitaizeFormstring($_POST['lastName']);
        $username = FormSanitize::sanitaizeFormUsername($_POST['username']);
        $email = FormSanitize::sanitaizeFormEmail($_POST['email']);
        $email2 = FormSanitize::sanitaizeFormEmail($_POST['email2']);
        $password = FormSanitize::sanitaizeFormPassword($_POST['password']);
        $password2 = FormSanitize::sanitaizeFormPassword($_POST['password2']);


        $success = $account->register($firstName, $lastName, $username, $email, $email2,
    $password, $password2);
        
        if($success){
            //store session
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
                    <h3>Sign Up</h3>
                </div>
            <form action="" method="POST">
                <?php echo $account->getError(Constant::$firstNameLength); ?>

                <input type="text" name="firstName" required class="inputField"
                value="<?php getInputData("firstName"); ?>">

                <?php echo $account->getError(Constant::$lastNameLength); ?>

                <input type="text" name="lastName" required class="inputField" 
                value="<?php getInputData("lastName"); ?>">

                <?php echo $account->getError(Constant::$usernameLength); ?> 
                <?php echo $account->getError(Constant::$usernameTaken); ?>   

                <input type="text" name="username" required class="inputField" 
                value="<?php getInputData("username"); ?>">

                <?php echo $account->getError(Constant::$emailNotMatch); ?> 
                <?php echo $account->getError(Constant::$emailInvalid); ?>         
                <?php echo $account->getError(Constant::$emailTaken); ?>    

                <input type="email" name="email" required class="inputField" 
                value="<?php getInputData("email"); ?>">
                <input type="email2" name="email2" required class="inputField" 
                value="<?php getInputData("email2"); ?>">

                <?php echo $account->getError(Constant::$passwordNotMatch); ?>  
                <?php echo $account->getError(Constant::$passwordLength); ?>  

                <input type="password" name="password" required class="inputField" 
                value="<?php getInputData("password"); ?>">
                <input type="password" name="password2" required class="inputField" 
                value="<?php getInputData("password2"); ?>">

                <input type="submit" name="submitButton" class="submit-button">
            </form>

            <a href="login.php" class="signIn">have account? please log in</a>
        </div>
    </div>
</body>
</html>