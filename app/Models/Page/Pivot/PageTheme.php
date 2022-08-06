<?php

namespace App\Models\Page\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PageTheme extends Pivot
{
    protected $fillable = ['page_id', 'theme_id'];
}
