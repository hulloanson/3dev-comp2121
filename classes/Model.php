<?php
/**
 * Created by: ycl
 * Date: 21/10/2017
 * Time: 1:44 AM
 */

class Model
{
  protected $table;
  
  private static $self_props = [
    'table'
  ];

  public function save($item) {
    $cols = '(';
    $vals = ')';
    $params = [];
    $first = true;
    foreach ($this as $prop => $value) {
      if (array_search($prop, self::$self_props) === false) continue;
      if ($first) {
        $first = false;
      } else {
        $col .= ',';
        $vals .= ',';
      }
      $col .= $prop;
      $place = ":${prop}";
      $vals .= $place;
      $params[$place] = $value;
    }
    if ($first) throw new \Exception('Error: Model has no self properties');
    $col .= ')';
    $vals .= ')';
    $sql = "insert into ${table} ${cols} values ${vals} on duplicate key update;";
    PDOHelper::exec($sql, $params);
  }

  public static function find($id) {
    $sql = "select * from ${table}
  }
}
