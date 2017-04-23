<?php

   $response = array();

   require_once __DIR__ . '/db_connect.php';


   history_id INT NOT NULL AUTO_INCREMENT,
   route_id INT,
   username VARCHAR(30),
   duration VARCHAR(20),
   avg_speed DECIMAL(10,2),


   // Checks for required field
   if(isset($_POST['route_id']) && isset($_POST['username']) && isset($_POST['description']) && isset($_POST['routeCoordinates']))
   {
      $title = $_POST['title'];
      $description = $_POST['description'];
      $address = $_POST['address'];
      $duration = $_POST['duration'];
      $distance = $_POST['distance'];
      $avg_speed = $_POST['avg_speed'];
      $difficulty = $_POST['difficulty'];
      $routeCoordinates = $_POST['routeCoordinates'];
      $username = $_POST['username'];

      $stmt = $pdo->prepare("INSERT INTO route (username, title, description, address, duration, distance, avg_speed, accessibility, visibility, difficulty) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([$username, $title, $description, $address, $duration, $distance, $avg_speed, "", "", $difficulty]);
      $last_id = $pdo->lastInsertId();

      $index = 0;

      $routeCoordinatesArray = json_decode($routeCoordinates, true);
      //echo $routeCoordinatesArray;

      try {

        foreach($routeCoordinatesArray as $item) { //foreach element in $arr

          $longitude = $item["longitude"];
          $latitude = $item["latitude"];
          $longitudeDelta = $item["longitudeDelta"];
          $latitudeDelta = $item["latitudeDelta"];

          if($index == 0) {

            // Insert marker coordinate (This is the the first coordinate of the route coordinates)
            $stmt = $pdo->prepare("INSERT INTO route_marker (route_id, longitude, latitude, longitudeDelta, latitudeDelta) VALUES(?, ?, ?, ?, ?)");
            $stmt->execute([$last_id, $longitude, $latitude, $longitudeDelta, $latitudeDelta]);

            // Insert route coordinates
            $stmt = $pdo->prepare("INSERT INTO route_coord (route_id, longitude, latitude, longitudeDelta, latitudeDelta) VALUES(?, ?, ?, ?, ?)");
            $stmt->execute([$last_id, $longitude, $latitude, $longitudeDelta, $latitudeDelta]);

            $index = $index + 1;
          }
          else {

            // Insert route coordinates
            $stmt = $pdo->prepare("INSERT INTO route_coord (route_id, longitude, latitude, longitudeDelta, latitudeDelta) VALUES(?, ?, ?, ?, ?)");
            //$stmt->execute([$last_id, $item['longitude'], $item['latitude'], $item['longitudeDelta'], $item['latitudeDelta']]);
            $stmt->execute([$last_id, $longitude, $latitude, $longitudeDelta, $latitudeDelta]);
          }
        }
      } catch(Exception $e) {

        echo $e->getMessage();
      }

      $response["success"] = 1;
      $response["status"] = 200;
      $response["message"] = "Route uploaded";

      echo json_encode($response);
   }
   else if(isset($_GET['route_id'])) {


     $route_id = $_GET['route_id'];
/*
     $stmt = $pdo->prepare("SELECT longitude, latitude, longitudeDelta, latitudeDelta FROM route_coord WHERE route_id = ?");
     $stmt->execute([$route_id]);
     $resultsCoord = $stmt->fetchAll(PDO::FETCH_ASSOC);
*/
     $stmt = $pdo->prepare("SELECT * FROM route r, route_marker rm WHERE r.route_id = rm.route_id");
      //$stmt = $pdo->prepare("SELECT * FROM route r, route_marker rm WHERE r.route_id = ? AND r.route_id = rm.route_id");
      $stmt->execute([]);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      //$results['route_coordinates'] = $resultsCoord;

      echo json_encode($results, JSON_NUMERIC_CHECK);
    }
    else if(isset($_GET['route'])) {

      $route_id = $_GET['route'];

      try {

        $stmt = $pdo->prepare("SELECT longitude, latitude, longitudeDelta, latitudeDelta FROM route_coord WHERE route_id = ?");
        $stmt->execute([$route_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      catch(PDOException $e) {

        echo $e->getMessage();
      }

      echo json_encode($results, JSON_NUMERIC_CHECK);
    }
?>
