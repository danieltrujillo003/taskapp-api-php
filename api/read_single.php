<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/Task.php';

  $database = new Database();
  $db = $database->connect();

  $task = new Task($db);

  $task->id = isset($_GET['id']) ? $_GET['id'] : die();

  $result = $task->read_single();

  $row = $result->fetch(PDO::FETCH_ASSOC);

  extract($row);

  $tasks_arr = array();
  $tasks_arr['data'] = array(
    'id' => $id,
    'priority' => $priority,
    'task' => $task,
    'date' => $date
  );

  echo json_encode($tasks_arr);
