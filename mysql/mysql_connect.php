<?php
class DB
{
  private $user = 'root';
  private $pass = '';
  private $dbname = 'gestate_dev_2';
  static function __constract()
  {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname='.$dbname, $user, $pass);
        foreach($pdo->query('SELECT * from FOO') as $row) {
            print_r($row);
        }
        $pdo = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

  }

  public function getinstatice()
  {
    return $db = new DB;
  }

}

  $res = DB::getinstatice();
  sleep(2);
  $stmt = $res->prepare('SELECT * FROM A');
  $stmt->execute();
  $pdo->query('SELECT pg_terminate_backend(pg_backend_pid());');
  var_dump($res);
// hashToInt