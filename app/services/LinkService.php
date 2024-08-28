<?php
// app/Services/YourService.php

namespace App\Services;

class LinkService
{
    public function getAppUrl()
    {
        return config('app.url');
    }
}
