<?php


namespace tests;


use PHPUnit\Framework\TestCase;

$test_models = [
  'User'         => [ 'email' => 'jojoma@gmail.com', 'password' => 'shit' ],
  'Product'      => [
    'name'  => 'Test product',
    'code'  => 'T0001',
    'cost'  => 1.05,
    'price' => 2.10
  ],
  'ShoppingCart' => [
    'user_id'    => 1,
    'product_id' => 1,
    'qty'        => 1
  ],
  'WishList'     => [
    'user_id'    => 1,
    'product_id' => 1
  ]
];

/**
 * Class ModelTest
 * @package tests
 */
class ModelTest extends TestCase {
  public function test_pre_test() {
    $error = false;
    try {
      $fp = fopen( '../install.sql', 'r' );
      if ( ! $fp )
        throw new \Exception( 'Unable to fopen install.sql' );
      $content = fread( $fp, filesize( '../install.sql' ) );
      if ( $content === false )
        throw new \Exception( 'Unable to fread install.sql' );
      fclose( $fp );
      \PDOHelper::exec( $content );
    } catch ( \Exception $e ) {
      $error = true;
    }
    $this->assertNotTrue( $error );
  }

  public function test_get_table() {
    $this->assertEquals( 'shopping_cart', \ShoppingCart::get_table() );
  }

  /**
   * @depends test_pre_test
   */
  public function test_save() {
    $saved_ids = [];
    global $test_models;
    $error = false;
    try {
      foreach ( $test_models as $model => $values ) {
        $ins = new $model( $values );
        $id  = $ins->save();
        if ( $id === 0 )
          throw new \Exception( 'Unexpected: existing instance' );
        $saved_ids[ strtolower( $model ) . '_id' ] = $id;
      }
    } catch ( \Exception $e ) {
      $error = true;
    }
    $this->assertNotTrue( $error );
    return $saved_ids;
  }

  /**
   * @depends test_save
   */
  public function test_fetch($saved_ids) {
    global $test_models;
    $error = false;
    try {
      foreach ( $test_models as $model => $values ) {
        $id  = $saved_ids[ strtolower( $model ) . '_id' ];
        $ins = $model::find( $id );
        if ( $ins === null || intval($ins->id) !== $id )
          throw new \Exception( 'Invalid instance' );
      }
    } catch ( \Exception $e ) {
      $error = true;
    }
    $this->assertNotTrue( $error );
  }
}