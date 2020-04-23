<?php
/*
plugin name: {{plugin_name_show}}
plugin URI: 
description: 
author: {{author}}
author URI: {{author_website}}
version: 1.0
*/
function install_{{plugin_name}}(){

}
register_activation_hook( __FILE__, 'install_{{plugin_name}}' );
function uninstall_{{plugin_name}}(){

}
register_deactivation_hook( __FILE__, 'uninstall_{{plugin_name}}' );