<?php

namespace App\Modules\Registration\Profile\Models;

use Illuminate\Database\Eloquent\Model;
 
class RegPool extends Model
{	

	/**
	 * Define connection of  model
	 * @var string
	 */
	protected $connection = 'mysql';

	/**
	 * Define table name
	 * @var string
	 */
	protected $table = 'reg_pool';

	/**
	 * Define primary key
	 * @var string
	 */
    protected $primaryKey = 'reg_pool_id';

    /**
     * Disable automatic timestamp of table
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Fillable field names
     * @var array
     */
	protected $fillable = [
		'affiliation', 'firstname', 'lastname', 'middlename', 'nickname', 'gender', 'email', 'mobile_no', 'role',
		'updated_at', 'created_at', 'ticket_id', 'event_id', 'activity','country','country_alt'
	];

}
