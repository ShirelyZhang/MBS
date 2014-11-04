$(document).ready(function () {
	$('.nav-link').on('click', function (event) {
		event.preventDefault();
		$('.nav-link').each(function () {
			$(this).removeClass('current-tab');
		});

		$(this).addClass('current-tab');
	});
});