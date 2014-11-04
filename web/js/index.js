$(document).ready(function () {
    var pageSize = 10,
        currentPage = 1,
        totalRecords = 0,
        totalPage = 0;

    // refresh pagination bar
    function refreshPaginationBar() {
        totalPage = Math.ceil(totalRecords / pageSize);

        if (totalPage <= 1) {
            $('.select-page-block button').attr('disabled', true);
            $('.select-page-block input').val(totalPage);
        } else if (1 == currentPage) {
            $('.select-page-block button').attr('disabled', false);
            $('.first-page').attr('disabled', true);
            $('.prev-page').attr('disabled', true);
            $('.select-page-block input').val(currentPage);
        } else if (totalPage == currentPage) {
            $('.select-page-block button').attr('disabled', false);
            $('.last-page').attr('disabled', true);
            $('.next-page').attr('disabled', true);
            $('.select-page-block input').val(currentPage);
        } else {
            $('.select-page-block button').attr('disabled', false);
            $('.select-page-block input').val(currentPage);
        }
    }

    // page input box validate function
    function changeCurrentPage(goToPage) {
        var reg = /^[1-9]\d*$/;
        if (reg.test(parseInt(goToPage))) {
            if (goToPage < 1) {
                goToPage = 1;
            } else if (goToPage > totalPage) {
                goToPage = totalPage;
            }
            if (goToPage != currentPage) {
                currentPage = goToPage;
                getMessageList();
            }
        } else {
            alert('Please input valid number.');
        }
    }

	// get message list
	var _strHtml = '',
		getMessageList = function () {
	    var params = $('#messageSearchForm').serialize() + '&page_size=' + pageSize + '&current_page=' + currentPage;
		$.ajax({
			url: 'get-message-list.php',
			type: 'get',
			data: params,
			dataType: 'json',
			success: function (result) {
			    _strHtml = '';
			    totalRecords = result.count;
			    var messages = result.messages;

				if ($.isEmptyObject(messages)) {
					_strHtml = '<tr><td colspan="4">No Record</td></tr>';
				} else {
					$.each(messages, function (index, message) {
						_strHtml += '<tr>';
						_strHtml += '<td title="' + message.message_id + '">' + message.message_id + 
									'</td>';
						_strHtml += '<td title="' + message.title + '"><a href="detail.php?message_id=' 
									+ message.message_id + '">' + message.title + '</td>';
						_strHtml += '<td title="' + message.nickname + '">' + message.nickname + '</td>';
						_strHtml += '<td title="' + message.created + '">' + message.created + '</td>';
						_strHtml += '</tr>';
					});
				}

				$('#messageListTable tbody').html(_strHtml);

				refreshPaginationBar();
			},
			error: function () {
				console.log('Get message list fail.');
			}
		});
	};

	$('#searchBtn').on('click', function () {
		getMessageList();
	});

	$('.pagesize-select').on('change', function () {
        pageSize = $(this).val();
        $('.pagesize-select').val(pageSize);
        currentPage = 1;
        getMessageList();
    });

	$('.page-input-box').on('keydown', function (e) {
	    if (13 == e.keyCode) {
	        changeCurrentPage($(this).val());
	    }
	});

	$('.first-page').on('click', function () {
        currentPage = 1;
        getMessageList();
	});

	$('.last-page').on('click', function () {
        currentPage = totalPage;
        getMessageList();
    });

	$('.prev-page').on('click', function () {
	    if (currentPage <= 1) {
	        // do nothing
	    } else {
	        currentPage = currentPage - 1;
	        getMessageList();
	    }
    });

	$('.next-page').on('click', function () {
        if (currentPage >= totalPage) {
            // do nothing
        } else {
            currentPage = currentPage + 1;
            getMessageList();
        }
    });

	getMessageList();
});