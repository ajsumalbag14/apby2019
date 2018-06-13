<?php

namespace App\Modules\Registration\Profile\Interfaces;

use Illuminate\Http\Request;

interface RequestParserInterface
{
    public function regInsertRequest(Request $request);
 
}