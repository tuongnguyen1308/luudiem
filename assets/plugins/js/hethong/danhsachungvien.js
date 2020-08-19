var url = window.location.href;
$(document).ready(function () {
	$(document).on('click', 'button[name=viewListCandidate]', function () {
		let maNganhLN = $('select[name=hoiDongNganhLN]').val();
		let search = '';
		if (maNganhLN !== ''){
			search = '?maln=' + maNganhLN;
		}
		let redirectURL = window.location.origin + window.location.pathname + search;
		window.location.href = redirectURL;
	});

	$(document).on('click', 'button[name=btnChangePass]', function () {
		let maUV = $(this).val();
		$('button[name=btnSaveNewPass]').val(maUV);
	});

	$(document).on('click', 'button[name=viewDetail]', function () {
		let maUV = $(this).val();
		$.ajax({
			type: 'post',
			url: url,
			data:{
				'action': 'getDetailCandidate',
				'maUV': maUV
			},
			success: function(response){
				let info = JSON.parse(response);
				document.getElementById("titleDetail").innerHTML = 'Thông tin ứng viên <b>' + info['sHoTen'] + '</b>';

				let html = '';
				html += '<div class="col-md-6">';
				html += '<p>Họ và tên người đăng ký: <b>'+ info['sHoTen'] +'</b></p>';
				html += '<p>Ngày tháng năm sinh: <b>'+ info['sNgaySinh'] +'</b></p>';
				html += '<p>Giới tính: <b>'+ info['sGioiTinh'] +'</b></p>';
				html += '<p>Dân tộc: <b>'+ (info['sTenDanToc']==null ? '' : info['sTenDanToc']) +'</b>; Tôn giáo: <b>'+ (info['sTenTG']==null ? '' : info['sTenTG']) +'</b></p>';
				html += '<p>Quốc tịch: <b>'+ (info['sQuocTich']==null ? '' : info['sQuocTich']) +'</b></p>';
				html += '<p>Quê quán: <b>'+ (info['sQueQuan']==null ? '' : info['sQueQuan']) +'</b></p>';
				html += '<p>Điện thoại nhà riêng: <b>'+ info['sDienThoaiNhaRieng'] +'</b></p>';
				html += '<p>Điện thoại di động: <b>'+ info['sDienThoaiDiDong'] +'</b></p>';
				html += '<p>Địa chỉ email: <b>'+ info['sEmail'] +'</b></p>';
				html += '<p>Hộ khẩu: <b>'+ info['sHoKhau'] +'</b></p>';
				html += '<p>Địa chỉ liên hệ: <b>'+ info['sDiaChiLienHe'] +'</b></p>';
				html += '</div>';

				html += '<div class="col-md-6">';
				html += '<p>Đảng viên Đảng Cộng sản Việt Nam: <b>'+ (info['sDangVien']==null ? 'Không' : 'Có') +'</b></p>';
				html += '<p>Đối tượng đăng ký: <b>'+ (info['sTenDoiTuong']==null ? '' : info['sTenDoiTuong']) +'</b></p>';
				html += '<p>Đăng ký xét đạt tiêu chuẩn chức danh: <b>'+ (info['sChucDanh']==null ? '' : info['sChucDanh']) +'</b></p>';
				html += '<p>Đăng ký xét tại HĐGS cơ sở: <b>'+ (info['sTenHoiDong']==null ? '' : info['sTenHoiDong']) +'</b></p>';
				html += '<p>Đăng ký xét tại HĐGS ngành, liên ngành: <b>'+ (info['sTenNganhLN']==null ? '' : info['sTenNganhLN']) +'</b></p>';
				html += '<p>Ngành: <b>'+ (info['sTenNganh']==null ? '' : info['sTenNganh']) +'</b></p>';
				html += '<p>Chuyên ngành: <b>'+ (info['sChuyenNganh']==null ? '' : info['sChuyenNganh']) +'</b></p>';
				html += '</div>';
				document.getElementById("contentDetail").innerHTML = html;
			}
		});
	});

	$(document).on('click', 'button[name=btnViewMinhChung]', function () {
		let maUV = $(this).val();
		let hoTen = $(this).parent().parent().find('td').eq(1).html();
		$.ajax({
			type: 'post',
			url: url,
			data:{
				'action': 'getListProof',
				'maUV': maUV
			},
			success: function(response){
				let info = JSON.parse(response);
				document.getElementById("titleMinhChung").innerHTML = 'Danh sách minh chứng của ứng viên <b>' + hoTen + '</b>';

				let html = '';
				var stt = 1;
				var stt2;
				for (let i = 0; i < info.length; i++) {
					stt2 = 1;
					let tenMinhChung = info[i]['sTenMinhChung'];
					if (info[i]['sGhiChu'] !== '') {
						tenMinhChung += ' (' + info[i]['sGhiChu'] + ')';
					}
					let listProof = info[i]['listProof'];
					let contentMC = '';
					let soluongmc = 0;
					for (let j = 0; j < listProof.length; j++) {
						let arrFile = listProof[j]['sFile'].split('|');
						let arrName = listProof[j]['sTenTaiLen'].split('|');
						for (let h = 0; h < arrFile.length; h++) {
							soluongmc++;
							contentMC += '<div class="col-md-12">';
							contentMC += '<a class="fileMinhChung" href="assets/minhchung/' + maUV + '/' + info[i]['PK_sMaMinhChung'] + '/' + arrFile[h] + '" target="_blank">' + stt + '.' + (stt2++) + '. ' + arrName[h] + '</a>';
							contentMC += '</div>';
						}
					}

					html += '<div class="col-md-12">';
					html += '<div class="ibox" style="margin-bottom: 15px;">';
					html += '<div class="ibox-title collapse-link cursor-point">'
					html += '<h5>' + stt + '. ' + tenMinhChung + ' - ' + soluongmc + ' minh chứng</h5>';
					html += '<div class="ibox-tools"><i class="fa fa-chevron-down"></i></div>';
					html += '</div>';
					html += '<div class="ibox-content" style="display: none;">';
					html += '<div class="row">';
					html += contentMC;
					
					if (stt2 == 1){
						html += '<div class="col-md-12">Không có minh chứng</div>';
					}
					html += '</div>';
					html += '</div>';
					html += '</div>';
					html += '</div>';
					stt++;
				}
				document.getElementById("contentListMinhChung").innerHTML = html;
			}
		});
	});
});