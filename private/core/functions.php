<?php

/**
 * functions model
 */

//  vérifie si une certaine clé existe
function get_var($key, $default = '')
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}

// aide à générer des éléments de formulaire HTML de type select
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
    } else {
        $class = new Image();
        $image = ROOT . "/" . $class->profile_thumb($image);
    }
    return $image;
}

function views_path($view)
{
    if (file_exists("../private/views/" . $view . ".inc.php")) {
        return ("../private/views/" . $view . ".inc.php");
    } else {
        return ("../private/views/404.view.php");
    }
}
function upload_image($FILES)
{
    if (count($FILES) > 0) {

        $allowed[] = "image/jpeg";
        $allowed[] = "image/png";

        if ($FILES['image']['error'] == 0 && in_array($FILES['image']['type'], $allowed)) {
            $folder = "uploads/";
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $destination = $folder . time() . "_" . $FILES['image']['name'];
            move_uploaded_file($FILES['image']['tmp_name'], $destination);
            return $destination;
        }
    }

    return false;
}
