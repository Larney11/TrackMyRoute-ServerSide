<?php
// DB connection info
require_once __DIR__ . '/db_connect.php';

try{

  $stmt = $pdo->prepare(
  "CREATE TABLE user(
    username VARCHAR(30),
    email VARCHAR(100),
    name VARCHAR(100),
    dateOfBirth VARCHAR(20),
    gender VARCHAR(30),
    weight DECIMAL(5,2),
    height DECIMAL(5,2),
    PRIMARY KEY (username)
  );");
  $stmt->execute();

  $stmt = $pdo->prepare(
  "CREATE TABLE route(
     route_id INT NOT NULL AUTO_INCREMENT,
     username VARCHAR(30),
     title VARCHAR(255),
     description VARCHAR(255),
     address VARCHAR(255),
     duration VARCHAR(20),
     distance DECIMAL(30,25),
     avg_speed DECIMAL(10,2),
     accessibility VARCHAR(20),
     visibility VARCHAR(20),
     difficulty VARCHAR(30),
     PRIMARY KEY (route_id),
     FOREIGN KEY(username)
       references user (username)
  );");
  $stmt->execute();

  $stmt = $pdo->prepare(
  "CREATE TABLE route_coord(
     route_id INT,
     longitude DECIMAL(30,25),
     latitude DECIMAL(30,25),
     longitudeDelta DECIMAL(30,25),
     latitudeDelta DECIMAL(30,25),
     FOREIGN KEY(route_id)
       references route (route_id)
  );");
  $stmt->execute();

  $stmt = $pdo->prepare(
  "CREATE TABLE route_marker(
     route_id INT,
     longitude DOUBLE(30,25),
     latitude DOUBLE(30,25),
     longitudeDelta DOUBLE(30,25),
     latitudeDelta DOUBLE(30,25),
     FOREIGN KEY(route_id)
       references route (route_id)
  );");
  $stmt->execute();

  $stmt = $pdo->prepare(
  "CREATE TABLE route_message(
      route_id INT,
      username VARCHAR(30),
      message_body VARCHAR(255),
      message_datetime VARCHAR(20),
      FOREIGN KEY(route_id) references route(route_id),
      FOREIGN KEY(username) references route (username)
   );");
   $stmt->execute();

   $stmt = $pdo->prepare(
   "CREATE TABLE route_history(
     history_id INT NOT NULL AUTO_INCREMENT,
     route_id INT,
     username VARCHAR(30),
     duration VARCHAR(20),
     avg_speed DECIMAL(10,2),
     PRIMARY KEY (history_id),
     FOREIGN KEY(route_id) references route(route_id),
     FOREIGN KEY(username) references route (username)
   );");
   $stmt->execute();


   $stmt = $pdo->prepare("INSERT INTO user (username, email, name, dateOfBirth, gender, weight, height) VALUES(?, ?, ?, ?, ?, ?, ?)");
   $stmt->execute(["Lar", "email", "name", "dateOfBirth", "gender", 5, 6]);

}
catch(Exception $e){
    die(print_r($e));
}
echo "<h3>Table created.</h3>";
?>
