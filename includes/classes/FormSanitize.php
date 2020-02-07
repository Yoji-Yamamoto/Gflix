<?php
    class FormSanitize{

        public static function sanitaizeFormString($inputText){
            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "", $inputText);
            $inputText = strtolower($inputText);
            $inputText = ucfirst($inputText);
            return $inputText;
        }

        public static function sanitaizeFormUsername($inputText){
            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "", $inputText);
            return $inputText;
        }

        public static function sanitaizeFormPassword($inputText){
            $inputText = strip_tags($inputText);
            return $inputText;
        }

        public static function sanitaizeFormEmail($inputText){
            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "", $inputText);
            return $inputText;
        }


        
    }
?>