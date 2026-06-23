<?php get_header(); ?>
<!-- HERO -->
<section class="hero" id="hero">
  <div class="hgrid"></div>
  <div class="hl rv">
    <div class="htag"><?php echo esc_html(get_option('ht_hero_tagline', 'Available for Work · 2026')); ?></div>
    <h1 class="hn">
      <?php echo esc_html(get_option('ht_hero_title_1', 'Hai')); ?><br>
      <span class="out"><?php echo esc_html(get_option('ht_hero_title_2', 'Truong')); ?></span><br>
      <span class="acc"><?php echo esc_html(get_option('ht_hero_title_3', 'Design')); ?></span>
    </h1>
    <p class="hdesc"><?php echo esc_html(get_option('ht_hero_intro', 'Graphic designer & web creator crafting bold visual identities, high-impact campaigns, and immersive digital experiences that leave lasting marks.')); ?></p>
    <div class="hacts">
      <a href="<?php echo esc_url(get_option('ht_hero_btn1_url', '#work')); ?>" class="btnp">
        <?php echo esc_html(get_option('ht_hero_btn1_text', 'View Work')); ?> 
        <svg width="13" height="13" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="<?php echo esc_url(get_option('ht_hero_btn2_url', '#contact')); ?>" class="btng">
        <?php echo esc_html(get_option('ht_hero_btn2_text', 'Let\'s Talk')); ?>
      </a>
    </div>
  </div>
  <div class="hr rv" style="transition-delay:.15s">
    <div class="pwrap">
      <div class="pcard">
        <?php $hero_img_id = get_option('ht_hero_image');
        if ($hero_img_id) :
            $hero_img_url = wp_get_attachment_image_url($hero_img_id, 'full');
        ?>
            <img class="pimg" src="<?php echo esc_url($hero_img_url); ?>" alt="Hero">
        <?php else : ?>
        <img class="pimg" src="data:image/jpeg;base64,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" alt="Hai Truong">
        <?php endif; ?>
        <div class="pov">
          <div style="display:flex;justify-content:space-between;align-items:flex-end">
            <div><div class="pname"><?php echo esc_html(get_option('ht_hero_card_name', 'Hai Truong')); ?></div><div class="prole"><?php echo esc_html(get_option('ht_hero_card_tags', 'Graphic · Web · Motion')); ?></div></div>
            <div class="pstat"><span class="dot"></span><?php echo esc_html(get_option('ht_hero_card_status', 'Open')); ?></div>
          </div>
        </div>
      </div>
      <div class="pills">
        <div class="pill">
          <div class="pn"><?php echo esc_html(get_option('ht_hero_stat1_num', '50+')); ?></div><div class="pl"><?php echo wp_kses_post(get_option('ht_hero_stat1_label', 'Projects<br>Done')); ?></div></div>
        <div class="pill">
          <div class="pn"><?php echo esc_html(get_option('ht_hero_stat2_num', '3+')); ?></div><div class="pl"><?php echo wp_kses_post(get_option('ht_hero_stat2_label', 'Years<br>Active')); ?></div></div>
      </div>
    </div>
  </div>
</section>

<!-- MARQUEE -->
<div class="mq">
  <div class="mqt">
    <?php
    $marquee_raw = get_option('ht_marquee_text', 'Brand Identity · Web Design · Motion Graphics · Campaign Design · UI / UX · Event Posters · Real Estate Visual · Art Direction');
    $marquee_items = array_filter(array_map('trim', explode('·', $marquee_raw)));
    // Output twice for seamless infinite scroll
    for ($i = 0; $i < 2; $i++) {
        foreach($marquee_items as $item): ?>
        <div class="mqi"><span class="mqd"></span><?php echo esc_html($item); ?></div>
        <?php endforeach;
    }
    ?>
  </div>
</div>

<!-- WORK -->
<section class="wsec" id="work">
  <div class="whead rv">
    <div class="stag">Selected Work</div>
    <h2 class="stit">Recent Projects</h2>
  </div>
  <div class="proj-grid">

            <?php
    $projects_query = new WP_Query([
        'post_type'      => 'project',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);
    
    if ( $projects_query->have_posts() ) :
        $project_index = 0;
        while ( $projects_query->have_posts() ) : $projects_query->the_post();
            
            $type  = get_post_meta( get_the_ID(), '_project_type', true );
            $sub   = get_post_meta( get_the_ID(), '_project_sub', true );
            
            $gallery_ids_str = get_post_meta( get_the_ID(), '_project_gallery', true );
            $gallery_count = 0;
            if ($gallery_ids_str) {
                $gallery_ids = array_filter(array_map('trim', explode(',', $gallery_ids_str)));
                $gallery_count = count($gallery_ids);
            }
            
            if ($type === 'coming_soon') {
                ?>
                <div class="pc" style="cursor:default">
                  <div class="pc-thumb" style="position:relative;overflow:hidden">
                    <div style="height:380px;background:linear-gradient(135deg,#0f0f0f 0%,#1a1a1a 100%);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1rem">
                      <div style="width:48px;height:48px;border:1px solid rgba(232,255,71,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center">
                        <svg width="18" height="18" viewBox="0 0 24 24" stroke="rgba(232,255,71,0.4)" fill="none" stroke-width="1.5"><circle cx="12" cy="12" r="9"/><path d="M12 8v4l3 3"/></svg>
                      </div>
                      <div style="font-family:'Syne',sans-serif;font-size:1.1rem;font-weight:700;color:rgba(245,243,239,0.9);letter-spacing:.05em">Coming Soon</div>
                      <div style="font-family:'Space Mono',monospace;font-size:.5rem;letter-spacing:.25em;text-transform:uppercase;color:rgba(245,243,239,0.25)">Next Project</div>
                    </div>
                  </div>
                  <div class="pc-bar">
                    <div><div class="pc-name"><?php the_title(); ?></div><div class="pc-cat"><?php echo esc_html( $sub ); ?></div></div>
                    <div class="pc-num"><?php echo str_pad( $project_index + 1, 2, '0', STR_PAD_LEFT ); ?></div>
                  </div>
                </div>
                <?php
                $project_index++;
                continue;
            }

            $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
            if ( ! $thumb_url ) {
                $thumb_url = ''; 
            }
            
            $num_display = str_pad( $project_index + 1, 2, '0', STR_PAD_LEFT );
            ?>
            <div class="pc" data-project="<?php echo esc_attr( $project_index ); ?>">
              <div class="pc-thumb">
                <?php if ( $thumb_url ) : ?>
                  <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                <?php endif; ?>
                <div class="pc-overlay">
                  <div class="pc-eye">
                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                  </div>
                </div>
                <?php if ( $gallery_count > 0 ) : ?>
                  <div class="pc-badge"><?php echo esc_html( $gallery_count ); ?> image<?php echo $gallery_count !== 1 ? 's' : ''; ?></div>
                <?php endif; ?>
              </div>
              <div class="pc-bar">
                <div>
                  <div class="pc-name"><?php the_title(); ?></div>
                  <div class="pc-cat"><?php echo esc_html( $sub ); ?></div>
                </div>
                <div class="pc-num"><?php echo esc_html( $num_display ); ?></div>
              </div>
            </div>
            <?php
            $project_index++;
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>

  </div>
</section>

<!-- SKILLS -->
<section class="ssec" id="skills">
  <div class="stag">Capabilities</div>
  <h2 class="stit rv">What I Do</h2>
  <div class="sgrid">
    <?php
    $skill_query = new WP_Query([
        'post_type'      => 'skill',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ]);
    if ($skill_query->have_posts()) :
        $delay = 0;
        while ($skill_query->have_posts()) : $skill_query->the_post();
            $num = get_post_meta(get_the_ID(), '_skill_num', true);
            $icon = get_post_meta(get_the_ID(), '_skill_icon', true);
            $tags_raw = get_post_meta(get_the_ID(), '_skill_tags', true);
            $tags = array_filter(array_map('trim', explode(',', $tags_raw)));
            $content = wp_strip_all_tags(get_the_content());
            
            $delay_style = $delay > 0 ? 'style="transition-delay:.' . str_pad($delay * 7, 2, '0', STR_PAD_LEFT) . 's"' : '';
            ?>
            <div class="sk rv" <?php echo $delay_style; ?>>
                <div class="snum"><?php echo esc_html($num); ?></div>
                <div class="sico"><?php echo wp_unslash($icon); // SVG string ?></div>
                <div class="sname"><?php the_title(); ?></div>
                <div class="sdesc"><?php echo esc_html($content); ?></div>
                <div class="stags">
                    <?php foreach($tags as $t): ?>
                        <span class="stk"><?php echo esc_html($t); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
            $delay = ($delay + 1) % 3; // Reset delay every 3 items for grid rows
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
  </div>
</section>

<!-- ABOUT -->
<section class="asec" id="about">
  <div>
    <div class="stag">About Me</div>
    <h2 class="stit rv" style="margin-bottom:1.6rem">The Designer<br>Behind It</h2>
    <p class="atxt rv">I'm <strong>Hai Truong</strong>, a graphic designer and web designer based in Đà Nẵng, Vietnam. I gravitate toward bold, high-contrast visuals — the kind that stop the scroll and stick in your head.</p>
<p class="atxt rv" style="transition-delay:.07s">My work spans brand identity, event posters, social campaigns and web design. I like projects that have a strong concept behind them — not just something that looks nice, but something that actually means something to the brand.</p>
<p class="atxt rv" style="transition-delay:.12s">Currently open to <strong>remote and international projects</strong> — if you have something interesting in the works, I'd love to hear about it.</p>  
    <div class="astats rv" style="transition-delay:.16s">
      <?php for($i=1; $i<=4; $i++): ?>
        <?php 
        $n = get_option('ht_stat_'.$i.'_num');
        $l = get_option('ht_stat_'.$i.'_label');
        if ($n || $l):
        ?>
        <div class="astat"><div class="an"><?php echo esc_html($n); ?></div><div class="al"><?php echo esc_html($l); ?></div></div>
        <?php endif; ?>
      <?php endfor; ?>
    </div>
  </div>
  <div>
    <div class="stag">Experience</div>
    <div class="tl rv" style="transition-delay:.1s">
      <?php
      $exp_query = new WP_Query([
          'post_type'      => 'experience',
          'posts_per_page' => -1,
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
      ]);
      if ($exp_query->have_posts()) :
          while ($exp_query->have_posts()) : $exp_query->the_post();
              $year = get_post_meta(get_the_ID(), '_exp_year', true);
              $company = get_post_meta(get_the_ID(), '_exp_company', true);
              // Clean up content by removing p tags for simple text, or keep them if needed.
              // Since the original was just text inside a div, strip tags to be safe or use wp_kses_post.
              $content = wp_strip_all_tags(get_the_content());
              ?>
              <div class="tli">
                <div class="tly"><?php echo wp_kses_post($year); ?></div>
                <div>
                  <div class="tlr"><?php the_title(); ?></div>
                  <div class="tlc"><?php echo esc_html($company); ?></div>
                  <div class="tld"><?php echo esc_html($content); ?></div>
                </div>
              </div>
              <?php
          endwhile;
          wp_reset_postdata();
      endif;
      ?>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section class="csec" id="contact">
  <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--accent),transparent)"></div>

  <div style="position:relative;z-index:2;padding:7rem 4rem">
    <!-- Tag -->
    <div class="stag" style="justify-content:center;margin-bottom:2rem">Let's Create Together</div>

    <!-- Heading -->
    <h2 class="stit rv" style="text-align:center;margin-bottom:.5rem">Got a project?<br>Let's make it <span style="color:var(--accent);font-style:italic">happen.</span></h2>

    <!-- Sub -->
    <p style="text-align:center;font-family:var(--fm);font-size:.62rem;letter-spacing:.18em;text-transform:uppercase;color:var(--muted);margin-bottom:3rem" class="rv" style="transition-delay:.08s">Open for freelance · Remote friendly · Based in Đà Nẵng</p>

    <!-- Email -->
    <div style="text-align:center;margin-bottom:4rem">
      <a href="mailto:<?php echo esc_attr(get_option('ht_social_email', 'haitruong2037@gmail.com')); ?>" class="cemail rv" style="transition-delay:.1s"><?php echo esc_html(get_option('ht_social_email', 'haitruong2037@gmail.com')); ?></a>
    </div>

    <!-- Social links -->
    <div id="contact-soc-row" class="rv" style="transition-delay:.18s;display:flex;justify-content:center;gap:0;border:1px solid var(--border);max-width:480px;margin:0 auto">
      <?php if(get_option('ht_social_be')): ?>
      <a href="<?php echo esc_url(get_option('ht_social_be')); ?>" target="_blank" class="soc-block">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h5.5a3.5 3.5 0 0 1 0 7H4V4zM4 11h6a3.5 3.5 0 0 1 0 7H4v-7z"/><path d="M15 7h6M15.5 12a4 4 0 1 0 8 0 4 4 0 0 0-8 0z"/></svg>
        Behance
      </a>
      <?php endif; ?>
      <?php if(get_option('ht_social_fb')): ?>
      <a href="<?php echo esc_url(get_option('ht_social_fb')); ?>" target="_blank" class="soc-block">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
        Facebook
      </a>
      <?php endif; ?>
      <?php if(get_option('ht_social_ig')): ?>
      <a href="<?php echo esc_url(get_option('ht_social_ig')); ?>" target="_blank" class="soc-block">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
        Instagram
      </a>
      <?php endif; ?>
    </div>
  </div>

  <div style="position:absolute;bottom:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--accent),transparent)"></div>
</section>

<?php get_footer(); ?>
