<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    public static string $photosMediaCollection = 'PHOTOS_COLLECTION';

    protected $fillable = ['user_id', 'name', 'description', 'price', 'old_price', 'action_btn', 'btn_label', 'btn_link', 'currency'];

    protected $appends = ['preview_photo', 'photos'];

    public function getPreviewPhotoAttribute(): string
    {
        if ($this->hasMedia(self::$photosMediaCollection)) {
            return $this
                ->getMedia(self::$photosMediaCollection)
                ->sortBy('order_column')
                ->first()
                ->getUrl();
        }
        return '';
    }

    public function getPhotosAttribute(): array
    {
        if ($this->hasMedia(self::$photosMediaCollection)) {
            $photos = [];
            foreach ($this->getMedia(self::$photosMediaCollection)->sortBy('order_column') as $photo) {
                $path = $photo->getPath();
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:application/' . $type . ';base64,' . base64_encode($data);
                $photos[] = [
                    'preview' => $photo->getUrl(),
                    'file' => $base64
                ];
            }
            return $photos;
        }
        return [];
    }
}
