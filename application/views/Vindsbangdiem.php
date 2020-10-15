<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Danh sách bảng điểm</title>

	<!-- <link rel="icon" href="{$url}assets/plugins/img/logo.png"> -->
	<!-- <link href="assets/plugins/css/mystyle.css" rel="stylesheet"> -->
</head>
<body>
<!-- <body {if $print}onload="window.print();"{/if}> -->

    <style>
        @page Section1 {
            size:8.27in 11.69in !important; 
            margin: .6in .3in .6in .3in !important;
            /* mso-header-margin:.5in;
            mso-footer-margin:.5in; */
            mso-paper-source:0;
        }
        div.Section1 {
            page:Section1;
        }
        /* @page Section2 {
            size:841.7pt 595.45pt;
            mso-page-orientation:landscape;
            margin: 0.99in 0.39in 0.59in 0.39in;
            mso-header-margin:.5in;
            mso-footer-margin:.5in;
            mso-paper-source:0;
        }
        div.Section2 {
            page:Section2;
        } */
        *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        }
        .container {
            margin-right: auto;
            margin-left: auto;
        }
        .text-left {
            text-align: left;
            padding-left: 2px !important;
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
            .Section1 {
                width: 8.27in;
                margin-left: auto;
                margin-right: auto;
                /* padding: .6in .4in .6in .4in !important; */
            }
            .table td {
                padding: 2px !important;
            }
            .text8 {
                font-size: 8pt;
            }
            .text8-5 {
                font-size: 8.5pt;
            }
            .text12 {
                font-size: 12pt;
            }
            .text14 {
                font-size: 14pt;
            }
            .table {
                font-size: 10pt;
            }
        {else}
            .table td {
                padding: 1px 0px;
            }
            .text8 {
                font-size: 8pt;
            }
            .text8-5 {
                font-size: 8.5pt;
            }
            .text12 {
                font-size: 12pt;
            }
            .text14 {
                font-size: 14pt;
            }
            .table {
                font-size: 10pt;
            }
        {/if}
    </style>
	<div class="Section1">
        {foreach $dssv as $index => $sv}
        <table width="100%">
            <tbody>
                <tr class="text12">
                    <td width="50%">BỘ GIÁO DỤC VÀ ĐÀO TẠO</td>
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
                    <td colspan="2"><h2><strong class="text14">PHỤ LỤC VĂN BẰNG (Bản sao)</strong></h2></td>
                </tr>
                <tr class="text12">
                    <td colspan="2"><i>(Theo Quyết định công nhận tốt nghiệp số: {$sv.sSoQuyetDinhTotNghiep} ngày {date("d/m/Y", strtotime($sv.dNgayQuyetDinhTotNghiep))})</i></td>
                </tr>
                <tr class="text12">
                    <td class="text-left">Họ và tên: <strong>{$sv.sHo} {$sv.sTen}</strong></td>
                    <td class="text-left">Ngành học: <strong>{$sv.sTenNganh}</strong></td>
                </tr>
                <tr class="text12">
                    <td class="text-left">Ngày sinh: <strong>{date("d/m/Y", strtotime($sv.dNgaySinh))}</strong></td>
                    <td class="text-left">Bậc học: <strong>{$sv.sTenBac}</strong></td>
                </tr>
                <tr class="text12">
                    <td class="text-left">Giới tính: <strong>{$sv.sGioiTinh}</strong></td>
                    <td class="text-left">Hệ: <strong>{$sv.sTenHe}</strong></td>
                </tr>
                <tr class="text12">
                    <td class="text-left">Khoa: <strong>{$sv.sTenDonVi}</strong></td>
                    <td class="text-left">Khoá học: <strong>{$sv.iKhoa}</strong></td>
                </tr>
                <tr>
                    <td>
                        <table class="table" border="1">
                            <thead>
                                <tr class="text8-5">
                                    <th rowspan="2">STT</th>
                                    <th rowspan="2" width="100%">MÔN HỌC</th>
                                    <th rowspan="2">SỐ TÍN CHỈ</th>
                                    <th rowspan="1" colspan="3">ĐIỂM</th>
                                </tr>
                                <tr class="text8">
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
                                        <td class="text-left" style="padding-left:2px !important;">{$v.sTenMon}</td>
                                        <td>{$v.iSoTinChi}</td>
                                        <td><strong>{$v.iDT10}</strong></td>
                                        <td><strong>{$v.sDTChu}</strong></td>
                                        <td><strong>{$v.iDT4}</strong></td>
                                    </tr>
                                    {/if}
                                {/foreach}
                                    <tr>
                                        <td colspan="6"><strong>Số Tín chỉ tích lũy: {$sv.iSoTCTL} - Điểm TBCTL toàn khóa học: {$sv.sTBCTL}</strong></td>
                                    </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table class="table" border="1">
                            <thead>
                                <tr class="text8-5">
                                    <th rowspan="2">STT</th>
                                    <th rowspan="2" width="100%">MÔN HỌC</th>
                                    <th rowspan="2">SỐ TÍN CHỈ</th>
                                    <th rowspan="1" colspan="3">ĐIỂM</th>
                                </tr>
                                <tr class="text8">
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
                                        <td class="text-left" style="padding-left:2px !important;">{$v.sTenMon}</td>
                                        <td>{$v.iSoTinChi}</td>
                                        <td><strong>{$v.iDT10}</strong></td>
                                        <td><strong>{$v.sDTChu}</strong></td>
                                        <td><strong>{$v.iDT4}</strong></td>
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
                                    <td colspan="6"><strong>Xếp loại tốt nghiệp: {$sv.sXepLoaiTotNghiep}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr class="text12">
                    <td></td>
                    <td><i>Hà Nội, ngày ... tháng ... năm ...</i></td>
                </tr>
                <tr class="text12">
                    <td></td>
                    <td><strong>TL. HIỆU TRƯỞNG</strong></td>
                </tr>
                <tr class="text12">
                    <td></td>
                    <td><strong>KT. TRƯỞNG PHÒNG</strong></td>
                </tr>
                <tr class="text12">
                    <td><strong>Người lập biểu</strong></td>
                    <td><strong>PTP PHỤ TRÁCH PHÒNG QL ĐÀO TẠO</strong></td>
                </tr>
            </tbody>
        </table>
        <br style="page-break-after: always;">
        {/foreach}
    </div>
</body>
</html>

    