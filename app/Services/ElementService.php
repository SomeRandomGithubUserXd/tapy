<?php

namespace App\Services;

class ElementService
{
    public static function getAliasProps()
    {
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
        ];
    }
}
