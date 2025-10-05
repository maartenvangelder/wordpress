<?php

use Verthe\Acf;
use Verthe\PostTypes;

// extended print function
if ( !function_exists('p') ) {
    function p($value = []) {
        $backtrace = debug_backtrace();
        unset( $backtrace[0]['args'] );

        echo '<div style="padding: 20px;"><pre>';
        print_r($value);
        if (empty($value)) {
            var_dump($value); echo '(var_dump)';
        }
        echo '<br><div class="alert alert-warning" role="alert">';
        foreach( $backtrace[0] as $key => $backtrace_value ) {
            echo $key . ': ' . $backtrace_value . '<br>';
        }
        echo '</div>';
        echo '</pre></div>';
    }
}

/**
 * We include function-only files (non-PSR-4 autoloadable, they're not classes) this way,
 * since including them in the theme composer.json will fail due to being 'hoisted' to
 * the main composer.json.
 */
$includes = [
    'lib/Verthe/Utils',
    'lib/Sage',
];
foreach ($includes as $directory) {
    $files = scandir(__DIR__ . '/' . $directory);
    foreach ($files as $file) {
        $filepath = locate_template($directory . '/' . $file);
        if (is_dir($file) || !$filepath) {
            continue;
        }
        require_once $filepath;
    }
}
unset($files, $file, $filepath);

/**
 * ACF (when available)
 */
try {
    (new Acf\Setup)->init();
} catch(\Exception $e) {
    // Let if fail silently
}

/**
 * Post Types
 */
(new PostTypes\Post)->init();
(new PostTypes\Page)->init();
(new PostTypes\Example)->init();

/**
 * API
 */
//(new \Verthe\API\Newsletter)->init();
