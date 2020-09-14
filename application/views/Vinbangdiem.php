<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Bảng điểm cá nhân</title>

	<!-- <link rel="icon" href="{$url}assets/plugins/img/logo.png"> -->
	<!-- <link href="assets/plugins/css/mystyle.css" rel="stylesheet"> -->
</head>
<body>
<!-- <body {if $print}onload="window.print();"{/if}> -->

    <style>
        *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        }
        .container {
            margin-right: auto;
            margin-left: auto;
            width: 890px;
        }
        .text-left {
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .text-bold{
            font-weight: bold;
        }
        table{
            line-height: normal;
            border-collapse: collapse;
            padding: 0 !important;
        }
        .text-upper{
            text-transform: uppercase;
        }
        th {
            vertical-align: middle !important;
        }
        td {
            vertical-align: top !important;
            padding: 1px 0px !important;
            text-align: center;
        }
        .table td {
            vertical-align: middle !important;
        }
        {if $print}
            .table td {
                padding: 2px !important;
            }
            * {
                font-size: 16px;
            }
            .text16 {
                font-size: 22px;
            }
        {else}
            .text12 {
                font-size: 9pt;
            }
            .text13 {
                font-size: 10pt;
            }
            .text16 {
                font-size: 14pt;
            }
            .table {
                font-size: 9pt;
            }
        {/if}
    </style>
	<div class="container">
        <table width="100%">
            <tbody>
                <tr class="text12">
                    <td width="50%"><strong>BỘ GIÁO DỤC VÀ ĐÀO TẠO</strong></td>
                    <td width="50%"><strong>CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></td>
                </tr>
                <tr class="text12">
                    <td><strong>TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI</strong></td>
                    <td><strong>Độc lập - Tự do - Hạnh phúc</strong></td>
                </tr>
                <tr class="text12">
                    <td><strong>----------------------------</strong></td>
                    <td><strong>----------------------------</strong></td>
                </tr>
                <tr>
                    <td colspan="2"><h2><strong class="text16">PHỤ LỤC VĂN BẰNG (Bản sao)</strong></h2></td>
                </tr>
                <tr class="text13">
                    <td colspan="2"><i>(Theo Quyết định công nhận tốt nghiệp số: {$sv.sSoQuyetDinh} ngày {date("d/m/Y", strtotime($sv.dNgayQuyetDinh))})</i></td>
                </tr>
                <tr class="text13">
                    <td class="text-left">Họ và tên: <strong>{$sv.sHo} {$sv.sTen}</strong></td>
                    <td class="text-left">Ngành học: <strong>{$sv.sTenNganh}</strong></td>
                </tr>
                <tr class="text13">
                    <td class="text-left">Ngày sinh: <strong>{date("d/m/Y", strtotime($sv.dNgaySinh))}</strong></td>
                    <td class="text-left">Bậc học: <strong>{$sv.sTenBac}</strong></td>
                </tr>
                <tr class="text13">
                    <td class="text-left">Giới tính: <strong>{$sv.sGioiTinh}</strong></td>
                    <td class="text-left">Hệ: <strong>{$sv.sTenHe}</strong></td>
                </tr>
                <tr class="text13">
                    <td class="text-left">Khoa: <strong>{$sv.sTenDonVi}</strong></td>
                    <td class="text-left">Khoá học: <strong>{$sv.iKhoa}</strong></td>
                </tr>
                <tr>
                    <td>
                        <table class="table" border="1">
                            <thead>
                                <tr>
                                    <th rowspan="2">STT</th>
                                    <th rowspan="2" width="100%">MÔN HỌC</th>
                                    <th rowspan="2">Số TC</th>
                                    <th rowspan="1" colspan="3">ĐIỂM</th>
                                </tr>
                                <tr>
                                    <th width="5%">ĐT 10</th>
                                    <th width="5%">ĐT chữ</th>
                                    <th width="5%">ĐT 4</th>
                                </tr>
                            </thead>
                            <tbody id="tbody1">
                                {foreach $sv.diem as $k => $v}
                                    {if $k <= count($sv.diem)/2+1}
                                    <tr>
                                        <td>{$k+1}</td>
                                        <td class="text-left" style="padding-left:2px !important;">{$v.sTenMon}</td>
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
                        </table>
                    </td>
                    <td>
                        <table class="table" border="1">
                            <thead>
                                <tr>
                                    <th rowspan="2">STT</th>
                                    <th rowspan="2" width="100%">MÔN HỌC</th>
                                    <th rowspan="2">Số TC</th>
                                    <th rowspan="1" colspan="3">ĐIỂM</th>
                                </tr>
                                <tr>
                                    <th width="5%">ĐT 10</th>
                                    <th width="5%">ĐT chữ</th>
                                    <th width="5%">ĐT 4</th>
                                </tr>
                            </thead>
                            <tbody id="tbody2">
                                {$i = 0}
                                {foreach $sv.diem as $k => $v}
                                    {if $k > count($sv.diem)/2+1}
                                    <tr>
                                        <td>{$k+1}</td>
                                        <td class="text-left" style="padding-left:2px !important;">{$v.sTenMon}</td>
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
                                    <td class="text-left" style="padding-left:2px !important;">Giáo dục quốc phòng</td>
                                    <td colspan="4">{$sv.sGDQP}</td>
                                </tr>
                                <tr>
                                    <td>{$i++}</td>
                                    <td class="text-left" style="padding-left:2px !important;">Giáo dục thể chất</td>
                                    <td colspan="4">{$sv.sGDTC}</td>
                                </tr>
                                <tr>
                                    <td>{$i++}</td>
                                    <td class="text-left" style="padding-left:2px !important;">Chuẩn đầu ra NL ngoại ngữ</td>
                                    <td colspan="4">{$sv.sCDRNN}</td>
                                </tr>
                                <tr>
                                    <td>{$i++}</td>
                                    <td class="text-left" style="padding-left:2px !important;">Xếp loại rèn luyện</td>
                                    <td colspan="4">{$sv.sXLRenLuyen}</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Xếp loại tốt nghiệp: {$sv.sXepLoaiTotNghiep}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="text13">
                    <td></td>
                    <td><i>Hà Nội, ngày ... tháng ... năm ...</i></td>
                </tr>
                <tr class="text13">
                    <td></td>
                    <td><strong>TL. HIỆU TRƯỞNG</strong></td>
                </tr>
                <tr class="text13">
                    <td></td>
                    <td><strong>KT. TRƯỞNG PHÒNG</strong></td>
                </tr>
                <tr class="text13">
                    <td><strong>Người lập biểu</strong></td>
                    <td><strong>PTP PHỤ TRÁCH PHÒNG QL ĐÀO TẠO</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

    