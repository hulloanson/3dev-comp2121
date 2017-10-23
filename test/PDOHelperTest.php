<?php
/**
 * Created by: ycl
 * Date: 23/10/2017
 * Time: 2:06 AM
 */

namespace tests;

use PHPUnit\Framework\TestCase;
$pdo = null;
final class PDOHelperTest extends TestCase
{
  public function testGetPDO() {
    $pdo = \PDOHelper::get_pdo();
    $this->assertInstanceOf('PDO', $pdo);
  }
  public function testPDOFetch() {
    $result = \PDOHelper::fetch('select (5+5) as sum;');
    $this->assertEquals(['sum' => 10], $result);
  }
}