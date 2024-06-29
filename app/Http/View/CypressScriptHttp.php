<?php

/**
 * Php CS FIXER Hook
 **/

$PHP_CS_CONFIG = null;

if(file_exists('.phpcs'))
{
    $PHP_CS_CONFIG = '--config ".phpcs"';
}
else if(file_exists('.php_cs'))
{
    $PHP_CS_CONFIG = '--config ".php_cs"';
}

if($PHP_CS_CONFIG)
{
    echo "Run php-cs-fixer.. " . PHP_EOL;

    $PHP_CS_FIXER = "php-cs-fixer";

    exec("git diff --cached --name-only --diff-filter=ACM -- '*.php'", $CHANGED_FILES);

    if($CHANGED_FILES)
    {
        $CHANGED_FILES = implode(" ", $CHANGED_FILES);
        exec("$PHP_CS_FIXER fix $PHP_CS_CONFIG $CHANGED_FILES");
        exec("git add $CHANGED_FILES");
    }

    echo "php-cs-fixer pre commit hook finish" . PHP_EOL . PHP_EOL;
}
