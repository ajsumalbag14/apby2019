<?php

namespace App\Modules\Registration\Profile\Services;

use Carbon\Carbon;
use App\Interfaces\LogSystemInterface;
use App\Modules\Registration\Profile\Interfaces\ProfileServiceInterface;
use App\Modules\Registration\Profile\Interfaces\ProfileRepositoryInterface;

class ProfileService implements ProfileServiceInterface
{
    protected $module = "Registration";
    protected $service = "Profile";
    private $_log;
    private $_repo;

    public function __construct(
        LogSystemInterface $log,
        ProfileRepositoryInterface $repo
    )
    {
        $this->_repo = $repo;
        $this->_log = $log;
        $this->_log->module = $this->module;
        $this->_log->service = $this->service;
        $this->_log->class = __CLASS__;
    }

    public function insertProfileService($request)
    {
        $update = [
            'created_at'    => Carbon::now()
        ];

        $params = array_merge($request, $update);

        $this->_log->info(__FUNCTION__, 'send to insert profile', [$params]);
        $user_profile = $this->_repo->insertProfile($params);
        
        if ($user_profile['code'] == 201) {
            $this->_log->info(__FUNCTION__, 'inserted resource', [$user_profile]);

            $response = [
                'code'      => 201,
                'status'    => 'PR001',
                'message'   => 'Success',
                'data'      => $user_profile['data']
            ];
        } else {
            $response = $user_profile;
        }
        

        return $response;

    }

}