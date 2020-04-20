<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/Database.php';
  include_once '../models/Task.php';

  $database = new Database();
  $db = $database->connect();

  $tasks = new Task($db);

  $p = isset($_GET['p']) ? $_GET['p'] : die();
  $priorities_list = explode(',', $p);
  
  $tasks_arr = array();
  $tasks_arr['data'] = array();
  
  foreach ($priorities_list as $priority) {
    $tasks_arr['data']['P'.$priority] = array();

    $tasks->priority = $priority;

    $result = $tasks->read_by_priority();

    $num = $result->rowCount();

    if($num > 0) {
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $task_item = array(
          'id' => $id,
          'task' => $task,
          'date' => $date
        );
        
        array_push($tasks_arr['data']['P'.$priority], $task_item);
      }
      
    } else {
      array_push($tasks_arr['data']['P'.$priority], array('message' => 'No tasks with this priority'));
    }
  }
  echo json_encode($tasks_arr);