<?php
/**
 * Created by: ycl
 * Date: 25/10/2017
 * Time: 10:08 AM
 */

class Product extends Model
{
  public static $has_many = [
      'tags' => 'ProductTag',
  ];

  public static $has_many_through = [
      'tags' => [
          'through' => 'product_tag',
          'model' => 'Tag'
      ]
  ];

  public function add_tag($tag)
  {
    if ($this->id === null) throw new \Exception('Adding tag before saving product is not allowed.');
    (new ProductTag([
        'product_id' => $this->id,
        'tag' => $tag
    ]))->save();
  }
}