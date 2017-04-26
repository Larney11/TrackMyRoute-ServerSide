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
      //$stmt = $conn->prepare("UPDATE user (username, email, name, dateOfBirth, gender, weight, height) VALUES(?, ?, ?, ?, ?, ?, ?)");
      $stmt = $conn->prepare("UPDATE user SET username=:username, email=:email, name=:name, dateOfBirth=:dateOfBirth, gender=:gender, weight=:weight, height=:height WHERE username = :username");
      //$stmt = $conn->prepare($sql);
      $stmt->bindValue(":username", $username);
      $stmt->bindValue(":email", $email);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":dateOfBirth", $dateOfBirth);
      $stmt->bindValue(":gender", $gender);
      $stmt->bindValue(":weight", $weight);
      $stmt->bindValue(":height", $height);
      $stmt->execute();


      //$stmt->execute([$username, $email, $name, $dateOfBirth, $gender, $weight, $height]);

      } catch(Exception $e) {

        echo $e->getMessage();
      }

      $response["success"] = 1;
      $response["status"] = 200;
      $response["message"] = "User Updated";

      echo json_encode($response);
   }
?>
