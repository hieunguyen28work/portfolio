<footer>
  <div class="fc">© 2026 <b>HaiTruong.design</b> — All rights reserved</div>
  <div class="fc">Built with obsession · Đà Nẵng, Vietnam</div>
</footer>
<?php
$projects_array = [];
$projects_query = new WP_Query([
    'post_type'      => 'project',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
if ($projects_query->have_posts()) {
    while ($projects_query->have_posts()) {
        $projects_query->the_post();
        
        $type = get_post_meta(get_the_ID(), '_project_type', true);
        if ($type === 'coming_soon') {
            continue; // Skip coming soon items for lightbox
        }
        
        $sub = get_post_meta(get_the_ID(), '_project_sub', true);
        $images = [];
        
        // Single type or gallery type?
        $gallery_ids_str = get_post_meta(get_the_ID(), '_project_gallery', true);
        if ($gallery_ids_str) {
            $gallery_type = 'gallery';
            $gallery_ids = array_map('trim', explode(',', $gallery_ids_str));
            foreach ($gallery_ids as $id) {
                if ($id) {
                    $img_url = wp_get_attachment_image_url($id, 'full');
                    if ($img_url) {
                        $images[] = $img_url;
                    }
                }
            }
        } else {
            $gallery_type = 'single';
            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($thumb_url) {
                $images[] = $thumb_url;
            }
        }
        
        // Fallback if no images found
        if (empty($images)) {
            $images[] = ''; 
        }
        
        $projects_array[] = [
            'title'  => get_the_title(),
            'sub'    => $sub,
            'type'   => $gallery_type,
            'images' => $images,
        ];
    }
    wp_reset_postdata();
}
?>
<script>
window.PROJECTS = <?php echo json_encode($projects_array); ?>;
</script>
<script type="module" src="<?php echo get_template_directory_uri(); ?>/assets/src/script.js"></script>
<?php wp_footer(); ?>
</body>
</html>