<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Mẫu số 09</title>
	<link rel="icon" href="{$url}assets/plugins/img/logo.png">
    <link href="assets/plugins/css/mystyle.css" rel="stylesheet">
    <!-- <link href="{$url}assets/plugins/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<style>
		page[size="A4"][layout="landscape"] {
			width: 29.7cm;
			height: 21cm;
		}
  </style>
<body onload="window.print()">
<!-- <body> -->
<!-- <a class="btn btn-primary" name="export09" target="_blank" href="{base_url()}export09?banin={$sThongTinUngVien.PK_iMaUV}"><i class="fa fa-print" aria-hidden="true"></i> In</a>
    <a class="btn btn-primary" name="export09" target="_blank" href="{base_url()}export09?banin={$sThongTinUngVien.PK_iMaUV}&download=1"><i class="fa fa-print" aria-hidden="true"></i> tải xuống</a> -->
	<div class="container-fluid">
			<div class="col-md-12">
				<div class="pull-right">
					<b>Mẫu số 09</b>
				</div>
			</div><br><br>
            <div  class="col-md-12">
                <div class="col-md-6 text-center">
                    <strong>HỘI ĐỒNG GIÁO SƯ NHÀ NƯỚC</strong><br>
                    <strong><span class="text-upper">{$sThongTinUngVien.sTenNganh}</span></strong><br>
                    <p>-------------</p>
                </div>
                <div class="col-md-5 text-center">
                    <strong>BẢN TRÍCH NGANG CÁC TIÊU CHUẨN</strong><br>
                    <strong>CHỨC DANH <span class="text-upper">{$sThongTinUngVien.sChucDanh}</span></strong>
                </div>
            </div>
			<div  class="col-md-12">
                <div class="col-md-5 text-left">
                    Họ và tên ứng viên: {$sThongTinUngVien.sHoTen}<br>
                    Nam,nữ: {$sThongTinUngVien.sGioiTinh} ;&nbsp; Dân tộc: {$sThongTinUngVien.sTenDanToc}<br>
                    Quốc tịch: {$sThongTinUngVien.sQuocTich}<br> 
                    Cơ quan đang công tác: {if !empty($sThongTinUngVien.sCoQuan)}{$sThongTinUngVien.sCoQuan}{/if}<br>
                    Sinh ngày {dateconvert('d', $sThongTinUngVien.dNgaySinh)}  tháng {dateconvert('m', $sThongTinUngVien.dNgaySinh)} năm {dateconvert('Y', $sThongTinUngVien.dNgaySinh)}
                    <br>
                    Quê quán: {$sThongTinUngVien.sQueQuan}<br><br>
                </div>
                <div class="col-md-6 text-right">
                    Ngành: {$sThongTinUngVien.sTenNganh} &nbsp; Chuyên ngành: {$sThongTinUngVien.sChuyenNganh}
                </div>
            </div>
            
            <div class="col-md-12">
                <table class="table" border="1">
                <tr>
                    <th class="text-center" rowspan="3" width="10%">Họ tên ,học vị và chức danh của người thẩm định</th>
                    <th class="text-center" colspan="2" width="5%">Đối tượng</th>
                    <th class="text-center" colspan="4" width="20%">Năm có quyết định hoặc cấp bằng/nước</th>
                    <th class="text-center" rowspan="3" width="5%">Năm công nhận PGS/ ngành</th>
                    <th class="text-center" colspan="4" width="5%">Thời gian thực hiện nhiệm vụ đào tạo</th>
                    <th class="text-center" colspan="3" width="5%">Số lượng TS, ThS/CK2/BSNT đã hướng dẫn </th>
                    <th class="text-center" colspan="5" width="30%">Số lượng chương trình, đề tài nghiên cứu; chương trình đào tạo (CTĐT) </th>
                </tr>
                <tr>
                    <th class="text-center" width="3%" rowspan="2">GV</th>
                    <th class="text-center" width="3%" rowspan="2">TG</th>
                    <th class="text-center" width="3%" rowspan="2">ĐH</th>
                    <th class="text-center" width="3%" rowspan="2">ThS</th>
                    <th class="text-center" width="3%" rowspan="2">TS</th>
                    <th class="text-center" width="4%" rowspan="2">TSKH</th>
                    <th class="text-center" width="5%" rowspan="2">Tổng số</th>
                    <th class="text-center" width="5%" colspan="3">3 năm cuối</th>
                    <th class="text-center" width="5%" colspan="2">Tiến sỹ</th>
                    <th class="text-center" width="5%" rowspan="2">ThS/CK2 /BSNT</th>
                    <th class="text-center" width="5%" rowspan="2">CN, PCN, TK Chương trình</th>
                    <th class="text-center" width="5%" colspan="3">Chủ nhiệm đề tài</th>
                    <th class="text-center" width="5%" rowspan="2">CTĐT hoặc CT KHCN (ƯV GS)</th>
                </tr>
                <tr>
                    <th class="text-center" width="5%">năm 1</th>
                    <th class="text-center" width="5%">năm 2</th>
                    <th class="text-center" width="5%">năm 3</th>
                    <th class="text-center" width="5%">Chính</th>
                    <th class="text-center" width="5%">Phụ</th>
                    <th class="text-center" width="5%">Cấp NN</th>
                    <th class="text-center" width="5%">Cấp Bộ</th>
                    <th class="text-center" width="5%">Cơ sở</th>
                </tr>
                <tr>
                    {for $i=0 to 19}
                        <td class="text-center" ><i>{$i}</i></td>
                    {/for}
                </tr>
                <tr>
                    <td class="text-left" >
                        A. Thẩm định 1:
                        <p>Họ tên: {$sThongTinUyVien.sHoTen}</p>
                        <p>Học vị: {$sThongTinUyVien.sHocVi}</p>
                        <p>Chức danh: {$sThongTinUyVien.sChucDanh}</p>
                    </td>
                    <td class="text-center" >{($sThongTinUngVien.sVietTatDT == 'GV') ? 'Đúng' : ''}</td>
                    <td class="text-center" >{($sThongTinUngVien.sVietTatDT == 'GVTG') ? 'Đúng' : ''}</td>
                    <td class="text-center" >
                    {dateconvert('Y', $sThongTinUngVien.sNgayCapBangDH)}
                    </td>
                    <td class="text-center" >
                    {dateconvert('Y', $sThongTinUngVien.sNgayCapBangThS)}
                    </td>
                    <td class="text-center" >
                    {dateconvert('Y', $sThongTinUngVien.sNgayCapBangTS)}
                    </td>
                    <td class="text-center" >
                    {dateconvert('Y', $sThongTinUngVien.sNgayCapBangTSKH)}
                    </td>
                    <td class="text-center" >{dateconvert('Y', $sThongTinUngVien.sNgayCapBangPGS)}</td>
                    <td class="text-center" >{$sThongTinUngVien.sTongSoNam}</td>
                    <td class="text-center" >
                    {$sMuc3.2.iSoGioChuan}
                    </td>
                    <td class="text-center" >
                    {$sMuc3.1.iSoGioChuan}
                    </td>
                    <td class="text-center" >
                    {$sMuc3.0.iSoGioChuan}
                    </td>
                    <td class="text-center" >{$sThongTinUngVien.sHuongDanNCSChinh}</td>
                    <td class="text-center" >{$sThongTinUngVien.sHuongDanNCSPhu}</td>
                    <td class="text-center" >{$sThongTinUngVien.sHuongDanHVCHChinh}</td>
                    <td class="text-center" >{$sThongTinUngVien.sDeTaiNN}</td>
                    <td class="text-center" >{$sThongTinUngVien.sDeTaiCapBo}</td>
                    <td class="text-center" >{$sThongTinUngVien.sDeTaiCoSo}</td>
                    <td class="text-center" >{$sThongTinUngVien.sCTCapNhaNuoc}</td>
                    <td class="text-center" >{$sThongTinUngVien.sCTCapNhaNuoc}</td>
                </tr>
                <table>
            </div>
            <br>
            <div class="col-md-12">
                <table class="table" border="1">
                <tr>
                    <th class="text-center" rowspan="2" width="10%">Họ tên ,học vị và chức danh của người thẩm định</th>
                    <th class="text-center" colspan="7" width="30%">Sách phục vụ đào tạo</th>
                    <th class="text-center" colspan="6" width="30%">Bài báo, báo cáo KH; sáng chế, giải pháp hữu ích, giải thưởng quốc gia, quốc tế</th>
                    <th class="text-center" colspan="2" width="8%">Tổng số điểm công trình KH quy đổi</th>
                    <th class="text-center" rowspan="2" width="5%">Tổng số BBUT, CKUT SC, GPHI, GTQT là TG chính sau PGS/TS (3)</th>
                    <th class="text-center" rowspan="2" width="5%">Tiêu chuẩn không đủ (thniên, giờ giảng, đề tài, B.báo kh. học, H.dẫn, sách) </th>
                    <th class="text-center" colspan="2" width="5%">Ngoại ngữ</th>
                    <th class="text-center" rowspan="2" width="5%">Tỷ lệ phiếu tín nhiệm (4)</th>
                </tr>
                <tr>
                    <th class="text-center" width="4%">CK <br>(SL/Đ)</th>
                    <th class="text-center" width="4%">Chương sách QTUT (SL/Đ)</th>
                    <th class="text-center" width="4%">GT <br> (SL/Đ)</th>
                    <th class="text-center" width="4%">STK <br> (SL/Đ)</th>
                    <th class="text-center" width="4%">SHD <br> (SL/Đ)</th>
                    <th class="text-center" width="4%">Tổng số điểm sách/ điểm 3 năm cuối</th>
                    <th class="text-center" width="4%">CK do NXBUT, Chương sách do NXBUT trên TG sau PGS/TS</th>
                    <th class="text-center" width="4%">Số BBUV khai/ Số BB được tính điểm</th>
                    <th class="text-center" width="4%">Số BBUT <br> (SL/Đ)</th>
                    <th class="text-center" width="4%">Số BB còn lại <br> (SL/Đ)</th>
                    <th class="text-center" width="4%">Số SC, GPHI, GTQG, QT <br> (SL/Đ)</th>
                    <th class="text-center" width="4%">Tổng số điểm  NCKH/điểm 3 năm cuối</th>
                    <th class="text-center" width="4%">Số BBUT, SC, GPHI, GTQT là TG chính sau PGS/TS</th>
                    <th class="text-center" width="4%">Cả quá trình</th>
                    <th class="text-center" width="4%">3 năm cuối</th>
                    <th class="text-center" width="4%">Ng.ngữ thành thạo (Đ/KĐ)</th>
                    <th class="text-center" width="4%">Giao tiếp tiếng Anh (Đ/KĐ)</th>
                </tr>
                <tr>
                    <td class="text-center" ><i>0</i></td>
                    {for $i=20 to 39}
                        <td class="text-center" ><i>{$i}</i></td>
                    {/for}
                </tr>
                <tr>
                    <td class="text-left" >
                        A. Thẩm định 1:
                        <p>Họ tên: {$sThongTinUyVien.sHoTen}</p>
                        <p>Học vị: {$sThongTinUyVien.sHocVi}</p>
                        <p>Chức danh: {$sThongTinUyVien.sChucDanh}</p>
                    </td>
                    <td class="text-center">{$sSach.SLCK}/{$sSach.DCK}</td>
                    <td class="text-center">{$sSach.SLCS}/{$sSach.DCS}</td>
                    <td class="text-center">{$sSach.SLGT}/{$sSach.DGT}</td>
                    <td class="text-center">{$sSach.SLSTK}/{$sSach.DSTK}</td>
                    <td class="text-center">{$sSach.SLSHD}/{$sSach.DSHD}</td>
                    <td class="text-center">{$sThongTinUngVien.iSoDiem}/{$sThongTinUngVien.iDiemBaNamCuoi}</td>
                    <td class="text-center">{$sThongTinUngVien.iSoLuongBBUyTinSauPGS}</td>
                    <td class="text-center">
                        {$sThongTinUngVien.sSL_BBKTrenTongDuocDiem}
                    </td>
                    <td class="text-center">
                        {$sThongTinUngVien.sSL_BBUT}
                    </td>
                    <td class="text-center">
                        {$sThongTinUngVien.sSL_BBCL}
                    </td>
                    <td class="text-center">
                    {if !empty($sThongTinUngVien)}{$sThongTinUngVien.sSL_SangChe_Muc2}/{$sThongTinUngVien.sD_SangChe_Muc2}{/if}
                    </td>
                    <td class="text-center">
                        {if !empty($sThongTinUngVien)}{$sThongTinUngVien.iSoDiemConLai}/{$sThongTinUngVien.iSoDiemConLai3}{/if}
                    </td>
                    <td class="text-center">
                        {if !empty($sThongTinUngVien)}{$sThongTinUngVien.sSL_SauPGS}/{$sThongTinUngVien.sSL_SauPGS}{/if}
                    </td>
                    <td class="text-center">{if !empty($sThongTinUngVien)}{$sThongTinUngVien.iDiemTongCong}{/if}</td>
                    <td class="text-center">{if !empty($sThongTinUngVien)}{$sThongTinUngVien.iDiemTongCong3}{/if}</td>
                    <td class="text-center">
                    {if !empty($sThongTinUngVien)}{$sThongTinUngVien.iTongCongSauPGS}{/if}
                    </td>
                    <td class="text-center">
                    {if !empty($sThongTinUngVien.sNamThieuTNDT)}thniên, {/if}
                    {if (!empty($sThongTinUngVien) && !empty($sThongTinUngVien.sGioGiangDayTrucTiep) || ((!empty($sThongTinUngVien)) && !empty($sThongTinUngVien.sGioChuanKhongDu)))}giờ giảng {/if}
                    <!-- {if !empty($sThongTinUngVien.sNamThieuTNDT)}thniên{/if}, -->
                    </td>
                    <td class="text-center">{$sThongTinUngVien.sNgoaiNguThanhThao}</td>
                    <td class="text-center">{$sThongTinUngVien.sGiaoTiepTiengAnh}</td>
                    <td class="text-center">{$sThongTinUngVien.sTyLePhieuTinNhiem}</td>
                </tr>
                <table>
            </div>
            <div class="col-md-12">
                <div class="col-md-5">
                </div>
                <div class="col-md-7 text-left">
                <p class="text-center   ">........(2)...,ngày......tháng.....năm......</p>
                <strong>CHỦ TỊCH HỘI ĐỒNG GIÁO SƯ <span class="text-upper">{$sThongTinUngVien.sTenNganh}</span></strong>
                <p class="text-center"><i>(Ký và ghi rõ họ tên)</i></p>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="col-md-12">
            <strong>Ghi chú:</strong><br>
            (1) Tên Hội đồng giáo sư ngành/liên ngành<br>
            (2) Địa danh<br>
            (3) 35 = 26 + 32<br>
            (4) Cột 39 ghi đầy đủ: số phiếu đồng ý/số thành viên Hội đồng có mặt/tổng số thành viên của Hội đồng<br>
            <i>-Các chữ viết tắt:</i> ƯV: ứng viên; SL: số lượng; Đ: điểm;<br>
            CK: sách chuyên khảo; CKUT: CK của NXB uy tín; GT: sách giáo trình; STK: sách tham khảo; SHD: sách hướng dẫn;<br>
            BB: bài báo KH; BBUT: bài báo trong TCKH quốc tế uy tín; SC: sáng chế; GPHI: giải pháp hữu ích; GTQG, QT: giải thưởng quốc gia, quốc tế.
            </div>
        </div>
</body>
</html>