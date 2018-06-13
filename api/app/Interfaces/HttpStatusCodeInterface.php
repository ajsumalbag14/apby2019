<?php

namespace App\Interfaces;


use Illuminate\Support\Facades\Response;

interface HttpStatusCodeInterface
{
    /**
     * Standard response for successful HTTP requests. The actual response will depend on the request method used.
     * In a GET request, the response will contain an entity corresponding to the requested resource.
     * In a POST request, the response will contain an entity describing or containing the result of the action.[7]
     *
     * @param string $message
     * @param array $content
     */
    public function success($status = '', $message = 'success', $content=array());

    /**
     * The request has been fulfilled, resulting in the creation of a new resource
     *
     * @param string $message
     * @param array $content
     */
    public function created($status = '', $message="CREATED", $content=array());

    /**
     * The server successfully processed the request and is not returning any data.
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function noContent($status = '', $message="NO CONTENT", $content=array());

    /**
     * The server successfully processed the request, but is not returning any data.
     * Unlike a 204 response, this response requires that the requester reset the document view.
     *
     * @param string $message
     * @param array $content
     */
    public function resetContent($message="RESET CONTENT",$content=array());

    /**
     * The server is delivering only part of the resource (byte serving) due to a range header sent by the client.
     * The range header is used by HTTP clients to enable resuming of interrupted downloads,
     * or split a download into multiple simultaneous streams.
     *
     * @param string $message
     * @param array $content
     */
    public function partialContent($message="PARTIAL CONTENT",$content=array());

    /**
     * The server cannot or will not process the request due to an apparent client error
     * (e.g., malformed request syntax, too large size, invalid request message framing, or deceptive request routing)
     *
     * @param string $message
     * @param array $content
     */
    public function badRequest($status = '', $message="BAD REQUEST");

    /**
     * Similar to 403 Forbidden, but specifically for use when authentication is required and has failed or has not yet been provided.
     * The response must include a WWW-Authenticate header field containing a challenge applicable to the requested resource.
     * See Basic access authentication and Digest access authentication.
     * 401 semantically means "unauthenticated",[34] i.e. the user does not have the necessary credentials.
     *
     * @param string $message
     * @param array $content
     */
    public function unauthorized($status = '', $message='UNAUTHORIZED ACCESS');

    /**
     * The request was a valid request, but the server is refusing to respond to it.
     * The user might be logged in but does not have the necessary permissions for the resource.
     *
     * @param string $message
     * @param array $content
     */
    public function forbidden($message="FORBIDDEN",$content=array());

    /**
     * The requested resource could not be found but may be available in the future.
     * Subsequent requests by the client are permissible.
     *
     * @param string $message
     * @param array $content
     */
    public function notFound($status='',  $message="NOT FOUND");

    /**
     * The request is larger than the server is willing or able to process.
     * Previously called "Request Entity Too Large".
     *
     * @param string $message
     * @param array $content
     */
    public function payloadToLarge($message="PAYLOAD TO LARGE",$content=array());

    /**
     * The request was well-formed but was unable to be followed due to semantic errors
     *
     * @param string $message
     * @param array $content
     */
    public function unprocessableEntity($message="Unprocessable Entity",$content=array());

    /**
     * Error found during process
     *
     * @param string $message
     * @param array $content
     * @return Response object
     */
    public function applicationValidationErrorCode($message="Error found",$content=array());

    /**
     * A code of 498 indicates an expired or otherwise invalid token.
     *
     * @param string $message
     * @param array $content
     */
    public function invalidToken($status, $message="INVALID TOKEN");

    /**
     *  A code of 499 indicates that a token is required but was not submitted.
     *
     * @param string $message
     * @param array $content
     */
    public function requiredToken($message="REQUIRED TOKEN",$content=array());

    /**
     *  A generic error message, given when an unexpected condition was encountered and no more specific message is suitable.
     *
     * @param string $message
     * @param array $content
     */
    public function internalServerError($status = '', $message='INTERNAL SERVER ERROR');
}