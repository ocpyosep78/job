<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('is_company_link')) {
	function is_company_link() {
		preg_match('/company\/(\d+)$/i', $_SERVER['REQUEST_URI'], $match);
		$is_company_link = (isset($match[1]) && !empty($match[1])) ? true : false;
		return $is_company_link;
	}
}

$is_website = true;
$url_arg = preg_replace('/(^\/|\/$)/i', '', @$_SERVER['argv'][0]);
$array_arg = explode('/', $url_arg);
if (count($array_arg) > 1) {
	$key = $array_arg[0];
	$is_company_link = is_company_link();
	
	if ($is_company_link) {
		$is_website = true;
	} else if (in_array($key, array('seeker'))) {
		$is_website = false;
		$route['seeker/(:num)/(:any)'] = "seeker/publish";
	} else if (in_array($key, array('company', 'editor', 'panel', 'master', 'subscribe'))) {
		$is_website = false;
	}
}

if ($is_website) {
	$route['(:any)'] = "website/home";
}

$route['default_controller'] = "website/home";
$route['404_override'] = '';