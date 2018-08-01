module.exports = function() {

	/**
	* BROWSERHACKS
	*     @link https://qiita.com/hashrock/items/189db03021b0f565ae27#2-align-itemscenter-%E3%81%AF%E3%81%BF%E5%87%BA%E3%81%99%E5%95%8F%E9%A1%8C
	*     @link http://browserhacks.com
	*     @link https://github.com/saadeghi/browser-hack-sass-mixins
	*/

	const mediaImages = document.getElementsByClassName('media__img');

	if ( typeof(mediaImages) == 'undefined' ){
		for (var i=0; i<mediaImages.length; i++) {
			mediaImages[i].classList.remove('media__img');
			mediaImages[i].outerHTML = '<div class="media__img">' + mediaImages[i].outerHTML + '</div>'; // = jQuery: $( ".inner" ).wrap( "<div class='new'></div>" );
		}
	}

};
