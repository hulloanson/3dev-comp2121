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

  public function __construct($props = [])
  {
    if (empty($props)) return;
    foreach($props as $col => $value) {
      $this->$col = $value;
    }
  }

  public function __get($name) {
    if (!isset($this->data[$name])) return null;
    return $this->data[$name];
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

  public static function save_many($items) {
    if (empty($items)) throw new \Exception('Attempted to create items from empty array');
    PDOHelper::transact(function() use ($items) {
      foreach($items as $item) {
        $obj = new static($item);
        $obj->save();
      }
    });
  }

  public static function find($id) {
    $sql = 'select * from `' . self::get_table() . '` where ' . static::$id . ' = :id;';
    $result = PDOHelper::fetch($sql, [':id' => $id]);
    if (empty($result)) return null;
    return new static($result[0]);
  }

  public static function search($where, $one = false) {
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
    $sql .= ($one ? ' limit 1' : '');
    $sql .= ';';
    if (empty($results = PDOHelper::fetch($sql, $params))) return null;
    if ($one) return $results[0];
    return array_map(function($result){
      return new static($result);
    }, $results);
  }

  public static function get_table() {
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
