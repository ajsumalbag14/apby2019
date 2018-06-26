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
        //get country
        $ct = config('constants.asia_pacific');
        foreach ($ct as $key => $val) {
            if ($key == $request['country_alt']) {
                $country = $val;
                break;
            }
        }

        $date = [
            'country'    => $country,       
            'created_at' => Carbon::now()
        ];

        $params = array_merge($request, $date);

        $this->_log->info(__FUNCTION__, 'send to insert profile', [$params]);
        $user_profile = $this->_repo->insertProfile($params);
        
        if ($user_profile['code'] == 201) {
            $this->_log->info(__FUNCTION__, 'inserted resource', [$user_profile]);

            $response = [
                'code'      => 201,
                'status'    => 'RP001',
                'message'   => 'Success',
                'data'      => $user_profile['data']
            ];
        } else {
            $response = $user_profile;
        }
        

        return $response;

    }

    public function checkDupsEmail($request)
    {
        $email = $request['email'];
        $this->_log->info(__FUNCTION__, 'check email', [$email]);
        $user_profile = $this->_repo->getProfile($email);
        
        if ($user_profile['status'] == 'PR001') {
            $this->_log->info(__FUNCTION__, 'selected resource', [$user_profile]);
            $response = [
                'code'      => 200,
                'status'    => 'PR001',
                'message'   => 'Email already exists.'
            ];
        } else {
            $response = $user_profile;
        }
        

        return $response;

    }

}