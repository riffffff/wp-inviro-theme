<?php
/**
 * Template Name: Paket Usaha
 * 
 * @package INVIRO
 */

get_header();
?>

<main id="primary" class="site-main paket-usaha-page">
    
    <!-- Hero Section -->
    <section class="paket-hero">
        <div class="container">
            <div class="paket-hero-content">
                <h1><?php echo esc_html(get_theme_mod('inviro_paket_hero_title', 'Paket Usaha')); ?></h1>
                <p><?php echo esc_html(get_theme_mod('inviro_paket_hero_subtitle', 'INVIRO menyediakan paket mulai dari Depot Air Minum Isi Ulang (DAMIU), mesin RO, Water Treatment Plant, Produk AMDK, dan lain-lain.')); ?></p>
            </div>
        </div>
    </section>

    <!-- Search & Filter -->
    <section class="paket-filter">
        <div class="container">
            <div class="filter-wrapper">
                <div class="search-box">
                    <input type="text" id="paket-search" placeholder="Cari paket usaha..." />
                    <button type="button" class="search-btn">🔍</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="paket-grid-section">
        <div class="container">
            <div class="paket-grid">
                <?php
                // Get all products
                $packages = new WP_Query(array(
                    'post_type' => 'produk',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                if ($packages->have_posts()) :
                    while ($packages->have_posts()) : $packages->the_post();
                        $price = get_post_meta(get_the_ID(), '_product_price', true);
                        $original_price = get_post_meta(get_the_ID(), '_product_original_price', true);
                ?>
                <div class="paket-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="paket-image">
                            <?php the_post_thumbnail('inviro-product'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="paket-content">
                        <h3><?php the_title(); ?></h3>
                        
                        <div class="paket-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>
                        
                        <div class="paket-meta">
                            <?php if ($price) : ?>
                                <div class="paket-price">
                                    <?php if ($original_price) : ?>
                                        <span class="original-price">Rp <?php echo number_format((int)str_replace(['Rp', '.', ' '], '', $original_price), 0, ',', '.'); ?></span>
                                    <?php endif; ?>
                                    <span class="current-price"><?php echo esc_html($price); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="paket-actions">
                            <a href="<?php the_permalink(); ?>" class="btn btn-outline">Detail</a>
                            <button type="button" class="btn btn-primary btn-wishlist" data-product-id="<?php echo get_the_ID(); ?>">
                                <span class="wishlist-icon">♡</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <div class="no-results">
                    <p>Belum ada paket usaha. Silakan tambahkan di <strong>Produk</strong> > <strong>Add New</strong></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="paket-features">
        <div class="container">
            <h2><?php echo esc_html(get_theme_mod('inviro_paket_features_title', 'Keunggulan Paket Usaha INVIRO')); ?></h2>
            <div class="features-grid">
                <?php for ($i = 1; $i <= 4; $i++) : 
                    $feature_icon = get_theme_mod("inviro_paket_feature_{$i}_icon", '✓');
                    $feature_title = get_theme_mod("inviro_paket_feature_{$i}_title", '');
                    $feature_desc = get_theme_mod("inviro_paket_feature_{$i}_desc", '');
                    if ($feature_title) :
                ?>
                <div class="feature-card">
                    <div class="feature-icon"><?php echo esc_html($feature_icon); ?></div>
                    <h3><?php echo esc_html($feature_title); ?></h3>
                    <p><?php echo esc_html($feature_desc); ?></p>
                </div>
                <?php 
                    endif;
                endfor; 
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="paket-cta">
        <div class="container">
            <div class="cta-content">
                <h2><?php echo esc_html(get_theme_mod('inviro_paket_cta_title', 'Siap Memulai Bisnis Depot Air Minum?')); ?></h2>
                <p><?php echo esc_html(get_theme_mod('inviro_paket_cta_subtitle', 'Konsultasikan kebutuhan bisnis Anda dengan tim ahli kami')); ?></p>
                <a href="<?php echo esc_url(get_theme_mod('inviro_paket_cta_link', '#kontak')); ?>" class="btn btn-primary">
                    <?php echo esc_html(get_theme_mod('inviro_paket_cta_button', 'Konsultasi Gratis')); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
