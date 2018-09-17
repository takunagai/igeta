<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package igeta
 */

?>

<li>
	<div class="media__img">
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'thumbnail', array() ); ?>
		</a>
	<?php else : ?>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo site_url() ?>/wp-content/themes/igeta/img/no-image.png" width="<?php echo get_option( 'thumbnail_size_w' ); ?>" height="<?php echo get_option( 'thumbnail_size_h' ); ?>" alt=""></a>
	<?php endif; ?>
	</div>
    <div class="media__body">
        <?php the_title( '<h3 class="entry-title media__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
        <?php if ( 'post' === get_post_type() ) : ?>
        <p class="media__meta entry-meta">
            <?php echo get_the_date('Y年n月j日(l)'); ?>
            <span class="separator"> | </span>
            <span class="category"><?php $cat = get_the_category(); $cat = $cat[0]; {echo "$cat->cat_name " ;} ?></span>
        </p>
        <?php endif; ?>
    </div>
</li>
