<?php
namespace BuildingDesigner\Core;

use BuildingDesigner\Admin\MenuManager;
use BuildingDesigner\Frontend\ShortcodeHandler;

class Plugin
{
    protected $loader;
    protected $plugin_name;
    protected $version;

    public function __construct()
    {
        $this->plugin_name = 'building-designer';
        $this->version = BUILDING_DESIGNER_VERSION;

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies()
    {
        $this->loader = new Loader();
    }

    private function define_admin_hooks()
    {
        $menu_manager = new MenuManager();

        $this->loader->add_action('admin_menu', $menu_manager, 'add_plugin_admin_menu');
        $this->loader->add_action('admin_enqueue_scripts', $this, 'enqueue_admin_styles');
        $this->loader->add_action('admin_enqueue_scripts', $this, 'enqueue_admin_scripts');
    }

    private function define_public_hooks()
    {
        $shortcode_handler = new ShortcodeHandler();

        $this->loader->add_action('wp_enqueue_scripts', $this, 'enqueue_public_styles');
        $this->loader->add_action('wp_enqueue_scripts', $this, 'enqueue_public_scripts');
        $this->loader->add_action('init', $shortcode_handler, 'register_shortcodes');
        // Add AJAX handlers
        $this->loader->add_action('wp_ajax_building_designer_submit', $this, 'handle_form_submission');
        $this->loader->add_action('wp_ajax_nopriv_building_designer_submit', $this, 'handle_form_submission');
    }

    public function enqueue_admin_styles()
    {
        wp_enqueue_style(
            $this->plugin_name . '-admin',
            BUILDING_DESIGNER_URL . 'assets/css/admin.css',
            array(),
            $this->version
        );
    }

    public function enqueue_admin_scripts()
    {
        wp_enqueue_script(
            $this->plugin_name . '-admin',
            BUILDING_DESIGNER_URL . 'assets/js/admin.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    public function enqueue_public_styles()
    {
        wp_enqueue_style(
            $this->plugin_name,
            BUILDING_DESIGNER_URL . 'assets/css/frontend.css',
            array(),
            $this->version
        );
    }

    public function enqueue_public_scripts()
    {
        wp_enqueue_script(
            $this->plugin_name,
            BUILDING_DESIGNER_URL . 'assets/js/frontend.js',
            array('jquery'),
            $this->version,
            true
        );

        wp_localize_script($this->plugin_name, 'buildingDesigner', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('building_designer_nonce'),
            'pluginUrl' => BUILDING_DESIGNER_URL
        ));
    }

    public function handle_form_submission()
    {
        check_ajax_referer('building_designer_nonce', 'nonce');

        $form_data = isset($_POST['formData']) ? $_POST['formData'] : array();

        if (empty($form_data)) {
            wp_send_json_error(array('message' => 'No data received'));
        }

        // Save to database
        global $wpdb;
        $table_name = $wpdb->prefix . 'building_designer_submissions';

        $result = $wpdb->insert(
            $table_name,
            array(
                'form_data' => json_encode($form_data),
                'user_email' => isset($form_data['email']) ? sanitize_email($form_data['email']) : '',
                'created_at' => current_time('mysql')
            ),
            array('%s', '%s', '%s')
        );

        if ($result) {
            // Send email notification
            $this->send_notification_email($form_data);

            wp_send_json_success(array('message' => 'Submission saved successfully'));
        } else {
            wp_send_json_error(array('message' => 'Failed to save submission'));
        }
    }

    private function send_notification_email($form_data)
    {
        $email_enabled = get_option('building_designer_email_notifications', 'yes');

        if ($email_enabled !== 'yes') {
            return;
        }

        $to = get_option('building_designer_admin_email', get_option('admin_email'));
        $subject = 'New Building Design Submission';

        $message = "New building design submission received:\n\n";
        foreach ($form_data as $key => $value) {
            $message .= ucwords(str_replace('_', ' ', $key)) . ": " . $value . "\n";
        }

        wp_mail($to, $subject, $message);
    }

    public function run()
    {
        $this->loader->run();
    }
}