<?php

class Comment
{
  public $id;
  public $comment;

  public function  __construct($data) {
    $this->id = isset($data['id']) ? intval($data['id']):null;
    $this->comment = $data['comment'];
  }

  public static function fetchAll() {
    // 1. Connect to the database
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    // 2. Prepare the query
    $sql = 'SELECT * FROM Standard';
    $statement = $db->prepare($sql);
    // 3. Run the query
    $success = $statement->execute();
    // 4. Handle the results
    $arr = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
      // 4.a. For each row, make a new work object
      $theComment =  new Comment($row);
      array_push($arr, $theComment);
    }
    return $arr;
  }

  public function create()  {
    $db = new PDO(DB_SERVER, DB_USER, DB_PW);
    $sql = 'INSERT into Standard (id,comment)
    VALUES (?,?)';

    $statement = $db->prepare($sql);
    $success = $statement->execute([
      $this->id,
      $this->comment,
    ]);

    $this->id = $db->lastInsertId();


  }






}
