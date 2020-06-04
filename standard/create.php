<?php

/**
 * To create a plugin with template, execute this
 */
class StandardTemplateProcessor
{
    private $plugin_name;
    private $plugin_name_show;
    private $author;
    private $author_website;
    private $file;
    function __construct($plugin_name, $author = "EnderCaster", $author_website = "https://wordpress.endercaster.com/")
    {
        $this->plugin_name_show = $plugin_name;
        $this->plugin_name = $this->plugin_name_preprocessor($plugin_name);
        $this->author = $author;
        $this->author_website = $author_website;
    }
    function get_file()
    {
        return $this->file;
    }
    function set_file($file)
    {
        $this->file = $file;
    }
    function replace($text, $mark, $content)
    {
        return preg_replace("/" . $mark . "/", $content, $text);
    }
    function plugin_name_preprocessor($plugin_name)
    {
        $plugin_name = strtolower($plugin_name);
        $plugin_name = preg_replace("/[^\w]/", "_", $plugin_name);
        $plugin_name = preg_replace("/_*$/", "", $plugin_name);
        return $plugin_name;
    }
    function output()
    {
        $file_contents = file_get_contents(dirname(__FILE__) . '/endercaster_template' . $this->get_file());
        $file_contents = $this->replace($file_contents, "EnderCaster Template", $this->plugin_name_show);
        $file_contents = $this->replace($file_contents, "EnderCaster", $this->author);
        $file_contents = $this->replace($file_contents, "https:\/\/wordpress.endercaster.com\/", $this->author_website);
        $file_contents = $this->replace($file_contents, "endercaster_template", $this->plugin_name);
        file_put_contents($this->get_output_dir() . '/' . str_replace('endercaster_template', $this->plugin_name, basename($this->get_file())), $file_contents);
    }
    function get_output_dir()
    {
        $pwd = dirname(__FILE__);
        $output_dir = $pwd . '/plugins/' . $this->plugin_name . '/' . dirname($this->get_file());
        if (file_exists($output_dir) && !is_dir($output_dir)) {
            unlink($output_dir);
        }
        if (!file_exists($output_dir)) {
            mkdir($output_dir, 0777, true);
        }
        return $output_dir;
    }
}
if (count($argv) < 4) {
    echo "Usage: \n";
    echo "php create.php 'plugin name' 'author' 'author url'\n";
    exit();
}
$plugin_name = $argv[1];
$author = $argv[2];
$author_website = $argv[3];
$processer = new StandardTemplateProcessor($plugin_name, $author, $author_website);
$file_list = [
    '/index.php',
    '/endercaster_template.php',
    '/classes/endercaster_template-pages.php',
    '/classes/endercaster_template-runner.php',
    '/classes/endercaster_template-utils.php',
    '/classes/endercaster_template-hooks.php',
];
foreach ($file_list as $file) {
    $processer->set_file($file);
    $processer->output();
}
