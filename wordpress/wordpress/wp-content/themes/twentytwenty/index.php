<?php
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" crossorigin="anonymous">

<style>
  .form-control-borderless {
    border: none;
    box-shadow: none;
  }
  .form-control-borderless:hover,
  .form-control-borderless:active,
  .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;
  }
  .card {
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  .btn-success {
    background-color: #28a745;
    border: none;
    font-weight: 600;
  }
  .btn-success:hover {
    background-color: #218838;
  }
  .fa-search {
    color: #666;
  }
</style>

<main id="site-content">

  <?php
  $archive_title    = '';
  $archive_subtitle = '';

  if ( is_search() ) {
    global $wp_query;
    
    // Tùy chỉnh tiêu đề tìm kiếm sang Tiếng Việt và màu đỏ
    $search_query_html = '&ldquo;' . get_search_query() . '&rdquo;';
    $archive_title = '<span style="color: red;">Tìm kiếm:</span> ' . $search_query_html;

    if ( $wp_query->found_posts ) {
      // Có kết quả tìm kiếm, hiển thị thông báo
      $archive_subtitle = sprintf(
        _n(
          'Chúng tôi tìm thấy %s kết quả cho tìm kiếm của bạn.',
          'Chúng tôi tìm thấy %s kết quả cho tìm kiếm của bạn.',
          $wp_query->found_posts,
          'twentytwenty'
        ),
        number_format_i18n( $wp_query->found_posts )
      );
    } else {
      // Không có kết quả tìm kiếm, hiển thị thông báo Tiếng Việt
      $archive_subtitle = __( 'Chúng tôi không tìm thấy bất kỳ kết quả nào. Bạn có thể tìm kiếm lại với form tìm kiếm bên dưới.', 'twentytwenty' );
      
      // 💡 PHẦN ĐÃ CHỈNH SỬA: Đã di chuyển khối search bar xuống đây
      // Thêm biến để đánh dấu không có kết quả
      $no_results = true; 
    }
  } elseif ( is_archive() && ! have_posts() ) {
    $archive_title = __( 'Nothing Found', 'twentytwenty' );
  } elseif ( ! is_home() ) {
    $archive_title    = get_the_archive_title();
    $archive_subtitle = get_the_archive_description();
  }

  if ( $archive_title || $archive_subtitle ) {
    ?>
    <header class="archive-header has-text-align-center header-footer-group">
      <div class="archive-header-inner section-inner medium">
        <?php if ( $archive_title ) { ?>
          <h1 class="archive-title" style="color: red; font-weight: bold;"><?php echo wp_kses_post( $archive_title ); ?></h1>
        <?php } ?>
        <?php if ( $archive_subtitle ) { ?>
          <div class="archive-subtitle section-inner thin max-percentage intro-text">
            <?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?>
          </div>
        <?php } ?>
      </div>
    </header>
    <?php
  }

  if ( have_posts() ) {
    // 💡 PHẦN ĐÃ CHỈNH SỬA: Hiển thị form tìm kiếm trên đầu khi CÓ kết quả
    if ( is_search() ) {
      ?>
      <div class="container py-4">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-8">
            <form class="card card-sm" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <div class="card-body row no-gutters align-items-center">
                <div class="col-auto">
                  <i class="fas fa-search h4 text-body"></i>
                </div>
                <div class="col">
                  <input class="form-control form-control-lg form-control-borderless" type="search" name="s" placeholder="Search topics or keywords" value="<?php echo get_search_query(); ?>">
                </div>
                <div class="col-auto">
                  <button class="btn btn-lg btn-success" type="submit">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
    }

    $i = 0;
    while ( have_posts() ) {
      ++$i;
      the_post();
      get_template_part( 'template-parts/content', get_post_type() );
    }
  } elseif ( is_search() ) {
    // 💡 PHẦN ĐÃ CHỈNH SỬA: Hiển thị form tìm kiếm ở DƯỚI khi KHÔNG CÓ kết quả
    if ( isset($no_results) && $no_results ) {
      ?>
      <div class="container py-4">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-8">
            <form class="card card-sm" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <div class="card-body row no-gutters align-items-center">
                <div class="col-auto">
                  <i class="fas fa-search h4 text-body"></i>
                </div>
                <div class="col">
                  <input class="form-control form-control-lg form-control-borderless" type="search" name="s" placeholder="Search topics or keywords" value="<?php echo get_search_query(); ?>">
                </div>
                <div class="col-auto">
                  <button class="btn btn-lg btn-success" type="submit">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
    }
  }
  ?>

  <?php get_template_part( 'template-parts/pagination' ); ?>

</main><?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>
<?php get_footer(); ?>