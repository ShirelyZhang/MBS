$(document).ready(function () {
	function emptyValidate() {
		var nickname = $('#nickname').val(),
			password = $('#pwd').val();

		if ('' == nickname) {
			$('.errors').text('Nickname can not be empty.');
			return false;
		} else if ('' == password) {
			$('.errors').text('Password can not be empty.');
			return false;
		} else {
			$('.errors').text('');
			return true;
		}
	}

	$('#nickname').on('blur', function () {
		var nickname = $('#nickname').val();

		if ('' == nickname) {
			$('.errors').text('Nickname can not be empty.');
		} else {
			$('.errors').text('');
		}
	});

	$('#pwd').on('blur', function () {
		var password = $('#pwd').val();

		if ('' == password) {
			$('.errors').text('Password can not be empty.');
		} else {
			$('.errors').text('');
		}
	});

	$('#logBtn').on('click', function () {
		if (emptyValidate()) {
			// login request
			$.ajax({
				url: 'log.php',
				type: 'post',
				data: $('#logForm').serialize(),
				dataType: 'text',
				success: function (result) {
					console.log(result);
					if ('success' == result) {
						window.location.href = 'index.php';
					} else if ('fail' == result) {
						$('.errors').text('Nickname or password is wrong.');
					} else {
						$('.errors').text(result);
					}
				},
				error: function () {
					console.log('Login failed.');
				}
			});
		}
	});
});