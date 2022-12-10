<?php

namespace App\Services;

class ElementService
{
    public static function getAliasProps(): array
    {
        $initProductIds = [];
        $product = auth()->user()->products()->first();
        if($product) {
            $initProductIds = [$product->id];
        }
        return [
            'profile' => [
                'picture' => asset('placeholders/logo.svg'),
                'username' => '@username',
                'caption' => '',
                'position' => 'center'
            ],
            'link' => [
                'href' => 'https://google.com',
                'text' => 'My link',
                'caption' => '',
                'position' => 'center',
                'hide_icon' => false
            ],
            'social_buttons' => [
                'buttons' => [
                    [
                        'alias' => 'phone',
                        'value' => '+1234567890',
                    ]
                ],
                'view' => 'circle',
                'use_theme_colors' => false
            ],
            'header' => [
                'text' => 'Header',
                'textAlign' => 'justify',
                'fontStyle' => 'normal',
                'textDecoration' => 'none',
                'fontSize' => '20px',
            ],
            'text' => [
                'text' => 'Text',
                'textAlign' => 'justify',
                'fontStyle' => 'normal',
                'textDecoration' => 'none',
                'fontSize' => '15px',
            ],
            'faq' => [
                'faqs' => [
                    [
                        'question' => 'Question',
                        'answer' => 'Answer',
                        'order' => 0
                    ]
                ]
            ],
            'products' => [
                'product_ids' => $initProductIds,
                'user_id' => auth()->id(),
                'view' => 'grid'
            ],
            'atc' => [
                'name' => '',
                'surname' => '',
                'patronymic' => '',
                'phn' => '',
                'wpn' => '',
                'company' => '',
                'address' => '',
                'website' => '',
            ],
            'html' => [
                'html' => '',
            ],
            'image' => [
                'picture' => '',
                'view' => '',
                'rounded' => '',
                'square' => '',
                'zoom' => '',
                'caption' => '',
            ],
            'video' => [
                'url' => '',
                'caption' => '',
            ],
            'separator' => [
                'fw' => '',
                'smooth' => '',
            ],
        ];
    }
}
