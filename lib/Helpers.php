<?php
function sanitizeSlash($string)
{
    return strtr($string, '/\\', DIRECTORY_SEPARATOR);
}