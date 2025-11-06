<?php
if (! is_singular()) :
?>
    <div class="container">
        <article <?php post_class('custom-post-item'); ?> id="post-<?php the_ID(); ?>">
            <div class="custom-post-wrap">
                <div class="custom-post-thumbnail">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <div class="custom-post-date">
                    <div class="day-large">
                        <?php the_time('d'); ?>
                    </div>
                    <div class="month-small">
                        <?php echo 'THÁNG ' . get_the_time('m'); ?>
                    </div>
                </div>

                <div class="custom-post-divider"></div>

                <div class="custom-post-content">
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="entry-excerpt">
                        <?php 
                        $excerpt = get_the_excerpt();
                        echo wp_trim_words($excerpt, 30); 
                        ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
<?php
endif;
?>

<style>
    /* Thêm style cho thumbnail */
    .custom-post-thumbnail {
        width: 200px;
        margin-right: 20px;
    }
    
    .custom-post-thumbnail img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 4px;
    }

    /* Điều chỉnh lại bố cục */
    .custom-post-wrap {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        margin-bottom: 20px;
        background: #fff;
        text-decoration: none;
        padding: 15px 20px;
    }

    /* Ô ngày-tháng */
    .custom-post-date {
        width: 80px;
        text-align: center;
        font-family: Arial, sans-serif;
        padding-right: 10px;
    }

    .custom-post-date .day-large {
        font-size: 36px;
        font-weight: bold;
        color: #222;
        line-height: 1;
    }

    .custom-post-date .month-small {
        font-size: 12px;
        color: #666;
        margin-top: 5px;
        text-transform: uppercase;
    }

    /* Vạch chia dọc */
    .custom-post-divider {
        width: 1px;
        background: #ccc;
        margin: 0 15px;
    }

    /* Nội dung bên phải */
    .custom-post-content {
        flex: 1;
    }

    .custom-post-content .entry-title {
        font-size: 16px;
        font-weight: bold;
        margin: 0 0 6px;
        color: #1e5799;
        /* xanh đậm */
        text-transform: uppercase;
    }

    .custom-post-content .entry-excerpt {
        font-size: 13px;
        color: #444;
        line-height: 1.5;
    }

    .entry-title a {
        text-decoration: none;
        color: #1e5799;
        display: block;
    }

    .entry-title a:hover {
        color: #2980b9;
    }

    .custom-post-wrap {
        cursor: pointer;
    }

    .custom-post-wrap:hover {
        background: #f9f9f9;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .custom-post-wrap {
            flex-direction: column;
            padding: 15px;
        }

        .custom-post-date {
            text-align: left;
            margin-bottom: 10px;
            width: auto;
        }

        .custom-post-divider {
            display: none;
        }

        .custom-post-content .entry-title {
            font-size: 15px;
        }

        .custom-post-thumbnail {
            width: 100%;
            margin-right: 0;
            margin-bottom: 15px;
        }
        
        .custom-post-thumbnail img {
            height: 200px;
        }
    }
</style>

