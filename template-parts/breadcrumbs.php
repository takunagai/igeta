<?php
/**
 * Bread Crumbs.
 *
 * @package igeta
 *
 *
 *
 * This Parent Theme doesn't have breaacrumbs function.
 * Set breadcrumbs in Child Theme.
 * Sample Code by using breadcrumbs plugins below.
 *
 * <?php if ( ! is_front_page() ) : ?>
 *
 *  <?php if ( function_exists( 'bcn_display' ) ) : // Breadcrumb NavXT Plugin ?>
 *
 *      <div class="breadcrumbs breadcrumb-navxt">
 *          <ol>
 *          <?php bcn_display(); ?>
 *          </ol>
 *      </div>
 *
 *
 *  <?php elseif ( shortcode_exists( 'wp-structuring-markup-breadcrumb' ) ) : ?>
 *
 *      <div class="breadcrumbs wp-structuring-markup-breadcrumb">
 *      <?php echo do_shortcode( '[wp-structuring-markup-breadcrumb]' ); // Markup (JSON-LD) structured in schema.org ?>
 *      </div>
 *
 *  <?php endif; ?>
 *
 * <?php endif ; ?>
 */

