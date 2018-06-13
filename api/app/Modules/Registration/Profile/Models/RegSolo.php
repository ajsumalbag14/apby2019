<?php

namespace App\Modules\Registration\Profile\Models;

use Illuminate\Database\Eloquent\Model;
 
class RegSolo extends Model
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
	protected $table = 'reg_solo';

	/**
	 * Define primary key
	 * @var string
	 */
    protected $primaryKey = 'id';

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
		'affiliation', 'firstname', 'lastname', 'gender', 'email', 'mobile_no', 'birthdate',
		'updated_at', 'created_at', 'civil_status', 'ticket_id', 'event_id', 'activity'
	];

}
