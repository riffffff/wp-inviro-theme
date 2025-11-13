<?php
/**
 * The template for displaying product archive
 *
 * @package INVIRO
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Semua Produk', 'inviro'); ?></h1>
            <?php if (get_the_archive_description()) : ?>
                <div class="archive-description">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>
        </header>
        
        <div class="products-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    $price = get_post_meta(get_the_ID(), '_product_price', true);
                    $original_price = get_post_meta(get_the_ID(), '_product_original_price', true);
                    ?>
                    <article class="product-card" itemscope itemtype="https://schema.org/Product">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('inviro-product'); ?>
                                </a>
                                <button class="product-like" aria-label="Like product">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-info">
                            <h3 class="product-title" itemprop="name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            
                            <?php if (get_the_excerpt()) : ?>
                                <div class="product-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="product-price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                <?php if ($original_price) : ?>
                                    <span class="product-original-price"><?php echo esc_html($original_price); ?></span>
                                <?php endif; ?>
                                <?php if ($price) : ?>
                                    <span class="product-current-price" itemprop="price"><?php echo esc_html($price); ?></span>
                                <?php endif; ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="btn btn-product"><?php esc_html_e('Lihat Detail', 'inviro'); ?></a>
                        </div>
                        
                        <meta itemprop="description" content="<?php echo esc_attr(wp_strip_all_tags(get_the_excerpt())); ?>">
                    </article>
                    <?php
                endwhile;
                
                // Pagination
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&laquo; Previous', 'inviro'),
                    'next_text' => __('Next &raquo;', 'inviro'),
                ));
            else :
                ?>
                <p><?php esc_html_e('Tidak ada produk yang ditemukan.', 'inviro'); ?></p>
                <?php
            endif;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();

