<?php

/**
 * @package endercaster_template
 * @subpackage classes
 */

namespace EnderCaster\endercaster_template;

class Runner
{
    public function run()
    {
        $this->load('Utils');
        $this->load('Pages');
        $this->load('Hooks');
        $this->load('Utils'); //utils function may used in other files
        $pages = new Pages();
        $pages->run();
        $hooks = new Hooks();
        $hooks->run();
    }

    public function load($class)
    {
        $file = plugin_dir_path(dirname(__FILE__)) . 'classes/endercaster_template-' . strtolower($class) . '.php';
        require_once $file;
    }

    public function install()
    {
    }

    public function uninstall()
    {
    }
}
