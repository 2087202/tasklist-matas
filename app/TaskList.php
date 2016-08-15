<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TaskList extends Model
{			

		use SoftDeletes;
		
        protected $table = 'lists';

         protected $dates = ['deleted_at'];



        
}
