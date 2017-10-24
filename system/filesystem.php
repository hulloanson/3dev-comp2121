<?php

/**
 * @param string[] ...$paths One or more paths
 * @return string The joined path.
 */
function path_join(...$paths) {
  return preg_replace('#/+#','/',join('/', $paths));
}

/**
 * @param array $paths
 * @return string Full path from the root of file system to the requested directory / file
 * @internal param string $path A relative path starting from app root, leading slash or not
 */
function app(...$paths) {
  return call_user_func_array('path_join', array_merge([APP_ROOT], $paths));
}

function web(...$paths) {
  return call_user_func_array('path_join', array_merge([WEB_ROOT], $paths));
}

/**
 * Get page path by name. Return 404 page if not found.
 * @param string $page_name Page name as listed in page_dir directory without the extension
 * @return string Full path from the root of file system to the requested page
 */
function page($page_name) {
  $page_path = app(get_config('view', 'page_dir'), "${page_name}.php" );
  return is_file($page_path) ? $page_path : get_404();
}

function script($script) {
  $script_path = path_join(get_config('view', 'script_dir'), "${script}.js");
  return is_file(app($script_path)) ? web($script_path) : '';
}

function style($style) {
  $style_path = path_join('/', get_config('view', 'style_dir'), "${style}.css");
  return is_file(app($style_path)) ? web($style_path) : '';
}

function image($image) {
  $image_path = path_join('/', get_config('view', 'image_dir'), "${image}");
  return is_file(app($image_path)) ? web($image_path) : '';
}