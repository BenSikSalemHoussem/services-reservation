<?php
class Validator {
    public static function string($value, $min = 1, $max = INF) {
        $value = trim($value);
        return is_string($value) && strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function numeric($value) {
        return is_numeric($value);
    }
}
?>