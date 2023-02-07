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

    public const PRO_PAGES_LIMIT = 10;

    public const NON_PRO_PAGES_LIMIT = 1;

    public static string $tempImagesCollection = 'TEMP_IMAGES_COLLECTION';

    protected $appends = ['is_pro', 'pages_limit'];

    protected $fillable = [
        'email',
        'password',
        'subscribed_until',
        'is_admin',
        'is_blocked',
        'pages_limit'
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
        if ($pagesCount >= $this->pages_limit) {
            $can = false;
        }
        return $can;
    }

    public function getPagesLimitAttribute($value): int
    {
        if (!$value) {
            if ($this->is_pro) {
                return self::PRO_PAGES_LIMIT;
            } else {
                return self::NON_PRO_PAGES_LIMIT;
            }
        }
        return $value;
    }
}
