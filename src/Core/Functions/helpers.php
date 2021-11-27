<?php

use Symfony\Component\HttpFoundation\Response;

if (!function_exists('render_template')) {

    /**
     * Render template
     *
     * @param string $page
     * @param array $data
     * @param Request $request
     * @return Response
     */
    function render_template($page, $data = [], $request = null)
    {
        if (!is_null($request)) {
            extract($request->attributes->all(), EXTR_SKIP);
        }
        extract($data, EXTR_SKIP);

        ob_start();
        include sprintf(__DIR__ . '/../../../src/pages/%s.php', $page);

        return new Response(ob_get_clean());
    }
}

if (!function_exists('env')) {

    /**
     * Get the value of an environment variable
     */
    function env($key, $default = '')
    {
        $value = '';
        if (isset($_ENV[$key])) {
            $value = $_ENV[$key];
        } else {
            $value = $default;
        }

        return $value;
    }
}

if (!function_exists('str_slug')) {

    /**
     * Generate a URL friendly "slug" from a given string.
     *
     * @param  string $string
     * @param  string $separator
     * @return string
     */
    function str_slug(string $string, string $separator = '-')
    {
        $lowercase_judul = strtolower($string);
        $replacespasi = str_replace(' ', $separator, $lowercase_judul);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $replacespasi);

        return $slug;
    }
}
