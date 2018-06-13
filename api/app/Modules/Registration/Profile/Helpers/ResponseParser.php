<?php

namespace App\Modules\Registration\Profile\Helpers;

use App\Interfaces\HttpResponseHelperInterface;
use App\Modules\Registration\Profile\Interfaces\ResponseParserInterface;

class ResponseParser implements ResponseParserInterface
{

    private $_status;

    public function __construct(HttpResponseHelperInterface $status)
    {
        $this->_status = $status;
    }

    public function regInsertResponse($response = [])
    {

        if ($response['code'] == 201 && !empty($response['data'])) {
    
            $data = [
                'id'            => $response['data']['id'],
                'firstname'     => $response['data']['firstname'],
                'lastname'      => $response['data']['lastname'],
                'gender'        => $response['data']['gender'],
                'email'         => $response['data']['email'],
                'birthdate'     => $response['data']['birthdate'],
                'created_at'    => $response['data']['created_at']
            ];

            $response['data'] = $data;

            return $this->_status->httpResponse($response);

        } else {

            return $this->_status->httpResponse($response);
        
        }

    }
    
}