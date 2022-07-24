<?php
/**
 * Dump and die
 *
 * @param boolean $flag
 * @param array $arguments
 * @return void
 */
function dd($flag = true, ...$arguments) {

    if (count($arguments)) {
    
    echo "<pre>";
    
    foreach($arguments as $arg) {
    
    var_dump($arg);
    
    }
    
    echo "</pre>";
    
    if ($flag) exit;
    
    }
    
    }

