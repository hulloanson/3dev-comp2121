<?php


namespace tests;


use PHPUnit\Framework\TestCase;

$test_models = [
  'User' => ['email' => 'jojoma@gmail.com', 'password' => 'shit'],
  'Product' => [
    'name' => 'Test product',
    'code' => 'T0001',
    'cost' => 1.05,
    'price' => 2.10
  ],
  'ShoppingCart' => [
    'user_id' => 1,
    'product_id' => 1,
    'qty' => 1
  ],
  'WishList' => [
    'user_id' => 1,
    'product_id' => 1
  ]
];

/**
 * Class ModelTest
 * @package tests
 */
class ModelTest extends TestCase
{
  public function test_pre_test()
  {
    $error = false;
    $fp = fopen('../install.sql', 'r');
    if (!$fp)
      throw new \Exception('Unable to fopen install.sql');
    $content = fread($fp, filesize('../install.sql'));
    if ($content === false)
      throw new \Exception('Unable to fread install.sql');
    fclose($fp);
    \PDOHelper::exec($content);
  }

  public function test_get_table()
  {
    $this->assertEquals('shopping_cart', \ShoppingCart::get_table());
  }

  /**
   * @depends test_pre_test
   */
  public function test_save()
  {
    $saved_ids = [];
    global $test_models;
    foreach ($test_models as $model => $values) {
      $ins = new $model($values);
      $id = $ins->save();
      $saved_ids[strtolower($model) . '_id'] = $id;
    }
    return $saved_ids;
  }

  /**
   * @depends test_save
   */
  public function test_fetch($saved_ids)
  {
    global $test_models;
    $saved_ins = [];
    $error = false;
    foreach ($test_models as $model => $values) {
      $id = $saved_ids[strtolower($model) . '_id'];
      $ins = $model::find($id);
      if ($ins === null || $ins->id !== $id)
        throw new \Exception("Invalid instance of ${model}, id " . var_export($id, true) . ':'. var_export($ins, true));
      $saved_ins[$model] = $ins;
    }
    $this->assertNotTrue($error);
    return $saved_ins;
  }

  /**
   * @depends test_fetch
   */
  public function test_has_many($saved_ins)
  {
    // Test has many
    $cart = $saved_ins['User']->cart;
    $this->assertNotNull($cart);
    $this->assertNotEmpty($cart);
    $this->assertInstanceOf('ShoppingCart', $cart[0]);
    $this->assertEquals(1, $cart[0]->id);
  }

  /**
   * @depends test_fetch
   */
  public function test_relation_fail($saved_ins)
  {
    $session = $saved_ins['WishList']->session;
    $this->assertNull($session);
  }

  /**
   * @depends test_fetch
   */
  public function test_belongs_to($saved_ins)
  {
    $user = $saved_ins['WishList']->user;
    $this->assertNotNull($user);
    $this->assertNotEmpty($user);
    $this->assertInstanceOf('User', $user);
    $this->assertEquals(1, $user->id);
  }

}