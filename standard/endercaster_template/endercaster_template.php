<?php
/*
Plugin Name: EnderCaster Template
Plugin URI: https://wordpress.endercaster.com/
Description: A template for create complicated plugins
Author: EnderCaster
Version: 0.0.1
Author URI: https://wordpress.endercaster.com/
*/
if (!defined('WPINC')) {
    die;
}
require_once plugin_dir_path(__FILE__) . '/classes/endercaster_template-runner.php';
$runner = new \EnderCaster\endercaster_template\Runner();
function install_endercaster_template()
{
    global $runner;
    $runner->install();
}

register_activation_hook(__FILE__, 'install_endercaster_template');
function uninstall_endercaster_template()
{
    global $runner;
    $runner->uninstall();
}

register_deactivation_hook(__FILE__, 'uninstall_endercaster_template');


$runner->run();