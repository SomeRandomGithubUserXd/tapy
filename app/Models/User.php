<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Page\Page;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = ['is_pro'];

    protected $fillable = [
        'email',
        'password',
        'role',
        'subscribed_until'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'subscribed_until' => 'date',
    ];

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getIsProAttribute()
    {
        return $this->subscribed_until && $this->subscribed_until->greaterThanOrEqualTo(Carbon::now());
    }

    public function canCreateMorePages()
    {
        $can = true;
        $pagesCount = $this->pages()->count();
        if ($this->is_pro) {
            if ($pagesCount >= 10) {
                $can = false;
            }
        } elseif ($pagesCount >= 1) {
            $can = false;
        }
        return $can;
    }
}
