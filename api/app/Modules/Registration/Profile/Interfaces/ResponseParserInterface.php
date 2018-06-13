<?php

namespace App\Modules\Registration\Profile\Interfaces;

interface ResponseParserInterface 
{
    public function regInsertResponse($response = []);
}