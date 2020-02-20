<?php

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
