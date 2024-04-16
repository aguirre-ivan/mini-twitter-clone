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