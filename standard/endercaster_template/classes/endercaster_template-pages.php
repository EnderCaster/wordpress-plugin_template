<?php

/**
 * @package endercaster_template
 * @subpackage classes
 */

namespace EnderCaster\endercaster_template;

class Pages
{
    public function run()
    {
        Hooks::add_action("admin_menu", [$this, "add_menu_item"]);
    }

    //pages to show
    public function example_page()
    {
?>
        <h1>Hello World</h1>
<?php
    }

    //add pages to menu
    function add_menu_item()
    {
        add_menu_page("Example", "Example", "manage_options", "endercaster_template-example", [$this, "example_page"], null, 99);
        add_submenu_page('endercaster_template-example', 'Different', 'Different', 'manage_options', 'endercaster_template-example', [$this, "example_page"]);
        add_submenu_page('endercaster_template-example', 'But', 'But', 'manage_options', 'endercaster_template-example', [$this, "example_page"]);
        add_submenu_page('endercaster_template-example', 'Same', 'Same', 'manage_options', 'endercaster_template-example', [$this, "example_page"]);
    }
}
