$(document).ready(function () {
	$(document).on('click', 'button[name=viewListCandidate]', function () {
		let maNganhLN = $('select[name=hoiDongNganhLN]').val();
		if (maNganhLN !== ''){
			let redirectURL = window.location.href + '?maln=' + maNganhLN;
			window.location.href = redirectURL;
		}
	});
});