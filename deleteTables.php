<?php
// DB connection info
require_once __DIR__ . '/db_connect.php';

try{

  $stmt = $pdo->prepare("DROP TABLE route_message;");
  $stmt->execute();

  $stmt = $pdo->prepare("DROP TABLE route_marker;");
  $stmt->execute();

  $stmt = $pdo->prepare("DROP TABLE route_coord;");
  $stmt->execute();

  $stmt = $pdo->prepare("DROP TABLE route;");
  $stmt->execute();

  $stmt = $pdo->prepare("DROP TABLE user;");
  $stmt->execute();
}
catch(Exception $e){
    die(print_r($e));
}
echo "<h3>Tabls Drooped!</h3>";
?>
