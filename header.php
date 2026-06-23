<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HaiTruong — Graphic & Webdesign</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=Space+Mono:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="cur"></div>
<div id="cur-ring"></div>

<!-- LIGHTBOX -->
<div class="lb" id="lb">
  <div class="lb-header">
    <div><div class="lb-title" id="lb-title"></div><div class="lb-sub" id="lb-sub"></div></div>
    <div class="lb-actions">
      <button class="lb-navbtn" id="lb-prev">← Prev</button>
      <button class="lb-navbtn" id="lb-next">Next →</button>
      <div class="lb-close" id="lb-close"><svg viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"/></svg></div>
    </div>
  </div>
  <div class="lb-body" id="lb-body"></div>
</div>

<!-- NAV -->
<nav>
  <div class="nl">Hai<b>Truong</b>.design</div>
  <ul>
    <li><a href="#work" class="lnk">Work</a></li>
    <li><a href="#skills" class="lnk">Skills</a></li>
    <li><a href="#about" class="lnk">About</a></li>
    <li><a href="#contact" class="lnk">Contact</a></li>
  </ul>
  <a href="#contact" class="ncta">Get in Touch →</a>
</nav>

