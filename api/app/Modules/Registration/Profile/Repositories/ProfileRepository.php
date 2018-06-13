<?php

namespace App\Modules\Registration\Profile\Repositories;

use App\Interfaces\LogSystemInterface;
use App\Modules\Registration\Profile\Models\RegSolo;
use App\Modules\Registration\Profile\Models\RegParty;
use App\Modules\Registration\Profile\Interfaces\ProfileRepositoryInterface;

class ProfileRepository implements ProfileRepositoryInterface
{
    protected $module = "Registration";
    protected $service = "Profile";
    private $_log;
    private $_repoParty;
    private $_repoSolo;

    public function __construct(
        LogSystemInterface $log,
        RegSolo $solo,
        RegParty $party
    )
    {
        $this->_repoSolo = $solo;
        $this->_repoParty = $party;
        $this->_log = $log;
        $this->_log->module = $this->module;
        $this->_log->service = $this->service;
        $this->_log->class = __CLASS__;
    }

    public function insertProfile($params)
    {  
        try {

            $resource = $this->_repoSolo;
            $resource->affiliation = $params['affiliation'];
            $resource->firstname = $params['firstname'];
            $resource->lastname = $params['lastname'];
            $resource->gender = $params['gender'];
            $resource->email = $params['email'];
            $resource->mobile_no = $params['mobile_no'];
            $resource->birthdate = $params['birthdate'];
            $resource->civil_status  = $params['civil_status'];
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
}