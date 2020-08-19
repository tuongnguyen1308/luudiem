<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Mẫu số 06</title>
	<link rel="icon" href="{$url}assets/plugins/img/logo.png">
    <link href="assets/plugins/css/mystyle.css" rel="stylesheet">
    <link href="{$url}assets/plugins/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .align-middle {
            vertical-align: middle !important;
        }
        .box-check {
            padding: 0 !important;
        }
        div {
            outline: none;
        }
        page[size="A4"][layout="portrait"] {
            width: 21cm;
            height: 29.7cm;
        }
        body {
            font-family: "Times New Roman", Times, serif;
        }

    </style>
</head>
<body {if ($mode==print)}onload="window.print();"{/if}>
	<div class="container">
		<div class="col-md-12">
			<div class="col-md-12">
				<div class="pull-right">
					<b>Mẫu số 06</b>
				</div>
			</div><br><br>
            <div  class="col-md-12">
                <div class="col-md-6 text-left">
                    <!-- <strong>TÊN CQ, TC CHỦ QUẢN</strong><br> -->
                    <div class="text-center text-bold">HỘI ĐỒNG GIÁO SƯ NHÀ NƯỚC</div>
                    <div class="text-center text-upper text-bold">{$sThongTinUngVien.sTenNganh}</div>
                    <p class="text-center">-------------</p>
                </div>
                <div class="col-md-6 text-left">
                    <strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong><br>
                    <strong style="margin-left: 50px">Độc lập - Tự do - Hạnh phúc</strong><br>
                    <strong style="margin-left: 80px">------------------------</strong>
                </div>
            </div>
            <div class="col-md-12">
                <center>
                <div class="col-md-12 m-t">
                    <strong>PHIẾU THẨM ĐỊNH HỒ SƠ</strong>
                </div>
                <div class="col-md-12 m-t">
                    <strong>ĐĂNG KÝ XÉT CÔNG NHẬN ĐẠT TIÊU CHUẨN CHỨC DANH</strong>
                </div>
                <div class="col-md-12 m-t">
                    <strong>GIÁO SƯ/PHÓ GIÁO SƯ</strong>
                </div>
                </center>
                <div class="col-md-12 m-t">
                Họ và tên người thẩm định: {$sThongTinUyVien.sHoTen}
                </div>
                <div class="col-md-12 m-t">
                Trình độ đào tạo và chức danh khoa học {$sThongTinUyVien.sChucDanh}, ngành:{$sThongTinUyVien.sTenNganh}, chuyên ngành:{$sThongTinUyVien.sChuyenNganh}
                </div>
                <div class="col-md-12 m-t">
                (Nếu nội dung đúng ở ô nào thì đánh dấu vào ô đó: <div class="box-check">&#10003;</div>; Nếu nội dung không đúng thì để trống: <div class="box-check"></div>)
                </div>
                <div class="col-md-12 m-t">
                Các số trong ngoặc [ ] cho biết mục này tương ứng với cột cùng số thứ tự trong bản trích ngang (Mẫu số 09)
                </div>
                <div class="col-md-12 m-t">
                <strong> A. THÔNG TIN CÁ NHÂN CỦA ỨNG VIÊN</strong>
                </div>
                <div class="col-md-12 m-t">
                - Đăng ký xét đạt tiêu chuẩn chức danh: Giáo sư <div class="box-check">{if $sThongTinUngVien.sChucDanh == 'Giáo sư'}&#10003;{/if}</div>; Phó giáo sư <div class="box-check">{if $sThongTinUngVien.sChucDanh == 'Phó giáo sư'}&#10003;{/if}</div>
                </div>
                <div class="col-md-12 m-t">
                - Ngành {$sThongTinUngVien.sTenNganh}; Chuyên ngành: {$sThongTinUngVien.sChuyenNganh}
                </div> 
                <div class="col-md-12 m-t">
                <strong>Họ và tên người đăng ký:</strong> <span class="text-uppercase">{$sThongTinUngVien.sHoTen}</span>
                </div>
                <div class="col-md-12 m-t">
                <!-- {$sThongTinUngVien.dNgaySinh} -->
                <!-- {if strlen($sThongTinUngVien.dNgaySinh) == 10} -->
                - Sinh ngày {substr($sThongTinUngVien.dNgaySinh,8,2)} tháng {substr($sThongTinUngVien.dNgaySinh,5,2)} năm {substr($sThongTinUngVien.dNgaySinh,0,4)};
                <!-- {else} -->
                <!-- - Sinh ngày {substr($sThongTinUngVien.dNgaySinh,0,2)} tháng {substr($sThongTinUngVien.dNgaySinh,3,1)} năm {substr($sThongTinUngVien.dNgaySinh,5,4)}; -->
                <!-- {/if} -->
                 Nam <div class="box-check">{if $sThongTinUngVien.sGioiTinh == 'Nam'}&#10003;{/if}</div>; Nữ <div class="box-check">{if $sThongTinUngVien.sGioiTinh == 'Nữ'}&#10003;{/if}</div> ; Dân tộc: {$sThongTinUngVien.sTenDanToc}
                </div>
                <div class="col-md-12 m-t">
                - Quê Quán (xã/phường, huyện/quận, tỉnh/thành phố): {$sThongTinUngVien.sQueQuan}
                </div>
                <div class="col-md-12 m-t">
                - Cơ quan đang công tác: {$sThongTinUngVien.sCoQuan}
                </div>
                <div class="col-md-12 m-t">
                - Đăng ký xét chức danh GS/PGS tại HĐGS Cơ sở: {$sThongTinUngVien.sCoSoXetChucDanh}
                </div>
 
                <div class="col-md-12 m-t">
                <strong>B. KẾT QUẢ THẨM ĐỊNH</strong>
                </div>
                <div class="col-md-12 m-t">
                    <strong>1. Đối tượng:</strong> Giảng viên [1] <div class="box-check">{if $sThongTinUngVien.sVietTatDT == 'GV'}&#10003;{/if}</div>; Giảng viên thỉnh giảng [2] <div class="box-check">{if $sThongTinUngVien.sVietTatDT == 'GVTG'}&#10003;{/if}</div> 
                </div>
                <div class="col-md-12 m-t">
                    Nơi thỉnh giảng: {$sThongTinUngVien.sNoiTG}
                </div> 
                <div class="col-md-12 m-t">
                <strong>2. Trình độ đào tạo, chức danh khoa học:</strong>
                </div>
                <div class="col-md-12 m-t">
                - Bằng ĐH [3] cấp ngày {dateconvert('d', $sThongTinUngVien.sNgayCapBangDH)} tháng {dateconvert('m', $sThongTinUngVien.sNgayCapBangDH)} năm {dateconvert('Y', $sThongTinUngVien.sNgayCapBangDH)}, ngành: {$sThongTinUngVien.sNganhDH}, chuyên ngành: {$sThongTinUngVien.sChuyenNganhDH}
                </div>
                <div class="col-md-12 m-t">
                - Bằng ThS [4] cấp ngày {dateconvert('d', $sThongTinUngVien.sNgayCapBangThS)} tháng {dateconvert('m', $sThongTinUngVien.sNgayCapBangThS)} năm {dateconvert('Y', $sThongTinUngVien.sNgayCapBangThS)}, ngành: {$sThongTinUngVien.sNganhThS}, chuyên ngành: {$sThongTinUngVien.sChuyenNganhThS}
                </div>
                <div class="col-md-12 m-t">
                - Bằng TS [5] cấp ngày {dateconvert('d', $sThongTinUngVien.sNgayCapBangTS)} tháng {dateconvert('m', $sThongTinUngVien.sNgayCapBangTS)} năm {dateconvert('Y', $sThongTinUngVien.sNgayCapBangTS)}, ngành: {$sThongTinUngVien.sNganhThS}, chuyên ngành: {$sThongTinUngVien.sChuyenNganhThS}
                </div> 
                <div class="col-md-12 m-t">
                - Bằng TSKH [6] cấp ngày {dateconvert('d', $sThongTinUngVien.sNgayCapBangTSKH)} tháng {dateconvert('m', $sThongTinUngVien.sNgayCapBangTS)} năm {dateconvert('Y', $sThongTinUngVien.sNgayCapBangTS)}, ngành: {$sThongTinUngVien.sNganhTSKH}, chuyên ngành: {$sThongTinUngVien.sChuyenNganhTSKH}
                <!-- - Bằng TSKH [6] cấp ngày ... tháng … năm..., ngành:….., chuyên ngành: ………………….. -->
                </div>
                <div class="col-md-12 m-t">
                - Được bổ nhiệm/công nhận chức danh PGS [7] ngày {dateconvert('d', $sThongTinUngVien.sNgayCapBangPGS)} tháng {dateconvert('m', $sThongTinUngVien.sNgayCapBangPGS)} năm {dateconvert('Y', $sThongTinUngVien.sNgayCapBangPGS)},
                thuộc ngành: {$sThongTinUngVien.sNganhPGS}      
                </div>
                <div class="col-md-12 m-t">
                <strong>3. Thời gian thực hiện nhiệm vụ đào tạo từ trình độ đại học trở lên</strong>
                </div>
                <div class="col-md-12 m-t">
                    -Tổng số thời gian [8]:  {$sThongTinUngVien.sTongSoNam}
                </div>
                <div class="col-md-12 m-t">
                    -Trong 06 năm ứng viên đã kê khai, trong đó có 03 năm cuối [9, 10, 11]
                </div>
                <div class="col-md-12 m-t">
                <table class="table" border="1">
					<tr>
						<th class="text-center" width="7%">TT</th>
						<th class="text-center" width="20%">Năm học</th>
						<th class="text-center" width="15%">Số giờ trực tiếp trên lớp</th>
						<th class="text-center">Số giờ chuẩn giảng dạy</th>
						<th class="text-center">Đánh giá</th>
					</tr>
                        {if $sMuc3 != null}
                            {foreach $sMuc3 as $k => $v}
                                <tr>
                                    <td>
                                        <div class="col-md-12 m-t text-center">
                                            <p>{$k+1}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 m-t text-center">
                                            <p>{$v.sNamHoc}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 m-t text-center">
                                            <p>{$v.iSoGioTrucTiep}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12 m-t text-center">
                                            <p>{$v.iSoGioChuan}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="col-md-12 m-t">
                                        Đủ <div class="box-check">{($v.sDanhGia == "du" || $v.sDanhGia == "dung") ? '&#10003;' : ''}
                                        </div>; 
                                        Không đủ <div class="box-check">{($v.sDanhGia == "connghivan" || $v.sDanhGia == "khongdu") ? '&#10003;' : ''}
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                        {else}
                            <tr>
                                <td colspan="5" align="center">Không có dữ liệu</td>
                            </tr>
                        {/if}
                </table>
                </div>
                <div class="col-md-12">
                <strong>4. Hướng dẫn NCS, HVCH/CK2/BSNT</strong>
                </div>
                <div class="col-md-12 m-t">
                    <table class="table" border="1">
                        <tr>
                            <th class="text-center">Đối tượng</th>
                            <th class="text-center">Trách nhiệm</th>
                            <th class="text-center" width="20%">Số lượng</th>
                            <th class="text-center" width="20%">Ghi chú</th>
                        </tr>
                                <tr>
                                    <td rowspan="2">NCS đã có Quyết định cấp bằng TS</td>
                                    <td>Chính[12]<br></td>
                                    <td class="text-center">{$sThongTinUngVien.sHuongDanNCSChinh}</td>
                                    <td class="text-center">{$sThongTinUngVien.sGhiChuNCSChinh}</td>
                                </tr>
                                <tr>
                                    <td>Phụ[13]<br></td>
                                    <td class="text-center">{$sThongTinUngVien.sHuongDanNCSPhu}</td>
                                    <td class="text-center">{$sThongTinUngVien.sGhiChuNCSPhu}</td>
                                </tr>
                                <tr>
                                    <td >HVCH/CK2/BSNT đã có Quyết định cấp bằng ThS/CK2/BSNT</td>
                                    <td>Chính[14]<br>
                                    </td>
                                    <td class="text-center">{$sThongTinUngVien.sHuongDanHVCHChinh}</td>
                                    <td class="text-center">{$sThongTinUngVien.sGhiChuHVCH}</td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <strong>5. Thực hiện các nhiệm vụ khoa học và công nghệ đã được nghiệm thu</strong>
                </div>
                <div class="col-md-12 m-t">
                    <table class="table" border="1">
						<thead> 
							<th class="" colspan="2">1.Chương trình, dự án, đề tài nghiên cứu</th>
							<th class="text-center">Trách nhiệm</th>
							<th class="text-center">Số lượng</th>
						</thead>
						<tbody>
							<tr>
								<td>Chương trình (CT)</td>
								<td>Cấp Nhà nước</td>
								<td>Chủ nhiệm, Phó CN, Thư ký [15]<br>
								</td>
								<td class="text-center">{$sThongTinThamDinh.sCTCapNhaNuoc}</td>
							</tr>
							<tr>
								<td rowspan="3">Đề tài (ĐT)</td>
								<td>Cấp Nhà nước</td>
								<td>Chủ nhiệm[16]</td>
								<td class="text-center">{$sThongTinThamDinh.sDeTaiNN}</td>
							</tr>
							<tr>
								<td>Cấp bộ, nhánh cấp NN, ĐTKH cơ bản</td>
								<td>Chủ nhiệm[17]</td>
								<td class="text-center">{$sThongTinThamDinh.sDeTaiCapBo}</td>
							</tr>
							<tr>
								<td>Cấp cơ sở</td>
								<td>Chủ nhiệm[18]</td>
								<td class="text-center">{$sThongTinThamDinh.sDeTaiCoSo}</td>
							</tr>
							<tr>
								<td colspan="2" class="text-bold">2. Chương trình đào tạo hoặc chương trình nghiên cứu, ứng dụng khoa học công nghệ của cơ sở giáo dục đại học</td>
								<td>Chủ trì hoặc tham gia xây dựng, phát triển [19]</td>
								<td class="text-center">{$sThongTinThamDinh.sCTDT}</td>
							</tr>
						</tbody>
					</table>
                </div>
                <div class="col-md-12">
                    <strong>6. Biên soạn sách phục vụ đào tạo</strong>
                </div>
                <div class="col-md-12 m-t">a) Kết quả chung</div>
                <div class="col-md-12 m-t">
                <table class="table align-middle" border="1">
						<thead>
                            <tr>
                                <th class="align-middle text-center" colspan="2" rowspan="2">Loại sách</th>
                                <th class="text-center" colspan="3">Cả quá trình</th>
                                <th class="text-center align-middle" rowspan="2">Điểm các sách trong 3 năm cuối</th>
                            </tr>
                            <tr>
                                <th class="text-center" width="30%">Tên sách</th>
                                <th class="text-center" width="9%">Số tác giả</th>
                                <th class="text-center" width="5%">Số điểm</th>
                            </tr>
							
						</thead>
						<tbody>
							<tr>
								<td rowspan="{$muc6.count.ck}">Sách chuyên khảo [20]</td>
								<td rowspan="{$muc6.count.ck_mm}" width="15%">Viết một mình</td>
                                {if count($muc6.0.ck_mm) > 0}
                                    {foreach $muc6.0.ck_mm as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
							</tr>
							<tr>
								<td rowspan="{$muc6.count.ck_cb}">Chủ biên</td>
                                {if count($muc6.0.ck_cb) > 0}
                                    {foreach $muc6.0.ck_cb as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
							</tr>
							<tr>
								<td rowspan="{$muc6.count.ck_vc}">Viết chung</td>
                                {if count($muc6.0.ck_vc) > 0}
                                    {foreach $muc6.0.ck_vc as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
							</tr>
							<tr>
								<td rowspan="{$muc6.count.cs}">Chương sách do NXB uy tín thế giới xuất bản [21]</td>
								<td rowspan="{$muc6.count.cs_mm}">Viết một mình</td>
                                {if count($muc6.0.cs_mm) > 0}
                                    {foreach $muc6.0.cs_mm as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
							</tr>
							<tr>
                                <td rowspan="{$muc6.count.cs_vc}">Viết chung</td>
                                {if count($muc6.0.cs_vc) > 0}
                                    {foreach $muc6.0.cs_vc as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
							</tr>
                            <tr>
                                <td rowspan="{$muc6.count.gt}">Giáo trình [22]</td>
								<td rowspan="{$muc6.count.gt_vcbvbs}">Vừa chủ biên vừa tham gia</td>
								{if count($muc6.0.gt_vcbvbs) > 0}
                                    {foreach $muc6.0.gt_vcbvbs as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                        </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
							</tr>
							<tr>
                                <td rowspan="{$muc6.count.gt_cb}">Chủ biên</td>
                                {if count($muc6.0.gt_cb) > 0}
                                    {foreach $muc6.0.gt_cb as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
							</tr>
							<tr>
                                <td rowspan="{$muc6.count.gt_vc}">Viết chung</td>
                                {if count($muc6.0.gt_vc) > 0}
                                    {foreach $muc6.0.gt_vc as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
							</tr>
                            <tr>
                                <td class="text-center" rowspan="{$muc6.count.tk}" colspan="2">Sách tham khảo [23]</td>
                                {if count($muc6.0.tk) > 0}
                                    {foreach $muc6.0.tk as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>
                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else} 
                                    <td></td>
                                    <td></td> 
                                    <td></td>
                                    <td></td>
                                {/if} 
                            </tr>
                            <tr>
                                <td class="text-center" rowspan="{$muc6.count.hd}" colspan="2">Sách hướng dẫn [24]</td>
                                {if count($muc6.0.hd) > 0}
                                    {foreach $muc6.0.hd as $k => $v}
                                        {if $k > 0}
                                            <tr>
                                        {/if}
                                        <td>{$v.sTenSach}</td>
                                        <td class="text-center">{$v.iSoTacGia}</td>

                                        <td class="text-center">{$v.iSoDiem}</td>
                                        <td class="text-center">{$v.iDiemBaNamCuoi}</td>
                                        {if $k > 0}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {else}
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                {/if}
                            </tr>
                            <tr>
                                <td class="text-center" colspan="4">Tổng số điểm do viết sách [25]</td>
                                <td class="text-center">{$muc6.0.tong}</td>
								<td class="text-center">{$muc6.0.tong3}</td>
                            </tr>
						</tbody>
					</table>
                </div>
                <div class="col-md-12">
                    b) Số lượng (ghi rõ số TT) sách chuyên khảo được xuất bản ở NXB có uy tín, chương sách được xuất bản ở NXB có uy tín trên thế giới sau PGS/TS [26]: {$sThongTinUngVien.iSoLuongBBUyTinSauPGS}
                </div>
                <div class="col-md-12">
                    <strong>7. Kết quả nghiên cứu khoa học và công nghệ; sáng chế, giải pháp hữu ích; giải thưởng quốc gia, quốc tế</strong>
                </div>
                <div class="col-md-12">
                    a) Kết quả chung
                </div>
                <div class="col-md-12 m-t">
                <table class="table" border="1">
						<thead> 
                        <tr>
							<th class="text-center" width="50%" rowspan="2">Các bài báo KH, sáng chế, giải thưởng(*)</th>
							<th class="text-center" width="25%" colspan="2">Cả quá trình</th>
							<th class="text-center" width="25%" colspan="2">3 năm cuối</th>
                        </tr>
                        <tr>
                            <th class="text-center" width="11%">Số lượng</th>
                            <th class="text-center" width="11%">điểm</th>
                            <th class="text-center" width="11%">Số lượng</th>
                            <th class="text-center" width="11%">điểm</th>
                        </tr>
						</thead>
						<tbody>
							<tr>
                                <td>
                                    1. Bài báo, báo cáo khoa học
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    - Tổng số bài báo, báo cáo KH ứng viên khai/Tổng số bài được tính điểm [27]:
                                </td>
                                <td class="text-center">
                                    {$sMuc7.sSL_BBKTrenTongDuocDiem}            
                                </td>
                                <td class="text-center">
                                {$sMuc7.sD_BBKTrenTongDuocDiem}
                                </td>
                                <td class="text-center">
                                {$sMuc7.sSL3_BBKTrenTongDuocDiem}
                                </td>
                                <td class="text-center">
                                {$sMuc7.sD3_BBKTrenTongDuocDiem}
                                </td>  
                            </tr>
                            <tr>
                                <td>
                                    - Số bài báo KH và điểm:
                                </td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                                <td class="text-center"></td>
                            </tr>
                            <tr>
                                <td>
                                    +) Bài báo đăng trong tạp chí có uy tín [28]:
                                </td>
                                <td class="text-center">{$sMuc7.sSL_BBUT}</td>
                                <td class="text-center">{$sMuc7.sD_BBUT}</td>
                                <td class="text-center">{$sMuc7.sSL3_BBUT}</td>
                                <td class="text-center">{$sMuc7.sD3_BBUT}</td>
                               
                            </tr>
                            <tr>
                                <td>
                                    +) Bài báo KH còn lại [29]:
                                </td>
                                <td class="text-center">{$sMuc7.sSL_BBCL}</td>
                                <td class="text-center">{$sMuc7.sD_BBCL}</td>
                                <td class="text-center">{$sMuc7.sSL3_BBCL}</td>
                                <td class="text-center">{$sMuc7.sD3_BBCL}</td>
                            </tr>

                            <tr>
                                <td>
                                    2. Sáng chế, giải pháp hữu ích, giải thưởng quốc gia, quốc tế [30]:
                                </td>
                                <td class="text-center">{$sMuc7.sSL_SangChe_Muc2}</td>
                                <td class="text-center">{$sMuc7.sD_SangChe_Muc2}</td>
                                <td class="text-center">{$sMuc7.sSL3_SangChe_Muc2}</td>
                                <td class="text-center">{$sMuc7.sD3_SangChe_Muc2}</td>
                            </tr>
                            <tr>
                                <td>
                                    3. Tổng số điểm từ các bài báo và sáng chế, giải pháp hữu ích, giải thưởng quốc gia, quốc tế [31]
                                </td>
                                <td class="text-center">{$sMuc7.sSL_Muc3}</td>                                
                                <td class="text-center">{$sMuc7.sD_Muc3}</td>                                
                                <td class="text-center">{$sMuc7.sSL3_Muc3}</td>                                
                                <td class="text-center">{$sMuc7.sD3_Muc3}</td>                                
                            </tr>
						</tbody>
					</table>
                </div>
                <div class="col-md-12">
                    b) Số lượng bài báo đăng trên tạp chí khoa học quốc tế uy tín, sáng chế, giải pháp hữu ích, giải thưởng quốc tế... mà ứng viên là tác giả chính sau khi được công nhận PGS hoặc cấp bằng TS [32]: {$sMuc7.sSL_SauPGS}
                </div>
                <div class="col-md-12">
                    <i>(*) Không tính điểm các CTKH thay thế cho các tiêu chuẩn còn thiếu.</i>
                </div>
                <div class="col-md-12">
                <strong>TỔNG HỢP KẾT QUẢ HOẠT ĐỘNG KHOA HỌC VÀ ĐÀO TẠO</strong> 
                </div>
                <div class="col-md-12">
                <p>1. Tổng hợp chung</p>
                </div>
                <div class="col-md-12">
                    <table class="table" border="1">
                        <tr>
                            <th class="text-center">Hoạt động khoa học và đào tạo</th>
                            <th class="text-center">Cả quá trình [33]</th>
                            <th class="text-center">3 năm cuối [34]</th>
                        </tr>
                                <tr>
                                    <td>- Số điểm sách [25]</td>
                                    <td class="text-center">{if !empty($sTongHop)}{$sTongHop.iSoDiemSach}{/if}</td>
                                    <td class="text-center">{if !empty($sTongHop)}{$sTongHop.iSoDiemSach3}{/if}</td>
                                </tr>
                                <tr>
                                    <td>- Số điểm bài kháo KH, sáng chế, giải pháp hữu ích, giải thưởng quốc gia, quốc tế[31]</td>
                                    <td class="text-center">{if !empty($sTongHop)}{$sTongHop.iSoDiemConLai}{/if}</td>
                                    <td class="text-center">{if !empty($sTongHop)}{$sTongHop.iSoDiemConLai3}{/if}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Điểm tổng cộng:</td>
                                    <td class="text-center">{if !empty($sTongHop)}{$sTongHop.iDiemTongCong}{/if}</td>
                                    <td class="text-center">{if !empty($sTongHop)}{$sTongHop.iDiemTongCong3}{/if}</td>
                                </tr>
                            </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <p>2. Tổng cộng sách CK xuất bản ở NXB có uy tín, chương sách được xuất bản ở NXB có uy tín trên thế giới, bài báo đăng trên tạp chí khoa học quốc tế uy tín, sáng chế, giải pháp hữu ích, giải thưởng quốc tế... mà ứng viên là tác giả chính sau khi được công nhận PGS hoặc cấp bằng TS [35]: {if !empty($sTongHop)}{$sTongHop.iTongCongSauPGS}{else}...{/if}</p>
                </div>
                <div class="col-md-12">
                    <p>3. Các tiêu chuẩn không đủ so với quy định và CTKH thay thế [36]:</p>
                </div>
                <div class="col-md-12">
                    <p>a) Thời gian được bổ nhiệm PGS</p>
                    <p>Được bổ nhiệm PGS chưa đủ 3 năm: thiếu (số lượng năm, tháng): 
                        {if !empty($sTongHop)}{$sTongHop.sNamThieuPGS}{else}...{/if}</p>

                    <p>b) Hoạt động đào tạo</p>
                    <p>- Thâm niên đào tạo chưa đủ 6 năm: thiếu (số lượng năm, tháng): 
                        {if !empty($sTongHop)}{$sTongHop.sNamThieuTNDT}{else}...{/if}</p>
                    <p>- Giờ giảng dạy</p>
                    <p> + Giờ giảng dạy trực tiếp trên lớp không đủ: thiếu (năm học/số giờ thiếu): 
                        {if !empty($sTongHop) && !empty($sTongHop.sGioGiangDayTrucTiep)}{$sTongHop.sGioGiangDayTrucTiep}{else}...{/if}</p>
                    <p> + Giờ chuẩn giảng dạy không đủ: thiếu (năm học, số giờ thiếu): 
                        {if !empty($sTongHop) && !empty($sTongHop.sGioChuanKhongDu)}{$sTongHop.sGioChuanKhongDu}{else}...{/if}</p>

                    <p>- Hướng dẫn chính NCS/HVCH,CK2/BSNT:</p>
                    <div> + Đã hướng dẫn chính 01 NCS có Quyết định cấp bằng TS (ƯV xét chức danh GS) <div class="box-check">{if !empty($sTongHop) && !empty($sTongHop.sHuongDanNCS) && $sTongHop.sHuongDanNCS == 'checked'}&#10003;{/if}</div></div>
                    <p style="text-align:justify">- CTKH để thay thế tiêu chuẩn hướng dẫn 01 NCS đươc cấp bằng TS bị thiếu: 
                        {if !empty($sTongHop) && !empty($sTongHop.sThayTheHDNCS)}{$sTongHop.sThayTheHDNCS}{else}...{/if}</p>
                    <div> + Đã hướng dẫn chính 1 HVCH/CK2/BSNT có Quyết định cấp bằng ThS/CK2/BSNT (ƯV chức danh PGS) <div class="box-check">{if !empty($sTongHop) && !empty($sTongHop.sHuongDanHVCH) && $sTongHop.sHuongDanHVCH == 'checked'}&#10003;{/if}</div></div>
                    <p style="text-align:justify">- CTKH để thay thế tiêu chuẩn hướng dẫn 01 HVCH/CK2/BSNT được cấp bằng ThS/CK2/BSNT bị thiếu: 
                        {if !empty($sTongHop) && !empty($sTongHop.sThayTheHDHVCH)}{$sTongHop.sThayTheHDHVCH}{else}...{/if}</p>
                    <p>c) Nghiên cứu khoa học</p>
                    <div>- Đã chủ trì 01 nhiệm vụ KH&CN cấp Bộ (ƯV chức danh GS) <div class="box-check">{if !empty($sTongHop) && !empty($sTongHop.sChuTriNVB) && $sTongHop.sChuTriNVB == 'checked'}&#10003;{/if}</div></div>
                    <p style="text-align:justify">CTKH để thay thế tiêu chuẩn chủ trì 01 nhiệm vụ KH&CN cấp Bộ bị thiếu: 
                        {if !empty($sTongHop) && !empty($sTongHop.sThayTheChuTriNVB)}{$sTongHop.sThayTheChuTriNVB}{else}...{/if}</p>
                    <div >- Đã chủ trì 01 nhiệm vụ KH&CN cấp cơ sở (ƯV chức danh PGS)<div class="box-check">{if !empty($sTongHop) && !empty($sTongHop.sChuTriNVCS) && $sTongHop.sChuTriNVCS == 'checked'}&#10003;{/if}</div></div>
                    <p style="text-align:justify">CTKH thay thế để thay thế tiêu chuẩn chủ trì 01 nhiệm vụ KH&CN cấp cơ sở bị thiếu: 
                        {if !empty($sTongHop) && !empty($sTongHop.sThayTheChuTriNVCS)}{$sTongHop.sThayTheChuTriNVCS}{else}...{/if}
                    </p>
                    <p>- Không đủ số công trình khoa học là tác giả chính:</p>
                    <div > + Đối với ứng viên chức danh GS, đã công bố được: 03 CTKH: <div class="box-check">{if !empty($sTongHop) && !empty($sTongHop.iCTKH3) && $sTongHop.iCTKH3 == 'checked'}&#10003;{/if}</div> ; 04 CTKH <div class="box-check">{if !empty($sTongHop) && !empty($sTongHop.iCTKH4) && $sTongHop.iCTKH4 == 'checked'}&#10003;{/if}</div></div>
                    <p style="text-align:justify">Sách CK/chương sách XB quốc tế thay thế cho việc ƯV không đủ 05 CTKH là tác giả chính theo quy định:
                        {if !empty($sTongHop)}{$sTongHop.sThayTheCTKH5}{else}...{/if}
                    </p>
                    <div> + Đối với ứng viên PGS, đã công bố được: 02 CTKH: <div class="box-check">{if !empty($sTongHop) && !empty($sTongHop.iCTKH2) && $sTongHop.iCTKH2 == 'checked'}&#10003;{/if}</div></div>
                    <p style="text-align:justify">Sách CK/chương sách XB quốc tế thay thế cho việc ƯV không đủ 03 CTKH là tác giả chính theo quy định:
                        {if !empty($sTongHop)}{$sTongHop.sThayTheCTKH3}{/if}
                    </p>
                    <p>d) Không đủ điểm biên soạn sách phục vụ đào tạo (đối với ứng viên chức danh GS):</p>
                    <p>- Tổng điểm biên soạn sách đạt {if !empty($sTongHop) && !empty($sTongHop.sTongDiemBienSoanSach)}{$sTongHop.sTongDiemBienSoanSach}{else}...{/if} điểm, thiếu {if !empty($sTongHop) && !empty($sTongHop.sTongDiemBienSoanSachThieu)}{$sTongHop.sTongDiemBienSoanSachThieu}{else}...{/if} điểm;</p>
                    <p>- Số điểm biên soạn giáo trình, sách chuyên khảo đạt {if !empty($sTongHop) && !empty($sTongHop.sSoDiemBienSoanGTCK)}{$sTongHop.sSoDiemBienSoanGTCK}{else}...{/if} điểm, thiếu {if !empty($sTongHop) && !empty($sTongHop.sSoDiemBienSoanGTCKThieu)}{$sTongHop.sSoDiemBienSoanGTCKThieu}{else}...{/if} điểm. </p>
                </div>
                <!-- <div class="col-md-12 m-t">
                <strong>13. Các tiêu chuẩn còn thiếu so với quy định cần được thay thế bằng bài báo khoa học quốc tế uy tín [35]:</strong>
                </div>
                {foreach $muc13 as $k => $v}
                    <div class="col-md-12 m-t">
                    - {$v.sTenTieuChuan}: <div class="box-check">{if in_array($v.PK_iMaTieuChuan, $arrTieuChuanTD)}&#10003;{else if in_array($v.PK_iMaTieuChuan, $arrTieuChuanHienTai)}&#10003;{/if}</div>;
                    </div>
                {/foreach} -->
                <div class="col-md-12">
                <strong>C. NHẬN XÉT CỦA NGƯỜI THẨM ĐỊNH</strong> 
                </div>
                <div class="col-md-12">
                    (Nêu rõ mặt mạnh, yếu của ứng viên và đánh giá ưu điểm, nhược điểm của hồ sơ, sự hợp lý của những công trình khoa học thay thế cho những tiêu chuẩn không đủ theo quy định)
                </div>
                <div class="col-md-12">
                    <p style="text-align:justify">a) Ưu điểm: {$sNhanXet.sUuDiem}</p>
                    <p style="text-align:justify">b) Nhược điểm: {$sNhanXet.sNhuocDiem}</p>
                    <p style="text-align:justify">c) Đánh giá chung (nêu rõ mức độ đạt/không đạt theo tiêu chuẩn quy định): {$sNhanXet.sDanhGiaChung}</p>
                <!-- {(!empty($nhanXet.sNhanXet))? $nhanXet.sNhanXet : '.......................................................................................................................................................................<br>.......................................................................................................................................................................<br>.......................................................................................................................................................................'} -->
                </div>
                <div  class="col-md-12">
                    <div class="col-md-6 text-left" style="padding: 0;">
                    </div>
                    <i>
                    <div class="col-md-6 text-center" style="padding: 0;">
                        <span contenteditable>..(2)..</span>, ngày <span contenteditable>...</span> tháng <span contenteditable>...</span> năm <span contenteditable>...</span>.
                        <br>
                    <p>(Ký và ghi rõ họ tên)</p>
                    </i>
                    </div>
                </div>
                <div class="col-md-12 m-t">
                <strong><i>Ghi chú:</i></strong>
                </div>
                <div class="col-md-12 m-t">
                (1) Tên Hội đồng giáo sư ngành, liên ngành.
                </div>
                <div class="col-md-12 m-t">
                (2) Địa danh.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
   
