<?php
function haitruong_theme_enqueue_styles() {
    wp_enqueue_style( 'haitruong-style', get_template_directory_uri() . '/assets/src/style.css' );
}
add_action( 'wp_enqueue_scripts', 'haitruong_theme_enqueue_styles' );

function haitruong_theme_custom_post_type() {
    register_post_type('project',
        array(
            'labels'      => array(
                'name'          => __('Projects', 'textdomain'),
                'singular_name' => __('Project', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'menu_icon'   => 'dashicons-portfolio',
        )
    );
    register_post_type('experience',
        array(
            'labels'      => array(
                'name'          => __('Experiences', 'textdomain'),
                'singular_name' => __('Experience', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => false,
            'supports'    => array('title', 'editor', 'page-attributes'),
            'menu_icon'   => 'dashicons-businessman',
        )
    );
    register_post_type('skill',
        array(
            'labels'      => array(
                'name'          => __('Skills', 'textdomain'),
                'singular_name' => __('Skill', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => false,
            'supports'    => array('title', 'editor', 'page-attributes'),
            'menu_icon'   => 'dashicons-welcome-learn-more',
        )
    );
}
add_action('init', 'haitruong_theme_custom_post_type');

add_theme_support('post-thumbnails');

// Enqueue media uploader in admin
function haitruong_admin_enqueue_scripts($hook) {
    wp_enqueue_media();
    if ('post.php' === $hook || 'post-new.php' === $hook) {
        wp_enqueue_script('haitruong-admin-script', get_template_directory_uri() . '/admin.js', array('jquery'), '1.0', true);
    }
}
add_action('admin_enqueue_scripts', 'haitruong_admin_enqueue_scripts');

// Custom Meta Boxes
function haitruong_add_meta_boxes() {
    add_meta_box('project_details', 'Project Details', 'haitruong_project_meta_box_html', 'project', 'normal', 'high');
    add_meta_box('experience_details', 'Experience Details', 'haitruong_experience_meta_box_html', 'experience', 'normal', 'high');
    add_meta_box('skill_details', 'Skill Details', 'haitruong_skill_meta_box_html', 'skill', 'normal', 'high');
}
add_action('add_meta_boxes', 'haitruong_add_meta_boxes');

function haitruong_project_meta_box_html($post) {
    $type = get_post_meta($post->ID, '_project_type', true);
    if (!$type) $type = 'done';
    
    $subtitle = get_post_meta($post->ID, '_project_sub', true);
    $badge = get_post_meta($post->ID, '_project_badge', true);
    $gallery = get_post_meta($post->ID, '_project_gallery', true);
    $gallery_count = $gallery ? count(array_filter(explode(',', $gallery))) : 0;
    
    wp_nonce_field('haitruong_project_meta_save', 'haitruong_project_meta_nonce');
    ?>
    <p>
        <label for="project_type"><strong>Project Type</strong></label><br>
        <select id="project_type" name="project_type">
            <option value="done" <?php selected($type, 'done'); ?>>Done</option>
            <option value="coming_soon" <?php selected($type, 'coming_soon'); ?>>Coming Soon</option>
        </select>
    </p>
    <p>
        <label for="project_sub"><strong>Subtitle (e.g. Brand Identity)</strong></label><br>
        <input type="text" id="project_sub" name="project_sub" value="<?php echo esc_attr($subtitle); ?>" style="width:100%;">
    </p>
    <p>
        <label for="project_gallery"><strong>Gallery Images</strong></label><br>
        <input type="hidden" id="project_gallery" name="project_gallery" value="<?php echo esc_attr($gallery); ?>">
        <button type="button" class="button" id="haitruong_gallery_button">Select Images</button>
        <span id="haitruong_gallery_count" style="margin-left: 10px;"><strong><?php echo $gallery_count; ?></strong> images selected</span>
    </p>
    <?php
}

function haitruong_save_project_meta($post_id) {
    if (!isset($_POST['haitruong_project_meta_nonce']) || !wp_verify_nonce($_POST['haitruong_project_meta_nonce'], 'haitruong_project_meta_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['project_type'])) update_post_meta($post_id, '_project_type', sanitize_text_field($_POST['project_type']));
    if (isset($_POST['project_sub'])) update_post_meta($post_id, '_project_sub', sanitize_text_field($_POST['project_sub']));
    if (isset($_POST['project_gallery'])) update_post_meta($post_id, '_project_gallery', sanitize_text_field($_POST['project_gallery']));
}
add_action('save_post_project', 'haitruong_save_project_meta');

function haitruong_experience_meta_box_html($post) {
    $year = get_post_meta($post->ID, '_exp_year', true);
    $company = get_post_meta($post->ID, '_exp_company', true);
    
    wp_nonce_field('haitruong_exp_meta_save', 'haitruong_exp_meta_nonce');
    ?>
    <p>
        <label for="exp_year"><strong>Year / Duration</strong></label><br>
        <input type="text" id="exp_year" name="exp_year" value="<?php echo esc_attr($year); ?>" style="width:100%;" placeholder="e.g. 2025–&lt;br&gt;Now">
        <small>Use &lt;br&gt; to break lines if needed.</small>
    </p>
    <p>
        <label for="exp_company"><strong>Company / Location</strong></label><br>
        <input type="text" id="exp_company" name="exp_company" value="<?php echo esc_attr($company); ?>" style="width:100%;" placeholder="e.g. Agency · Đà Nẵng">
    </p>
    <?php
}

function haitruong_save_experience_meta($post_id) {
    if (!isset($_POST['haitruong_exp_meta_nonce']) || !wp_verify_nonce($_POST['haitruong_exp_meta_nonce'], 'haitruong_exp_meta_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['exp_year'])) update_post_meta($post_id, '_exp_year', wp_kses_post($_POST['exp_year']));
    if (isset($_POST['exp_company'])) update_post_meta($post_id, '_exp_company', sanitize_text_field($_POST['exp_company']));
}
add_action('save_post_experience', 'haitruong_save_experience_meta');

function haitruong_skill_meta_box_html($post) {
    $num = get_post_meta($post->ID, '_skill_num', true);
    $icon = get_post_meta($post->ID, '_skill_icon', true);
    $tags = get_post_meta($post->ID, '_skill_tags', true);
    
    wp_nonce_field('haitruong_skill_meta_save', 'haitruong_skill_meta_nonce');
    ?>
    <p>
        <label for="skill_num"><strong>Skill Number (e.g. 01)</strong></label><br>
        <input type="text" id="skill_num" name="skill_num" value="<?php echo esc_attr($num); ?>" style="width:100%;">
    </p>
    <p>
        <label for="skill_icon"><strong>Skill SVG Icon Code</strong></label><br>
        <textarea id="skill_icon" name="skill_icon" rows="5" style="width:100%;"><?php echo esc_textarea($icon); ?></textarea>
    </p>
    <p>
        <label for="skill_tags"><strong>Skill Tags (Comma separated, e.g. UI Design, HTML/CSS)</strong></label><br>
        <input type="text" id="skill_tags" name="skill_tags" value="<?php echo esc_attr($tags); ?>" style="width:100%;">
    </p>
    <?php
}

function haitruong_save_skill_meta($post_id) {
    if (!isset($_POST['haitruong_skill_meta_nonce']) || !wp_verify_nonce($_POST['haitruong_skill_meta_nonce'], 'haitruong_skill_meta_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    
    if (isset($_POST['skill_num'])) update_post_meta($post_id, '_skill_num', sanitize_text_field($_POST['skill_num']));
    if (isset($_POST['skill_icon'])) update_post_meta($post_id, '_skill_icon', wp_unslash($_POST['skill_icon'])); // Allow SVG tags
    if (isset($_POST['skill_tags'])) update_post_meta($post_id, '_skill_tags', sanitize_text_field($_POST['skill_tags']));
}
add_action('save_post_skill', 'haitruong_save_skill_meta');

// Add Thumbnail to Admin Columns
add_filter('manage_project_posts_columns', 'haitruong_project_columns');
function haitruong_project_columns($columns) {
    $new_columns = array();
    foreach($columns as $key => $title) {
        if ($key == 'title') {
            $new_columns['project_thumbnail'] = __('Thumbnail');
        }
        $new_columns[$key] = $title;
    }
    return $new_columns;
}

add_action('manage_project_posts_custom_column', 'haitruong_project_custom_column', 10, 2);
function haitruong_project_custom_column($column, $post_id) {
    if ($column == 'project_thumbnail') {
        echo get_the_post_thumbnail($post_id, array(50, 50));
    }
}

// Include Theme Options
require_once get_template_directory() . '/inc/theme-options.php';

// Handle Data Migration
add_action('admin_post_haitruong_migrate_data', 'haitruong_migrate_data_handler');
function haitruong_migrate_data_handler() {
    if (!current_user_can('manage_options')) return;
    check_admin_referer('haitruong_migrate_data_nonce', 'migrate_nonce');
    
    require_once get_template_directory() . '/inc/migrate-data.php';
    
    wp_redirect(admin_url('admin.php?page=haitruong-theme-options&migrated=true'));
    exit;
}