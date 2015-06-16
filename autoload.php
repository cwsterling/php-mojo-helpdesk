<?php

function __autoload($className) {
    if(file_exists('./php-mojo-helpdesk/'.$className . '.php')) {
        require_once('./php-mojo-helpdesk/'.$className . '.php');    
    } else {
        throw new Exception("Unable to load $className.");
    }
}