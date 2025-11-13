<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead" class="site-header">
    <div class="header-container">
        <div class="header-wrapper">
            <div class="site-branding">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                        <span class="site-title">INVIRO<sup>™</sup></span>
                    </a>
                    <?php
                }
                ?>
            </div>
            
            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'nav-menu',
                    'fallback_cb'    => 'inviro_default_menu',
                    'link_before'    => '',
                    'link_after'     => '',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ));
                ?>
            </nav>
            
            <div class="header-actions">
                <button class="search-toggle" aria-label="Search">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
                <a href="tel:+621234567890" class="phone-link" aria-label="Phone">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <div class="search-overlay">
        <div class="search-container">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="search-field" placeholder="<?php esc_attr_e('Cari...', 'inviro'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                <button type="submit" class="search-submit">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </form>
            <button class="search-close" aria-label="Close search">×</button>
        </div>
    </div>
</header>

<?php
// Default menu fallback
function inviro_default_menu() {
    echo '<ul class="nav-menu">';
    echo '<li' . (is_front_page() ? ' class="current-menu-item"' : '') . '><a href="' . esc_url(home_url('/')) . '">Beranda</a></li>';
    echo '<li' . (is_page('profil') ? ' class="current-menu-item"' : '') . '><a href="' . esc_url(home_url('/profil')) . '">Profil</a></li>';
    echo '<li' . (is_page('paket-usaha') ? ' class="current-menu-item"' : '') . '><a href="' . esc_url(home_url('/paket-usaha')) . '">Paket Usaha</a></li>';
    echo '<li' . (is_page('pelanggan') ? ' class="current-menu-item"' : '') . '><a href="' . esc_url(home_url('/pelanggan')) . '">Pelanggan</a></li>';
    echo '<li' . (is_page('spare-parts') ? ' class="current-menu-item"' : '') . '><a href="' . esc_url(home_url('/spare-parts')) . '">Spare Parts</a></li>';
    echo '<li' . ((is_single() && get_post_type() == 'post') || is_category() || is_tag() || is_date() ? ' class="current-menu-item"' : '') . '><a href="' . esc_url(home_url('/artikel')) . '">Artikel</a></li>';
    echo '<li' . (is_page('unduhan') ? ' class="current-menu-item"' : '') . '><a href="' . esc_url(home_url('/unduhan')) . '">Unduhan</a></li>';
    echo '</ul>';
}
?>

