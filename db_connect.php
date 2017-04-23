<?php
/*

  $host = 'localhost';
  $db   = 'project';
  $user = 'root';
  $pass = 'europe1193';
  $charset = 'utf8';
  */

  $host = 'eu-cdbr-azure-north-e.cloudapp.net';
  $db   = 'trackmyroutedb';
  $user = 'bbb0b49bcfdd1b';
  $pass = 'b1d373b1';
  $charset = 'utf8';
//  require_once __DIR__ . '/db_connect.php';

/*

    $dsn = "mysql:host=$DB_SERVER;dbname=$DB_DATABASE;charset=$CHARSET";

      $opt = [
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => false,
      ];

      $pdo = new PDO($dsn, $DB_USER, $DB_PASSWORD, $opt);

      */


  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $pdo = new PDO($dsn, $user, $pass, $opt);
?>
