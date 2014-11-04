$(document).ready(function () {
	function titleValidate() {
		var title = $.trim($('#messageTitle').val());

		if ('' == title) {
			$('.title-tips').text('Title can not be empty.');
			return false;
		} else {
			$('.title-tips').text('');
			return true;
		}
	}

	function contentValidate() {
		var content = $.trim($('#messageContent').val());

		if ('' == content) {
			$('.content-tips').text('Content can not be empty.');
			return false;
		} else {
			$('.content-tips').text('');
			return true;
		}
	}

	$('#messageTitle').on('blur', function () {
		titleValidate();
	});

	$('#messageContent').on('blur', function () {
		contentValidate();
	});

	$('#editBtn').on('click', function () {
		console.log('edit message');
		if (titleValidate() && contentValidate()) {
			// edit request
			$.ajax({
				url: 'message_edit.php',
				type: 'post',
				data: $('#messageEditForm').serialize(),
				dataType: 'text',
				success: function (result) {
					if ('success' == result) {
						window.location.href = 'my-messages.php';
					} else if ('fail' == result) {
						alert('Edit failed.');
					} else if ('permission denied' == result) {
						window.location.href = 'login.php';
					} else {
						alert(result);
					}
				},
				error: function () {
					console.log('Edit message failed.');
				}
			});
		}
	});

	$('#createBtn').on('click', function () {
		if (titleValidate() && contentValidate()) {
			// edit request
			$.ajax({
				url: 'message_create.php',
				type: 'post',
				data: $('#messageEditForm').serialize(),
				dataType: 'text',
				success: function (result) {
					if ('success' == result) {
						window.location.href = 'my-messages.php';
					} else if ('fail' == result) {
						alert('Create failed.');
					} else if ('permission denied' == result) {
						window.location.href = 'login.php';
					} else {
						alert(result);
					}
				},
				error: function () {
					console.log('Create message failed.');
				}
			});
		}
	});
});