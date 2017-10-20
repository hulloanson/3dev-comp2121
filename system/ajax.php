<?php
/**
 * Created by: ycl
 * Date: 20/10/2017
 * Time: 10:02 AM
 */

function handle_ajax() {
  global $req;
  if (!isset($req[1])) {
    set_ajax_headers();
    http_response_code(400);
    echo json_encode(['err' => "Ajax Route not specified"]);
    exit;
  }
  $class_name = hyp_to_camel($req[1]);
  if (!class_exists($class_name)) {
    set_ajax_headers();
    http_response_code(404);
    echo json_encode(['err' => "Ajax Handler ${class_name} not specified"]);
  }
  $handler = new $class_name;
  $action = !isset($req[2]) || empty($req[2]) ? 'index' : $req[2];
  if (!method_exists($handler, $action_method = "${action}Action")) {
    set_ajax_headers();
    http_response_code(404);
    echo json_encode(['err' => "${action_method} not found in ${class_name}"]);
  }
  call_user_func_array([$handler, $action_method], []);
  $_SERVER['REQUEST_METHOD'];
}

function set_ajax_headers() {
  header('Content-Type: application/json');
}

function ajax_send($data) {
  echo json_encode($data);
}

function sanitize_ajax_route() {

}

function hyp_to_camel($hyp_str) {
  return preg_replace('/-/', '', ucwords($hyp_str, '-'));
}