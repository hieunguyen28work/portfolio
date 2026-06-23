<?php

function haitruong_theme_options_page() {
    add_theme_page('Theme Options', 'Theme Options', 'manage_options', 'haitruong-theme-options', 'haitruong_theme_options_html');
}
add_action('admin_menu', 'haitruong_theme_options_page');

function haitruong_register_settings() {
    register_setting('haitruong_options_group', 'ht_hero_tagline');
    register_setting('haitruong_options_group', 'ht_hero_title_1');
    register_setting('haitruong_options_group', 'ht_hero_title_2');
    register_setting('haitruong_options_group', 'ht_hero_title_3');
    register_setting('haitruong_options_group', 'ht_hero_intro');
    register_setting('haitruong_options_group', 'ht_hero_btn1_text');
    register_setting('haitruong_options_group', 'ht_hero_btn1_url');
    register_setting('haitruong_options_group', 'ht_hero_btn2_text');
    register_setting('haitruong_options_group', 'ht_hero_btn2_url');
    register_setting('haitruong_options_group', 'ht_hero_card_name');
    register_setting('haitruong_options_group', 'ht_hero_card_tags');
    register_setting('haitruong_options_group', 'ht_hero_card_status');
    register_setting('haitruong_options_group', 'ht_hero_stat1_num');
    register_setting('haitruong_options_group', 'ht_hero_stat1_label');
    register_setting('haitruong_options_group', 'ht_hero_stat2_num');
    register_setting('haitruong_options_group', 'ht_hero_stat2_label');
    register_setting('haitruong_options_group', 'ht_hero_image');
    register_setting('haitruong_options_group', 'ht_marquee_text');
    
    // Stats
    for ($i = 1; $i <= 4; $i++) {
        register_setting('haitruong_options_group', 'ht_stat_' . $i . '_num');
        register_setting('haitruong_options_group', 'ht_stat_' . $i . '_label');
    }
    
    // Social
    register_setting('haitruong_options_group', 'ht_social_email');
    register_setting('haitruong_options_group', 'ht_social_fb');
    register_setting('haitruong_options_group', 'ht_social_ig');
    register_setting('haitruong_options_group', 'ht_social_be');
}
add_action('admin_init', 'haitruong_register_settings');

function haitruong_theme_options_html() {
    if (!current_user_can('manage_options')) return;
    ?>
    <div class="wrap">
        <h1>Theme Options</h1>
        <?php if (isset($_GET['migrated']) && $_GET['migrated'] == 'true') : ?>
            <div class="notice notice-success is-dismissible"><p>Data migrated successfully!</p></div>
        <?php endif; ?>
        
        <form method="post" action="options.php">
            <?php settings_fields('haitruong_options_group'); ?>
            
            <h2 class="title">Hero Section</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Hero Tagline</th>
                    <td><input type="text" name="ht_hero_tagline" value="<?php echo esc_attr(get_option('ht_hero_tagline')); ?>" style="width: 400px;" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Title Line 1</th>
                    <td><input type="text" name="ht_hero_title_1" value="<?php echo esc_attr(get_option('ht_hero_title_1')); ?>" style="width: 400px;" placeholder="e.g. Hai" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Title Line 2</th>
                    <td><input type="text" name="ht_hero_title_2" value="<?php echo esc_attr(get_option('ht_hero_title_2')); ?>" style="width: 400px;" placeholder="e.g. Truong" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Title Line 3</th>
                    <td><input type="text" name="ht_hero_title_3" value="<?php echo esc_attr(get_option('ht_hero_title_3')); ?>" style="width: 400px;" placeholder="e.g. Design" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Intro Text</th>
                    <td><textarea name="ht_hero_intro" rows="4" style="width: 400px;"><?php echo esc_textarea(get_option('ht_hero_intro')); ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Primary Button (Text / URL)</th>
                    <td>
                        <input type="text" name="ht_hero_btn1_text" value="<?php echo esc_attr(get_option('ht_hero_btn1_text')); ?>" style="width: 190px;" placeholder="e.g. View Work" />
                        <input type="text" name="ht_hero_btn1_url" value="<?php echo esc_attr(get_option('ht_hero_btn1_url')); ?>" style="width: 200px;" placeholder="e.g. #work" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Secondary Button (Text / URL)</th>
                    <td>
                        <input type="text" name="ht_hero_btn2_text" value="<?php echo esc_attr(get_option('ht_hero_btn2_text')); ?>" style="width: 190px;" placeholder="e.g. Let's Talk" />
                        <input type="text" name="ht_hero_btn2_url" value="<?php echo esc_attr(get_option('ht_hero_btn2_url')); ?>" style="width: 200px;" placeholder="e.g. #contact" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Card Overlay Name</th>
                    <td><input type="text" name="ht_hero_card_name" value="<?php echo esc_attr(get_option('ht_hero_card_name')); ?>" style="width: 400px;" placeholder="e.g. Hai Truong" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Card Overlay Tags</th>
                    <td><input type="text" name="ht_hero_card_tags" value="<?php echo esc_attr(get_option('ht_hero_card_tags')); ?>" style="width: 400px;" placeholder="e.g. Graphic · Web · Motion" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Card Overlay Status</th>
                    <td><input type="text" name="ht_hero_card_status" value="<?php echo esc_attr(get_option('ht_hero_card_status')); ?>" style="width: 400px;" placeholder="e.g. Open" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Stat 1 (Num / Label)</th>
                    <td>
                        <input type="text" name="ht_hero_stat1_num" value="<?php echo esc_attr(get_option('ht_hero_stat1_num')); ?>" style="width: 100px;" placeholder="e.g. 50+" />
                        <input type="text" name="ht_hero_stat1_label" value="<?php echo esc_attr(get_option('ht_hero_stat1_label')); ?>" style="width: 290px;" placeholder="e.g. Projects<br>Done" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Stat 2 (Num / Label)</th>
                    <td>
                        <input type="text" name="ht_hero_stat2_num" value="<?php echo esc_attr(get_option('ht_hero_stat2_num')); ?>" style="width: 100px;" placeholder="e.g. 3+" />
                        <input type="text" name="ht_hero_stat2_label" value="<?php echo esc_attr(get_option('ht_hero_stat2_label')); ?>" style="width: 290px;" placeholder="e.g. Years<br>Active" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hero Image</th>
                    <td>
                        <?php $hero_img = get_option('ht_hero_image'); ?>
                        <input type="hidden" id="ht_hero_image" name="ht_hero_image" value="<?php echo esc_attr($hero_img); ?>" />
                        <div id="ht_hero_image_preview" style="margin-bottom: 10px;">
                            <?php if ($hero_img) : ?>
                                <?php echo wp_get_attachment_image($hero_img, 'medium', false, array('style' => 'max-width:300px;height:auto;')); ?>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="button" id="ht_hero_image_button">Select Image</button>
                        <button type="button" class="button" id="ht_hero_image_remove" style="<?php echo $hero_img ? '' : 'display:none;'; ?>">Remove Image</button>
                        <script>
                        jQuery(document).ready(function($){
                            var frame;
                            $('#ht_hero_image_button').on('click', function(e) {
                                e.preventDefault();
                                if (frame) { frame.open(); return; }
                                frame = wp.media({
                                    title: 'Select Hero Image',
                                    button: { text: 'Use this image' },
                                    multiple: false
                                });
                                frame.on('select', function() {
                                    var attachment = frame.state().get('selection').first().toJSON();
                                    $('#ht_hero_image').val(attachment.id);
                                    $('#ht_hero_image_preview').html('<img src="'+attachment.sizes.full.url+'" style="max-width:300px;height:auto;" />');
                                    $('#ht_hero_image_remove').show();
                                });
                                frame.open();
                            });
                            $('#ht_hero_image_remove').on('click', function(e) {
                                e.preventDefault();
                                $('#ht_hero_image').val('');
                                $('#ht_hero_image_preview').html('');
                                $(this).hide();
                            });
                        });
                        </script>
                    </td>
                </tr>
            </table>

            <h2 class="title">Marquee Section</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Marquee Text</th>
                    <td><input type="text" name="ht_marquee_text" value="<?php echo esc_attr(get_option('ht_marquee_text')); ?>" style="width: 400px;" /></td>
                </tr>
            </table>

            <h2 class="title">About Stats</h2>
            <table class="form-table">
                <?php for ($i = 1; $i <= 4; $i++) : ?>
                <tr valign="top">
                    <th scope="row">Stat <?php echo $i; ?> Number / Label</th>
                    <td>
                        <input type="text" name="ht_stat_<?php echo $i; ?>_num" value="<?php echo esc_attr(get_option('ht_stat_' . $i . '_num')); ?>" placeholder="Num" style="width: 100px;" />
                        <input type="text" name="ht_stat_<?php echo $i; ?>_label" value="<?php echo esc_attr(get_option('ht_stat_' . $i . '_label')); ?>" placeholder="Label" style="width: 290px;" />
                    </td>
                </tr>
                <?php endfor; ?>
            </table>

            <h2 class="title">Social Links</h2>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Email Address</th>
                    <td><input type="email" name="ht_social_email" value="<?php echo esc_attr(get_option('ht_social_email')); ?>" style="width: 400px;" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Facebook Link</th>
                    <td><input type="url" name="ht_social_fb" value="<?php echo esc_attr(get_option('ht_social_fb')); ?>" style="width: 400px;" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Instagram Link</th>
                    <td><input type="url" name="ht_social_ig" value="<?php echo esc_attr(get_option('ht_social_ig')); ?>" style="width: 400px;" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Behance Link</th>
                    <td><input type="url" name="ht_social_be" value="<?php echo esc_attr(get_option('ht_social_be')); ?>" style="width: 400px;" /></td>
                </tr>
            </table>

            <?php submit_button('Save Changes'); ?>
        </form>

        <hr style="margin: 40px 0;" />
        
        <h2>Migrate Demo Data</h2>
        <p>Click the button below to migrate default options, skills, experiences, and projects.</p>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="haitruong_migrate_data">
            <?php wp_nonce_field('haitruong_migrate_data_nonce', 'migrate_nonce'); ?>
            <button type="submit" class="button button-secondary" onclick="return confirm('Are you sure you want to run the migration? This will add demo data.');">Migrate Data</button>
        </form>
    </div>
    <?php
}
