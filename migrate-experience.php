<?php
require_once( dirname( dirname( dirname( __DIR__ ) ) ) . '/wp-load.php' );

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
    // Check if exists
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
            echo "Inserted: " . $exp['title'] . "\n";
        } else {
            echo "Error inserting: " . $exp['title'] . "\n";
        }
    } else {
        echo "Already exists: " . $exp['title'] . "\n";
    }
}
echo "Done.";
