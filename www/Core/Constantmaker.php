<?php

namespace App\Core;

class Constantmaker{

    private $envPath = ".env";
    private $data = [];

    public function __construct() {
        if(!file_exists($this->envPath)) {
            die("Le fichier ".$this->envPath." n\'esiste pas");
        }

        $this->parseEnv($this->envPath);

        if(!empty($this->data["ENV"])) {
            $this->parseEnv($this->envPath.".".$this->data["ENV"]);
        }

        $this->defineConstants();
    }

    public function defineConstants() {
        foreach($this->data as $key => $value) {
            self::defineConstant($key, $value); // Self permet d'appeler la methode static d'une meme classe
        }
    }

    public static function defineConstant($key, $value) {
        $key = str_replace(" ", " ", mb_strtoupper(trim($key)));

        if(!defined($key)) {
            define($key, $value);
        } else {
            die("La constante ".$key." existe deja");
        }
    }

    public function parseEnv($file) {
        $handle = fopen($file, "r");
        if(!empty($handle)) {
            while (!feof($handle)) {
                $line = trim(fgets($handle));
                preg_match("/([^=]*)=([^#]*)/", $line, $results);
               
                if (!empty($results[1]) && !empty($results[2])) {
                    $this->data[$results[1]] = trim($results[2]);
                }

            }
        }
    }

}

?>