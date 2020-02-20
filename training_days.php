<?php
/*
 * Profiling custom and internal functions.
 * Target: drupal training days.
 * Author: vrs11.
 */

/**
 * Profiling code execution time.
 */
function profile($message, callable $func) {
    $start = microtime(true); //start time of execution in microseconds
    $func(); //user func to profile
    $end = microtime(true); //end time of execution in microseconds
    echo $message, $end-$start, PHP_EOL;
}

$string = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam rhoncus mauris at nisl molestie, 
           vel viverra elit elementum. Donec nec lobortis purus. Integer auctor nulla nisl, vitae sodales 
           dui lacinia quis. Nulla id massa nunc. Proin venenatis nisl sed tellus aliquet gravida. Nunc 
           sollicitudin id augue sit amet commodo. In hac habitasse platea dictumst. Nulla in tellus dolor. 
           Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur 
           non fermentum urna. Suspendisse molestie lacus eget pretium porttitor
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam rhoncus mauris at nisl molestie, 
           vel viverra elit elementum. Donec nec lobortis purus. Integer auctor nulla nisl, vitae sodales 
           dui lacinia quis. Nulla id massa nunc. Proin venenatis nisl sed tellus aliquet gravida. Nunc 
           sollicitudin id augue sit amet commodo. In hac habitasse platea dictumst. Nulla in tellus dolor. 
           Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur 
           non fermentum urna. Suspendisse molestie lacus eget pretium porttitor
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam rhoncus mauris at nisl molestie, 
           vel viverra elit elementum. Donec nec lobortis purus. Integer auctor nulla nisl, vitae sodales 
           dui lacinia quis. Nulla id massa nunc. Proin venenatis nisl sed tellus aliquet gravida. Nunc 
           sollicitudin id augue sit amet commodo. In hac habitasse platea dictumst. Nulla in tellus dolor. 
           Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur 
           non fermentum urna. Suspendisse molestie lacus eget pretium porttitor
           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam rhoncus mauris at nisl molestie, 
           vel viverra elit elementum. Donec nec lobortis purus. Integer auctor nulla nisl, vitae sodales 
           dui lacinia quis. Nulla id massa nunc. Proin venenatis nisl sed tellus aliquet gravida. Nunc 
           sollicitudin id augue sit amet commodo. In hac habitasse platea dictumst. Nulla in tellus dolor. 
           Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Curabitur 
           non fermentum urna. Suspendisse molestie lacus eget pretium porttitor';
/**
 * String reverse for a test.
 * Custom reverse function.
 */
profile('custom string reverse function: ', function() use (&$string)
{
    $tmp = '';
    for ($i = strlen($string) - 1; $i >= 0; $i--) {
        $tmp .= $string[$i];
    }
    $result = $tmp;
});

/**
 * String reverse for a test.
 * PHP way reverse function.
 */
profile('PHP strrev function: ', function() use (&$string)
{
    $result = strrev($string);
});
