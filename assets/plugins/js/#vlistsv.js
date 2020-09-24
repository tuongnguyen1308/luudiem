function getRandomColor() {
	var letters = '0123456789ABCDEF';
	var color = '#';
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}
$(document).ready(function () {
	$('.feature').each(function (k, v){
		$(v).css("background-color", getRandomColor());
	});
});

var maBac	= '';
var maHe	= '';
var maNganh	= '';
var namHoc	= '';
var maDonvi	= '';
var maKhoa	= '';

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
	});
	$("#donvi").click(function(){
		postAjaxDonVi();
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


		
		let bac     = Object.values(excelRows[2])[3];
		let he      = Object.values(excelRows[2])[7];
		let khoa    = Object.values(excelRows[3])[3];
		let nganh	= Object.values(excelRows[3])[7];
		let namhoc	= Object.values(excelRows[4])[3];
		let khoahoc	= Object.values(excelRows[4])[7];
		// console.log(ctdt);
		
		$('#prv_bac').html('Bậc: <b class="font-weight-bold">'+ bac + '</b>');
		$('#prv_he').html('Hệ: <b class="font-weight-bold">'+ he + '</b>');
		$('#prv_khoa').html('Khoa: <b class="font-weight-bold">'+ khoa + '</b>');
		$('#prv_nganh').html('Ngành: <b class="font-weight-bold">'+ nganh + '</b>');
		$('#prv_namhoc').html('Năm học: <b class="font-weight-bold">'+ namhoc + '</b>');
		$('#prv_khoahoc').html('Khoá học: <b class="font-weight-bold">'+ khoahoc + '</b>');
		
		
		//Create a HTML Table element.
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
				headerCell = $("<th class='text-center' colspan='5' />");
				j+=5;
			}
			headerCell.html(headerRow[i]);
			row.append(headerCell);
		}
		thead.append(row);
		
		//Thêm hàng môn bằng tiếng anh
		row = $('<tr />');
		for (let list_mon_ta = Object.values(excelRows[6]), i = 7; i < list_mon_ta.length - 13; i+=5) {
			let headerCell = $("<th class='text-center' colspan='5' />");
			headerCell.html(list_mon_ta[i]);
			row.append(headerCell);
		}
		thead.append(row);

		//Thêm số tín chỉ
		row = $('<tr />');
		for (let stc = Object.values(excelRows[7]), i = 7; i < stc.length - 13; i+=5) {
			let headerCell = $("<th class='text-center' colspan='5' />");
			headerCell.html(stc[i]);
			row.append(headerCell);
		}
		thead.append(row);

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
			//Thêm hàng dữ liệu
			row = $('<tr />');
			for (let dataRow = Object.values(excelRows[i]), j = 0; j < dataRow.length; j++) {
				//Thêm cột dữ liệu
				let cell = '';
				if (j == 3 || j == 4) { // cột họ và tên
					cell = $("<td class='text-left' />");
				}
				else if (j > 6 && j < dataRow.length - 13) { //các cột điểm
					let valid_val = ['A', 'A+', 'B', 'B+', 'C', 'C+', 'D', 'D+', 'F', 'F+'];
					if ((!dataRow[j].trim() || dataRow[j].trim() == 'F') && (j-7)%5 < 3) {
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
				}
				else { //các cột còn lại
					cell = $("<td class='text-center' />");
				}
				cell.html(dataRow[j]);
				row.append(cell);
			}
			tbody.append(row);
		}

		$("#excel_preview").html('').append(thead).append(tbody);
		$('#card-body').removeClass('d-none');
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


	// $(".btnView").click(function(){
	// 	$.post(
	// 		"",
	// 		{
	// 			action: 'getSVGrade',
	// 			masv: $(this).data('ma')
	// 		},
	// 		function(res){
	//             console.log(res.length);
	//             let i = 0;
	//             $('#list_grade').html('');
	//             $('#list_grade2').html('');
	// 			res.forEach(mon => {
	//                 let list_grade = '<tr>';
	//                 list_grade += '<td>' + mon['sTenMon'] + '</td>';
	//                 list_grade += '<td>' + mon['iDT10'] + '</td>';
	//                 list_grade += '<td>' + mon['sDTChu'] + '</td>';
	//                 list_grade += '<td>' + mon['iDT4'] + '</td>';
	//                 list_grade += '</tr>';
	//                 if (i++ < res.length / 2) {
	//                     $('#list_grade').append(list_grade);
	//                 }
	//                 else {
	//                     $('#list_grade2').append(list_grade);
	//                 }
	// 			});
	// 	}, 'json');
	// });
})