<?php

namespace App\Modules\Registration\Profile\Helpers;

use Illuminate\Http\Request;
use Validator;
use App\Modules\Registration\Profile\Interfaces\RequestParserInterface;

class RequestParser implements RequestParserInterface
{
    
    public function regInsertRequest(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'affiliation'	=> 'string',
                'firstname' 	=> 'required|string',
                'lastname'		=> 'required|string',
                'gender'		=> 'string',
                'email'			=> 'required|email',
                'mobile'		=> 'string',
                'birthdate'		=> 'date',
                'mode'          => 'required|string'
            ]
        );

        if ($validator->fails()) {
            $response = [
                'code'      => 400,
                'status'    => 'PR000',
                'message'   => $validator->errors()
            ];
        } else {

            $tmp = strtotime($request->birthdate);
            $bdate = date('Y-m-d', $tmp);

            $response = [
                'affiliation'   => $request->affiliation ? $request->affiliation : '------',
                'firstname'     => $request->firstname ? $request->firstname : null,
                'lastname'      => $request->lastname ? $request->lastname : null,
                'gender'        => $request->gender ? $request->gender : null,
                'email'         => $request->email ? $request->email : null,
                'mobile_no'     => $request->mobile,
                'birthdate'     => $request->birthdate ? $bdate : null,
                'mode'          => $request->mode ? $request->mode : 'solo',
                'civil_status'  => 'NULL',
                'ticket_id'     => 1,
                'event_id'      => 1
            ];
        }

        return $response;
    }
    
    
}