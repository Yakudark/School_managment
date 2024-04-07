<?php

/**
 * functions model
 */

function get_var($key, $default = '')
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}

function get_select($key, $value)
{
    if (isset($_POST[$key])) {
        if ($_POST[$key] == $value) {
            return "selected";
        }
    }
    return "";
}


function esc($var)
{
    return htmlspecialchars($var);
}

function random_string($length)
{
    $array = array(
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9,
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
        'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
        'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N',
        'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
        'Y', 'Z'
    );
    $text = "";

    for ($x = 0; $x < $length; $x++) {
        $random = rand(0, 61);
        $text .= $array[$random];
    }
    return $text;
}

function get_date($date, $format = 'dd MMMM y, H:mm:ss')
{
    $date = new DateTime($date, new DateTimeZone('Europe/Paris'));
    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
    $formatter->setPattern($format);
    return $formatter->format($date);
}

function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function get_image($image, $gender)
{
    if (!file_exists($image)) {
        $image = ASSETS . '/female.png';
        if ($gender == 'Homme') {
            $image = ASSETS . '/male.png';
        }
    }
    return $image;
}
