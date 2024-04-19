<?php

/**
 * Debugging helper function for dumping variable contents and terminating script execution.
 *
 * Outputs the contents of a variable in a formatted and readable way within <pre> tags,
 * then stops script execution immediately.
 *
 * @param mixed $variable The variable to be dumped.
 */
function dd($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    die();
}

/**
 * Convert timestamp to a human-readable time format for tweets.
 *
 * @param int $timestamp The timestamp of the tweet.
 * @return string The formatted time string.
 */
function tweetTime($timestamp)
{
    $now = time();
    $diff = $now - $timestamp;

    if ($diff < 3600) { // If the difference is less than 1 hour
        $minutes = round($diff / 60);
        return "$minutes minuto" . ($minutes != 1 ? 's' : '') . " atrás";
    } elseif ($diff < 86400) { // If the difference is less than 1 day
        $hours = round($diff / 3600);
        return "$hours hora" . ($hours != 1 ? 's' : '') . " atrás";
    } elseif ($diff < 31536000) { // If the difference is less than 1 year
        $days = round($diff / 86400);
        return "$days día" . ($days != 1 ? 's' : '') . " atrás";
    } else { // If the difference is greater than or equal to 1 year
        return date("j M", $timestamp) . (date("Y", $now) != date("Y", $timestamp) ? ' Y' . date("Y", $timestamp) : '');
    }
}

/**
 * Convert timestamp to a human-readable time format for user creation time.
 *
 * @param int $timestamp The timestamp of user creation time.
 * @return string The formatted time string.
 */
function userCreatedTime($timestamp)
{
    return "Se unió en " . date("F", $timestamp) . " de " . date("Y", $timestamp);
}
