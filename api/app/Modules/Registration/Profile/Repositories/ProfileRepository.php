<?php

namespace App\Modules\Registration\Profile\Repositories;

use Ramsey\Uuid\Uuid;
use App\Interfaces\LogSystemInterface;
use App\Modules\Registration\Profile\Models\RegPool;
use App\Modules\Registration\Profile\Interfaces\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    protected $module = "Registration";
    protected $service = "Profile";
    private $_log;
    private $_repoPool;

    public function __construct(
        LogSystemInterface $log,
        RegPool $pool
    )
    {
        $this->_repoPool = $pool;
        $this->_log = $log;
        $this->_log->module = $this->module;
        $this->_log->service = $this->service;
        $this->_log->class = __CLASS__;
    }

    public function insertProfile($params)
    {  
        try {

            $resource = $this->_repoPool;
            $resource->reg_pool_uuid = Uuid::uuid1();
            $resource->firstname = $params['firstname'];
            $resource->lastname = $params['lastname'];
            $resource->middlename = $params['middlename'];
            $resource->nickname = $params['nickname'];
            $resource->gender = $params['gender'];
            $resource->email = $params['email'];
            $resource->mobile_no = $params['mobile_no'];
            $resource->affiliation = $params['affiliation'];
            $resource->role  = $params['role'];
            $resource->activity = $params['activity'];
            $resource->ticket_id = $params['ticket_id'];
            $resource->event_id = $params['event_id'];
            $resource->created_at = $params['created_at'];

            if ($resource->save()) {
                $this->_log->info(__FUNCTION__, 'inserting record', $resource->toArray());
                $response = [
                    'code'      => 201,
                    'status'    => 'PR001',
                    'data'      => $resource->toArray()
                ];
            } else {
                $this->_log->info(__FUNCTION__, 'failed to insert record', []);
                $response = [
                    'code'      => 400,
                    'status'    => 'PR000',
                    'message'   => 'Something went wrong'
                ];
            }

            
        } catch (\Illuminate\Database\QueryException $ex) { 
            $this->_log->error(__FUNCTION__, 'DB_ERROR: '.$ex, []);
            $response = [
                'code'      => 500,
                'status'    => 'ER000',
                'message'   => 'Something went wrong'
            ];
        }

        return $response;
    }

    public function getProfile($email)
    {  
        try {

            $resource = $this->_repoPool::where('email', $email)->first();
            if ($resource) {
                $this->_log->info(__FUNCTION__, 'getting record', [$resource]);
                $response = [
                    'code'      => 200,
                    'status'    => 'PR001',
                    'data'      => $resource->toArray()
                ];
            } else {
                $this->_log->info(__FUNCTION__, 'no record found', []);
                $response = [
                    'code'      => 200,
                    'status'    => 'PR002',
                    'message'   => 'No existing email found'
                ];
            }

            
        } catch (\Illuminate\Database\QueryException $ex) { 
            $this->_log->error(__FUNCTION__, 'DB_ERROR: '.$ex, []);
            $response = [
                'code'      => 500,
                'status'    => 'ER000',
                'message'   => 'Something went wrong'
            ];
        }

        return $response;
    }
}