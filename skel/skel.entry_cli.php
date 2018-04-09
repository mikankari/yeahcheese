<?php
/**
 *  {$action_name}.php
 *
 *  @author     {$author}
 *  @package    Yeahcheese
 */
chdir(dirname(__FILE__));
require_once '{$dir_app}/Yeahcheese_Controller.php';

ini_set('max_execution_time', 0);

Yeahcheese_Controller::main_CLI('Yeahcheese_Controller', '{$action_name}');
