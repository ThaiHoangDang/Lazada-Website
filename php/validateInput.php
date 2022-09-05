<?php
function validate_length($value, int $min_length, $max_length = null)
{
    if ($max_length == null) {
        return strlen($value) >= $min_length;
    } else {
        return strlen($value) >= $min_length && strlen($value) <= $max_length;
    }
}
function validate_username($username): bool {
    $username_regex = "/[A-Za-z\d]{8,15}$/";
    return boolval(preg_match($username_regex, $username));    
}
function validate_password($pass): bool
{
    $pass_regex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,20}$/";
    return boolval(preg_match($pass_regex, $pass));
}

?>