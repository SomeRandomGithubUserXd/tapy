<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public static array $themes = [
        [
            "containerStyle" => "background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(240, 242, 245);",
            "blockStyle" => "background-color: rgb(255, 255, 255);border-radius: 16px;color: #000000;",
            "elementStyle" => "background-color: rgb(24, 26, 34); opacity: 0.9; border: 2px none; border-radius: 10px;color: #ffffff !important",
        ],
        [
            "containerStyle" => "background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgba(195, 30, 57, 0.08);",
            "blockStyle" => "background-color: rgb(255, 255, 255);border-radius: 16px;color: #000000;",
            "elementStyle" => "background-color: rgb(195, 30, 57); opacity: 0.7; border: 2px none; border-radius: 28px;color: #ffffff !important",
        ],
        [
            "containerStyle" => "background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(1, 1, 1);",
            "blockStyle" => "background-color: rgb(32, 32, 32);border-radius: 16px;color: #ffffff;",
            "elementStyle" => "background-color: rgb(53, 62, 62); opacity: 0.9; border: 2px none; border-radius: 10px;color: rgb(221, 221, 221) !important;",
        ],
        [
            "containerStyle" => "background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(192, 185, 182);",
            "blockStyle" => "background-color: rgb(226, 218, 215);border-radius: 16px;color: #000000;",
            "elementStyle" => "background-color: rgb(251, 248, 247); opacity: 0.9; border: 2px none; border-radius: 28px;color: #000000 !important",
        ],
        [
            "containerStyle" => "background-color: linear-gradient(rgba(255, 0, 0, 0.125), transparent), linear-gradient(to left top, rgba(0, 255, 0, 0.125), transparent), linear-gradient(to right top, rgba(0, 0, 255, 0.125), transparent) rgba(255, 255, 255, 0);",
            "blockStyle" => "background-color: rgb(255, 255, 255);border-radius: 16px;color: #000000;",
            "elementStyle" => "background-color: rgb(39, 50, 62); opacity: 0.8; border: 2px none; border-radius: 28px;color: #ffffff !important",
        ],
        [
            "containerStyle" => "background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(249, 203, 76);",
            "blockStyle" => "background-color: rgba(255, 255, 255, 0);border-radius: 16px;color: #000000;",
            "elementStyle" => "background-color: rgb(255, 255, 255); opacity: 1; border: 2px solid rgb(0, 0, 0); border-radius: 0px;color: #000000 !important;box-shadow: rgba(0, 0, 0, 0.1) 4px 4px;",
        ],
        [
            "containerStyle" => "background-color: url('/backgrounds/dots.png') rgba(239, 235, 231, 0.9);",
            "blockStyle" => "background-color: rgb(255, 255, 255);border-radius: 16px;color: #000000;",
            "elementStyle" => "background-color: rgb(51, 51, 51); opacity: 0.7; border-radius: 0px; border-width: 2px;color: #ffffff !important;box-shadow: rgba(0, 0, 0, 0.1) 4px 4px 0px 0px;",
        ],
        [
            "containerStyle" => "background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(236, 242, 247);",
            "blockStyle" => "background-color: rgba(255, 255, 255, 0);border-radius: 16px;color: rgb(27, 61, 112);",
            "elementStyle" => "background-color: rgb(255, 255, 255); opacity: 1; border-radius: 28px; border-width: 2px;color: rgb(27, 61, 112) !important;box-shadow: rgba(0, 0, 0, 0.03) 0px 4px 0px 0px; border-radius: 28px;",
        ],
        [
            "containerStyle" => "background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; background-color: rgb(255, 255, 255);",
            "blockStyle" => "background-color: rgb(255, 255, 255);border-radius: 16px;color: #000000;",
            "elementStyle" => "background-color: rgb(255, 255, 255); opacity: 1; border: 2px solid rgb(51, 51, 51);color: #000000 !important;box-shadow: rgb(51, 51, 51) 5px 5px;",
        ],
        [
            "containerStyle" => "background-image: linear-gradient(45deg, rgb(20, 21, 49) 0%, rgb(32, 18, 45) 100%);",
            "blockStyle" => "background-color: rgb(42, 32, 69);border-radius: 16px;color: #ffffff;",
            "elementStyle" => "background-color: rgb(74, 73, 189); opacity: 1; border-radius: 10px; border-width: 2px;color: #ffffff !important",
        ],
    ];

    public function run()
    {
        foreach (self::$themes as $theme) {
            Theme::create($theme);
        }
    }
}
