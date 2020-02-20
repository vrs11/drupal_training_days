<?php
/*
 * Good code examples.
 * Target: drupal training days.
 * Author: vrs11.
 */

/**
 * Magic numbers.
 */
// What the heck is 86400 for?
addExpireAt(86400);

const SECONDS_IN_A_DAY = 86400;
addExpireAt(DateGlobal::SECONDS_IN_A_DAY);