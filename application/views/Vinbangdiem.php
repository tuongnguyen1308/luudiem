<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Bảng điểm cá nhân</title>

	<!-- <link rel="icon" href="{$url}assets/plugins/img/logo.png"> -->
	<link href="assets/plugins/css/mystyle.css" rel="stylesheet">
    <style>
        th {
            vertical-align: middle !important;
        }
        td {
            text-align: center;
        }
        table {
            padding: 0 !important;
        }
    </style>
</head>
<body onload="window.print();">
	<div class="container" style="width:900px;">
		<div class="row">
            <div  class="col-md-12">
                <div class="col-md-5 text-center">
                    <strong>BỘ GIÁO DỤC VÀ ĐÀO TẠO</strong><br>
                    <strong>TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI</strong><br>
                    <strong>----------------------------</strong>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-6 text-center">
                    <strong>CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong><br>
                    <strong>Độc lập - Tự do - Hạnh phúc</strong><br>
                    <strong>----------------------------</strong>
                    
                </div>
            </div>
            <div  class="col-md-12 text-center">
                <h2><strong>PHỤ LỤC VĂN BẰNG (Bản sao)</strong></h2>
                <i>(Theo Quyết định công nhận tốt nghiệp số: 2271/QĐ-ĐHM ngày 30/06/2020)</i>
            </div>
			<div  class="col-md-12">
                <div class="col-md-6 text-left">
                    Họ và tên: <strong>{$sv.sHo} {$sv.sTen}</strong><br>
                    Ngày sinh: <strong>{date("d/m/Y", strtotime($sv.dNgaySinh))}</strong><br>
                    Giới tính: <strong>{$sv.sGioiTinh}</strong><br>
                    Khoa: <strong>{$sv.sTenDonVi}</strong><br>
                </div>
                <div class="col-md-6 text-left">
                    Ngành học: <strong>{$sv.sTenNganh}</strong><br>
                    Bậc học: <strong>{$sv.sTenBac}</strong><br>
                    Hệ: <strong>{$sv.sTenHe}</strong><br>
                    Khoá học: <strong>{$sv.iKhoa}</strong><br>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table col-md-6" border="1">
                    <thead>
                        <tr>
                            <th rowspan="2">STT</th>
                            <th rowspan="2" width="100%">MÔN HỌC</th>
                            <th rowspan="2">SỐ TÍN CHỈ</th>
                            <th rowspan="1" colspan="3">ĐIỂM</th>
                        </tr>
                        <tr>
                            <th width="5%">Thang 10</th>
                            <th width="5%">Thang chữ</th>
                            <th width="5%">Thang 4</th>
                        </tr>
                    </thead>
                    <tbody id="tbody1">
                        {foreach $sv.diem as $k => $v}
                            {if $k <= count($sv.diem)/2+1}
                            <tr>
                                <td>{$k+1}</td>
                                <td class="text-left" style="padding-left:2px;">{$v.sTenMon}</td>
                                <td>{$v.iSoTinChi}</td>
                                <td>{$v.iDT10}</td>
                                <td>{$v.sDTChu}</td>
                                <td>{$v.iDT4}</td>
                            </tr>
                            {/if}
                        {/foreach}
                            <tr>
                                <td colspan="6">Số Tín chỉ tích lũy: {$sv.iSoTCTL} - Điểm TBCTL toàn khóa học: {$sv.sTBCTL}</td>
                            </tr>
                    </tbody>
                <table>
                <table class="table col-md-6" border="1">
                    <thead>
                        <tr>
                            <th rowspan="2">STT</th>
                            <th rowspan="2" width="100%">MÔN HỌC</th>
                            <th rowspan="2">SỐ TÍN CHỈ</th>
                            <th rowspan="1" colspan="3">ĐIỂM</th>
                        </tr>
                        <tr>
                            <th width="5%">Thang 10</th>
                            <th width="5%">Thang chữ</th>
                            <th width="5%">Thang 4</th>
                        </tr>
                    </thead>
                    <tbody id="tbody2">
                        {$i = 0}
                        {foreach $sv.diem as $k => $v}
                            {if $k > count($sv.diem)/2+1}
                            <tr>
                                <td>{$k+1}</td>
                                <td class="text-left" style="padding-left:2px;">{$v.sTenMon}</td>
                                <td>{$v.iSoTinChi}</td>
                                <td>{$v.iDT10}</td>
                                <td>{$v.sDTChu}</td>
                                <td>{$v.iDT4}</td>
                            </tr>
                            {/if}
                            {$i = $k}
                        {/foreach}
                        <tr>
                            <td>{$i++}</td>
                            <td>Giáo dục quốc phòng</td>
                            <td colspan="4">{$sv.sGDQP}</td>
                        </tr>
                        <tr>
                            <td>{$i++}</td>
                            <td>Giáo dục thể chất</td>
                            <td colspan="4">{$sv.sGDTC}</td>
                        </tr>
                        <tr>
                            <td>{$i++}</td>
                            <td>Chuẩn đầu ra NL ngoại ngữ</td>
                            <td colspan="4">{$sv.sCDRNN}</td>
                        </tr>
                        <tr>
                            <td>{$i++}</td>
                            <td>Xếp loại rèn luyện</td>
                            <td colspan="4">{$sv.sXLRenLuyen}</td>
                        </tr>
                        <tr>
                            <td colspan="6">Xếp loại tốt nghiệp: {$sv.sXepLoaiTotNghiep}</td>
                        </tr>
                    </tbody>
                <table>
            </div>
            <div  class="col-md-12">
                <div class="col-md-5 text-center">
                    <br>
                    <br>
                    <br>
                    <strong>Người lập biểu</strong><br>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-6 text-center">
                    <i>Hà Nội, ngày ... tháng ... năm ...</i><br>
                    <strong>TL. HIỆU TRƯỞNG</strong><br>
                    <strong>KT. TRƯỞNG PHÒNG</strong><br>
                    <strong>PTP PHỤ TRÁCH PHÒNG QL ĐÀO TẠO</strong>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>