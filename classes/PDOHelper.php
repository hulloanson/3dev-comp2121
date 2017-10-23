<?php
/**
 * Created by: ycl
 * Date: 21/10/2017
 * Time: 2:49 AM
 */

class PDOHelper
{
  public static function exec($statement, $args = [])
  {
    $pdo = self::get_pdo();
    if (empty($args))
      $result = $pdo->exec($statement);
    else
      $result = $pdo->prepare($statement)->execute($args);
    if ($result === false)
      throw new \Exception('Error: ' . $pdo->errorCode());
  }

  public static function fetch($statement, $args = [])
  {
    $pdo = self::get_pdo();
    if (empty($args)) {
      $result = $pdo->query($statement, PDO::FETCH_ASSOC)->fetch(PDO::FETCH_ASSOC);
    } else {
      $stmt = $pdo->prepare($statement);
//      foreach ($args as $name => $arg) {
//        $stmt->bindValue($name, $arg);
//      }
      $result = $stmt->execute($args);
      if ($result === false)
        throw new \Exception('Error: ' . var_export($pdo->errorCode(), true));
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if ($result === false)
      throw new \Exception('Error: ' . var_export($pdo->errorCode(), true));
    return $result;
  }

  public static function get_pdo()
  {
    global $pdo;
    if (!$pdo instanceof PDO) {
      $pdo = new PDO('mysql:dbname=snacks;host=localhost;', 'snacks', 'snacks');
    }
    return $pdo;
  }
}