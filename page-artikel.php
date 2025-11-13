<?php
/**
 * Template Name: Artikel dan Berita
 */

get_header();
?>

<div class="artikel-page">
    <!-- Hero Section -->
    <section class="artikel-hero">
        <div class="container">
            <div class="hero-content">
                <h1>Artikel dan Berita Terbaru</h1>
                <p>Update terbaru dari Inviro untuk mendukung usaha dan kebutuhan air minum Anda</p>
            </div>
        </div>
    </section>

    <!-- Search -->
    <section class="artikel-search">
        <div class="container">
            <div class="search-bar">
                <input type="text" id="artikel-search" placeholder="🔍 Cari artikel..." />
            </div>
        </div>
    </section>

    <!-- Artikel Grid -->
    <section class="artikel-grid-section">
        <div class="container">
            <div class="artikel-grid">
                <?php
                $articles = new WP_Query(array(
                    'post_type' => 'artikel',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($articles->have_posts()) :
                    while ($articles->have_posts()) : $articles->the_post();
                        $author_name = get_the_author_meta('display_name');
                        $post_date = get_the_date('d/m/Y');
                ?>
                <div class="artikel-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="artikel-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="artikel-content">
                        <div class="artikel-meta-top">
                            <span class="artikel-author">Oleh <?php echo esc_html($author_name); ?></span>
                            <span class="artikel-date">📅 <?php echo esc_html($post_date); ?></span>
                        </div>
                        
                        <h3>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                        
                        <div class="artikel-excerpt">
                            <?php 
                            if (has_excerpt()) {
                                the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 20);
                            }
                            ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="artikel-link">
                            Baca Selengkapnya »
                        </a>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <div class="no-results">
                    <p>Belum ada artikel. Silakan tambahkan di <strong>Artikel</strong> > <strong>Tambah Artikel</strong></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<style>
.artikel-page {
    padding-top: 80px;
}

.artikel-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.artikel-hero h1 {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.artikel-hero p {
    font-size: 1.1rem;
    opacity: 0.95;
}

.artikel-search {
    padding: 30px 0;
    background: white;
    border-bottom: 1px solid #e0e0e0;
}

.search-bar {
    max-width: 600px;
    margin: 0 auto;
}

#artikel-search {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
}

#artikel-search:focus {
    outline: none;
    border-color: #667eea;
}

.artikel-grid-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.artikel-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.artikel-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.artikel-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.artikel-image {
    height: 220px;
    overflow: hidden;
}

.artikel-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.artikel-card:hover .artikel-image img {
    transform: scale(1.1);
}

.artikel-content {
    padding: 25px;
}

.artikel-meta-top {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 15px;
    font-size: 0.85rem;
    color: #666;
    flex-wrap: wrap;
}

.artikel-author {
    font-weight: 600;
    color: #667eea;
}

.artikel-content h3 {
    margin-bottom: 15px;
    line-height: 1.4;
}

.artikel-content h3 a {
    color: #333;
    text-decoration: none;
    font-size: 1.2rem;
    transition: color 0.3s;
}

.artikel-content h3 a:hover {
    color: #667eea;
}

.artikel-excerpt {
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
    font-size: 0.95rem;
}

.artikel-link {
    display: inline-block;
    color: #667eea;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.artikel-link:hover {
    color: #764ba2;
    transform: translateX(5px);
}

.no-results {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
}

@media (max-width: 992px) {
    .artikel-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .artikel-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .artikel-hero h1 {
        font-size: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('artikel-search');
    const cards = document.querySelectorAll('.artikel-card');
    
    if (searchInput && cards.length) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const excerpt = card.querySelector('.artikel-excerpt').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || excerpt.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});
</script>

<?php get_footer(); ?>
