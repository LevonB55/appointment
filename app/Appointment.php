<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Appointment extends Model
{
	use HasRoles;

	protected $guard_name = 'web';	

	const APPOINTMENT_OPEN = 0;
	const APPOINTMENT_TAKEN = 1;
	const EMPTY_VALUE = null;
	

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
