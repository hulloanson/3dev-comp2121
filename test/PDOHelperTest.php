<?php
/**
 * Created by: ycl
 * Date: 23/10/2017
 * Time: 2:06 AM
 */

namespace tests;

use PHPUnit\Framework\TestCase;

final class PDOHelperTest extends TestCase {
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

  public function test_get_pdo() {
    $pdo = \PDOHelper::get_pdo();
    $this->assertInstanceOf( 'PDO', $pdo );
  }

  public function test_pdo_fetch() {
    $result = \PDOHelper::fetch( 'select (5+5) as sum;' );
    $this->assertEquals( [[ 'sum' => 10 ]], $result );
  }

  public function test_transact() {
    $sql = 'insert into `user` (`email`, `password`) values (:email, :password);';
    \PDOHelper::transact( function () use ( $sql ) {
      \PDOHelper::exec( $sql, [
        ':email' => 'hulloanson@gmail.com',
        ':password' => 'shit'
      ] );
    } );
    $result = \PDOHelper::fetch(
      'select * from `user` where `email` = \'hulloanson@gmail.com\''
    );
    $this->assertNotEmpty($result);
    $this->assertEquals('hulloanson@gmail.com', $result[0]['email']);
  }

  public function test_transact_fail() {
    $sql = 'insert into `user` (`email`, `password`) values (:email, :password);';
    $thrown = false;
    try {
      \PDOHelper::transact( function () use ( $sql ) {
        \PDOHelper::exec( $sql, [
          ':email'    => 'haha@gmail.com',
          ':password' => 'shit'
        ] );
        throw new \Exception( 'troll' );
      } );
    } catch (\Exception $e) {
      $thrown = true;
    }
    $this->assertTrue($thrown);
    $result = \PDOHelper::fetch(
      'select * from `user` where `email` = \'haha@gmail.com\''
    );
    $this->assertEmpty($result);
  }
}