<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class LinkClick extends Model
{
    protected $fillable = ['page_id', 'link_name'];
}
