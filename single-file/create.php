<?php
/**
 * To create a plugin with template, execute this
 */
class SingleTemplateProcessor{
    private $plugin_name;
    private $plugin_name_show;
    private $author;
    private $author_website;
    private $file;
    function __construct($plugin_name,$author="EnderCaster",$author_website="https://wordpress.endercaster.com/"){
        $this->plugin_name_show=$plugin_name;
        $this->plugin_name=$this->plugin_name_preprocessor($plugin_name);
        $this->author=$author;
        $this->author_website=$author_website;
    }
    function get_file(){
        return $this->file;
    }
    function set_file($file){
        $this->file=$file;
    }
    function replace($text,$mark,$content){
        return preg_replace("/".$mark."/",$content,$text);
    }
    function plugin_name_preprocessor($plugin_name){
        $plugin_name=strtolower($plugin_name);
        $plugin_name=preg_replace("/[^\w]/","_",$plugin_name);
        $plugin_name=preg_replace("/_*$/","",$plugin_name);
        return $plugin_name;
    }
    function output(){
        $file_contents=file_get_contents($this->get_file());
        $file_contents=$this->replace($file_contents,"{{author}}",$this->author);
        $file_contents=$this->replace($file_contents,"{{author_website}}",$this->author_website);
        $file_contents=$this->replace($file_contents,"{{plugin_name_show}}",$this->plugin_name_show);
        $file_contents=$this->replace($file_contents,"{{plugin_name}}",$this->plugin_name);
        file_put_contents($this->get_output_dir()."/".$this->plugin_name.".php",$file_contents);
    }
    function get_output_dir(){
        $pwd=dirname(__FILE__);
        $output_dir=$pwd.'/plugins';
        if(file_exists($output_dir)&&!is_dir($output_dir)){
            unlink($output_dir);
        }
        if(!file_exists($output_dir)){
            mkdir($output_dir);
        }
        return $output_dir;
    }
}
if(count($argv)<4){
    echo "Usage: \n";
    echo "php create.php 'plugin name' 'author' 'author url'\n";
    exit();
}
$plugin_name=$argv[1];
$author=$argv[2];
$author_website=$argv[3];
$processer=new SingleTemplateProcessor($plugin_name,$author,$author_website);
$processer->set_file(dirname(__FILE__)."/template.php");
$processer->output();