<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package igeta
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( get_template() ); ?>>
<!--[if lt IE 10]>
	<p class="browserupgrade">あなたは<a href="https://www.microsoft.com/japan/msbc/Express/ie_support/?tduid=(c23a0b4c2c4250d18195e73da240a60d)(256380)(2459594)(TnL5HPStwNw-X1eNbpe1sMi3IMh_IJlqPA)()" target="_blank">Microsoftがもはやサポートしていない</a>旧いWebブラウザを使用されています。サポート対象から外れたブラウザはセキュリティ的に危険です。安全性を確保し、表示の適正化するために<a href="https://browsehappy.com/">ブラウザをアップデート</a>することをおすすめします。</p>
<![endif]-->



<div class="site">
	<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'igeta' ); ?></a>



	<div class="site-header-wrapper">

		<header id="masthead" class="site-header" role="banner">
			<div class="site-header-inner container my-0">

			<?php
			if ( has_custom_logo() ) {
				$igeta_site_title = get_custom_logo();
			}
			else {
				$igeta_site_title = '<a href="' . get_bloginfo('url', 'display') . '" class="custom-logo-link">' . get_bloginfo('name', 'display') . "</a>";
			}

			if ( is_front_page() ) : ?>
				<div class="site-branding">
					<h1 class="site-title"><?php echo $igeta_site_title ?></h1>
					<?php
					$igeta_description = get_bloginfo( 'description', 'display' );
					if ( isset( $igeta_description ) ) : ?>
						<p class="catch-phrase"><?php echo $igeta_description; ?></p>
					<?php endif; ?>
				</div>
			<?php else : ?>
				<div class="site-branding">
					<p class="site-title"><?php echo $igeta_site_title ?></p>
				</div>
			<?php endif; ?>


			<?php get_template_part( 'template-parts/primary-menu' ); ?>

			</div>
		</header>



		<?php if ( is_front_page() ) : ?>
			<?php get_template_part( 'template-parts/hero-image' ); ?>
		<?php endif ; ?>

	</div>



	<?php get_template_part( 'template-parts/page-header' ); ?>

	<div class="site-content<?php igeta_wrapper_container_setting(); ?>">
