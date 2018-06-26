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
                'country' 	    => 'required|string',
                'firstname' 	=> 'required|string',
                'lastname'		=> 'required|string',
                'middlename'    => 'required|string',
                'nickname'		=> 'required|string',
                'gender'		=> 'string',
                'email'			=> 'required|email',
                'mobile'		=> 'required|string',
                'org'   		=> 'required|string',
                'role'  		=> 'string'
            ]
        );

        if ($validator->fails()) {
            $response = [
                'code'      => 400,
                'status'    => 'PR000',
                'message'   => $validator->errors()
            ];
        } else {

            $response = [
                'code'  => 200,
                'data'  => [
                    'country_alt'   => $request->country,
                    'firstname'     => $request->firstname ? $request->firstname : 'firstname',
                    'lastname'      => $request->lastname ? $request->lastname : 'lastname',
                    'middlename'    => $request->middlename ? $request->middlename : 'middlename',
                    'nickname'      => $request->nickname ? $request->nickname : 'nickname',
                    'gender'        => $request->gender ? $request->gender : 'gender',
                    'email'         => $request->email ? $request->email : 'email@email.com',
                    'mobile_no'     => $request->mobile ? $request->mobile : '0123456789',
                    'affiliation'   => $request->org ? $request->org : 'affiliation',
                    'role'          => $request->role ? $request->role : 'role',
                    'ticket_id'     => 1,
                    'activity'      => 'workshop 1',
                    'event_id'      => 1
                ]
            ];
        }

        return $response;
    }
    
    
}