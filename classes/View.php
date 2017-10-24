<?php
/**
 * Created by: ycl
 * Date: 19/10/2017
 * Time: 11:42 PM
 */
class View
{
  protected $html_vars;
  protected $page_content;

  public function __construct()
  {
    $this->html_vars = ['scripts' => '', 'styles' => ''];
    $this->page_content = '';
  }

  protected function prep_vars() {
    global $req;
    $page = empty($req) || empty($req[0]) ? 'home' : $req[0];
    ob_start();
    include page($page);
    $this->page_content .= ob_get_contents();
    ob_end_clean();
    $this->style_tags();
    $this->script_tags();
//    var_dump($this->html_vars);
  }

  public function render()
  {
    $this->prep_vars();
    // Get controller
    extract($this->html_vars);
    // Prep page
    include app('layouts/header.php');

    echo $this->page_content;
    include app('layouts/footer.php');
//    $content = ob_get_contents();
//    ob_end_clean();
//    return $content;
//    ob_flush();
  }
  
  protected function script_tags() {
    global $res;
    if (!isset($res['scripts'])) return;
//    var_export($res['scripts']);
    foreach ($res['scripts'] as $script) {
      $this->html_vars['scripts'] .= "<script src='${script}' type='application/javascript'></script>";
    }
  }
  
  protected function style_tags() {
    global $res;
    if (!isset($res['styles'])) return;
    foreach ($res['styles'] as $style) {
      $this->html_vars['styles'] .= "<link href='${style}' rel='stylesheet' type='text/css'>";
    }
  }

}

