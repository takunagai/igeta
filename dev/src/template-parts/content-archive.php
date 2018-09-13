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
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" class="media__img">
				<?php the_post_thumbnail( 'thumbnail', array() ); ?>
			</a>
		<?php else : // アイキャッチ画像がない場合 ?>
			<a href="<?php the_permalink(); ?>" class="media__img"><img src="<?php echo site_url() ?>/wp-content/uploads/2018/09/dummy-150x100.png" alt=""></a>
		<?php endif; ?>
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
