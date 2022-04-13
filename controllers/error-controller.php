<?php
require_once(dirname(__FILE__).'/../config/config.php');

$idError = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

$errorMsg = ERROR_ARRAY[$idError];

include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/error.php');
include(dirname(__FILE__).'/../views/templates/footer.php');