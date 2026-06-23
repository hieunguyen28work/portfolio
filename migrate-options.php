<?php
require_once( dirname( dirname( dirname( __DIR__ ) ) ) . '/wp-load.php' );

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
            echo "Inserted Skill: " . $sk['title'] . "\n";
        }
    } else {
        echo "Skill exists: " . $sk['title'] . "\n";
    }
}

// 2. Set Default Theme Options
$options = [
    'ht_hero_tagline' => 'Available for Work · 2026',
    'ht_hero_intro'   => 'Graphic designer & web creator crafting bold visual identities, high-impact campaigns, and immersive digital experiences that leave lasting marks.',
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
        echo "Set option: $key\n";
    }
}

echo "Migration done.";
