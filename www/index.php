<?php

require_once dirname(__FILE__) . '/../app/Yeahcheese_Controller.php';

/**
 * If you want to enable the UrlHandler, comment in following line,
 * and then you have to modify $action_map on app/Yeahcheese_UrlHandler.php .
 *
 */
// $_SERVER['URL_HANDLER'] = 'index';

/**
 * Run application.
 */
Yeahcheese_Controller::main('Yeahcheese_Controller', 'index');

