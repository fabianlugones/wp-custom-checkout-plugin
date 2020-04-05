<?php

namespace WP_Custom_Checkout;

class Bootstrap
{
    
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'adminEnqueueStyles']);
        add_action('admin_enqueue_scripts', [$this, 'adminEnqueueScripts']);
        add_action('wp_enqueue_scripts', [$this, 'frontEnqueueStyles']);
        add_action('wp_enqueue_scripts', [$this, 'frontEnqueueScripts']);

        $this->initializeSettings();
    }

    public function initializeSettings()
    {
        new Settings();
    }
}