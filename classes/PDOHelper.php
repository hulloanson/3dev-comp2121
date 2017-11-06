<?php
/**
 * Created by: ycl
 * Date: 21/10/2017
 * Time: 2:49 AM
 */

class PDOHelper
{
  public static function transact(callable $callback) {
    $pdo = self::get_pdo();
    $pdo->beginTransaction();
    try {
      $callback();
    } catch(\Exception $e) {
      $pdo->rollBack();
      throw $e;
    }
    $pdo->commit();
  }

  public static function exec($statement, $args = [])
  {
    $pdo = self::get_pdo();
    if (empty($args))
      $result = $pdo->exec($statement);
    else
      $result = $pdo->prepare($statement)->execute($args);
    if ($result === false)
      throw new \Exception(var_export($pdo->errorCode(), true));
  }

  public static function fetch($statement, $args = [])
  {
    $pdo = self::get_pdo();
    if (empty($args)) {
      $result = $pdo->query($statement, PDO::FETCH_ASSOC)->fetchAll(PDO::FETCH_ASSOC);
    } else {
      $stmt = $pdo->prepare($statement);
      $result = $stmt->execute($args);
      if ($result === false)
        throw new \Exception('Error: ' . var_export($pdo->errorCode(), true));
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if ($result === false)
      throw new \Exception('Error: ' . var_export($pdo->errorCode(), true));
    return $result;
  }

  public static function get_pdo()
  {
    global $pdo;
    if (!$pdo instanceof PDO) {
      $db_info = get_config('database');
      $pdo = new PDO(
        $db_info['driver'] . ':' .
        'dbname=' . $db_info['database'] . ';' .
        'host=' . $db_info['host'] . ';' ,
        $db_info['user'], $db_info['password']
      );
    }
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    return $pdo;
  }
}