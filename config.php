<?php
$servername = "localhost";
$dbname="psms_primary";
$username = "root";
$password = "";
date_default_timezone_set('Asia/Dhaka');
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e){
  echo "Connection failed: " . $e->getMessage();
}

  function strowCount($col,$val){
    global $conn;
    $stmt=$conn->prepare("SELECT $col FROM students WHERE $col=?");
    $stmt->execute(array($val));
    $count= $stmt->rowCount();
    return $count;
  }
    function Shahalom($col, $id){
      global $conn ;
      $stmt = $conn -> prepare("SELECT $col FROM students WHERE id=?");
      $stmt->execute(array($id));
      $result  = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result[0][$col];
    }

?> 