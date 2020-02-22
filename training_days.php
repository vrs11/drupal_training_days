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

$numbers = range(0, 10000000, 1); //generating test data
shuffle($numbers); //randomize an array

/**
 * Sorting array for a test.
 * Custom function.
 */
$sorted =[];
profile('test 1: ', function() use (&$numbers, &$sorted)
{
    $cnt = count($numbers);
    for ($i = 0; $i < $cnt; $i++) {
        $sorted[$i] = $numbers[$i];
    }
});

/**
 * Sorting array for a test.
 * PHP sort function.
 */
$sorted =[];
profile('test 2: ', function() use (&$numbers, &$sorted)
{
    foreach ($numbers as $number) {
        $number = 0;
    }
});

/**
 * Sorting array for a test.
 * PHP sort function.
 */
$sorted =[];
profile('test 3: ', function() use (&$numbers, &$sorted)
{
    foreach ($numbers as &$number) {
        $number = 0;
    }
});
