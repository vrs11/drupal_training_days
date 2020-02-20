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

/**
 * Generating and shuffling an array for a sort test.
 * Custom way.
 */
$numbers = [];
profile('custom array generate: ', function() use (&$numbers)
{
    for ($i = 0; $i < 10000000; $i++) {
        $numbers[] = $i;
    }
    shuffle($numbers);
});

/**
 * Generating and shuffling an array for a sort test.
 * Functions way.
 */
$numbers = [];
profile('internal array generate: ', function() use (&$numbers)
{
    $numbers = range(0, 10000000, 1);
    shuffle($numbers);
});
