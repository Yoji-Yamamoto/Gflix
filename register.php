<?php
    require_once("includes/config.php");
    require_once("includes/classes/FormSanitize.php");
    require_once("includes/classes/Constant.php");
    require_once("includes/classes/Account.php");

    $account = new Account($con);

    if(isset($_POST['submitButton'])){
        $username = FormSanitize::sanitaizeFormUsername($_POST['username']);
        $email = FormSanitize::sanitaizeFormEmail($_POST['email']);
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
    <div class="formContainer">
        <div class="column">
                <div class="header">
                    <img src="assets/images/logo.png" alt="siteLogo" class="logo">
                    <h3>新規登録</h3>
                </div>
            <form action="" method="POST">

                <input type="text" name="username" required class="inputField" 
                placeholder= "お名前(5文字以上)" value="<?php getInputData("username"); ?>">

                <?php echo $account->getError(Constant::$emailInvalid); ?>         
                <?php echo $account->getError(Constant::$emailTaken); ?>    

                <input type="email" name="email" required class="inputField" 
                placeholder= "メールアドレス" value="<?php getInputData("email"); ?>">

                <?php echo $account->getError(Constant::$passwordNotMatch); ?>  
                <?php echo $account->getError(Constant::$passwordLength); ?>  

                <input type="password" name="password" required class="inputField" 
                placeholder="パスワード" value="<?php getInputData("password"); ?>">
                <input type="password" name="password2" required class="inputField" 
                placeholder="パスワード(確認)" value="<?php getInputData("password2"); ?>">

                <input type="submit" name="submitButton" class="submit-button">
            </form>

            <a href="login.php" class="signIn">アカウントをお持ちですか?ログインしてください</a>
        </div>
    </div>
</body>
</html>