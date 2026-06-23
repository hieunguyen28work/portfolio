<?php
if (!defined('ABSPATH')) exit;

function ht_import_local_image($filename) {
    $filepath = get_template_directory() . '/portfolio/images/' . $filename;
    if (!file_exists($filepath)) return false;

    $title = sanitize_title(pathinfo($filename, PATHINFO_FILENAME));
    
    // Quick check if already imported
    global $wpdb;
    $existing = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'attachment'", $title));
    if ($existing) return $existing;

    $upload_dir = wp_upload_dir();
    $upload_path = $upload_dir['path'] . '/' . $filename;
    copy($filepath, $upload_path);

    $filetype = wp_check_filetype($filename, null);
    $attachment = [
        'post_mime_type' => $filetype['type'],
        'post_title'     => $title,
        'post_content'   => '',
        'post_status'    => 'inherit'
    ];
    $attach_id = wp_insert_attachment($attachment, $upload_path);
    if (!is_wp_error($attach_id)) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $upload_path);
        wp_update_attachment_metadata($attach_id, $attach_data);
        return $attach_id;
    }
    return false;
}

// 1. Insert Skills
$skills = [
    [
        'title' => 'Web Design & Dev',
        'num'   => '02',
        'desc'  => 'Designing and building high-performance websites with modern aesthetics, clean code, and seamless user experience.',
        'icon'  => '<svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></svg>',
        'tags'  => 'UI Design, HTML/CSS, Figma',
        'order' => 1
    ],
    [
        'title' => 'Brand Identity',
        'num'   => '01',
        'desc'  => 'Crafting strong, memorable visual identities that capture the essence of a brand, ensuring consistency across all touchpoints.',
        'icon'  => '<svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>',
        'tags'  => 'Logo Design, Branding, Guidelines',
        'order' => 0
    ],
    [
        'title' => 'Digital Art',
        'num'   => '03',
        'desc'  => 'Creating immersive and visually striking digital artwork and illustrations tailored for modern campaigns and media.',
        'icon'  => '<svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.52 0 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>',
        'tags'  => 'Illustration, Manipulation, Key Visual',
        'order' => 2
    ],
];

foreach ($skills as $sk) {
    $existing = get_page_by_title($sk['title'], OBJECT, 'skill');
    if (!$existing) {
        $post_id = wp_insert_post([
            'post_title'   => $sk['title'],
            'post_content' => $sk['desc'],
            'post_status'  => 'publish',
            'post_type'    => 'skill',
            'menu_order'   => $sk['order'],
        ]);
        if ($post_id) {
            update_post_meta($post_id, '_skill_num', $sk['num']);
            update_post_meta($post_id, '_skill_icon', $sk['icon']);
            update_post_meta($post_id, '_skill_tags', $sk['tags']);
        }
    }
}

// 2. Insert Experiences
$experiences = [
    [
        'title'   => 'Freelance Designer',
        'year'    => '2025–<br>Now',
        'company' => 'Independent · Vietnam',
        'desc'    => 'Handling end-to-end design for brands across F&B, real estate, automotive and nightlife — from logo, poster, social content to full web design.',
        'order'   => 0
    ],
    [
        'title'   => 'Graphic/Web Designer',
        'year'    => '2024–<br>2025',
        'company' => 'Agency · Đà Nẵng',
        'desc'    => 'Designed brand identities, social media campaigns, event posters and product visuals for clients in F&B, real estate and entertainment.',
        'order'   => 1
    ],
    [
        'title'   => 'Web Designer',
        'year'    => '2023–<br>2024',
        'company' => 'Studio · Vietnam',
        'desc'    => 'Built and maintained websites for local businesses, focusing on layout, typography and translating brand identity into digital interfaces.',
        'order'   => 2
    ],
];

foreach ($experiences as $exp) {
    $existing = get_page_by_title($exp['title'], OBJECT, 'experience');
    if (!$existing) {
        $post_id = wp_insert_post([
            'post_title'   => $exp['title'],
            'post_content' => $exp['desc'],
            'post_status'  => 'publish',
            'post_type'    => 'experience',
            'menu_order'   => $exp['order'],
        ]);
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_exp_year', $exp['year']);
            update_post_meta($post_id, '_exp_company', $exp['company']);
        }
    }
}

// 3. Set Default Theme Options & Hero Image
$hero_id = ht_import_local_image('personal (1).webp');

$options = [
    'ht_hero_tagline' => 'Available for Work · 2026',
    'ht_hero_title_1' => 'Hai',
    'ht_hero_title_2' => 'Truong',
    'ht_hero_title_3' => 'Design',
    'ht_hero_intro'   => 'Graphic designer & web creator crafting bold visual identities, high-impact campaigns, and immersive digital experiences that leave lasting marks.',
    'ht_hero_btn1_text' => 'View Work',
    'ht_hero_btn1_url'  => '#work',
    'ht_hero_btn2_text' => 'Let\'s Talk',
    'ht_hero_btn2_url'  => '#contact',
    'ht_hero_card_name' => 'Hai Truong',
    'ht_hero_card_tags' => 'Graphic · Web · Motion',
    'ht_hero_card_status' => 'Open',
    'ht_hero_stat1_num' => '50+',
    'ht_hero_stat1_label' => 'Projects<br>Done',
    'ht_hero_stat2_num' => '3+',
    'ht_hero_stat2_label' => 'Years<br>Active',
    'ht_hero_image'   => $hero_id ? $hero_id : '',
    'ht_marquee_text' => 'AVAILABLE FOR WORK · BASED IN DANANG · BRAND IDENTITY · WEB DESIGN · DIGITAL ART · MOTION ·',
    
    'ht_stat_1_num'   => '05',
    'ht_stat_1_label' => 'Years of Experience',
    'ht_stat_2_num'   => '40+',
    'ht_stat_2_label' => 'Projects Delivered',
    'ht_stat_3_num'   => '100%',
    'ht_stat_3_label' => 'Client Satisfaction',
    'ht_stat_4_num'   => '∞',
    'ht_stat_4_label' => 'Creative Drive',
    
    'ht_social_email' => 'haitruong2037@gmail.com',
    'ht_social_fb'    => 'https://facebook.com',
    'ht_social_ig'    => 'https://instagram.com',
    'ht_social_be'    => 'https://behance.net',
];

foreach ($options as $key => $val) {
    if (!get_option($key)) {
        update_option($key, $val);
    }
}

// 4. Migrate Projects with Images
$projects = [
    [
        'title' => 'Urban Edge',
        'sub'   => 'Brand Identity',
        'type'  => 'done',
        'order' => 0,
        'images'=> ['preview (1).webp', 'preview (2).webp', 'preview (3).webp']
    ],
    [
        'title' => 'Neon Nights',
        'sub'   => 'Event Poster Design',
        'type'  => 'done',
        'order' => 1,
        'images'=> ['preview (4).webp', 'preview (5).webp', 'preview (6).webp']
    ],
    [
        'title' => 'Apex Athletics',
        'sub'   => 'UI/UX & Web Design',
        'type'  => 'done',
        'order' => 2,
        'images'=> ['preview (7).webp', 'preview (8).webp', 'preview (9).webp']
    ],
    [
        'title' => 'Cosmic Burger',
        'sub'   => 'Packaging & Branding',
        'type'  => 'done',
        'order' => 3,
        'images'=> ['preview (10).webp', 'preview (11).webp', 'preview (12).webp']
    ],
    [
        'title' => 'Future Project',
        'sub'   => 'Digital Art',
        'type'  => 'coming_soon',
        'order' => 4,
        'images'=> []
    ]
];

foreach ($projects as $proj) {
    $existing = get_page_by_title($proj['title'], OBJECT, 'project');
    if (!$existing) {
        $post_id = wp_insert_post([
            'post_title'   => $proj['title'],
            'post_content' => 'Project description for ' . $proj['title'],
            'post_status'  => 'publish',
            'post_type'    => 'project',
            'menu_order'   => $proj['order'],
        ]);
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_project_type', $proj['type']);
            update_post_meta($post_id, '_project_sub', $proj['sub']);
            
            if (!empty($proj['images'])) {
                // First image is thumb
                $thumb_id = ht_import_local_image($proj['images'][0]);
                if ($thumb_id) {
                    set_post_thumbnail($post_id, $thumb_id);
                }
                
                // All images in gallery
                $gallery_ids = [];
                foreach ($proj['images'] as $img) {
                    $id = ht_import_local_image($img);
                    if ($id) $gallery_ids[] = $id;
                }
                if (!empty($gallery_ids)) {
                    update_post_meta($post_id, '_project_gallery', implode(',', $gallery_ids));
                }
            }
        }
    }
}
