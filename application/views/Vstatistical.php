<div class="wrapper wrapper-content">
    <!-- <form action="" method="post">
        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
        <h3 class="badge badge-warning text-dark p-2 w-100" style="font-size: 16px !important;"><button type="button" class="btn btn-outline p-0" style="color:#000;font-family:'arial' !important;" disabled>Yêu cầu: Điền đầy đủ các giá trị trong file excel! Xem mẫu tại </button> <button name="download_demo" value="1" class="btn btn-outline font-weight-bold p-0" type="submit">đây!</button></h3>
    </form> -->
    <h3 id="noty_badge" class="badge badge-success text-dark p-2 w-100 d-none" style="font-size: 16px !important;">hí</h3>
    <div class="row">
		


        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <span class="float-left text-uppercase">Thống kê</span>
                </div>
                <div class="card-body">
					<div class="mb-2 float-left">Danh sách sinh viên: </div>
                    <table id="tbl" class="table table-striped table-inverse table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%">STT</th>
                                <th class="text-center">Khoá</th>
                                <th width="10%">Lớp</th>
                                <th class="text-center" width="15%">Mã SV</th>
                                <th class="text-center">Họ và Tên</th>
                                <th class="text-center">Ngày sinh</th>
                                <th class="text-center">Giới</th>
                                <!-- <th class="text-center" width="11%">In mẫu</th> -->
                                <th class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {if !empty($DSSV)}
                                {foreach $DSSV as $key => $value}
                                <tr>
                                    <td class="text-center">{($present_page-1)*10 + $key+1}</td>
                                    <td class="">{$value.iKhoa}</td>
                                    <td class="">{$value.sTenLop}</td>
                                    <td class="">{$value.PK_iMaNhapHoc}</td>
                                    <td class="">{$value.sHo} {$value.sTen}</td>
                                    <td class="text-center">{date('d/m/Y', strtotime($value.dNgaySinh))}</td>
                                    <td class="">{$value.sGioiTinh}</td>
                                    <td class="text-center">
										<form action="" method="post">
                                            <a target="_blank" href="{$url}inbangdiem?masv={$value.PK_iMaNhapHoc}&d_f_w=true">
                                                <button class="btn btn-success btn-sm" type="button">
                                                    <i class="fa fa-download" aria-hidden="true" title="Tải file word"></i>
                                                </button>
                                            </a>
                                            <a target="_blank" href="{$url}inbangdiem?masv={$value.PK_iMaNhapHoc}">
                                                <button class="btn btn-success btn-sm" type="button">
                                                    <i class="fa fa-eye" aria-hidden="true" title="Xem điểm"></i>
                                                </button>
                                            </a>
											<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
											<button class="btn btn-sm btn-danger" type="submit" title="Xoá" value="{$value.PK_iMaNhapHoc}" name="delSV" onclick="return confirm('Bạn chắc chắn muốn xóa?')">
												<i class="fa fa-trash" aria-hidden="true" title="Xoá"></i>
											</button>
										</form>
                                    </td>
                                    
                                </tr>
                                {/foreach}
                                {else}
                                <tr>
                                    <td colspan="8" class="text-center">
                                    <i>Chưa có sinh viên nào</i>
                                    </td>
                                </tr>
                                {/if}
                        </tbody>
                    </table>
                    {if $countPage > 0}
					<nav class="float-right">
						<ul class="pagination">
							<li class="page-item m-1 mr-3">Trang {$present_page}/{$countPage}</li>
							<li class="page-item {if $present_page == 1}disabled{/if}"><a class="page-link" href="{$url}listsv?page={$present_page-1}{if !empty($filter)}&filter=1{/if}">Trước</a></li>
							{for $i=1 to $countPage}
                                {if $i <= $present_page+3 && $i >= $present_page-3}
								<li class="page-item {if $present_page == $i}active{/if}"><a class="page-link" href="{$url}listsv?page={$i}{if !empty($filter)}&filter=1{/if}">{$i}</a></li>
                                {/if}
							{/for}
							<li class="page-item {if $present_page >= $countPage}disabled{/if}"><a class="page-link" href="{$url}listsv?page={$present_page+1}{if !empty($filter)}&filter=1{/if}">Sau</a></li>
						</ul>
					</nav>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">

    .container{
        padding: 0px !important;
    }
    .custom-file-input ~ .custom-file-label::after {
        content: "Chọn";
    }
    .welcome-text{
        font-size: 40px;
        margin-top: 10px;
    }
    .feature{
        background-color: #ddd;
        width: 100%;
        height: 3cm;
        margin: 5px;
        padding: 25px;
        color: #fff;
        font-weight: bold;
        text-align: center;
        display: table;
    }
    .nameFeature{
        display: table-cell;
        vertical-align: middle;
    }
    @media screen and (max-width: 768px){
        .welcome-text{
            font-size: 30px;
            margin-top: 10px;
            padding-left: 15px;
            padding-right: 15px;
        }
    }
    @media screen and (max-width: 425px){
        .welcome-text{
            font-size: 25px;
            margin-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>
<script src="{$url}assets/plugins/js/vlistsv.js"></script>
