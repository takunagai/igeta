<?php
/**
 * TinyMCE and TinyMCE Advanced Settings.
 *
 * @package igeta
 * @link https://nagaishouten.com/
 */



if ( ! function_exists( 'igeta_customize_tinymce_settings' ) ) :

	function igeta_customize_tinymce_settings( $init_array ) {

		global $allowedposttags;

		/**
		 * "プレーンテキストでペースト" ボタンをデフォルトで ON に
		 */
		$init_array['paste_as_text'] = true;

		/**
		 * ブロックレベル要素(段落、見出し1、見出し2…)のドロップダウンメニューをカスタマイズ
		 *
		 * @link http://www.warna.info/archives/2868/
		 */
		$init_array['block_formats'] = 'Paragraph=p;見出し2=h2;見出し3=h3;見出し4=h4;整形済みテキスト=pre;コード=code';

		/**
		 * リサイズ禁止
		 */
		$init_array['object_resizing']   = false;
		$init_array['table_resize_bars'] = false;

		/**
		 * ビジュアルエディタに切り替えで、空の span タグや i タグ、data- 属性が消されるのを防止
		 *
		 * @link https://www.the-triad.jp/blog/wordpressのエディタが独自拡張の属性値を消してしまう/
		 * @link http://blog.yuhiisk.com/archive/2017/05/11/tiny-mce-before-init-setting.html
		 */
		$init_array['valid_elements']          = '*[*]'; // 全てのタグと属性を許可（空の span や div タグ等を削除させない）
		$init_array['extended_valid_elements'] = '*[*]'; // 全ての属性が消されるのを防止 (data- など)
		$init_array['valid_children']          = '+a[' . implode( '|', array_keys( $allowedposttags ) ) . ']';// a タグに全てのタグを入れられるようにする
		$init_array['indent']                  = true; // インデントを消さない
		$init_array['verify_html']             = false; // 空タグ、属性なしのタグを消させない

		/**
		 * エディター独自スタイル追加
		 */
		$style_formats = [
			[
				'title'   => '赤字・太字',
				'inline'  => 'strong',
				'classes' => 'warning',
			],
			[
				'title'  => 'マーカー',
				'inline' => 'mark',
			],
			[
				'title'  => '小さい文字',
				'inline' => 'small',
			],
			[
				'title'   => 'リード文',
				'block'   => 'p',
				'classes' => 'lead',
			],
			[
				'title'      => 'ボタン1',
				'inline'     => 'a',
				'classes'    => 'btn--primary',
				'attributes' => [
					'href' => 'https://alafarine.com',
				],
			],
			[
				'title'      => 'ボタン2',
				'inline'     => 'a',
				'classes'    => 'btn--secondary',
				'attributes' => [
					'href' => 'https://alafarine.com',
				],
			],
		];

		$init_array['style_formats'] = json_encode( $style_formats );

		/**
		 * editor-style.css のキャッシュクリア
		 */
		$init_array['cache_suffix'] = 'v=' . time();

		return $init_array;
	}
endif;
add_filter( 'tiny_mce_before_init', 'igeta_customize_tinymce_settings', 1000 );// TinyMCE Advanced より後に実行されるよう、1000番にフック登録
