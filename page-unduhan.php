<?php
/**
 * Template Name: Unduhan
 */

get_header();
?>

<div class="unduhan-page">
    <!-- Hero Section -->
    <section class="unduhan-hero">
        <div class="container">
            <div class="hero-content">
                <h1>Pusat Unduhan</h1>
                <p>Download katalog produk, brosur, dan dokumen pendukung lainnya</p>
            </div>
        </div>
    </section>

    <!-- Search & Filter -->
    <section class="unduhan-filter">
        <div class="container">
            <div class="filter-bar">
                <input type="text" id="unduhan-search" placeholder="🔍 Cari file..." />
                <select id="unduhan-type">
                    <option value="">Semua Tipe File</option>
                    <option value="pdf">PDF</option>
                    <option value="doc">DOC/DOCX</option>
                    <option value="xls">Excel</option>
                    <option value="zip">ZIP/RAR</option>
                    <option value="image">Gambar</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Unduhan Grid -->
    <section class="unduhan-grid-section">
        <div class="container">
            <div class="unduhan-grid">
                <?php
                $files = new WP_Query(array(
                    'post_type' => 'unduhan',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($files->have_posts()) :
                    while ($files->have_posts()) : $files->the_post();
                        $file_url = get_post_meta(get_the_ID(), '_unduhan_file_url', true);
                        $file_size = get_post_meta(get_the_ID(), '_unduhan_file_size', true);
                        $file_type = get_post_meta(get_the_ID(), '_unduhan_file_type', true);
                        $download_count = get_post_meta(get_the_ID(), '_unduhan_download_count', true);
                        $download_count = $download_count ? $download_count : 0;
                        
                        // Get file extension for icon
                        $extension = '';
                        if ($file_url) {
                            $path_parts = pathinfo($file_url);
                            $extension = isset($path_parts['extension']) ? strtolower($path_parts['extension']) : '';
                        }
                        
                        // Determine icon based on extension
                        $icon = '📄';
                        $icon_class = 'default';
                        if (in_array($extension, array('pdf'))) {
                            $icon = '📕';
                            $icon_class = 'pdf';
                        } elseif (in_array($extension, array('doc', 'docx'))) {
                            $icon = '📘';
                            $icon_class = 'doc';
                        } elseif (in_array($extension, array('xls', 'xlsx'))) {
                            $icon = '📗';
                            $icon_class = 'xls';
                        } elseif (in_array($extension, array('zip', 'rar', '7z'))) {
                            $icon = '📦';
                            $icon_class = 'zip';
                        } elseif (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {
                            $icon = '🖼️';
                            $icon_class = 'image';
                        }
                        
                        $data_type = '';
                        if (in_array($extension, array('pdf'))) $data_type = 'pdf';
                        elseif (in_array($extension, array('doc', 'docx'))) $data_type = 'doc';
                        elseif (in_array($extension, array('xls', 'xlsx'))) $data_type = 'xls';
                        elseif (in_array($extension, array('zip', 'rar', '7z'))) $data_type = 'zip';
                        elseif (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) $data_type = 'image';
                ?>
                <div class="unduhan-card" data-type="<?php echo esc_attr($data_type); ?>">
                    <div class="unduhan-icon <?php echo esc_attr($icon_class); ?>">
                        <?php echo $icon; ?>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="unduhan-thumb">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="unduhan-content">
                        <h3><?php the_title(); ?></h3>
                        
                        <?php if (has_excerpt()) : ?>
                            <p class="unduhan-desc">
                                <?php the_excerpt(); ?>
                            </p>
                        <?php endif; ?>
                        
                        <div class="file-info">
                            <?php if ($file_type) : ?>
                                <span class="file-type-badge">
                                    <?php echo esc_html(strtoupper($file_type)); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ($file_size) : ?>
                                <span class="file-size">
                                    📦 <?php echo esc_html($file_size); ?>
                                </span>
                            <?php endif; ?>
                            
                            <span class="download-count">
                                ⬇️ <?php echo number_format($download_count); ?> download
                            </span>
                        </div>
                        
                        <?php if ($file_url) : ?>
                            <a href="<?php echo esc_url($file_url); ?>" 
                               class="download-btn" 
                               data-post-id="<?php echo get_the_ID(); ?>"
                               download>
                                Unduh File
                            </a>
                        <?php else : ?>
                            <span class="no-file">File tidak tersedia</span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <div class="no-results">
                    <p>Belum ada file. Silakan tambahkan di <strong>Unduhan</strong> > <strong>Tambah Unduhan</strong></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="unduhan-cta">
        <div class="container">
            <div class="cta-content">
                <h2>Butuh Informasi Lebih Lanjut?</h2>
                <p>Hubungi tim kami untuk konsultasi gratis seputar produk dan layanan Inviro</p>
                <a href="https://wa.me/6281234567890" class="btn-wa" target="_blank">
                    Konsultasi Via WhatsApp
                </a>
            </div>
        </div>
    </section>
</div>

<style>
.unduhan-page {
    padding-top: 80px;
}

.unduhan-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.unduhan-hero h1 {
    font-size: 2.5rem;
    margin-bottom: 15px;
}

.unduhan-hero p {
    font-size: 1.1rem;
    opacity: 0.95;
}

.unduhan-filter {
    padding: 30px 0;
    background: white;
    border-bottom: 1px solid #e0e0e0;
}

.filter-bar {
    display: flex;
    gap: 15px;
    max-width: 800px;
    margin: 0 auto;
}

#unduhan-search {
    flex: 1;
    padding: 15px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
}

#unduhan-type {
    padding: 15px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 16px;
    min-width: 200px;
}

#unduhan-search:focus,
#unduhan-type:focus {
    outline: none;
    border-color: #667eea;
}

.unduhan-grid-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.unduhan-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.unduhan-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    text-align: center;
}

.unduhan-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.unduhan-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 12px;
    display: inline-block;
}

.unduhan-icon.pdf {
    background: #ffebee;
}

.unduhan-icon.doc {
    background: #e3f2fd;
}

.unduhan-icon.xls {
    background: #e8f5e9;
}

.unduhan-icon.zip {
    background: #fff3e0;
}

.unduhan-icon.image {
    background: #f3e5f5;
}

.unduhan-icon.default {
    background: #f5f5f5;
}

.unduhan-thumb {
    margin-bottom: 20px;
}

.unduhan-thumb img {
    max-width: 150px;
    border-radius: 8px;
}

.unduhan-content h3 {
    margin-bottom: 15px;
    color: #333;
    font-size: 1.2rem;
}

.unduhan-desc {
    color: #666;
    line-height: 1.6;
    margin-bottom: 15px;
    font-size: 0.95rem;
}

.file-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.file-type-badge {
    display: inline-block;
    padding: 5px 12px;
    background: #667eea;
    color: white;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 700;
}

.file-size,
.download-count {
    font-size: 0.9rem;
    color: #666;
}

.download-btn {
    display: inline-block;
    width: 100%;
    padding: 15px 30px;
    background: #667eea;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s;
}

.download-btn:hover {
    background: #764ba2;
    transform: scale(1.02);
}

.no-file {
    display: block;
    padding: 15px;
    color: #999;
    font-style: italic;
}

.no-results {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
}

.unduhan-cta {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 0;
    color: white;
    text-align: center;
}

.unduhan-cta h2 {
    font-size: 2rem;
    margin-bottom: 15px;
}

.unduhan-cta p {
    font-size: 1.1rem;
    margin-bottom: 30px;
    opacity: 0.95;
}

.btn-wa {
    display: inline-block;
    padding: 15px 40px;
    background: #25D366;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-wa:hover {
    background: #1fb855;
    transform: translateY(-3px);
    box-shadow: 0 5px 20px rgba(37, 211, 102, 0.4);
}

@media (max-width: 992px) {
    .unduhan-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filter-bar {
        flex-direction: column;
    }
    
    #unduhan-type {
        min-width: 100%;
    }
}

@media (max-width: 768px) {
    .unduhan-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .unduhan-hero h1 {
        font-size: 2rem;
    }
    
    .unduhan-cta h2 {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('unduhan-search');
    const typeSelect = document.getElementById('unduhan-type');
    const cards = document.querySelectorAll('.unduhan-card');
    
    function filterCards() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedType = typeSelect.value;
        
        cards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const desc = card.querySelector('.unduhan-desc');
            const descText = desc ? desc.textContent.toLowerCase() : '';
            const cardType = card.dataset.type;
            
            const matchesSearch = title.includes(searchTerm) || descText.includes(searchTerm);
            const matchesType = !selectedType || cardType === selectedType;
            
            if (matchesSearch && matchesType) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    if (searchInput && typeSelect) {
        searchInput.addEventListener('input', filterCards);
        typeSelect.addEventListener('change', filterCards);
    }
    
    // Track downloads via AJAX
    const downloadButtons = document.querySelectorAll('.download-btn');
    downloadButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const postId = this.dataset.postId;
            
            if (postId) {
                fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=track_download&post_id=' + postId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update download count display
                        const countSpan = btn.closest('.unduhan-card').querySelector('.download-count');
                        if (countSpan && data.data.new_count) {
                            countSpan.textContent = '⬇️ ' + data.data.new_count.toLocaleString() + ' download';
                        }
                    }
                });
            }
        });
    });
});
</script>

<?php get_footer(); ?>
