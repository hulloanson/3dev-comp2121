<?php
/**
 * Created by: ycl
 * Date: 21/10/2017
 * Time: 1:44 AM
 */
// TODO: class Model: add soft delete support
class Model {
  const STYLE_OBJ = 0;

  const STYLE_ARRAY = 1;

  protected $data = [];

  protected static $table;

  protected static $id_name = 'id';

  protected static $props = [];

  protected static $unique = [];

  protected static $has_many = [];

  protected static $has_many_through = [];

  protected static $belongs_to = [];

  protected $exists = false;

  public function __construct( $props = [] ) {
    if ( empty( $props ) )
      return;
    foreach ( $props as $col => $value ) {
      $this->$col = $value;
    }
    $this->exists = $this->id !== null;
  }

  protected function is_relation( $name ) {
    if ( isset( static::$has_many[ $name ] ) )
      return 'has_many';
    else if ( isset( static::$has_many_through[ $name ] ) )
      return 'has_many_through';
    else if ( isset( static::$belongs_to[ $name ] ) )
      return 'belongs_to';
    else return false;
  }

  public function __get( $name ) {
    if ( ! isset( $this->data[ $name ] ) ) {
      // Search relationships
      $relation = $this->is_relation( $name );
      if ( ! $relation ) {
        return null;
      } else if ( $relation == 'has_many' ) {
        $self_table = static::get_table();
        $has_class  = static::$has_many[ $name ];

        return $has_class::search( [ "${self_table}_id" => $this->id ] );
      } else if ( $relation == 'has_many_through' ) {
        $self_table = static::get_table();

        return $this->data[ $name ] = static::$has_many_through[ $name ]['through']::search( [
          "${self_table}_id" => $this->{static::$id_name}
        ] );
      } else { // $in_belongs_to
        $belongs_class = static::$belongs_to[ $name ];
        $class_table   = $belongs_class::get_table();
        if ( ( $parent_id = $this->{"${class_table}_id"} ) === null )
          return null;

        return $belongs_class::find( $parent_id );
      }
    }

    return $this->data[ $name ];
  }

  public function __set( $name, $value ) {
    if (($relation_type = static::is_relation($name)) || $relation_type !== 'belongs_to')
      throw new \Exception('cannot use setters to set has many relationships');
    $this->data[ $name ] = $value;
  }

  public function __call( $name, $args ) {
    if ( ( $relation_type = static::is_relation( preg_filter( '^add_', '', $name ) ) ) ) {
      if (!isset($args[0]) || $relation_type === 'belongs_to')
        throw new \Exception( 'No data when adding foreign model in has many relationship' );
      if ($relation_type === 'has_many' || $relation_type === 'has_many_through') {
        $foreign_obj = new static::$has_many[ $name ]($args[0]);
        $self_foreign_id = static::get_table() . '_id';
        $self_id = $this->{static::$id_name};
        if ($relation_type === 'has_many') {
          $foreign_obj->$self_foreign_id = $self_id;
        }
        $foreign_obj_id = $foreign_obj->save();
        if ($relation_type === 'has_many_through') {
          $foreign_through = new static::$has_many_through[$name]['through'];
          $foreign_through->$self_foreign_id = $self_id;
          $foreign_through->{$foreign_obj::get_table() . '_id'} = $foreign_obj_id;
          $foreign_through->save();
        }
      }
    } else if ( ( $relation_type = static::is_relation( preg_filter( '^add_', '', $name ) ) ) ) {

    }
  }

  private function model_pre_save() {
    foreach ( static::$unique as $unique ) {
      if ( $this->$unique === null )
        continue;
      if ( ( $ins = static::search( [ $unique => $this->$unique ], true ) ) !== null
           && $ins->${static::$id_name} != $this->${static::$id_name}
      ) { // TODO: check id is string problem
        throw new \Exception( 'duplicate attribute' );
      }
    }
  }

  protected function pre_save() {
  }

  public function save() {
    $this->model_pre_save();
    $this->pre_save();
    if ( empty( $this->data ) )
      throw new \Exception( 'Attempted to save an empty model' );
    $cols   = '(';
    $vals   = '(';
    $params = [];
    $first  = true;
    foreach ( $this->data as $prop => $value ) {
      if ( $this->is_relation( $prop ) )
        continue;
      if ( $first ) {
        $first = false;
      } else {
        $cols .= ',';
        $vals .= ',';
      }
      $cols             .= "`$prop`";
      $place            = ":${prop}";
      $vals             .= $place;
      $params[ $place ] = $value;
    }
    $cols     .= ')';
    $vals     .= ')';
    $sql      = 'replace `' . self::get_table() . "` ${cols} values ${vals};";
    $id_known = $this->id !== null;
    PDOHelper::exec( $sql, $params );
    // Refresh the instance
    $new_props = static::find( $id_known ? $this->id : PDOHelper::get_pdo()->lastInsertId(), self::STYLE_ARRAY );
    $this->update( $new_props );
    $this->exists = true;

    return $this->id;
  }

  public function update( $props ) {
    foreach ( $props as $prop => $value ) {
      $this->$prop = $value;
    }
  }

  public static function save_many( $items ) {
    if ( empty( $items ) )
      throw new \Exception( 'Attempted to create items from empty array' );
    PDOHelper::transact( function () use ( $items ) {
      foreach ( $items as $item ) {
        $obj = new static( $item );
        $obj->save();
      }
    } );
  }

  public static function find( $id, $style = self::STYLE_OBJ ) {
//    if (($parsed_id = intval($id)) === 0) throw new \Exception("Invalid id value ${id} passed to find() function.");
    $sql    = 'SELECT * FROM `' . self::get_table() . '` WHERE ' . static::$id_name . ' = :id;';
    $result = PDOHelper::fetch( $sql, [ ':id' => $id ] );
    if ( empty( $result ) )
      return null;
    if ( $style === self::STYLE_ARRAY )
      return $result[0];
    else return new static( $result[0] );
  }

  public static function search( $where, $one = false ) {
    if ( ! is_array( $where ) || empty( $where ) )
      throw new \Exception( 'Empty parameters in model search' );
    $sql    = 'SELECT * FROM `' . self::get_table() . '` WHERE ';
    $params = [];
    $first  = true;
    foreach ( $where as $col => $val ) {
      if ( $first ) {
        $first = false;
      } else {
        $sql .= ' and';
      }
      $place            = ":${col}";
      $sql              .= " ${col} = ${place}";
      $params[ $place ] = $val;
    }
    $sql .= ( $one ? ' limit 1' : '' );
    $sql .= ';';
    if ( empty( $results = PDOHelper::fetch( $sql, $params ) ) )
      return null;
    if ( $one )
      return new static( $results[0] );

    return array_map( function ( $result ) {
      return new static( $result );
    }, $results );
  }

  public static function get_table() {
    if ( isset( static::$table ) && static::$table )
      return static::$table;
    $class_name = static::class;
    $split      = preg_split( '/[A-Z]/', $class_name, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE );
    $result     = '';
    foreach ( $split as $component ) {
      $cap_index = $component[1] - 1;
      if ( $cap_index !== 0 )
        $result .= '_';
      $result .= strtolower( $class_name[ $component[1] - 1 ] ) . $component[0];
    }

    return $result;
  }

  public function delete() {
    PDOHelper::exec( 'DELETE FROM ' . static::$table . ' WHERE ' . static::$id_name . ' = :id',
      [ ':id' => static::$id_name ]
    );
  }

}
