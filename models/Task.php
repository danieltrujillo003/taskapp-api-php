<?php
  class Task {
    private $conn;
    private $table = 'tasks';

    public $id;
    public $priority;
    public $task;
    public $date;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function read() {
      $query = 'SELECT id, priority, task, date FROM ' . $this->table . ' ORDER BY priority';

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }

    public function read_single() {
      $query = 'SELECT id, priority, task, date FROM ' . $this->table . ' WHERE id = ?';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->id);
      $stmt->execute();

      return $stmt;
    }

    public function read_by_priority() {
      $query = 'SELECT id, priority, task, date FROM ' . $this->table . ' WHERE priority = ?';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->priority);
      $stmt->execute();

      return $stmt;
    }

    public function create() {
      $query = '
        INSERT INTO ' .
          $this->table . '
        SET
          priority = :priority,
          task = :task,
          date = :date';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(':priority', $this->priority);
      $stmt->bindParam(':task', $this->task);
      $stmt->bindParam(':date', $this->date);

      if ($stmt->execute()) {
        return true;

      } else {
        printf("Error: %s.\n", $stmt->error);
        return false;
      }
    }

    public function update() {
      $query = '
        UPDATE ' .
          $this->table . '
        SET
          priority = :priority,
          task = :task,
          date = :date
        WHERE
          id = :id';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(':priority', $this->priority);
      $stmt->bindParam(':task', $this->task);
      $stmt->bindParam(':date', $this->date);
      $stmt->bindParam(':id', $this->id);

      if ($stmt->execute()) {
        return true;

      } else {
        printf("Error: %s.\n", $stmt->error);
        return false;
      }
    }

    public function delete() {
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(':id', $this->id);

      if ($stmt->execute()) {
        return true;

      } else {
        printf("Error: %s.\n", $stmt->error);
        return false;
      }
    }
  }
