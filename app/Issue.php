<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Issue extends Model
{

	public function user()
	{
		return $this->belongsTo('App\User');
	}

    public function delete()
    {
    	$this->delete();
    }
}
