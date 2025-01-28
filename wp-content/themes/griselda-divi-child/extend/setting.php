<?php

//Get Current Theme Details 
$theme = wp_get_theme();
// set current theme version
define('dc_version',$theme->version);
// set current theme name
define('dc_themename',$theme->name); 
// set current theme version
define('dc_themedesc',$theme->description);
// Set Changelogs
define('dc_changelogs', get_stylesheet_directory_uri() .'/demo/changelog.txt');
define('dc_theme_options_file_name','divi-theme-option.json');
define('dc_theme_options_url',get_stylesheet_directory_uri() .'/demo/divi-theme-option.json');
// Set Latest Product URL 
// Set customizer_settings Json File Name 
define('dc_customizer_settings_file_name','divi-customizer.dat ');
// Set customizer_settings Json File URL 
define('dc_customizer_settings_url',get_stylesheet_directory_uri() .'/demo/divi-customizer.dat');
// Pramary Menu Name
define('main_menu','main_menu');
// Secondary Menu
define('secondary_menu','');
// Footer Menu
define('footer_menu','');
// Front Page
define('front_page','Home');