<?php
/**
 * Created by Ahmed Zidan.
 * email: php.ahmedzidan@gmail.com
 * Project: Alrabeh LMS
 * Date: 3/7/19
 * Time: 4:47 PM
 */
/**
 * @param $string
 * @param string $separator
 * @return bool|false|mixed|string|string[]|null
 */
function make_slug($string, $separator = '-')
{
    $string = trim($string);
    $string = mb_strtolower($string, 'UTF-8');

// Make alphanumeric (removes all other characters)
// this makes the string safe especially when used as a part of a URL
// this keeps latin characters and Persian characters as well
    $string = preg_replace("/[^a-z0-9_\s-۰۱۲۳۴۵۶۷۸۹ءاآؤئبپتثجچحخدذرزژسشصضطظعغفقکكگگلمنهويةىأ]/u", '', $string);

// Remove multiple dashes or whitespaces or underscores
    $string = preg_replace("/[\s-_]+/", ' ', $string);

// Convert whitespaces and underscore to the given separator
    $string = preg_replace("/[\s_]/", $separator, $string);

    return $string;
}
