<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['page_id', 'source'];
}
