<?php

namespace TTSCJ;

use TTSCJ\Admin;
use TTSCJ\Post;
use TTSCJ\Settings;
use TTSCJ\Traits\Singleton;

class TTSCJ
{
    use Singleton;

    protected function init(): void
    {
        register_activation_hook(__FILE__, [$this, 'activate']);

        Settings::instance();
        Admin::instance();

        add_action('wp_head', [$this, 'wpHead'], 12);
    }

    public function wpHead()
    {
        if (!is_single()) {
            return;
        }

        $post = get_post();

        if (!$post) {
            return;
        }

        if ($post->post_type === 'post' && empty(get_option('ttscj_enable_on_posts'))) {
            return;
        } elseif ($post->post_type === 'page' && empty(get_option('ttscj_enable_on_pages'))) {
            return;
        }

        $post = new Post($post);
        $code = $post->getCode();

        if ($code != '') {
            echo $code . "\n";
        }
    }

    /**
     * Add some options with default values
     */
    public function activate()
    {

        foreach (Settings::instance()->settings as $settings) {
            add_option($settings['id'], $settings['default']);
        }
    }

    /**
     * Delete all the options
     */
    public function uninstall()
    {
        foreach (Settings::instance()->settings as $settings) {
            delete_option($settings['id']);
        }
    }
}
