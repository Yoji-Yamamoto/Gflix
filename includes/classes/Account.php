<?php
    class Account{
        private $con;
        private $errorArray = array();

        public function __construct($con){
            $this->con = $con;    
        }

        public function updateDetail($em, $un){
            $this->validatenewEmail($em, $un);

            if(empty($this->errorArray)){
                //update
                $query = $this->con->prepare("UPDATE users SET email=:em WHERE username=:un");
                $query->bindValue(":em", $em);
                $query->bindValue(":un", $un);

                return $query->execute();
            }

            return false;
        }

        public function register($un, $em, $pw, $pw2){
                $this->validateUsername($un);
                $this->validatePasswords($pw, $pw2);
                $this->validateEmail($em);

                if(empty($this->errorArray)){
                    return $this->insertUserDetails($un, $em, $pw);
                }

                return false;
    
        }

        
        public function login($un, $pw){
            $pw = hash("sha512", $pw);
           
            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un
            AND password=:pw");
            $query->bindValue(":un", $un);
            $query->bindValue(":pw", $pw);

            $query->execute();

            if($query->rowCount() == 1){
                return true;
            }
            array_push($this->errorArray, Constant::$loginFailed);
            return false;
        }

        private function insertUserDetails($un, $em, $pw){
            $pw = hash("sha512", $pw);
            $query = $this->con->prepare("INSERT INTO users (username, email, password)
                                        VALUES(:un, :em, :pw)");
            $query->bindValue(":un", $un);
            $query->bindValue(":em", $em);
            $query->bindValue(":pw", $pw);

            return $query->execute();

        }

        private function validateUsername($un){
            if(strlen($un) < 5 || strlen($un) > 25){
                array_push($this->errorArray, Constant::$usernameLength);
                return;
            }

            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
            $query->bindValue(":un", $un);

            $query->execute();
            if($query->rowCount() != 0){
                array_push($this->errorArray, Constant::$usernameTaken);
            }
        }

        private function validateEmail($em){
            
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constant::$emailInvalid);
                return;
            }

            $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
            $query->bindValue(":em", $em);

            $query->execute();
            if($query->rowCount() != 0){
                array_push($this->errorArray, Constant::$emailTaken);
            }

        }

        private function validatenewEmail($em, $un){
            
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constant::$emailInvalid);
                return;
            }

            $query = $this->con->prepare("SELECT * FROM users WHERE email=:em AND username!= :un");
            $query->bindValue(":em", $em);
            $query->bindValue(":un", $un);

            $query->execute();
            if($query->rowCount() != 0){
                array_push($this->errorArray, Constant::$emailTaken);
            }

        }


        private function validatePasswords($pw, $pw2){
            if($pw != $pw2){
                array_push($this->errorArray, Constant::$passwordNotMatch);
                return;
            }

            if(strlen($pw) < 5 || strlen($pw) > 25){
                array_push($this->errorArray, Constant::$passwordLength);
                return;
            }

        }

        public function getError($error){
            if(in_array($error, $this->errorArray)){
                return "<span class='errorMessage'>$error</span>";
            }
        }

        public function getFirstError(){
            if(!empty($this->errorArray)){
                return $this->errorArray[0];
            }
        }

        public function updatePassword($oldPw, $pw, $pw2, $un){
            $this->validateOldPassword($oldPw, $un);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)){
                //update
                $query = $this->con->prepare("UPDATE users SET password=:pw WHERE username=:un");
                $pw = hash("sha512", $pw);

                $query->bindValue(":pw", $pw);
                $query->bindValue(":un", $un);

                return $query->execute();
            }

            return false;
        }

        public function validateOldPassword($oldPw, $un){
            $pw = hash("sha512", $oldPw);
           
            $query = $this->con->prepare("SELECT * FROM users WHERE username=:un
            AND password=:pw");
            $query->bindValue(":un", $un);
            $query->bindValue(":pw", $pw);

            $query->execute();

            if($query->rowCount() == 0){
                array_push($this->errorArray, Constant::$passwordIncorrect);
            }

        }
    
    }


?>