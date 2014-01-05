$(function(){
	$('.dropdown_head').click(function() {
		$head = $(this);
		if ($head.hasClass('open')) {
			$head.siblings('.dropdown_block').stop(true, true).slideUp('slow');
		} else {
			$head.siblings('.dropdown_block').stop(true, true).slideDown('slow');
		}
		$head.toggleClass('open');
	});
});