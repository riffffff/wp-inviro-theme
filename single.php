<?php
/**
 * The template for displaying single posts
 *
 * @package INVIRO
 */

get_header();
?>

<main id="main" class="site-main">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <span class="posted-on">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </span>
                        <?php if (get_post_type() === 'produk') : ?>
                            <?php
                            $price = get_post_meta(get_the_ID(), '_product_price', true);
                            $original_price = get_post_meta(get_the_ID(), '_product_original_price', true);
                            if ($price || $original_price) :
                                ?>
                                <div class="product-price-single">
                                    <?php if ($original_price) : ?>
                                        <span class="product-original-price"><?php echo esc_html($original_price); ?></span>
                                    <?php endif; ?>
                                    <?php if ($price) : ?>
                                        <span class="product-current-price"><?php echo esc_html($price); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="entry-content">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'inviro'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
                
                <footer class="entry-footer">
                    <?php
                    $categories = get_the_category();
                    if ($categories) :
                        ?>
                        <div class="post-categories">
                            <span class="cat-links">
                                <?php esc_html_e('Categories:', 'inviro'); ?>
                                <?php the_category(', '); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    $tags = get_the_tags();
                    if ($tags) :
                        ?>
                        <div class="post-tags">
                            <span class="tags-links">
                                <?php esc_html_e('Tags:', 'inviro'); ?>
                                <?php the_tags('', ', ', ''); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </footer>
            </article>
            
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();

