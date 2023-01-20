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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    public static string $tempImagesCollection = 'TEMP_IMAGES_COLLECTION';

    protected $appends = ['is_pro'];

    protected $fillable = [
        'email',
        'password',
        'subscribed_until',
        'is_admin'
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

    public function domains(): HasMany
    {
        return $this->hasMany(UserDomain::class);
    }

    public function themes(): HasMany
    {
        return $this->hasMany(Theme::class, 'user_id');
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
