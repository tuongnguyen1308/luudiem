Object.defineProperty(String.prototype, 'hashCode', {
	value: function() {
	  var hash = 0, i, chr;
	  for (i = 0; i < this.length; i++) {
		chr   = this.charCodeAt(i);
		hash  = ((hash << 5) - hash) + chr;
		hash |= 0; // Convert to 32bit integer
	  }
	  return hash;
	}
  });


var bac     = '';
var he      = '';
var khoa    = '';
var nganh	= '';
var namhoc	= '';
var khoahoc	= '';

var insert_bac		= '';
var insert_he		= '';
var insert_nganh	= '';
var insert_ctdt		= '';
var insert_donvi	= '';
var insert_dv_ctdt	= '';
var insert_khoahoc	= '';
var insert_namtn	= '';

 // ds môn trong file excel
var ds_ma_mon_ctdt		= [];

//ds để insert vào db
var insert_ds_mon		= [];
var insert_ds_mon_ctdt	= [];
var insert_ds_sv		= [];
var insert_ds_lop		= [];
var insert_ds_sv_lop	= [];
var insert_ds_nhaphoc	= [];
var insert_ds_diem		= [];

//đs để update vào db
var update_ds_mon		= [];
var update_ds_mon_ctdt	= [];
var update_ds_sv		= [];
var update_ds_lop		= [];
var update_ds_sv_lop	= [];
var update_ds_nhaphop	= [];
var update_ds_diem		= [];

//ds đã có trong db
var already_ds_ma_mon		= [];
var already_ds_ma_mon_ctdt	= [];
var already_ds_ma_lop		= [];
var already_ds_ma_sv		= [];
var already_ds_ma_nhaphoc	= [];
var already_ds_ma_diem		= [];





$(document).ready(() => {
	// var url = window.location.href;
	
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
		

		$.post(
			"",
			{
				action: 'get_all_ds_ajax',
				contentType: "application/json; charset=utf-8"
			},
			function(res){
				already_ds_ma_mon		= res.ds_ma_mon;
				already_ds_ma_mon_ctdt	= res.ds_ma_mon_ctdt;
				already_ds_ma_sv		= res.ds_ma_sv;
				already_ds_ma_nhaphoc	= res.ds_ma_nhaphoc;
				already_ds_ma_lop		= res.ds_ma_lop;
				already_ds_ma_diem		= res.ds_ma_diem;
			},
			'json'
		);



		bac     = Object.values(excelRows[2])[3];
		he      = Object.values(excelRows[2])[7];
		khoa    = Object.values(excelRows[3])[3];
		nganh	= Object.values(excelRows[3])[7];
		namhoc	= Object.values(excelRows[4])[3];
		khoahoc	= Object.values(excelRows[4])[7];
		let so_cot = he == 'Đào tạo từ xa' ? 5 : 3;

		insert_bac = {
			'PK_iMaBac'	: bac.hashCode(),
			'sTenBac'	: bac
		}
		insert_he = {
			'PK_iMaHe'	: he.hashCode(),
			'sTenHe'	: he
		}
		insert_nganh = {
			'PK_iMaNganh'	: nganh.hashCode(),
			'sTenNganh'		: nganh
		}
		ctdt = bac + he + nganh;
		insert_ctdt = {
			'PK_iMaCTDT'	: ctdt.hashCode(),
			'FK_iMaBac'		: insert_bac.PK_iMaBac,
			'FK_iMaHe'		: insert_he.PK_iMaHe,
			'FK_iMaNganh'	: insert_nganh.PK_iMaNganh,
			'sNam'			: namhoc
		}
		insert_donvi = {
			'PK_iMaDonVi'	: khoa.hashCode(),
			'sTenDonVi'		: khoa
		}
		dv_ctdt = khoa + ctdt;
		insert_dv_ctdt = {
			'PK_iMaDVCTDT'	: dv_ctdt.hashCode(),
			'FK_iMaDonVi'	: insert_donvi.PK_iMaDonVi,
			'FK_iMaCTDT'	: insert_ctdt.PK_iMaCTDT
		}
		let makhoahoc = khoahoc + ctdt;
		insert_khoahoc = {
			'PK_iMaKhoa'	: makhoahoc.hashCode(),
			'iKhoa'			: khoahoc,
			'FK_iMaDVCTDT'	: insert_dv_ctdt.PK_iMaDVCTDT
		}
		insert_namtn = {
			'PK_iNamTN'	: namhoc
		}
		
		
		$('#prv_bac').html('Bậc: <b class="font-weight-bold">'+ bac + '</b>');
		$('#prv_he').html('Hệ: <b class="font-weight-bold">'+ he + '</b>');
		$('#prv_khoa').html('Khoa: <b class="font-weight-bold">'+ khoa + '</b>');
		$('#prv_nganh').html('Ngành: <b class="font-weight-bold">'+ nganh + '</b>');
		$('#prv_namhoc').html('Năm học: <b class="font-weight-bold">'+ namhoc + '</b>');
		$('#prv_khoahoc').html('Khoá học: <b class="font-weight-bold">'+ khoahoc + '</b>');
		
		//Tạo bảng html.
		var thead = $('<thead />');


		//Thêm 3 hàng đầu tiên.
		var row1 = $('<tr />');
		var row2 = $('<tr />');
		var row3 = $('<tr />');
		for (let hang_ten_mon = Object.values(excelRows[5]), hang_ten_mon_ta = Object.values(excelRows[6]),  hang_stc = Object.values(excelRows[7]), i = 0, j = 0; i < hang_ten_mon.length;i = j) {
			
			let o_ten_mon = '';
			if (i < 7 || i >= hang_ten_mon.length - 13) {
				o_ten_mon = $("<th class='text-center' rowspan='4' />");
				j++;
			}
			else {
				o_ten_mon = $("<th class='text-center' colspan='" + so_cot + "' />");
				let o_ten_mon_ta = $("<th class='text-center' colspan='" + so_cot + "' />");
				let o_stc = $("<th class='text-center' colspan='"+ so_cot + "' />");
				o_ten_mon_ta.html(hang_ten_mon_ta[i]);
				o_stc.html(hang_stc[i]);
				row2.append(o_ten_mon_ta);
				row3.append(o_stc);
				
				let mon = {
					'PK_iMaMon' : hang_ten_mon[i].hashCode(),
					'sTenMon'	: hang_ten_mon[i],
					'sTenMonTA'	: hang_ten_mon_ta[i],
					'iSoTinChi'	: hang_stc[i]
				}
				if (already_ds_ma_mon.indexOf(mon.PK_iMaMon) == -1) {
					insert_ds_mon.push(mon);
				}

				let mon_ctdt = {
					'PK_iMaMon_CTDT': mon.PK_iMaMon + "_" + insert_ctdt.PK_iMaCTDT,
					'iSTT'			: insert_ds_mon.length,
					'FK_iMaMon'		: mon.PK_iMaMon,
					'FK_iMaCTDT'	: insert_ctdt.PK_iMaCTDT
				}

				ds_ma_mon_ctdt.push(mon_ctdt.PK_iMaMon_CTDT);

				if (already_ds_ma_mon_ctdt.indexOf(mon_ctdt.PK_iMaMon_CTDT) == -1) {
					insert_ds_mon_ctdt.push(mon_ctdt);
				}
				
				j += so_cot;
			}
			o_ten_mon.html(hang_ten_mon[i]);
			row1.append(o_ten_mon);
		}
		thead.append(row1);
		thead.append(row2);
		thead.append(row3);
		

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
			let lop		= {
				'PK_iMaLop'	: ten_lop.hashCode(),
				'sTenLop'	: ten_lop,
				'FK_iMaKhoa': insert_khoahoc.PK_iMaKhoa
			};
			if (already_ds_ma_lop.indexOf(lop.PK_iMaLop) == -1 && !insert_ds_lop.find(item => item.sTenLop == lop.sTenLop)) {
				insert_ds_lop.push(lop);
			}
			

			let sv = {
				'PK_iMaSV'	: dataRow[2],
				'sHo'		: dataRow[3],
				'sTen'		: dataRow[4],
				'dNgaySinh'	: dataRow[5].split("/").reverse().join("-"),
				'sGioiTinh'	: dataRow[6]
			};

			let nhaphoc = {
				'PK_iMaNhapHoc'	: sv.PK_iMaSV + "_" + insert_ctdt.PK_iMaCTDT,
				'FK_iMaSV'		: sv.PK_iMaSV,
				'FK_iMaKhoa'	: insert_khoahoc.PK_iMaKhoa,
				'sGDTC'			: dataRow[dataRow.length - 13],
				'sGDQP'			: dataRow[dataRow.length - 12],
				'sCDRNN'		: dataRow[dataRow.length - 11],
				'sXLRenLuyen'	: dataRow[dataRow.length - 10],
				'sTBCTL'		: dataRow[dataRow.length - 9],
				'iSoTCTL'		: dataRow[dataRow.length - 8],
				'iSoTCConNo'	: dataRow[dataRow.length - 7],
				'sXepLoaiTotNghiep'			: dataRow[dataRow.length - 6],
				'sSoQuyetDinhDauVao'		: dataRow[dataRow.length - 5],
				'dNgayQuyetDinhDauVao'		: dataRow[dataRow.length - 4].split("/").reverse().join("-"),
				'sSoQuyetDinhTotNghiep'		: dataRow[dataRow.length - 3],
				'dNgayQuyetDinhTotNghiep'	: dataRow[dataRow.length - 2].split("/").reverse().join("-"),
				'iSoHocPhanThiLai'			: dataRow[dataRow.length - 1],
				'FK_iNamTN'					: insert_namtn.PK_iNamTN
			};
			
			if (already_ds_ma_sv.indexOf(sv.PK_iMaSV) == -1 && !insert_ds_sv.find(item => item.PK_iMaSV == sv.PK_iMaSV)) {
				insert_ds_sv.push(sv);
			}
			if (already_ds_ma_nhaphoc.indexOf(nhaphoc.PK_iMaNhapHoc) == -1 && !insert_ds_nhaphoc.find(item => item.PK_iMaNhapHoc == nhaphoc.PK_iMaNhapHoc)) {
				insert_ds_nhaphoc.push(nhaphoc);
				
				var sv_lop = {
					'PK_iMaSVLop'	: lop.PK_iMaLop + '_' + nhaphoc.PK_iMaNhapHoc,
					'FK_iMaLop'		: lop.PK_iMaLop,
					'FK_iMaNhapHoc'	: nhaphoc.PK_iMaNhapHoc
				};
				insert_ds_sv_lop.push(sv_lop);
			}
			
			//Thêm hàng dữ liệu
			row = $('<tr />');
			for (let j = 0,index_mon_ctdt = 0; j < dataRow.length;) {
				if (j < 7 || j >= dataRow.length - 13) {
					let cell = '';
					if (j == 3 || j == 4) { // cột họ và tên
						cell = $("<td class='text-left' />");
					}
					else {
						cell = $("<td class='text-center' />");
					}
					cell.html(dataRow[j]);
					row.append(cell);
					j++;
				}
				else {
					for (let i_in_mon = 0; i_in_mon < so_cot; i_in_mon++) {
						let cell_value = dataRow[j+i_in_mon];
						let cell = '';
						let valid_val = ['A', 'A+', 'B', 'B+', 'C', 'C+', 'D', 'D+', 'F', 'F+'];
						if ((!cell_value.trim() || cell_value == 'F') && (j+i_in_mon-7)%5 < 3) {
							//Điểm trống hoặc = F
							cell = $("<td class='text-center' style='background-color: #f99' title='Điểm trống' />");
						}
						else if ((j+i_in_mon - 7) % 5 == 1 && !valid_val.includes(cell_value)) {
							//điểm chữ không hợp lệ
							cell = $("<td class='text-center' style='background-color: #f33' title='Điểm không hợp lệ' />");
						}
						else if (((j+i_in_mon - 7) % 5 == 0 || (j+i_in_mon - 7) % 5 == 2) && isNaN(cell_value)) {
							//điểm số không hợp lệ
							cell = $("<td class='text-center' style='background-color: #f33' title='Điểm không hợp lệ' />");
						}
						else {
							//điểm hợp lệ
							cell = $("<td class='text-center' />");
						}
						cell.html(cell_value);
						row.append(cell);
					}
					
					var diem = {
						'PK_iMaDiem'	: sv_lop.PK_iMaSVLop + '_' + j,
						'iDT10'			: dataRow[j++],
						'sDTChu'		: dataRow[j++],
						'iDT4'			: dataRow[j++],
						'FK_iMaSVLop'	: sv_lop.PK_iMaSVLop,
						'FK_iMaMonCTDT'	: ds_ma_mon_ctdt[index_mon_ctdt++]
					};
					if (so_cot == 5) {
						diem.sLichSu	= dataRow[j++];
						diem.sNoiMien	= dataRow[j++];
					}
					
					if (already_ds_ma_diem.indexOf(diem.PK_iMaDiem) == -1 && insert_ds_diem.indexOf(diem) == -1) {
						insert_ds_diem.push(diem);
					}
				}
			}

			tbody.append(row);
		}
		// console.log(insert_he);
		// console.log(insert_bac);
		// console.log(insert_ds_sv);
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

		insert_ds_mon		= [];
		insert_ds_mon_ctdt	= [];
		insert_ds_sv		= [];
		insert_ds_lop		= [];
		insert_ds_sv_lop	= [];
		insert_ds_nhaphoc	= [];
		insert_ds_diem		= [];

		update_ds_mon		= [];
		update_ds_mon_ctdt	= [];
		update_ds_sv		= [];
		update_ds_lop		= [];
		update_ds_sv_lop	= [];
		update_ds_nhaphop	= [];
		update_ds_diem		= [];
	});

	$("#btn_submit").click(function(){
		
		$.post(
			"",
			{
				action: 'submit_import_ajax',
				contentType: "application/json; charset=utf-8",
				insert_bac			: insert_bac,
				insert_he			: insert_he,
				insert_nganh		: insert_nganh,
				insert_ctdt			: insert_ctdt,
				insert_donvi		: insert_donvi,
				insert_dv_ctdt		: insert_dv_ctdt,
				insert_khoahoc		: insert_khoahoc,
				insert_namtn		: insert_namtn,
				insert_ds_mon		: insert_ds_mon,
				insert_ds_mon_ctdt	: insert_ds_mon_ctdt,
				insert_ds_lop		: insert_ds_lop,
				insert_ds_sv		: insert_ds_sv,
				insert_ds_nhaphoc	: insert_ds_nhaphoc,
				insert_ds_sv_lop	: insert_ds_sv_lop,
				insert_ds_diem		: insert_ds_diem
			},
			function(res){
				// console.log(res);
			},
			'json'
		);
		window.location.reload();
		// $('#noty_badge').html('Đã thêm file').removeClass('d-none');

		
	});

	$('#submit_import').click(() => {
		$(this).val('Đang tải lên...').attr('disabled', true);
	});
	$('btn[name=btn_delete]').click(() => {
		$(this).val('Đang tải lên...').attr('disabled', true);
	});
})