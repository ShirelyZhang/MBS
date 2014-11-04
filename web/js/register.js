$(document).ready(function () {
	function nicknameIsExist(name) {
		var isExist = false;

		$.ajax({
			url: 'name_is_exist.php',
			type: 'get',
			async: false,
			data: {nickname: name},
			dataType: 'text',
			success: function (result) {
				if ('success' == result) {
					isExist = true;
				} else if ('fail' == result) {
					isExist = false;
				}
			},
			error: function () {
				alert('Get nickname fail.');
			}
		});

		return isExist;
	};

	function nicknameValidate() {
		// 字母，数字，汉字，下划线
		var nicknameFormat = /^[\u4e00-\u9fa5\w]+$/,
			nickname = $.trim($('#nickname').val()),
			tips = '',
			color = '#797979',
			returnValue = true;

		if ('' == nickname) {
			tips = 'Nickname can not be empty.';
			color = '#a94442';
			returnValue = false;
		} else if (nickname.length > 255) {
			tips = 'The length is more than 255 characters.';
			color = '#a94442';
			returnValue = false;
		} else if (!nicknameFormat.test(nickname)) {
			tips = 'Name format is wrong.';
			color = '#a94442';
			returnValue = false;
		} else if (nicknameIsExist(nickname)) {
			tips = 'This name is already exist.';
			color = '#a94442';
			returnValue = false;
		} else {
			tips = '';
			color = '#797979';
			returnValue = true;
		}

		$('.nickname-tips').text(tips);
		$('.nickname-tips').css('color', color);
		return returnValue;
	}

	function pwdValidate() {
		var pwdFormat = /^\w+$/,
			pwd = $('#pwd').val(),
			tips = '',
			color = '#797979',
			returnValue = true;

		if ('' == pwd) {
			tips = 'Password can not be empty.';
			color = '#a94442';
			returnValue = false;
		} else if (pwd.length < 6) {
			tips = 'The length is less than 6 characters.';
			color = '#a94442';
			returnValue = false;
		} else if (pwd.length > 20) {
			tips = 'The length is more than 20 characters.';
			color = '#a94442';
			returnValue = false;
		} else if (!pwdFormat.test(pwd)) {
			tips = 'Password format is wrong.';
			color = '#a94442';
			returnValue = false;
		} else {
			tips = '';
			color = '#797979';
			returnValue = true;
		}

		$('.pwd-tips').text(tips);
		$('.pwd-tips').css('color', color);
		return returnValue;
	}

	function confirmPwdValidate() {
		var pwdFormat = /^[\da-zA-Z_]+$/,
			pwd = $('#pwd').val(),
			confirmPwd = $('#confirmPwd').val(),
			tips = '',
			color = '#797979',
			returnValue = true;

		if ('' == confirmPwd) {
			tips = 'Confirm password can not be empty.';
			color = '#a94442';
			returnValue = false;
		} else if (confirmPwd.length < 6) {
			tips = 'The length is less than 6 characters.';
			color = '#a94442';
			returnValue = false;
		} else if (confirmPwd.length > 20) {
			tips = 'The length is more than 20 characters.';
			color = '#a94442';
			returnValue = false;
		} else if (!pwdFormat.test(confirmPwd)) {
			tips = 'Password format is wrong.';
			color = '#a94442';
			returnValue = false;
		}else if (confirmPwd != pwd) {
			tips = 'The two password is not same.';
			color = '#a94442';
			returnValue = false;
		} else {
			tips = '';
			color = '#797979';
			returnValue = true;
		}

		$('.confirm-pwd-tips').text(tips);
		$('.confirm-pwd-tips').css('color', color);
		return returnValue;
	}

	$('#nickname').on('blur', function () {
		nicknameValidate();
	});

	$('#pwd').on('blur', function () {
		pwdValidate();
	});

	$('#confirmPwd').on('blur', function () {
		confirmPwdValidate();
	});

	$('#regBtn').on('click', function () {
		// validation
		if (nicknameValidate() && pwdValidate() && confirmPwdValidate()) {
			// register request
			$.ajax({
				url: 'reg.php',
				type: 'post',
				data: $('#regForm').serialize(),
				dataType: 'text',
				success: function (result) {
					if ('success' == result) {
						window.location.href = 'index.php';
					} else if ('fail' == result) {
						alert('Register failed.');
					} else {
						alert(result);
					}
				},
				error: function () {
					console.log('Register failed.');
				}
			});	
		}
	});
});