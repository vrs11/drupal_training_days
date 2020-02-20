<?php
/*
 * Good code examples.
 * Target: drupal training days.
 * Author: vrs11.
 */

/**
 * Functions in cycles.
 */
//Bad Practice:
for ($i = 0, $i <= count($array);  $i++) {
//statements
}

//Good Practice:
$count = count($array);
for ($i = 0; $i < $count;  $i++) {
//statements
}