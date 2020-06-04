<?php

/**
 * @package endercaster_template
 * @subpackage classes
 */

namespace EnderCaster\endercaster_template;

class Hooks
{
    public function run()
    {
        //add hooks
        self::add_action('admin_init', [$this, 'example']);
    }

    public function example()
    {
        echo "Hello EnderCaster";
    }

    public static function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1);
    }
}
