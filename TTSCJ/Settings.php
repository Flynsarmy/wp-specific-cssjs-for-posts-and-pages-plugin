<?php

namespace TTSCJ;

use TTSCJ\Traits\Singleton;

class Settings
{
    use Singleton;

    public const SETTINGS_GROUP = 'ttscj_general_settings';
    public array $settings = [
            [
                "name" => 'Specific CSS/JS on posts',
                "desc" => 'Enable specific CSS/JS on posts',
                "id" => "ttscj_enable_on_posts",
                "default" => true,
                "type" => "checkbox"
            ],
            [
                "name" => 'Specific CSS/JS on pages',
                "desc" => 'Enable specific CSS/JS on pages',
                "id" => "ttscj_enable_on_pages",
                "default" => true,
                "type" => "checkbox"
            ],
    ];

    public function register(): void
    {
        foreach ($this->settings as $settings) {
            register_setting(self::SETTINGS_GROUP, $settings['id']);
        }
    }
}
