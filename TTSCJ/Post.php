<?php

namespace TTSCJ;

use WP_Post;

class Post
{
    public const META_CODE = '_ttscj_header_code';
    public WP_Post $post;

    public function __construct(WP_Post $post)
    {
        $this->post = $post;
    }

    public function getCode(): string
    {
        return (string)get_post_meta($this->post->ID, self::META_CODE, true);
    }

    public function setCode(string $value): void
    {
        $value = trim($value);

        if ($value) {
            update_post_meta($this->post->ID, self::META_CODE, $value);
        } else {
            delete_post_meta($this->post->ID, self::META_CODE);
        }
    }
}
