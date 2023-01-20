<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['containerStyle', 'blockStyle', 'elementStyle', 'user_id', 'linkStyle', 'overlayStyle'];
}
