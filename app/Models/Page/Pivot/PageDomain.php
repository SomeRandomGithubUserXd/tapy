<?php

namespace App\Models\Page\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PageDomain extends Pivot
{
    protected $fillable = ['page_id', 'theme_id'];
}
