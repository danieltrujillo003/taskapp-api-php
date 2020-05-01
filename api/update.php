<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('
    Access-Control-Allow-Headers:
      Access-Control-Allow-Headers,
      Content-Type,
      Access-Control-Allow-Methods,
      Authorization,
      X-Requested-With
  ');

  include_once '../config/Database.php';
  include_once '../models/Task.php';

  $database = new Database();
  $db = $database->connect();

  $task = new Task($db);

  $data = json_decode(file_get_contents('php://input'));

  $task->priority = $data->priority;
  $task->task = $data->task;
  $task->date = $data->date;
  $task->id = $data->id;

  if($task->update()) {
    echo json_encode(
      array('message' => 'Task updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Task failed to update')
    );
  }
