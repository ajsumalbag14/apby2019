<?php

namespace App\Modules\Registration\Profile\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\LogSystemInterface;
use App\Interfaces\HttpResponseHelperInterface;
use App\Modules\Registration\Profile\Interfaces\RequestParserInterface;
use App\Modules\Registration\Profile\Interfaces\ProfileServiceInterface;
use App\Modules\Registration\Profile\Interfaces\ResponseParserInterface;

class ProfileController extends Controller 
{
    protected $module = "Registration";
    protected $service = "Profile";

    private $_status;
    private $_log;
    private $_requestParser;
    private $_responseParser;
    private $_service;

    public function __construct(
        HttpResponseHelperInterface $status,
        LogSystemInterface $log,
        RequestParserInterface $requestParser,
        ResponseParserInterface $responseParser,     
        ProfileServiceInterface $service
    )
    {
        $this->_requestParser = $requestParser;
        $this->_responseParser = $responseParser;
        $this->_service = $service;
        $this->_status = $status;
        $this->_log = $log;
        $this->_log->module = $this->module;
        $this->_log->service = $this->service;
        $this->_log->class = __CLASS__;
    }

    public function insertRecords(Request $request)
    {
        //log activity
        $this->_log->info(__FUNCTION__, "Form parameters", $request->all());
        
        //Validate and Parse request
        $parsedRequest = $this->_requestParser->regInsertRequest($request);

        //Insert/update user record
        $reg_user = $this->_service->insertProfileService($parsedRequest);

        $this->_log->info(__FUNCTION__, "response parameters", [$reg_user]);
        //parse response
        $parsedResponse = $this->_responseParser->regInsertResponse($reg_user);
    
        //throw response
        return $parsedResponse;
    }
}