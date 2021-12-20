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

if (!function_exists('str_random')) {

    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param  int $length
     * @return string
     */
    function str_random(int $length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }
}

if (!function_exists('str_limit')) {

    /**
     * Limit the number of characters in a string.
     *
     * @param  string $value
     * @param  int $limit
     * @param  string $end
     * @return string
     */
    function str_limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }

        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }
}

if (!function_exists('str_contains')) {

    /**
     * Determine if a given string contains a given substring.
     *
     * @param  string $haystack
     * @param  string|array $needles
     * @return bool
     */
    function str_contains($haystack, $needles)
    {
        foreach ((array)$needles as $needle) {
            if ($needle != '' && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('str_is')) {

    /**
     * Determine if a given string matches a given pattern.
     *
     * @param  string $pattern
     * @param  string $value
     * @return bool
     */
    function str_is($pattern, $value)
    {
        if ($pattern == $value) {
            return true;
        }

        $pattern = preg_quote($pattern, '#');

        // Asterisks are translated into zero-or-more regular expression wildcards
        // to make it convenient to check if the strings starts with the given
        // pattern such as "library/*", making any string check convenient.
        $pattern = str_replace('\*', '.*', $pattern) . '\z';

        return (bool)preg_match('#^' . $pattern . '#', $value);
    }
}

if (!function_exists('str_finish')) {

    /**
     * Cap a string with a single instance of a given value.
     *
     * @param  string $value
     * @param  string $cap
     * @return string
     */
    function str_finish($value, $cap)
    {
        $quoted = preg_quote($cap, '/');

        return preg_replace('/(?:' . $quoted . ')+$/u', '', $value) . $cap;
    }
}

if (!function_exists('callAPI')) {

    /**
     * Call API
     *
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $header
     * @return array
     */
    function callAPI($method, $url, $data, $headers = false)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        if (!$headers) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: Accept application/json',
                'application/json: application/json',
            ));
        } else {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: Accept application/json',
                'application/json: application/json',
                $headers
            ));
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_VERBOSE, true);

        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        
        return json_decode($result, true);
    }
}