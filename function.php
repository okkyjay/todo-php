<?php
session_start();
function connectDB(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "todo";
    // Create connection
    return new mysqli($servername, $username, $password, $dbName);
}
function getUser($userId){
    $conn = connectDB();
    $sqlStatement = "SELECT * FROM todo_users WHERE id='{$userId}'";
    $query = $conn->query($sqlStatement);
    return $query->fetch_assoc();
}
