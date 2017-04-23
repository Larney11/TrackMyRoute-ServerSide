<?php

   $response = array();

   require_once __DIR__ . '/db_connect.php';

   // Checks for required field
   if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['dateOfBirth']) && isset($_POST['gender']))
   {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $name = $_POST['name'];
      $dateOfBirth = $_POST['dateOfBirth'];
      $gender = $_POST['gender'];
      $weight = $_POST['weight'];
      $height = $_POST['height'];

      try {
      $stmt = $pdo->prepare("INSERT INTO user (username, email, name, dateOfBirth, gender, weight, height) VALUES(?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([$username, $email, $name, $dateOfBirth, $gender, $weight, $height]);

      } catch(Exception $e) {

        echo $e->getMessage();
      }

      $response["success"] = 1;
      $response["status"] = 200;
      $response["message"] = "Route uploaded";

      echo json_encode($response);
   }
   else if(isset($_GET['username'])) {

     $username = $_GET['username'];

     $stmt = $pdo->prepare("SELECT * FROM username WHERE username = $username");
      $stmt->execute([]);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($results, JSON_NUMERIC_CHECK);
    }
?>
