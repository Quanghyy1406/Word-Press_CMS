<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
    /* --- Tổng thể header --- */
    header#site-header {
      background: #d9d9d9;
      border-bottom: 1px solid #ccc;
      font-family: "Segoe UI", Arial, sans-serif;
    }

    .header-inner {
      max-width: 1300px;
      margin: 0 auto;
      padding: 8px 30px;
    }

    /* --- Hàng ngang chính --- */
    .header-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 25px;
      flex-wrap: nowrap;
      white-space: nowrap;
    }

    /* --- Bên trái --- */
    .header-left {
      display: flex;
      align-items: center;
      gap: 20px;
      flex-shrink: 0;
      height: 40px;
    }

    .header-left a {
      color: #333;
      font-weight: 600;
      text-decoration: none;
      font-size: 15px;
      line-height: 38px;
    }

    .header-left a:hover {
      color: #007bff;
    }

    /* --- Form tìm kiếm --- */
    .search-form {
      display: flex;
      align-items: center;
      height: 38px;
    }

    .search-field {
      width: 250px; /* chiều dài ô tìm kiếm */
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 6px 0 0 6px;
      outline: none;
      background: #fff;
      font-size: 14px;
      height: 100%;
    }

    .search-submit {
      padding: 0 16px;
      border: none;
      border-radius: 0 6px 6px 0;
      background: #ccc;
      color: #333;
      font-weight: 600;
      cursor: pointer;
      height: 100%;
      transition: 0.3s;
    }

    .search-submit:hover {
      background: #bbb;
    }

    /* --- Menu giữa (WordPress) --- */
    .header-navigation-wrapper {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 40px;
    }

    .primary-menu-wrapper ul {
      display: flex;
      align-items: center;
      justify-content: center;
      list-style: none;
      margin: 0;
      padding: 0;
      gap: 25px;
    }

    .primary-menu-wrapper ul li a {
      color: #b30000;
      text-decoration: none;
      font-weight: 600;
      font-size: 15px;
      line-height: 38px;
      transition: 0.2s;
    }

    .primary-menu-wrapper ul li a:hover {
      text-decoration: underline;
    }

    /* --- Bên phải --- */
    .header-right {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      gap: 20px;
      flex-shrink: 0;
      height: 40px;
    }

    .header-right a {
      color: #333;
      font-weight: 500;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 15px;
      line-height: 38px;
    }

    .header-right a:hover {
      color: #007bff;
    }

    .header-right i {
      font-size: 15px;
    }

    html, body {
      overflow-x: hidden;
    }
  </style>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="header-footer-group">
  <div class="header-inner">
    <div class="header-row">

      <!-- Bên trái -->
      <div class="header-left">
        <a href="http://localhost:8080/">Group C</a>
        <a href="http://localhost:8080/">Home</a>

        <form class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
          <input type="text" class="search-field" placeholder="abc" name="s">
          <button type="submit" class="search-submit">SUBMIT</button>
        </form>
      </div>

      <!-- Menu giữa (WordPress dynamic) -->
      <div class="header-navigation-wrapper">
        <?php
        if (has_nav_menu('primary') || ! has_nav_menu('expanded')) {
        ?>
          <nav class="primary-menu-wrapper" aria-label="<?php echo esc_attr_x('Horizontal', 'menu', 'twentytwenty'); ?>">
            <ul class="primary-menu reset-list-style">
              <?php
              if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                  'container'  => '',
                  'items_wrap' => '%3$s',
                  'theme_location' => 'primary',
                ));
              } elseif (! has_nav_menu('expanded')) {
                wp_list_pages(array(
                  'match_menu_classes' => true,
                  'show_sub_menu_icons' => true,
                  'title_li' => false,
                  'walker'   => new TwentyTwenty_Walker_Page(),
                ));
              }
              ?>
            </ul>
          </nav>
        <?php } ?>
      </div>

      <!-- Bên phải -->
      <div class="header-right">
        <a href="#"><i class="fas fa-ellipsis-v"></i> Menu</a>
        <a href="#"><i class="fas fa-search"></i> Search</a>
        <a href="#"><i class="fas fa-user"></i> Quang Huy <i class="fas fa-chevron-down" style="font-size:10px;"></i></a>
      </div>

    </div>
  </div>
</header>

<?php get_template_part('template-parts/modal-menu'); ?>
