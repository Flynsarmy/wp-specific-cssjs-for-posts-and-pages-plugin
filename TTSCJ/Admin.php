<?php

namespace TTSCJ;

use TTSCJ\Helpers;
use TTSCJ\Post;
use TTSCJ\Settings;
use TTSCJ\Traits\Singleton;
use WP_Post;

class Admin
{
    use Singleton;

    protected function init(): void
    {
        add_action('admin_init', [$this, 'adminInit']);
        add_action('admin_menu', [$this, 'adminMenu']);
    }

    public function adminInit()
    {
        Settings::instance()->register();
    }

    // Admin menu
    public function adminMenu()
    {
        // Create menu link under settings
        add_options_page(
            'Specific CSS/JS options',
            'Specific CSS/JS',
            'manage_options',
            'ttscj-options',
            [$this, 'optionsPage']
        );
        add_action('add_meta_boxes', [$this, 'addMetaBoxes']);
        add_action('save_post', [$this, 'savePost'], 10, 2);
    }

    public function optionsPage()
    {
        echo Helpers::requireWith(__DIR__ . '/../partials/backend/optionsPage/index.php', [
            'settings' => Settings::instance()->settings,
            'group' => Settings::instance()::SETTINGS_GROUP,
        ]);
    }

    public function addMetaBoxes()
    {
        $post_types = get_post_types('', 'names');

        foreach ($post_types as $post_type) {
            if (
                (get_option('ttscj_enable_on_posts') != '' && $post_type == 'post') ||
                (get_option('ttscj_enable_on_pages') != '' &&  $post_type == 'page')
            ) {
                add_meta_box(
                    'ttscj',
                    'Specific CSS or Javascript',
                    [$this, 'addMetaBox'],
                    $post_type,
                    'advanced',
                    'default'
                );
            }
        }
    }

    /**
     * Get post meta in a callback
     *
     * @param WP_Post $post    The current post.
     * @param array   $metabox With metabox id, title, callback, and args elements.
     */
    public function addMetaBox(WP_Post $post, array $metabox)
    {
        // Use nonce for verification
        wp_nonce_field(plugin_basename(__FILE__), 'ttscj');

        $post = new Post($post);

        echo Helpers::requireWith(__DIR__ . '/../partials/backend/metabox.php', [
            'code' => $post->getCode(),
        ]);
    }

    public function savePost(int $post_id, WP_Post $post)
    {
        // if this is an auto save routine we dont want to do anything
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!wp_verify_nonce(Helpers::POST('ttscj', ''), plugin_basename(__FILE__))) {
            return;
        }

        // Check permissions
        if (Helpers::POST('post_type', '') === 'page' && !current_user_can('edit_page', $post_id)) {
            return;
        } elseif (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // OK, we're authenticated: we need to find and save the data
        $post = new Post($post);
        $post->setCode(Helpers::POST('_ttscj_header_code', ''));
    }
}
