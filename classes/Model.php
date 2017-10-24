<?php
/**
 * Created by: ycl
 * Date: 21/10/2017
 * Time: 1:44 AM
 */
// TODO: class Model: add soft delete support
class Model
{
  protected $data = [];

  protected static $table;

  protected static $id = 'id';

  protected static $props = [];

  public function __get($name) {
    if (!isset($this->data[$name])) return null;
    else return $this->data[$name];
  }

  public function __set($name, $value) {
    $this->data[$name] = $value;
  }

  protected function pre_save() {}

  public function save() {
    $this->pre_save();
    if (empty($this->data)) throw new \Exception('Attempted to save an empty model');
    $cols = '(';
    $vals = '(';
    $params = [];
    $first = true;
    foreach ($this->data as $prop => $value) {
      if ($first) {
        $first = false;
      } else {
        $cols .= ',';
        $vals .= ',';
      }
      $cols .= $prop;
      $place = ":${prop}";
      $vals .= $place;
      $params[$place] = $value;
    }
    $cols .= ')';
    $vals .= ')';
    $sql = 'replace `' . self::get_table() . "` ${cols} values ${vals};";
    PDOHelper::exec($sql, $params);
    if (!$this->id) {
      $this->id = intval( PDOHelper::get_pdo()->lastInsertId() );
      return $this->id;
    }
    return 0;
  }

  public static function find($id) {
    $sql = 'select * from `' . self::get_table() . '` where ' . static::$id . ' = :id;';
    $result = PDOHelper::fetch($sql, [':id' => $id]);
    if (empty($result)) return null;
    $obj = new static;
    foreach($result[0] as $col => $value) {
      $obj->$col = $value;
    }
    return $obj;
  }

  public static function search($where) {
    if ( !is_array($where) || empty($where)) throw new \Exception('Empty parameters in model search');
    $sql = 'select * from `' . self::get_table() . '` where ';
    $params = [];
    $first = true;
    foreach($where as $col => $val) {
      if ($first) { $first = false; }
      else { $sql .= ' and'; }
      $place = ":${col}";
      $sql .= " ${col} = ${place}";
      $params[$place] = $val;
    }
    $sql .= ';';
    if (empty($results = PDOHelper::fetch($sql, $params))) return $results;
    $objs = [];
    foreach($results as $result) {
      $obj = new static;
      foreach ($result as $col => $value) {
        $obj->$col = $value;
      }
      array_push($objs, $obj);
    }
    return $objs;
  }

  protected static function get_table() {
    if (isset(static::$table) && static::$table) return static::$table;
    $class_name = static::class;
    $split = preg_split('/[A-Z]/', $class_name,  null,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
    $result = '';
    foreach ($split as $component) {
      $cap_index = $component[1] - 1;
      if ($cap_index !== 0 ) $result .= '_';
      $result .= strtolower($class_name[$component[1] - 1]) . $component[0];
    }
    return $result;
  }
}
