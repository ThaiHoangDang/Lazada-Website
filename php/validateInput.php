<?php
function validate_length($value, int $min_length, $max_length = null)
{
    if ($max_length == null) {
        return strlen($value) >= $min_length;
    } else {
        return strlen($value) >= $min_length && strlen($value) <= $max_length;
    }
}
// function validate_length($value, int $min_length, int $max_length = strlen($value) + 1)
// {
//     return (strlen($value) > $min_length && strlen($value) < $max_length);
// }
function validate_password($pass): bool
{
    $pass_regex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,20}$/";
    return boolval(preg_match($pass_regex, $pass));
}

function validate_email($email): bool
{
    $email_regex = "/^(([a-zA-Z0-9][.]?){2,}|([a-zA-Z0-9]\.)+)([a-zA-Z0-9]|(?!\.))+?[a-zA-Z0-9][@](?=[^.])[a-zA-Z0-9.]+[.][a-zA-Z]{2,5}$/";
    return boolval(preg_match($email_regex, $email));
}
function validate_tel($tel): bool
{
    $phone_regex = "/^([0-9][-. ]?){8,10}[0-9]$/";
    return boolval(preg_match($phone_regex, $tel));
}
?>