<?php

namespace App\Modules\Registration\Profile\Models;

use Illuminate\Database\Eloquent\Model;
 
class RegParty extends Model
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
	protected $table = 'reg_party';

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
		'name','email','mobile_no','affiliation', 'event_id',
		'updated_at', 'created_at'
	];

}
