<?php
class DB {
    private $con; //Ühendus salvestatkse siia

    function __construct() {
        $this->con = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); //Ühendus andmebaasiga
        if ($this->con->connect_errno) { //Kui ühendus nurjus
            echo "<strong>Viga andmebaasiga:</strong>".$this->con->connect_errno; //Näitab viga
        }else {
            mysqli_set_charset($this->con, "utf8"); //Seab tähemärgid
        }
    }

    #UPDATE INSERT või  DELETE  sql lausete jaoks
    function dbQuery($sql) {
        if ($this->con) { //Kui on viga
            $res = mysqli_query($this->con, $sql); //Teeb päringu
            if ($res === false) { //Kui päring õnnestus
                echo "<div>Vigane päring: " .htmlspecialchars($sql). "</div>";
            return false; //Tagastab false
            }   
        return $res; //Tagastab objekti
        }
        return false;  
    }

    #SELECT sql lausete jaoks
    function dbGetArray($sql) {
            $res = $this->dbQuery($sql); //Teeb päringu
            if ($res !== false) { //Kui päring õnnestus
                $data = array(); //Loome tühja massiivi
                while ($row = mysqli_fetch_assoc($res)) { //Kuni on andmeid
                    $data[] = $row; //Lisa massiivi
                }
                return (!empty($data)) ? $data : false; // HÜÜMÄRK tähistab eitust, Kui $data pole tühi, siis tagastab massiivi, kui on tühi, siis tagastab false
        }
        return false; //Tagastab false
    }

    # $_POST (vormi andmed) / $_GET (URL andmed) väärtuste tagstamine
    #?string saab olla post, get ja null (vaikimisi)
    function getVar(string $name, ?string $method = null) {
        if ($method === 'post') {
            return $_POST[$name] ?? null;
        } elseif ($method === 'get') {
            return $_GET[$name] ?? null;
        } else {
            return $_POST[$name] ?? $_GET[$name] ?? null;
        }
    }

    #Sisendi turvalisemaks muutmine
    function dbFix($var) {
        if(!$this->con || !($this->con instanceof mysqli)) { // || = või/or
            return 'NULL'; 
        }

        if(is_null($var)) { //Kui on tühi
            return 'NULL'; //Tagastab null
        } elseif (is_bool($var)) { //Kui on boolean
            return $var ? '1' : '0'; //Tagastab 1 või 0
        } elseif (is_numeric($var)) { //Kui on number
            return $var; //Tagastab numbri
        } else {
            return $this->con->real_escape_string($var); //Tagastab stringi
        }
    }

    #iInimlikul kujul massiivi sisu vaatamine
    function show($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    
    

} //class Db lõpp
