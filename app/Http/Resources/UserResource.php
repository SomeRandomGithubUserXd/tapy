<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\User */
class UserResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        try {
            $pageLastUpdatedAt = $this->pages()
                ->orderBy('updated_at', 'DESC')
                ->first()
                ->updated_at
                ->diffForHumans();
        } catch (\Exception) {
            $pageLastUpdatedAt = 'Никогда';
        }
        return [
            'key' => $this->id,
            'email' => $this->email,
            'is_pro' => $this->is_pro ? 'Да': 'Нет',
            'is_admin' => $this->is_admin ? 'Да': 'Нет',
            'is_blocked' => $this->is_blocked ? 'Да': 'Нет',
            'updated_at' => $this->updated_at->diffForHumans(),
            'page_last_updated_at' => $pageLastUpdatedAt
        ];
    }
}
