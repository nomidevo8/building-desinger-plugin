<?php
if (!defined('ABSPATH')) exit;

// Save settings
if (isset($_POST['bd_save_settings'])) {
    check_admin_referer('bd_settings_nonce');
    
    update_option('building_designer_email_notifications', $_POST['email_notifications']);
    update_option('building_designer_admin_email', sanitize_email($_POST['admin_email']));
    
    echo '<div class="notice notice-success"><p>Settings saved successfully!</p></div>';
}

$email_notifications = get_option('building_designer_email_notifications', 'yes');
$admin_email = get_option('building_designer_admin_email', get_option('admin_email'));
?>

<div class="wrap">
    <h1>Building Designer Settings</h1>
    
    <form method="post" action="">
        <?php wp_nonce_field('bd_settings_nonce'); ?>
        
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="email_notifications">Email Notifications</label>
                </th>
                <td>
                    <select name="email_notifications" id="email_notifications">
                        <option value="yes" <?php selected($email_notifications, 'yes'); ?>>Enabled</option>
                        <option value="no" <?php selected($email_notifications, 'no'); ?>>Disabled</option>
                    </select>
                    <p class="description">Receive email notifications for new submissions</p>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="admin_email">Admin Email</label>
                </th>
                <td>
                    <input type="email" 
                           name="admin_email" 
                           id="admin_email" 
                           value="<?php echo esc_attr($admin_email); ?>" 
                           class="regular-text">
                    <p class="description">Email address to receive notifications</p>
                </td>
            </tr>
        </table>
        
        <?php submit_button('Save Settings', 'primary', 'bd_save_settings'); ?>
    </form>
</div>