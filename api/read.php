<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/Task.php';

  $database = new Database();
  $db = $database->connect();

  $tasks = new Task($db);

  $result = $tasks->read();
  $num = $result->rowCount();

  if($num > 0) {
    $tasks_arr = array();
    $tasks_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $task_item = array(
        'id' => $id,
        'priority' => $priority,
        'task' => $task,
        'date' => $date
      );

      array_push($tasks_arr['data'], $task_item);
    }

    echo json_encode($tasks_arr);

  } else {
    echo json_encode(
      array('message' => 'no tasks yet')
    );
  }
