<?php
    require_once("includes/header.php");
    require_once("includes/classes/Account.php");
    require_once("includes/classes/FormSanitize.php");
    require_once("includes/classes/Constant.php");

    $detailMessage = "";
    $passwordMessage= "";

    if(isset($_POST["saveData"])){
        $account = new Account($con);
        $firstName = FormSanitize::sanitaizeFormString($_POST["firstName"]);
        $lastName = FormSanitize::sanitaizeFormString($_POST["lastName"]);
        $email = FormSanitize::sanitaizeFormEmail($_POST["email"]);

        if($account->updateDetail($firstName, $lastName, $email, $userLoggedIn)){
            //success
            $detailMessage = "<div class='success message'>
                        Successfully Updated!!
                    </div>";
        } else{
            $errorMessage = $account->getFirstError();

            $detailMessage = "<div class='getError message'>
                $errorMessage
        </div>";

        }
    }

    if(isset($_POST["savePassword"])){
        $account = new Account($con);

        $oldPassword = FormSanitize::sanitaizeFormPassword($_POST["oldPassword"]);
        $newPassword = FormSanitize::sanitaizeFormPassword($_POST["newPassword"]);
        $newPassword2 = FormSanitize::sanitaizeFormPassword($_POST["newPassword2"]);

        if($account->updatePassword($oldPassword, $newPassword, $newPassword2, $userLoggedIn)){
            //success
            $passwordMessage = "<div class='success message'>
                        Password successfully Updated!!
                    </div>";
        } else{
            $errorMessage = $account->getFirstError();

            $passwordMessage = "<div class='getError message'>
                $errorMessage
        </div>";

        }
    }
?>

<div class="settingsContainer column">
    
    <div class="form">

        <form action="" method="POST">
            <h2>プロフィール編集</h2>

            <?php
                $user = new User($con, $userLoggedIn);
                $email = isset($_POST["email"]) ? $_POST["email"] : $user->getEmail();
          

            ?>
            <input type="email" name="email" class="inputField profile" 
            value="<?php echo $email;?>">

            <div class="message">
                <?php echo $detailMessage; ?>
            </div>

            <input type="submit" value="save" name="saveData" class="submit-button save">
        </form>

    </div>

    <div class="form">

<form action="" method="POST">
    <h2>update password</h2>

    <input type="password" name="oldPassword" class="inputField profile" >
    <input type="password" name="newPassword" class="inputField profile" >
    <input type="password" name="newPassword2" class="inputField profile" >

    <div class="message">
                <?php echo $passwordMessage; ?>
            </div>


    <input type="submit" value="save" name="savePassword" class="submit-button save">
</form>

</div>

</div>