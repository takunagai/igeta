<?php
/**
Template Name: フロントページ
Template Post Type: page
*/

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kunai
 */

the_post();
get_header(); ?>


	<div id="content" class="site-content">


		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">




				<div class="container">
				<?php if ( is_front_page() ) : ?>
						<?php if ( has_excerpt() || get_the_content() ) : // TODO: 読み込み減らすようリファクタリング ?>
						<div class="front-page-content">
								<?php if ( has_excerpt() ) : ?>
								<div class="front-page-content__lead">
										<?php the_excerpt(); ?>
								</div>
								<?php endif; ?>
								<?php if ( get_the_content() ) : ?>
								<div class="front-page-content__body">
										<?php the_content() ?>
								</div>
								<?php endif; ?>
						</div>
						<?php endif; ?>
				<?php else : ?>
				<?php get_template_part( 'template-parts/show-top-level-header' ); // 最上位のヘッダーの表示 ?>
				<?php endif ; ?>
				</div>




				<?php // フロントページのウィジェットコンテンツ群。有効なら表示
				if ( is_active_sidebar( 'front-page-contents' ) ) :
				?>
					<div class="front-page-contents-area">
							<?php dynamic_sidebar( 'front-page-contents' ); ?>
					</div>
				<?php endif; ?>





			<?php
			/**
			 * ブログ最新記事
			 */
			$article_posts = get_posts(
				array(
					'post_type'        => 'post',
					'order'            => 'DESC',
					'orderby'          => 'date',
					'posts_per_page'   => 12,
					// 'category_name'    => 'news',// カテゴリスラッグ
					// 'category'         => 149,// カテゴリIDで指定する場合
					// 'category__not_in' => array( 149 ),// ニュースカテゴリ以外
				)
			);

			if ( isset( $article_posts ) ) :
			?>

				<section class="bg-dark">
					<div class="container">
						<div class="aligncenter">
							<h2>ブログ最新記事<small>blog</small></h2>
							<p>様々なレイアウトパターンが適用できます</p>
						</div>

						<div class="grid grid--mobile-2col card--base">

						<?php
						foreach ( $article_posts as $post ) :setup_postdata( $post );

						// カテゴリ表示用
						$cat = get_the_category();
						$cat = $cat[0];
						?>

							<div class="grid__item">
								<div class="card">
								<?php if ( has_post_thumbnail() ) :
								?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'large', array( 'class' => "card__img" ) ); ?>
									</a>
								<?php else : // アイキャッチ画像がない場合 ?>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/no-image.png" alt="" class="card__img"></a>
								<?php endif; ?>

									<div class="card__body">
											<h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											<p class="card__meta"><?php echo get_the_date( 'Y年m月d日' ); ?></p>
											<p class="card__meta"><?php echo get_cat_name($cat->term_id); ?></p>
											<!-- <p><?php the_excerpt(); ?></p> -->
									</div>
								</div>
							</div>

						<?php
						endforeach; wp_reset_postdata();
						?>
						</div>
						<p class="aligncenter"><a class="btn--primary" href="./blog/">全ての記事を見る</a></p>
					</div>
				</section>

			<?php
			endif;
			// ブログ最新記事 ここまで
			?>



				<section class="border-bottom">
					<div class="container mb-6">
						<h2>色</h2>
						<ul class="inline-list no-listmarker">
							<li><span class="font-x-large color-font           ">■</span> .color-font           </li>
							<li><span class="font-x-large color-font-light     ">■</span> .color-font-light     </li>
							<li><span class="font-x-large color-primary        ">■</span> .color-primary        </li>
							<li><span class="font-x-large color-primary-light  ">■</span> .color-primary-light  </li>
							<li><span class="font-x-large color-primary-dark   ">■</span> .color-primary-dark   </li>
							<li><span class="font-x-large color-secondary      ">■</span> .color-secondary      </li>
							<li><span class="font-x-large color-secondary-light">■</span> .color-secondary-light</li>
							<li><span class="font-x-large color-secondary-dark ">■</span> .color-secondary-dark </li>
							<li><span class="font-x-large color-accent         ">■</span> .color-accent         </li>
							<li><span class="font-x-large color-info           ">■</span> .color-info           </li>
							<li><span class="font-x-large color-link           ">■</span> .color-link           </li>
							<li><span class="font-x-large color-link-hover     ">■</span> .color-link-hover     </li>
							<li><span class="font-x-large color-link-visited   ">■</span> .color-link-visited   </li>
							<li><span class="font-x-large color-red            ">■</span> .color-red            </li>
							<li><span class="font-x-large color-yellow         ">■</span> .color-yellow         </li>
							<li><span class="font-x-large color-gray-100       ">■</span> .color-gray-100       </li>
							<li><span class="font-x-large color-gray-200       ">■</span> .color-gray-200       </li>
							<li><span class="font-x-large color-gray-300       ">■</span> .color-gray-300       </li>
							<li><span class="font-x-large color-gray-400       ">■</span> .color-gray-400       </li>
							<li><span class="font-x-large color-gray           ">■</span> .color-gray (= .color-gray-500)</li>
							<li><span class="font-x-large color-gray-500       ">■</span> .color-gray-500       </li>
							<li><span class="font-x-large color-gray-600       ">■</span> .color-gray-600       </li>
							<li><span class="font-x-large color-gray-700       ">■</span> .color-gray-700       </li>
							<li><span class="font-x-large color-gray-800       ">■</span> .color-gray-800       </li>
							<li><span class="font-x-large color-gray-900       ">■</span> .color-gray-900       </li>
						</ul>
					</div>
				</section>



				<section class="border-bottom">
					<div class="container mb-6">
						<h2>テキスト、フォント</h2>
						<ul>
							<li class="font-x-small">.font-x-small</li>
							<li><small>&lt;small&gt;</small></li>
							<li class="font-small">.font-small</li>
							<li>指定なし</li>
							<li class="font-large">.font-large</li>
							<li class="font-x-large">.font-x-large</li>
							<li class="bold">.bold</li>
							<li><b>&lt;b&gt;</b></li>
						</ul>
					</div>
				</section>



				<section class="border-bottom aligncenter">
					<div class="container mb-6">

						<h2>レイアウト Media</h2>
						<p>画像と文字ブロックが横並びになるレイアウト<br>
						<a href="#">» グリッドのサンプル	</a></p>

						<div class="media media--mobile-2col mb-6">
							<img class="media__img" src="http://dummyimage.com/200x300/CCC/fff.png&text=代替テキスト">
							<div class="media__body">
								<h3 class="media__title">見出しです</h3>
								<p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
								<p class="alignright">社長 <b>鈴木 太郎</b></p>
							</div>
						</div>

						<div class="media media--inverse">
							<img class="media__img" src="http://dummyimage.com/800x600/CCC/fff.png&text=代替テキスト">
							<div class="media__body">
								<h3 class="media__title">見出しです</h3>
								<p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
								<p class="alignright">社長 <b>鈴木 太郎</b></p>
							</div>
						</div>
					</div>

					<div style="background-image: url(https://www.toptal.com/designers/subtlepatterns/patterns/memphis-colorful.png)">
						<div class="container--narrow">
							<div class="media media--25">
								<img class="media__img" src="http://dummyimage.com/800x600/CCC/fff.png&text=代替テキスト">
								<div class="media__body">
									<h3 class="media__title">見出しです</h3>
									<p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
									<p class="alignright">社長 鈴木 太郎</p>
								</div>
							</div>
						</div>
					</div>

					<div class="container--narrow">
						<div class="media media--50 media--inverse mb-6">
							<img class="media__img" src="http://dummyimage.com/800x600/CCC/fff.png&text=代替テキスト">
							<div class="media__body">
								<h3 class="media__title">見出しです</h3>
								<p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
								<p class="alignright">社長 鈴木 太郎</p>
							</div>
						</div>

						<div class="media media--75">
							<img class="media__img" src="http://dummyimage.com/800x600/CCC/fff.png&text=代替テキスト">
							<div class="media__body">
								<h3 class="media__title">見出しです</h3>
								<p>ダミーですお子様の成長は、日々の体験の積み重ねです。様々な場面に幼いながらも自分で関わり、取り組み、感じ取り、心も身体も大きな成長をみせます。季節の自然物を発見したり触れたり、みんなで童謡を歌ったり、五感を刺激しながら、様々な体験ができるよう側で見守ります。スタッフ皆が、毎日が楽しみにできるような温かな保育園を目指していきますので、どうぞ宜しくお願い致します。</p>
								<p class="alignright">社長 鈴木 太郎</p>
							</div>
						</div>
					</div>
				</section>



				<section class="border-bottom bgc-gray-100">
					<div class="container--narrow">
						<h2>テーブル</h2>
						<p><a href="#">» テーブルのサンプル	</a></p>

						<table class="equal-row-width">
							<caption>キャプション</caption>
							<tbody>
								<tr>
									<th> </th>
									<th>見出し１</th>
									<th>見出し２</th>
								</tr>
								<tr>
									<th>見出しA</th>
									<td>内容が入ります</td>
									<td>内容が入ります</td>
								</tr>
								<tr>
									<th>見出しB</th>
									<td>内容が入ります</td>
									<td>内容が入ります</td>
								</tr>
							</tbody>
						</table>
					</div>
				</section>



				<section class="container border-bottom">
					<h2>グリッドレイアウト</h2>
					<p><a href="#">» グリッドのサンプル	</a></p>
					<div class="grid grid--mobile-2col">
						<div class="grid__item">
							<div class="card">
								<img class="card__img" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="">
								<div class="card__body">
									<p>ダミーです私は同年同時にこういう理解通りというは</p>
								</div>
							</div>
						</div>
						<div class="grid__item">
							<div class="card">
								<img class="card__img" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="">
								<div class="card__body">
									<p>ダミーです私は同年同時にこういう理解通りというは</p>
								</div>
							</div>
						</div>
						<div class="grid__item">
							<div class="card">
								<img class="card__img" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="">
								<div class="card__body">
									<p>ダミーです私は同年同時にこういう理解通りというは</p>
								</div>
							</div>
						</div>
						<div class="grid__item">
							<div class="card">
								<img class="card__img" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="">
								<div class="card__body">
									<p>ダミーです私は同年同時にこういう理解通りというは</p>
								</div>
							</div>
						</div>
						<div class="grid__item">
							<div class="card">
								<img class="card__img" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="">
								<div class="card__body">
									<p>ダミーです私は同年同時にこういう理解通りというは</p>
								</div>
							</div>
						</div>
						<div class="grid__item">
							<div class="card">
								<img class="card__img" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト" alt="">
								<div class="card__body">
									<p>ダミーです私は同年同時にこういう理解通りというは</p>
								</div>
							</div>
						</div>
					</div>
				</section>




				<section class="border-bottom">
					<div class="container">
						<h2>メディア（画像、動画 etc）</h2>
						<p><a href="#">» グリッドのサンプル	</a></p>

						<div class="grid--narrow grid--mobile-2col aligncenter">
							<div class="grid__item">
								<img class="rounded--3" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト"><br>
								角丸 3px
							</div>
							<div class="grid__item">
								<img class="rounded" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト">
								角丸 5px
							</div>
							<div class="grid__item">
								<img class="rounded--7" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト">
								角丸 7px
							</div>
							<div class="grid__item">
								<img class="rounded--10" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト">
								角丸 10px
							</div>
							<div class="grid__item">
								<img class="circle" src="http://dummyimage.com/400x400/CCC/fff.png&text=代替テキスト">
								円
							</div>
							<div class="grid__item">
								<img class="box-shadow" src="http://dummyimage.com/600x400/CCC/fff.png&text=代替テキスト">
								box-shadow
							</div>
						</div>
					</div>
				</section>



				<section class="border-bottom">
					<div class="container mb-6">
						<h2>ボタン</h2>
						<p><a href="#" class="btn">.btn</a>
							<a href="#" class="btn--primary">.btn--primary</a>
							<a href="#" class="btn--secondary">.btn--secondary</a>
							<a href="#" class="btn--strong">.btn--strong</a>
						</p>
						<p>
							<a href="#" class="btn btn--small">.btn--small</a>
							<a href="#" class="btn btn--large">.btn--large</a>
						</p>
						<p>
							<a href="#" class="btn btn--selected">.btn--selected</a>
							<a href="#" class="btn btn--visited">.btn--visited</a>
							<a href="#" class="btn btn--disabled">.btn--disabled</a>
						</p>
						<p>
							<a href="#" class="btn btn--pill">.btn--pill</a>
							<a href="#" class="btn">.btn<small>small</small></a>
							<a href="#" class="btn">.btn <small class="inline">small</small></a>
						</p>
						<p>
							<a href="#" class="btn btn--full-width">.btn--full-width</a>
						</p>
					</div>
				</section>



				<section class="border-bottom">
					<div class="container mb-6">
						<h2>デバイスで表示切り替え</h2>
						<p class="mobile-only">This message is displayed only on small monitor.</p>
						<p class="mobile-small-text">This message is displayed smaller on small monitor.</p>
						<p><span style="display:inline-block;outline:1px solid red;" class="mobile-full-width">This message is displayed full width on small monitor.</span></p>
						<p>小さいモニタになっても<span class="mobile-no-break">「折り返したくないフレーズ」</span></p>
						<p>小さいモニタなら<wbr class="mobile-br">折返す</p>
						<p class="mobile-aligncenter">小さいモニタならセンター揃え</p>
						<div class="aligncenter"><p class="mobile-alignleft">小さいモニタなら左揃え</p></div>
					</div>
				</section>



				<?php // get_template_part( 'template-parts/widget-main-bottom' ); ?>

			</main>

		<!-- /#primary.content-area -->
		</div>


		<?php get_sidebar(); ?>


	<!-- /#content -->
	</div>

	<a href="#top" id="move-to-page-top"><i class="fa fa-chevron-up" aria-hidden="true"></i> Top</a>

<?php get_footer(); ?>
