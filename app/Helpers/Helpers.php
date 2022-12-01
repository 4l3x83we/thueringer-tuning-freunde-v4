<?php

namespace App\Helpers;

class Helpers
{
    public static function replaceStrToLower($item): string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", "-");

        return strtolower(str_replace($search, $replace, $item));
    }

    public static function replaceStrToUpper($item): string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", "-");

        return strtoupper(str_replace($search, $replace, $item));
    }

    public static function replaceBlank($item): string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", "-");

        return str_replace($search, $replace, $item);
    }

    public static function replaceBlankMinus($item): string
    {
        $search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´", " ", "-", "_");
        $replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "", "-", " ", "-");

        return str_replace($search, $replace, $item);
    }
}
