<?php
// load config
require_once 'config/config.php';

// // load libraries
// require_once 'libraries/Core.php';
// require_once 'libraries/Controller.php';
// require_once 'libraries/database.php';

require_once 'helpers/SESSION_helpers.php';
// autoload core libraries
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
}); 