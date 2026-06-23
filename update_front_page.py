import os

theme_dir = "/Users/macbook/Local Sites/haitruong/app/public/wp-content/themes/haitruong-theme"
final_html_path = os.path.join(theme_dir, "portfolio/final.html")
front_page_path = os.path.join(theme_dir, "front-page.php")

with open(final_html_path, 'r', encoding='utf-8') as f:
    content = f.read()

start_marker = "<!-- HERO -->"
end_marker = "<footer>"

start_idx = content.find(start_marker)
end_idx = content.find(end_marker)

if start_idx != -1 and end_idx != -1:
    extracted_block = content[start_idx:end_idx]
    
    new_front_page_content = "<?php get_header(); ?>\n" + extracted_block + "<?php get_footer(); ?>\n"
    
    with open(front_page_path, 'w', encoding='utf-8') as f:
        f.write(new_front_page_content)
    print("Updated front-page.php successfully.")
else:
    print("Could not find start or end markers.")
