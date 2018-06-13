<?php

namespace App\Helpers;

use App\Interfaces\HttpStatusCodeInterface;
use App\Interfaces\HttpResponseHelperInterface;

class HttpResponseHelper implements HttpResponseHelperInterface
{

    private $_status;

    public function __construct(HttpStatusCodeInterface $status)
    {
        $this->_status = $status;
    }

    public function httpResponse($response)
    {
        
        $data = empty($response['data']) ? [] : $response['data'];

        switch($response['code']) {

        case 200:
            $result = $this->_status->success(
                $response['status'], $response['message'], $data
            );
            break;
            
        case 201:
            $result = $this->_status->created(
                $response['status'], $response['message'], $data
            );
            break;

        case 204:
            $result = $this->_status->noContent(
                $response['status'], $response['message'], $data
            );
            break;

        case 500:
            $msg = isset($response['message']) ? $response['message'] : 'Something went wrong';
            $result = $this->_status->internalServerError(
                $response['status'], $msg
            );
            break;
        
        case 498:
            $msg = isset($response['message']) ? $response['message'] : 'Invalid token';
            $result = $this->_status->invalidToken(
                $response['status'], $msg
            );
            break;

        case 401:
            $msg = isset($response['message']) ? $response['message'] : 'Unauthorized access';
            $result = $this->_status->unauthorized(
                $response['status'], $msg
            );
            break;
        case 406:
            $msg = isset($response['message']) ? $response['message'] : 'Not acceptable';
            $result = $this->_status->notAcceptable(
                $response['status'], $msg
            );
            break;
        case 400:
            $msg = isset($response['message']) ? $response['message'] : 'Bad request';
            $result = $this->_status->badRequest(
                $response['status'], $msg
            );
            break;

        default:
        //not found
            $msg = isset($response['message']) ? $response['message'] : 'Resource not found';
            $result = $this->_status->notFound(
                $response['status'], $msg
            );

        }
        
        return $result;

    }
}