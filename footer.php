<footer id="colophon" class="site-footer">
    <div class="footer-top">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-brand">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        ?>
                        <h2 class="footer-logo">INVIRO<sup>™</sup></h2>
                        <?php
                    }
                    ?>
                    <p class="footer-description">
                        <?php echo esc_html(get_theme_mod('inviro_footer_description', 'Solusi terpercaya untuk usaha depot air minum Anda. Mesin berkualitas, harga terjangkau, dukungan penuh.')); ?>
                    </p>
                    <div class="footer-social">
                        <?php 
                        $fb_url = get_theme_mod('inviro_footer_facebook', '#');
                        $ig_url = get_theme_mod('inviro_footer_instagram', '#');
                        $tw_url = get_theme_mod('inviro_footer_twitter', '#');
                        ?>
                        <a href="<?php echo esc_url($fb_url); ?>" aria-label="Facebook" target="_blank" rel="noopener">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url($tw_url); ?>" aria-label="Twitter" target="_blank" rel="noopener">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url($ig_url); ?>" aria-label="Instagram" target="_blank" rel="noopener">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" aria-label="YouTube" target="_blank" rel="noopener">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="footer-columns">
                    <div class="footer-column">
                        <h3 class="footer-title">Tentang Kami</h3>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'container'      => false,
                            'menu_class'     => 'footer-menu',
                            'fallback_cb'    => 'inviro_footer_menu_fallback',
                        ));
                        ?>
                    </div>
                    
                    <div class="footer-column">
                        <h3 class="footer-title">Komunitas</h3>
                        <ul class="footer-menu">
                            <li><a href="#">Events</a></li>
                            <li><a href="<?php echo esc_url(home_url('/artikel')); ?>">Blog</a></li>
                            <li><a href="#">Podcast</a></li>
                            <li><a href="#">Invite a friend</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3 class="footer-title">Sosial Media</h3>
                        <ul class="footer-menu">
                            <li><a href="#" target="_blank" rel="noopener">YouTube</a></li>
                            <li><a href="#" target="_blank" rel="noopener">Instagram</a></li>
                            <li><a href="#" target="_blank" rel="noopener">WhatsApp</a></li>
                            <li><a href="#" target="_blank" rel="noopener">Facebook</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-column">
                        <h3 class="footer-title">Kunjungi Lokasi INVIRO<sup>™</sup></h3>
                        <ul class="footer-menu">
                            <?php
                            $branches = new WP_Query(array(
                                'post_type' => 'cabang',
                                'posts_per_page' => 4,
                                'orderby' => 'date',
                                'order' => 'ASC'
                            ));
                            
                            if ($branches->have_posts()) {
                                while ($branches->have_posts()) {
                                    $branches->the_post();
                                    echo '<li><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></li>';
                                }
                                wp_reset_postdata();
                            } else {
                                echo '<li><a href="#">INVIRO Jakarta</a></li>';
                                echo '<li><a href="#">INVIRO Surabaya</a></li>';
                                echo '<li><a href="#">INVIRO Bandung</a></li>';
                                echo '<li><a href="#">INVIRO Yogyakarta</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="footer-container">
            <div class="footer-bottom-content">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'inviro'); ?>
                </p>
                <div class="footer-links">
                    <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>"><?php esc_html_e('Privacy & Policy', 'inviro'); ?></a>
                    <span class="separator">|</span>
                    <a href="<?php echo esc_url(home_url('/terms-condition')); ?>"><?php esc_html_e('Terms & Condition', 'inviro'); ?></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php
function inviro_footer_menu_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/profil')) . '">Profil</a></li>';
    echo '<li><a href="' . esc_url(home_url('/paket-usaha')) . '">Paket Usaha</a></li>';
    echo '<li><a href="' . esc_url(home_url('/pelanggan')) . '">Pelanggan</a></li>';
    echo '</ul>';
}
?>

<div class="whatsapp-float">
    <?php $wa_number = get_theme_mod('inviro_whatsapp', '621234567890'); ?>
    <a href="https://wa.me/<?php echo esc_attr($wa_number); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>
</div>

<?php wp_footer(); ?>
</body>
</html>

