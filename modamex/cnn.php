<?php
// Para hostinger.
 define('usuario', 'u481415426_admin');
 define('password', '#Unaclavetodalargota1');
 define('HOST', 'localhost');
 define('DATABASE', 'u481415426_ModaMexDos');
// Para la db descarga en mi compuuu.
//define('usuario', 'root');
//define('password', '');
//define('HOST', 'localhost');
//define('DATABASE', 'u481415426_ModaMexDos');
try {
    $cnn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE, usuario, password);
} catch (PDOException $e) {
    exit("error :" . $e->getMessage());
}
?>