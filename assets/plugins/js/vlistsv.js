// function getRandomColor() {
// 	var letters = '0123456789ABCDEF';
// 	var color = '#';
// 	for (var i = 0; i < 6; i++) {
// 		color += letters[Math.floor(Math.random() * 16)];
// 	}
// 	return color;
// }
// $(document).ready(function () {
// 	$('.feature').each(function (k, v){
// 		$(v).css("background-color", getRandomColor());
// 	});
// });

var maBac	= '';
var maHe	= '';
var maNganh	= '';
var namHoc	= '';
var maDonvi	= '';
var maKhoa	= '';

var bac     = '';
var he      = '';
var khoa    = '';
var nganh	= '';
var namhoc	= '';
var khoahoc	= '';

var list_mon = [];
var list_mon_ta = [];
var list_stc = [];
var list_sv = [];
var sv = [];
var diem = [];

var ds_lop		= [];
var ds_sv		= [];
var ds_nhaphoc	= [];
var ds_sv_lop	= [];
var ds_diem		= [];

var ds_lop_update		= [];
var ds_sv_update		= [];
var ds_nhaphoc_update	= [];
var ds_sv_lop_update	= [];
var ds_diem_update		= [];

var ds_ten_lop		= [];
var ds_ma_sv		= [];
var ds_ma_nhaphoc	= [];
var ds_ma_sv_lop	= [];
var ds_ma_diem		= [];




$(document).ready(() => {
	var url = window.location.href;
	// $('#tbl').DataTable();

	// nếu đã có filter thì chạy các lệnh post ajax để lấy các hàng trong ô select


	$("#bac").change(function(){
		postAjax();
	});
	$("#he").change(function(){
		postAjax();
	});
	$("#nganh").change(function(){
		postAjax();
	});
	$("#namhoc").click(function(){
		postAjaxNamHoc();
		$('.group_btn').addClass('d-none');
	});
	$("#donvi").click(function(){
		postAjaxDonVi();
		$('.group_btn').addClass('d-none');
	});
	$("#khoahoc").click(function(){
		if ($('#khoahoc').val() != '') {
			$('.group_btn').removeClass('d-none');
		}
		else {
			$('.group_btn').addClass('d-none');
		}
	});

	
	function postAjax() {
		maBac = $('#bac').val();
		maHe = $('#he').val();
		maNganh = $('#nganh').val();
		if(maBac != '' && maHe != '' && maNganh != '') {
			// console.log(maBac + ' ' + maHe + ' ' + maNganh);
			$.post(
				"",
				{
					action:			'getNamHoc',
					FK_iMaBac:		maBac,
					FK_iMaHe:		maHe,
					FK_iMaNganh:	maNganh,
				},
				function(res){
					// console.log(res);
					$('#namhoc').html('<option value="">--Chọn Năm học--</option>');
					res.forEach(namhoc => {
						let option = '<option value=' + namhoc['sNam'] + '>';
						option += namhoc['sNam'];
						option += '</option>';
						$('#namhoc').append(option);
					});
			}, 'json');
		}
		else {
			$('#namhoc').html('<option value="">--Chọn Năm học--</option>');
		}
		$('.group_btn').addClass('d-none');
	}

	function postAjaxNamHoc() {
		maBac = $('#bac').val();
		maHe = $('#he').val();
		maNganh = $('#nganh').val();
		namHoc = $('#namhoc').val();
		if(namHoc != '') {
			$.post(
				"",
				{
					action:			'getDonVi',
					FK_iMaBac:		maBac,
					FK_iMaHe:		maHe,
					FK_iMaNganh:	maNganh,
					sNam:			namHoc
				},
				function(res){
					// console.log(res);
					$('#donvi').html('<option value="">--Chọn Khoa--</option>');
					res.forEach(khoa => {
						let option = '<option value=' + khoa['PK_iMaDVCTDT'] + '>';
						option += khoa['sTenDonVi'];
						option += '</option>';
						$('#donvi').append(option);
					});
			}, 'json');
		}
		else {
			$('#donvi').html('<option value="">--Chọn Khoa--</option>');
		}
	}

	function postAjaxDonVi() {
		maBac = $('#bac').val();
		maHe = $('#he').val();
		maNganh = $('#nganh').val();
		namHoc = $('#namhoc').val();
		maDonVi = $('#donvi').val();
		if(maDonVi != '') {
			$.post(
				"",
				{
					action:			'getKhoaHoc',
					FK_iMaDVCTDT:	maDonVi
				},
				function(res){
					// console.log(res);
					$('#khoahoc').html('<option value="">--Chọn Khoá học--</option>');
					res.forEach(khoahoc => {
						let option = '<option value=' + khoahoc['PK_iMaKhoa'] + '>';
						option += khoahoc['iKhoa'];
						option += '</option>';
						$('#khoahoc').append(option);
					});
			}, 'json');
		}
		else {
			$('#khoahoc').html('<option value="">--Chọn Khoá học--</option>');
		}
	}

	$("body").on("change", "#fileExcel", function () {
		var fileUpload = $("#fileExcel")[0];
		var file_name = 'Chưa chọn file';
		if (fileUpload.files[0]) {
			file_name = fileUpload.files[0].name;
		}
		$('#file-name').text(file_name);
		
	});

	$("body").on("click", "#btn_preview", function () {
		
		var fileUpload = $("#fileExcel")[0];

		
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xls|.xlsx)$/;
		if (regex.test(fileUpload.value.toLowerCase())) {
			if (typeof (FileReader) != "undefined") {
				var reader = new FileReader();

				//For Browsers other than IE.
				if (reader.readAsBinaryString) {
					reader.onload = function (e) {
						ProcessExcel(e.target.result);
					};
					reader.readAsBinaryString(fileUpload.files[0]);
				} else {
					//For IE Browser.
					reader.onload = function (e) {
						var data = "";
						var bytes = new Uint8Array(e.target.result);
						for (var i = 0; i < bytes.byteLength; i++) {
							data += String.fromCharCode(bytes[i]);
						}
						ProcessExcel(data);
					};
					reader.readAsArrayBuffer(fileUpload.files[0]);
				}
			} else {
				alert("Trình duyệt của bạn không hỗ trợ HTML5. Vui lòng tải hoặc cập nhật trình duyệt Chrome/Cốc cốc phiên bản mới nhất");
			}
		} else {
			alert("File chưa được tải lên hoặc không đúng định dạng!");
		}
	});
	function ProcessExcel(data) {
		//Read the Excel File data.
		var workbook = XLSX.read(data, {
			type: 'binary'
		});

		//Fetch the name of First Sheet.
		var firstSheet = workbook.SheetNames[0];

		//Read all rows from First Sheet into an JSON array.
		var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[firstSheet], {defval: ''});
		// console.log(Object.values(excelRows[2]));
		
		bac     = Object.values(excelRows[2])[3];
		he      = Object.values(excelRows[2])[7];
		khoa    = Object.values(excelRows[3])[3];
		nganh	= Object.values(excelRows[3])[7];
		namhoc	= Object.values(excelRows[4])[3];
		khoahoc	= Object.values(excelRows[4])[7];
		let so_cot = he == 'Đào tạo từ xa' ? 5 : 3;
		
		
		$.post(
			"",
			{
				action: 'insert_ctdt_ajax',
				contentType: "application/json; charset=utf-8",
				sTenBac		: bac,
				sTenDonVi	: he,
				sNam		: khoa,
				sTenHe		: nganh,
				sTenNganh	: namhoc,
				iKhoa		: khoahoc
			},
			function(res){
				console.log(res);
				console.log(list_sv);
			},
			'json'
		);
		// console.log(ctdt);
		
		$('#prv_bac').html('Bậc: <b class="font-weight-bold">'+ bac + '</b>');
		$('#prv_he').html('Hệ: <b class="font-weight-bold">'+ he + '</b>');
		$('#prv_khoa').html('Khoa: <b class="font-weight-bold">'+ khoa + '</b>');
		$('#prv_nganh').html('Ngành: <b class="font-weight-bold">'+ nganh + '</b>');
		$('#prv_namhoc').html('Năm học: <b class="font-weight-bold">'+ namhoc + '</b>');
		$('#prv_khoahoc').html('Khoá học: <b class="font-weight-bold">'+ khoahoc + '</b>');
		
		//Tạo bảng html.
		var thead = $('<thead />');


		//Thêm hàng đầu tiên.
		var row = $('<tr />');
		for (let headerRow = Object.values(excelRows[5]), i = 0, j = 0; i < headerRow.length;i = j) {
			//Add the header cells.
			let headerCell = '';
			if (i < 7 || i >= headerRow.length - 13) {
				headerCell = $("<th class='text-center' rowspan='4' />");
				j++;
			}
			else {
				headerCell = $("<th class='text-center' colspan='" + so_cot + "' />");
				j += so_cot;

				
				list_mon.push(headerRow[i]);
			}
			headerCell.html(headerRow[i]);
			row.append(headerCell);
		}
		thead.append(row);
		
		//Thêm hàng môn bằng tiếng anh
		row = $('<tr />');
		for (let subheaderRow = Object.values(excelRows[6]), i = 7; i < subheaderRow.length - 13; i+=5) {
			let headerCell = $("<th class='text-center' colspan='" + so_cot + "' />");
			headerCell.html(subheaderRow[i]);
			row.append(headerCell);

			list_mon_ta.push(subheaderRow[i]);
		}
		thead.append(row);

		//Thêm số tín chỉ
		row = $('<tr />');
		for (let stc = Object.values(excelRows[7]), i = 7; i < stc.length - 13; i+=5) {
			let headerCell = $("<th class='text-center' colspan='"+ so_cot + "' />");
			headerCell.html(stc[i]);
			row.append(headerCell);
			
			list_stc.push(stc[i]);
		}
		thead.append(row);

		// console.log(list_mon);
		// console.log(list_mon_ta);
		// console.log(list_stc);

		//Thêm label điểm
		row = $('<tr />');
		for (let label_diem = Object.values(excelRows[8]), i = 7; i < label_diem.length - 13; i++) {
			let headerCell = $("<th class='text-center' />");
			headerCell.html(label_diem[i]);
			row.append(headerCell);
		}
		thead.append(row);


		let tbody = $('<tbody />');

		//Thêm dữ liệu vào bảng
		for (let i = 9; i < excelRows.length; i++) {
			let dataRow = Object.values(excelRows[i]);
			var ten_lop =  dataRow[1];
			var lop		= {
				'PK_iMaLop'	: '',
				'sTenLop'	: ten_lop,
				'FK_iMaKhoa': ''
			};
			if (ds_ten_lop.indexOf(ten_lop) == -1 && ds_lop.indexOf(lop) == -1) {
				ds_lop.push(lop);
			}

			var sv = {
				'PK_iMaSV'	: dataRow[2],
				'sHo'		: dataRow[3],
				'sTen'		: dataRow[4],
				'dNgaySinh'	: dataRow[5],
				'sGioiTinh'	: dataRow[6]
			};
			if (ds_ma_sv.indexOf(sv.PK_iMaSV) == -1 && ds_sv.indexOf(sv) == -1) {
				ds_sv.push(sv);
			}
			
			var nhaphoc = {
				'PK_iMaNhapHoc'	: sv['PK_iMaSV'],
				'FK_iMaSV'		: sv['PK_iMaSV'],
				'FK_iMaKhoa'	: '',
				'sGDTC'			: dataRow[dataRow.length - 13],
				'sGDQP'			: dataRow[dataRow.length - 12],
				'sCDRNN'		: dataRow[dataRow.length - 11],
				'sXLRenLuyen'	: dataRow[dataRow.length - 10],
				'sTBCTL'		: dataRow[dataRow.length - 9],
				'iSoTCTL'		: dataRow[dataRow.length - 8],
				'iSoTCConNo'	: dataRow[dataRow.length - 7],
				'sXepLoaiTotNghiep'			: dataRow[dataRow.length - 6],
				'sSoQuyetDinhDauVao'		: dataRow[dataRow.length - 5],
				'dNgayQuyetDinhDauVao'		: dataRow[dataRow.length - 4],
				'sSoQuyetDinhTotNghiep'		: dataRow[dataRow.length - 3],
				'dNgayQuyetDinhTotNghiep'	: dataRow[dataRow.length - 2],
				'iSoHocPhanThiLai'			: dataRow[dataRow.length - 1],
				'iNamTotNghiep'				: namhoc
			};
			if (ds_ma_nhaphoc.indexOf(nhaphoc.PK_iManhaphoc) == -1 && ds_nhaphoc.indexOf(nhaphoc) == -1) {
				ds_nhaphoc.push(nhaphoc);
			}

			var sv_lop = {
				'PK_iMaSVLop'	: lop['PK_iMaLop'] + '_' + nhaphoc['PK_iMaNhapHoc'],
				'FK_iMaLop'		: lop['PK_iMaLop'],
				'FK_iMaNhapHoc'	: nhaphoc['PK_iMaNhapHoc']
			};
			if (ds_ma_sv_lop.indexOf(sv_lop.PK_iMaSVLop) == -1 && ds_sv_lop.indexOf(sv_lop) == -1) {
				ds_sv_lop.push(sv_lop);
			}
			
			for (j = 7; j < dataRow.length - 13;) {
				var diem = {
					'PK_iMaDiem'	: nhaphoc['PK_iMaNhapHoc'] + '_' + j, // đây nữa
					'iDT10'			: dataRow[j++],
					'sDTChu'		: dataRow[j++],
					'iDT4'			: dataRow[j++],
					'FK_iMaNhapHoc'	: nhaphoc['PK_iMaNhapHoc'],
					'FK_iMaMonCTDT'	: sttmon[i++], // đang có vấn đề
				};
				if (so_cot == 5) {
					diem.sLichSu	= dataRow[j++];
					diem.sNoiMien	= dataRow[j++];
				}
				if (ds_ma_diem.indexOf(diem.PK_iMaDiem) == -1 && ds_diem.indexOf(diem) == -1) {
					ds_diem.push(diem);
				}
			}

			//Thêm hàng dữ liệu
			row = $('<tr />');
			//Thêm cột dữ liệu
			let cell = '';
			if (j == 3 || j == 4) { // cột họ và tên
				cell = $("<td class='text-left' />");
				sv.push(dataRow[j]);
			}
			for (j = 7; j < dataRow.length - 13; j++) {
				let valid_val = ['A', 'A+', 'B', 'B+', 'C', 'C+', 'D', 'D+', 'F', 'F+'];
				if ((!dataRow[j].trim() || dataRow[j] == 'F') && (j-7)%5 < 3) {
					//Điểm trống hoặc = F
					cell = $("<td class='text-center' style='background-color: #f99' title='Điểm trống' />");
				}
				else if ((j - 7) % 5 == 1 && !valid_val.includes(dataRow[j])) {
					//điểm chữ không hợp lệ
					cell = $("<td class='text-center' style='background-color: #f33' title='Điểm không hợp lệ' />");
				}
				else if (((j - 7) % 5 == 0 || (j - 7) % 5 == 2) && isNaN(dataRow[j])) {
					//điểm số không hợp lệ
					cell = $("<td class='text-center' style='background-color: #f33' title='Điểm không hợp lệ' />");
				}
				else {
					//điểm hợp lệ
					cell = $("<td class='text-center' />");
				}
				diem.push(dataRow[j]);
				
			}
			cell = $("<td class='text-center' />");
			sv.push(dataRow[j]);

			cell.html(dataRow[j]);
			row.append(cell);
			tbody.append(row);

			if(diem != []) {
				sv.push(diem);
			}
			diem = [];

			list_sv.push(sv);
			sv = [];
		}

		
		//Thêm dữ liệu vào bảng
		// for (let i = 9; i < excelRows.length; i++) {
		// 	//Thêm hàng dữ liệu
		// 	row = $('<tr />');
		// 	for (let dataRow = Object.values(excelRows[i]), j = 0; j < dataRow.length; j++) {
		// 		//Thêm cột dữ liệu
		// 		let cell = '';
		// 		if (j == 3 || j == 4) { // cột họ và tên
		// 			cell = $("<td class='text-left' />");
		// 			sv.push(dataRow[j]);
		// 		}
		// 		else if (j > 6 && j < dataRow.length - 13) { //các cột điểm
		// 			let valid_val = ['A', 'A+', 'B', 'B+', 'C', 'C+', 'D', 'D+', 'F', 'F+'];
		// 			if ((!dataRow[j].trim() || dataRow[j] == 'F') && (j-7)%5 < 3) {
		// 				//Điểm trống hoặc = F
		// 				cell = $("<td class='text-center' style='background-color: #f99' title='Điểm trống' />");
		// 			}
		// 			else if ((j - 7) % 5 == 1 && !valid_val.includes(dataRow[j])) {
		// 				//điểm chữ không hợp lệ
		// 				cell = $("<td class='text-center' style='background-color: #f33' title='Điểm không hợp lệ' />");
		// 			}
		// 			else if (((j - 7) % 5 == 0 || (j - 7) % 5 == 2) && isNaN(dataRow[j])) {
		// 				//điểm số không hợp lệ
		// 				cell = $("<td class='text-center' style='background-color: #f33' title='Điểm không hợp lệ' />");
		// 			}
		// 			else {
		// 				//điểm hợp lệ
		// 				cell = $("<td class='text-center' />");
		// 			}
		// 			diem.push(dataRow[j]);
		// 		}
		// 		else { //các cột còn lại
		// 			cell = $("<td class='text-center' />");
		// 			sv.push(dataRow[j]);
		// 		}
		// 		cell.html(dataRow[j]);
		// 		row.append(cell);
		// 	}
		// 	tbody.append(row);

		// 	if(diem != []) {
		// 		sv.push(diem);
		// 	}
		// 	diem = [];

		// 	list_sv.push(sv);
		// 	sv = [];
		// }

		// console.log(list_sv);
		// console.log(list_mon_ta);
		$("#excel_preview").html('').append(thead).append(tbody);
		$('#card-body').removeClass('d-none');
		$('#submit_import').removeClass('d-none');
	};

	$('#undo_preview_excel').click(() => {
		$('#prv_bac').html('');
		$('#prv_he').html('');
		$('#prv_khoa').html('');
		$('#prv_nganh').html('');
		$('#prv_namhoc').html('');
		$('#prv_khoahoc').html('');
		$("#excel_preview").html('');
		$('#card-body').addClass('d-none');
		$("#fileExcel").val('');
	});

	$("#btn_submit").click(function(){
		// console.log(bac);
		// console.log(he);
		// console.log(khoa);
		// console.log(nganh);
		// console.log(namhoc);
		// console.log(khoahoc);
		// console.log(list_mon);
		// console.log(list_mon_ta);
		// console.log(list_stc);
		// console.log(list_sv);
		
		$.post(
			"",
			{
				action: 'submit_import_ajax',
				contentType: "application/json; charset=utf-8",
				bac			: bac,
				he			: he,
				khoa		: khoa,
				nganh		: nganh,
				namhoc		: namhoc,
				khoahoc		: khoahoc,
				list_mon	: list_mon,
				list_mon_ta	: list_mon_ta,
				list_stc	: list_stc
			},
			function(res){
				console.log(res);
				console.log(list_sv);
				// var sum_sv = 0;
				// list_sv.forEach((sv) => {
				// 	$.post(
				// 		"",
				// 		{
				// 			action		: 'import_diem',
				// 			contentType	: "application/json; charset=utf-8",
				// 			stt_mon		: res.sttmon,
				// 			ctdt		: res.ctdt,
				// 			sv			: sv
				// 		},
				// 		function(res1){
				// 			// sum_sv += res1;
				// 	}, 'json');
				// })
			},
			'json'
		);

		$('#noty_badge').html('Đã thêm ' + list_sv.length + ' sinh viên').removeClass('d-none');

		
	});

	$('#submit_import').click(() => {
		$(this).val('Đang tải lên...').attr('disabled', true);
	});
	$('btn[name=btn_delete]').click(() => {
		$(this).val('Đang tải lên...').attr('disabled', true);
	});
})