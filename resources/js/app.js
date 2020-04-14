require('./bootstrap');

$( function() {

	$(document).on('click', '.app-about .read-more', function(e) {
		e.preventDefault();

		let $this = $(this);
		let $about_block = $this.closest('.app-about');

		$about_block.toggleClass('opened');

		if( $about_block.hasClass('opened') ) {
			$this.html($this.attr('data-opened-text'));
		} else {
			$this.html($this.attr('data-closed-text'));
		}

		return false;
	});
});