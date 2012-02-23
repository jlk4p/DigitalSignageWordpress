	function updateDateTime(showSeconds) {
		var month_name = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		var current_date_time = new Date();
		var dateString = month_name[current_date_time.getMonth()]+' '+current_date_time.getDate();
		var hour = current_date_time.getHours();
		var merideim = '';
		if (hour < 12) {
			merideim = 'am';
		} else {
			merideim = 'pm';
		}
		if (hour == 0) {
			hour = 12;
		} else if (hour > 12) {
			hour = hour - 12;
		}
		var minute = current_date_time.getMinutes().toString();
		if (minute.length < 2) {
			minute = '0'+minute;
		}
		var timeString = hour+':'+minute+' '+merideim;
		// Seconds on the clock is indicated via a parameter that is set in the theme options.
		if (showSeconds == 'yes') {
			var second = current_date_time.getSeconds().toString();
			if (second.length < 2) {
				second = '0'+second;
			}
			timeString = hour+':'+minute+':'+second+' '+merideim;
		}
		$('#dig-sign-time').html(timeString);
		$('#dig-sign-date').html(dateString);
	}
