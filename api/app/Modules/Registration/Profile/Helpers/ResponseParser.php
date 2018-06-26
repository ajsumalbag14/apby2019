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
                'uuid'          => $response['data']['reg_pool_uuid'],
                'firstname'     => $response['data']['firstname'],
                'lastname'      => $response['data']['lastname'],
                'middlename'    => $response['data']['middlename'],
                'nickname'      => $response['data']['nickname'],
                'gender'        => $response['data']['gender'],
                'email'         => $response['data']['email'],
                'organization'  => $response['data']['affiliation'],
                'role'          => $response['data']['role'],
                'country'       => $response['data']['country'],
                'country_alt'   => $response['data']['country_alt'],
                'created'       => $response['data']['created_at']
            ];

            $response['data'] = $data;

            return $this->_status->httpResponse($response);

        } else {

            return $this->_status->httpResponse($response);
        
        }

    }
    
}