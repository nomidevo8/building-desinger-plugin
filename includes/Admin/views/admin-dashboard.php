<?php
if (!defined('ABSPATH')) exit;

global $wpdb;
$table_name = $wpdb->prefix . 'building_designer_submissions';
$submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC LIMIT 20");
$total_submissions = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
?>

<div class="wrap bd-admin-wrapper">
    <div class="bd-admin-header">
        <h1>Building Designer Dashboard</h1>
        <p>Manage your building design submissions</p>
    </div>

    <div class="bd-admin-stats">
        <div class="bd-stat-card">
            <h3>Total Submissions</h3>
            <div class="bd-stat-value"><?php echo $total_submissions; ?></div>
        </div>
        <div class="bd-stat-card">
            <h3>This Month</h3>
            <div class="bd-stat-value">
                <?php
                $this_month = $wpdb->get_var(
                    "SELECT COUNT(*) FROM $table_name 
                    WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) 
                    AND YEAR(created_at) = YEAR(CURRENT_DATE())"
                );
                echo $this_month;
                ?>
            </div>
        </div>
        <div class="bd-stat-card">
            <h3>Today</h3>
            <div class="bd-stat-value">
                <?php
                $today = $wpdb->get_var(
                    "SELECT COUNT(*) FROM $table_name WHERE DATE(created_at) = CURDATE()"
                );
                echo $today;
                ?>
            </div>
        </div>
    </div>

    <div class="bd-submissions-table">
        <h2>Recent Submissions</h2>
        <table class="bd-table wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Building Details</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($submissions): ?>
                    <?php foreach ($submissions as $submission): ?>
                        <?php $data = json_decode($submission->form_data, true); ?>
                        <tr>
                            <td><?php echo $submission->id; ?></td>
                            <td><?php echo esc_html($submission->user_email); ?></td>
                            <td>
                                <?php 
                                if (isset($data['framing_type'])) {
                                    echo '<strong>' . ucwords(str_replace('_', ' ', $data['framing_type'])) . '</strong><br>';
                                }
                                if (isset($data['building_width'], $data['building_length'], $data['building_height'])) {
                                    echo $data['building_width'] . 'W × ' . 
                                         $data['building_length'] . 'L × ' . 
                                         $data['building_height'] . 'H';
                                }
                                ?>
                            </td>
                            <td><?php echo date('M j, Y', strtotime($submission->created_at)); ?></td>
                            <td>
                                <a href="#" class="button button-small" onclick="viewSubmission(<?php echo $submission->id; ?>)">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No submissions yet</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function viewSubmission(id) {
    alert('View submission #' + id + ' - Full details modal would open here');
}
</script>