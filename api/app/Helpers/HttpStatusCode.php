<?php
namespace App\Helpers;


use App\Interfaces\HttpStatusCodeInterface;
use Illuminate\Support\Facades\Response;

class HttpStatusCode implements HttpStatusCodeInterface
{
    /**
     * Standard response for successful HTTP requests. The actual response will depend on the request method used.
     * In a GET request, the response will contain an entity corresponding to the requested resource.
     * In a POST request, the response will contain an entity describing or containing the result of the action.[7]
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function success($status = '', $message = 'success', $content=array())
    {
        if (empty($content)) {
            $data = [
                'code' => 200,
                'status' => $status,
                'message' => $message
            ];
        } else {
            $data = [
                'code' => 200,
                'status' => $status,
                'message' => $message,
                'data' => $content
            ];
        }
        

        if (!isset($message))
            return $data;
        else
            return Response::json($data, $data['code']);

    }

    /**
     * The request has been fulfilled, resulting in the creation of a new resource
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function created($status = '', $message="CREATED", $content=array())
    {
        if (empty($content)) {
            $return = [
                'code' => 201,
                'status' => $status,
                'message' => $message
            ];
        } else {
            $return = [
                'code' => 201,
                'status' => $status,
                'message' => $message,
                'data' => $content
            ];
        }
        
        return Response::json($return, $return['code']);
    }

    /**
     * The server successfully processed the request and is not returning any data.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function noContent($status = '', $message="NO CONTENT", $content=array())
    {
        $return = [
            'code'=>204,
            'status' => $status,
            'message'=>$message,
            'data' => $content
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * The server successfully processed the request, but is not returning any data.
     * Unlike a 204 response, this response requires that the requester reset the document view.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function resetContent($message="RESET CONTENT", $content=array())
    {
        $return = [
            'code'=>205,
            'message'=>$message,
            'data' => $content
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * The server is delivering only part of the resource (byte serving) due to a range header sent by the client.
     * The range header is used by HTTP clients to enable resuming of interrupted downloads,
     * or split a download into multiple simultaneous streams.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function partialContent($message="PARTIAL CONTENT", $content=array())
    {
        $return = [
            'code'=>206,
            'message'=>$message,
            'data' => $content
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * The server cannot or will not process the request due to an apparent client error
     * (e.g., malformed request syntax, too large size, invalid request message framing, or deceptive request routing)
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function badRequest($status = '', $message="BAD REQUEST")
    {
        $data = [
            'code'      => 400,
            'status'    => $status,
            'message'   => $message
        ];
        return $data;
    }

    /**
     * Similar to 403 Forbidden, but specifically for use when authentication is required and has failed or has not yet been provided.
     * The response must include a WWW-Authenticate header field containing a challenge applicable to the requested resource.
     * See Basic access authentication and Digest access authentication.
     * 401 semantically means "unauthenticated",[34] i.e. the user does not have the necessary credentials.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function unauthorized($status = '', $message='UNAUTHORIZED ACCESS')
    {
        $return = [
            'code' => 401,
            'status' => $status,
            'message' => $message
        ];
        return Response::json($return, $return['code']);
    }

    public function notAcceptable($status = '', $message='Not acceptable')
    {
        $return = [
            'code' => 406,
            'status' => $status,
            'message' => $message
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * The request was a valid request, but the server is refusing to respond to it.
     * The user might be logged in but does not have the necessary permissions for the resource.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function forbidden($message="FORBIDDEN", $content=array())
    {
        $return = [
            'code'=>403,
            'message'=>$message,
            'data' => $content
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * The requested resource could not be found but may be available in the future.
     * Subsequent requests by the client are permissible.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function notFound($status='',  $message="NOT FOUND")
    {
        $return = [
            'code' => 404,
            'status' => $status,
            'message' => $message
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * The request is larger than the server is willing or able to process.
     * Previously called "Request Entity Too Large".
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function payloadToLarge($message="PAYLOAD TO LARGE", $content=array())
    {
        $return = [
            'code'=>413,
            'message'=>$message,
            'data' => $content
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * The request was well-formed but was unable to be followed due to semantic errors
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function unprocessableEntity($message="Unprocessable Entity", $content=array())
    {
        $return = [
            'code'=>422,
            'message'=>$message,
            'details' => $content
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * Error found during process
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function applicationValidationErrorCode($message="Error found", $content=array())
    {
        $return = [
            'code'=>423,
            'message'=>$message,
            'data' => $content
        ];
        return Response::json($return, $return['code']);
    }

    /**
     * A code of 498 indicates an expired or otherwise invalid token.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function invalidToken($status, $message="INVALID TOKEN")
    {
        $return = [
            'code'      => 498,
            'status'    => $status,
            'message'   => $message
        ];
        return Response::json($return, $return['code']);
    }

    /**
     *  A code of 499 indicates that a token is required but was not submitted.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function requiredToken($message="REQUIRED TOKEN", $content=array())
    {
        $return = [
            'code'=>499,
            'message'=>$message,
            'data' => $content
        ];
        return Response::json($return, $return['code']);
    }

    /**
     *  A generic error message, given when an unexpected condition was encountered and no more specific message is suitable.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function internalServerError($status = '', $message='INTERNAL SERVER ERROR')
    {
        $return = [
            'code' => 500,
            'status' => $status,
            'message' => $message
        ];
        return Response::json($return, $return['code']);
    }
}