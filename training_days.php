<?php
/*
 * Profiling custom and internal functions.
 * Target: drupal training days.
 * Author: vrs11.
 */

/**
 * quicksort algorithm for array.
 * identical to php sort function.
 */
function quicksort($array) {
    if (($cnt = count($array)) == 0)
        return [];

    $pivot_element = $array[0];
    $left_element = $right_element = [];

    for ($i = 1; $i < $cnt; $i++) {
        if ($array[$i] < $pivot_element)
            $left_element[] = $array[$i];
        else
            $right_element[] = $array[$i];
    }

    return array_merge(quicksort($left_element), [$pivot_element], quicksort($right_element));
}

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
profile('custom array sort function: ', function() use (&$numbers, &$sorted)
{
    $sorted = quicksort($numbers);
});

/**
 * Sorting array for a test.
 * PHP sort function.
 */
$sorted =[];
profile('php array sort function: ', function() use (&$numbers, &$sorted)
{
    $sorted = sort($numbers);
});
