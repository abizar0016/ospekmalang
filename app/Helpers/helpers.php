<?php
// app/Helpers/helpers.php

if (!function_exists('getAppUrl')) {
    function getAppUrl()
    {
        return config('app.url');
    }
}
