<?php
/**
 * The front page template file
 *
 * @package INVIRO
 */

get_header();
?>

<main id="main" class="site-main">
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-slider">
            <?php
            $hero_image = get_theme_mod('inviro_hero_image');
            $hero_image_url = $hero_image ? wp_get_attachment_image_url($hero_image, 'full') : '';
            $hero_title = get_theme_mod('inviro_hero_title', 'Solusi Depot Air Minum Terpercaya');
            $hero_description = get_theme_mod('inviro_hero_description', 'Mesin berkualitas tinggi dengan harga terjangkau untuk usaha depot air minum Anda');
            $hero_button_text = get_theme_mod('inviro_hero_button_text', 'Pelajari Lebih Lanjut');
            $hero_button_link = get_theme_mod('inviro_hero_button_link', '#');
            ?>
            <div class="hero-slide active" style="background-image: url('<?php echo esc_url($hero_image_url ? $hero_image_url : get_template_directory_uri() . '/assets/images/hero-placeholder.jpg'); ?>');">
                <div class="hero-overlay">
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                            <p class="hero-description"><?php echo esc_html($hero_description); ?></p>
                            <a href="<?php echo esc_url($hero_button_link); ?>" class="btn btn-primary"><?php echo esc_html($hero_button_text); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Statistics Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number"><?php echo esc_html(get_theme_mod('inviro_stat_1_number', '500+')); ?></div>
                    <div class="stat-label"><?php echo esc_html(get_theme_mod('inviro_stat_1_label', 'Pelanggan Puas')); ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo esc_html(get_theme_mod('inviro_stat_2_number', '15')); ?></div>
                    <div class="stat-label"><?php echo esc_html(get_theme_mod('inviro_stat_2_label', 'Tahun Pengalaman')); ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?php echo esc_html(get_theme_mod('inviro_stat_3_number', '24/7')); ?></div>
                    <div class="stat-label"><?php echo esc_html(get_theme_mod('inviro_stat_3_label', 'Dukungan Pelanggan')); ?></div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-branches">
                    <?php
                    // Get selected branches from customizer
                    $displayed_branches = array();
                    for ($i = 1; $i <= 4; $i++) {
                        $branch_id = get_theme_mod('inviro_branch_' . $i);
                        if ($branch_id) {
                            $displayed_branches[] = $branch_id;
                        }
                    }
                    
                    // Display selected branches
                    if (!empty($displayed_branches)) :
                        $branches_query = new WP_Query(array(
                            'post_type' => 'cabang',
                            'post__in' => $displayed_branches,
                            'orderby' => 'post__in',
                            'posts_per_page' => 4
                        ));
                        
                        if ($branches_query->have_posts()) :
                            while ($branches_query->have_posts()) : $branches_query->the_post();
                                $location = get_post_meta(get_the_ID(), '_branch_location', true);
                                ?>
                                <div class="branch-card">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="branch-image">
                                            <?php the_post_thumbnail('inviro-branch'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="branch-name"><?php the_title(); ?></h3>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    else :
                        // Fallback: display latest 4 branches if none selected
                        $branches_query = new WP_Query(array(
                            'post_type' => 'cabang',
                            'posts_per_page' => 4,
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        
                        if ($branches_query->have_posts()) :
                            while ($branches_query->have_posts()) : $branches_query->the_post();
                                $location = get_post_meta(get_the_ID(), '_branch_location', true);
                                ?>
                                <div class="branch-card">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="branch-image">
                                            <?php the_post_thumbnail('inviro-branch'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="branch-name"><?php the_title(); ?></h3>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    endif;
                    ?>
                </div>
                
                <div class="about-text">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('inviro_about_title', 'Tentang INVIRO')); ?></h2>
                    <div class="about-description">
                        <?php echo wp_kses_post(get_theme_mod('inviro_about_description', 'INVIRO adalah perusahaan terkemuka dalam penyediaan mesin dan peralatan depot air minum berkualitas tinggi. Dengan pengalaman lebih dari 15 tahun, kami telah melayani ratusan pelanggan di seluruh Indonesia.')); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Products Section -->
    <section id="products" class="products-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('inviro_products_title', 'Produk Unggulan')); ?></h2>
                <p class="section-subtitle"><?php echo esc_html(get_theme_mod('inviro_products_subtitle', 'Pilihan terbaik untuk usaha depot air minum Anda')); ?></p>
            </div>
            
            <div class="products-grid">
                <?php
                // Get featured products from customizer
                $featured_products = array();
                for ($i = 1; $i <= 8; $i++) {
                    $product_id = get_theme_mod('inviro_featured_product_' . $i);
                    if ($product_id) {
                        $featured_products[] = $product_id;
                    }
                }
                
                // Get products count from customizer
                $products_count = get_theme_mod('inviro_products_count', 8);
                
                // Query args
                $args = array(
                    'post_type' => 'produk',
                    'posts_per_page' => $products_count,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                
                // If there are featured products, prioritize them
                if (!empty($featured_products)) {
                    $args['post__in'] = $featured_products;
                    $args['orderby'] = 'post__in';
                }
                
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        $price = get_post_meta(get_the_ID(), '_product_price', true);
                        $original_price = get_post_meta(get_the_ID(), '_product_original_price', true);
                        $buy_url = get_post_meta(get_the_ID(), '_product_buy_url', true);
                        
                        // Fallback URL jika tidak diisi
                        if (empty($buy_url)) {
                            $buy_url = get_theme_mod('inviro_whatsapp') ? 'https://wa.me/' . get_theme_mod('inviro_whatsapp') : '#';
                        }
                        ?>
                        <article class="product-card" data-product-id="<?php echo esc_attr(get_the_ID()); ?>" itemscope itemtype="https://schema.org/Product">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="product-image">
                                    <?php the_post_thumbnail('inviro-product'); ?>
                                    <button class="product-like" data-product-id="<?php echo esc_attr(get_the_ID()); ?>" aria-label="Like product">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                        </svg>
                                    </button>
                                </div>
                            <?php endif; ?>
                            
                            <div class="product-info">
                                <h3 class="product-title" itemprop="name"><?php the_title(); ?></h3>
                                
                                <div class="product-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                    <?php if ($original_price) : ?>
                                        <span class="product-original-price"><?php echo esc_html($original_price); ?></span>
                                    <?php endif; ?>
                                    <?php if ($price) : ?>
                                        <span class="product-current-price" itemprop="price"><?php echo esc_html($price); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <a href="<?php echo esc_url($buy_url); ?>" class="btn btn-product" target="_blank" rel="noopener"><?php esc_html_e('Beli', 'inviro'); ?></a>
                            </div>
                            
                            <meta itemprop="description" content="<?php echo esc_attr(wp_strip_all_tags(get_the_excerpt())); ?>">
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Default products
                    for ($i = 1; $i <= 4; $i++) :
                        ?>
                        <article class="product-card">
                            <div class="product-image">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product-placeholder.jpg" alt="Product <?php echo $i; ?>">
                                <button class="product-like" aria-label="Like product">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="product-info">
                                <h3 class="product-title"><?php esc_html_e('Mesin RO 20.000 GPD Kapasitas Setara 2000 Liter/Jam', 'inviro'); ?></h3>
                                <div class="product-price">
                                    <span class="product-original-price">Rp6.000.000</span>
                                    <span class="product-current-price">Rp5.000.000</span>
                                </div>
                                <a href="#" class="btn btn-product"><?php esc_html_e('Beli', 'inviro'); ?></a>
                            </div>
                        </article>
                        <?php
                    endfor;
                endif;
                ?>
            </div>
            
            <div class="section-footer">
                <a href="<?php echo esc_url(get_post_type_archive_link('produk')); ?>" class="btn btn-outline"><?php esc_html_e('Lihat semua produk', 'inviro'); ?></a>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html(get_theme_mod('inviro_testimonials_title', 'Dipercaya Oleh Banyak Pelanggan')); ?></h2>
                <p class="section-subtitle"><?php echo esc_html(get_theme_mod('inviro_testimonials_subtitle', '95% Pelanggan INVIRO di berbagai daerah di Indonesia merasa puas dengan pelayanan & produk INVIRO')); ?></p>
            </div>
            
            <div class="testimonials-carousel">
                <div class="testimonials-track">
                    <?php
                    // Get selected testimonials from customizer (up to 10)
                    $selected_testimonials = array();
                    for ($i = 1; $i <= 10; $i++) {
                        $testimonial_id = get_theme_mod('inviro_testimonial_' . $i);
                        if ($testimonial_id) {
                            $selected_testimonials[] = $testimonial_id;
                        }
                    }
                    
                    if (!empty($selected_testimonials)) :
                        $testimonials = new WP_Query(array(
                            'post_type' => 'testimoni',
                            'post__in' => $selected_testimonials,
                            'orderby' => 'post__in',
                            'posts_per_page' => -1
                        ));
                        
                        if ($testimonials->have_posts()) :
                            while ($testimonials->have_posts()) : $testimonials->the_post();
                                $customer_name = get_post_meta(get_the_ID(), '_testimonial_customer_name', true);
                                $rating = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                                $message = get_post_meta(get_the_ID(), '_testimonial_message', true);
                                $date = get_post_meta(get_the_ID(), '_testimonial_date', true);
                                
                                if (!$customer_name) $customer_name = get_the_title();
                                if (!$rating) $rating = 5;
                                if (!$message) $message = get_the_content();
                                if (!$date) $date = get_the_date('d / m / Y');
                                ?>
                                <div class="testimonial-card" itemscope itemtype="https://schema.org/Review">
                                    <div class="testimonial-header">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="testimonial-avatar">
                                                <?php the_post_thumbnail('inviro-testimonial'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="testimonial-meta">
                                            <h4 class="testimonial-name" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                                <span itemprop="name"><?php echo esc_html($customer_name); ?></span>
                                            </h4>
                                            <div class="testimonial-date"><?php echo esc_html($date); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="testimonial-rating" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                                        <meta itemprop="ratingValue" content="<?php echo esc_attr($rating); ?>">
                                        <meta itemprop="bestRating" content="5">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<span class="star filled">★</span>';
                                            } else {
                                                echo '<span class="star">★</span>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    
                                    <div class="testimonial-content" itemprop="reviewBody">
                                        <?php echo wpautop(esc_html($message)); ?>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    else :
                        // Default testimonials when none selected
                        $default_testimonials = array(
                            array('name' => 'Robert B.', 'rating' => 5, 'date' => '1/1/2020', 'content' => 'Wow... I am so happy to see this business is turned out to be more than my expectations and as for the service, I am so pleased. Thank you so much!'),
                            array('name' => 'Diana M.', 'rating' => 4.5, 'date' => '1/1/2020', 'content' => 'Wow... I am very happy to use this service. It turned out to be more than my expectations and as for the service, I am so pleased. Thank you so much!'),
                            array('name' => 'Syahrani P.', 'rating' => 5, 'date' => '1/10/2025', 'content' => 'Wow... I am very happy to use this Service. It turned out to be more than my expectations and so far there have been no problems. Inviro always the best.')
                        );
                        
                        foreach ($default_testimonials as $testimonial) :
                            ?>
                            <div class="testimonial-card">
                                <div class="testimonial-header">
                                    <div class="testimonial-avatar">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/avatar-placeholder.jpg" alt="<?php echo esc_attr($testimonial['name']); ?>">
                                    </div>
                                    <div class="testimonial-meta">
                                        <h4 class="testimonial-name"><?php echo esc_html($testimonial['name']); ?></h4>
                                        <div class="testimonial-date"><?php echo esc_html($testimonial['date']); ?></div>
                                    </div>
                                </div>
                                <div class="testimonial-rating">
                                    <?php
                                    $rating = $testimonial['rating'];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<span class="star filled">★</span>';
                                        } elseif ($i - 0.5 <= $rating) {
                                            echo '<span class="star half">★</span>';
                                        } else {
                                            echo '<span class="star">★</span>';
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="testimonial-content">
                                    <p><?php echo esc_html($testimonial['content']); ?></p>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                
                <div class="testimonials-controls">
                    <button class="testimonial-prev" aria-label="Previous testimonial">‹</button>
                    <button class="testimonial-next" aria-label="Next testimonial">›</button>
                </div>
                
                <div class="testimonials-indicators"></div>
            </div>
        </div>
    </section>
    
    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php echo esc_html(get_theme_mod('inviro_contact_title', 'Hubungi Kami')); ?></h2>
                <?php 
                $contact_desc = get_theme_mod('inviro_contact_description', '');
                if ($contact_desc) : ?>
                    <p class="section-subtitle"><?php echo esc_html($contact_desc); ?></p>
                <?php endif; ?>
            </div>
            
            <div class="contact-content">
                <div class="contact-map">
                    <?php
                    $map_url = get_theme_mod('inviro_contact_map_url', '');
                    if ($map_url) {
                        // Simply use iframe with the URL directly - let browser handle it
                        // Google Maps will auto-convert most URL formats when used in iframe
                        echo '<iframe src="' . esc_url($map_url) . '" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';
                    } else {
                        ?>
                        <div class="map-placeholder" itemscope itemtype="https://schema.org/LocalBusiness">
                            <div class="map-placeholder-content">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <p><?php esc_html_e('Peta akan ditampilkan di sini', 'inviro'); ?></p>
                                <p class="small"><?php esc_html_e('Tambahkan URL embed Google Maps di Customizer', 'inviro'); ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                
                <div class="contact-features">
                    <?php for ($i = 1; $i <= 3; $i++) : 
                        $icon = get_theme_mod('inviro_contact_feature_' . $i . '_icon', $i == 1 ? 'phone' : ($i == 2 ? 'tag' : 'map-pin'));
                        $title = get_theme_mod('inviro_contact_feature_' . $i . '_title', $i == 1 ? 'Customer Support' : ($i == 2 ? 'Harga & Kualitas Terjamin' : 'Banyak Lokasi'));
                        $description = get_theme_mod('inviro_contact_feature_' . $i . '_description', $i == 1 ? 'Tim support kami siap membantu Anda 24/7' : ($i == 2 ? 'Harga terbaik dengan kualitas premium' : 'Hadir di berbagai kota di Indonesia'));
                        $color = get_theme_mod('inviro_contact_feature_' . $i . '_color', $i == 1 ? '#28a745' : ($i == 2 ? '#ff8c00' : '#dc3545'));
                        ?>
                        <div class="feature-item">
                            <div class="feature-icon" style="background-color: <?php echo esc_attr($color); ?>;">
                                <?php echo inviro_get_feature_icon($icon); ?>
                            </div>
                            <div class="feature-content">
                                <h3><?php echo esc_html($title); ?></h3>
                                <p><?php echo esc_html($description); ?></p>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            
            <div class="contact-form-wrapper">
                <h3 class="form-title"><?php esc_html_e('Silakan tinggalkan saran atau tanggapan Anda!', 'inviro'); ?></h3>
                <form id="inviro-contact-form" class="contact-form" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-name"><?php esc_html_e('Nama', 'inviro'); ?> <span class="required">*</span></label>
                            <input type="text" id="contact-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email"><?php esc_html_e('Email', 'inviro'); ?> <span class="required">*</span></label>
                            <input type="email" id="contact-email" name="email" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contact-subject"><?php esc_html_e('Subjek', 'inviro'); ?></label>
                            <input type="text" id="contact-subject" name="subject">
                        </div>
                        <div class="form-group">
                            <label for="contact-phone"><?php esc_html_e('Nomor Ponsel', 'inviro'); ?></label>
                            <input type="tel" id="contact-phone" name="phone">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-message"><?php esc_html_e('Pesan', 'inviro'); ?> <span class="required">*</span></label>
                        <textarea id="contact-message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary"><?php esc_html_e('Kirim Pesan', 'inviro'); ?></button>
                    </div>
                    
                    <div class="form-message"></div>
                </form>
            </div>
        </div>
    </section>
    
</main>

<?php
get_footer();

