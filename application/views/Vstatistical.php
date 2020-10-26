<div class="wrapper wrapper-content">
    <!-- <form action="" method="post">
        <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
        <h3 class="badge badge-warning text-dark p-2 w-100" style="font-size: 16px !important;"><button type="button" class="btn btn-outline p-0" style="color:#000;font-family:'arial' !important;" disabled>Yêu cầu: Điền đầy đủ các giá trị trong file excel! Xem mẫu tại </button> <button name="download_demo" value="1" class="btn btn-outline font-weight-bold p-0" type="submit">đây!</button></h3>
    </form> -->
    <h3 id="noty_badge" class="badge badge-success text-dark p-2 w-100 d-none" style="font-size: 16px !important;">hí</h3>
    <div class="row">
		


        <div class="col-xl-5 col-12 mb-xl-3">
            <div class="card">
                <div class="card-header">
                    <span class="float-left text-uppercase">Thống kê theo năm tốt nghiệp</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-12">
                            <form action="" method="POST" class="form-horizontal row text-center" enctype="multipart/form-data">
                                <div class="form-group form-inline col-12 mb-0">
                                    <span>Chọn năm tốt nghiệp: </span>
                                    <select name="namtotnghiep" id="namtotnghiep" class="form-control mr-3">
                                        <option value="">--Năm tốt nghiệp--</option>
                                        {foreach $listNamTN as $k => $v}
                                            <option {if $iNamTN == $v.PK_iNamTN}selected{/if} value="{$v.PK_iNamTN}">{$v.PK_iNamTN}</option>
                                        {/foreach}
                                    </select>
                                    <button name="btn_filter" value="1" class="btn btn-sm mr-2 btn-success" type="submit">Lọc</button>
                                </div>
                                <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                            </form>
                        </div>
                    </div>
                    <table id="tbl" class="table table-striped table-inverse table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="9%">STT</th>
                                <th class="text-center">Ngành</th>
                                <th class="text-center">Số lượng SV</th>
                                <th class="text-center">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {if !empty($count_sv)}
                                {foreach $count_sv as $key => $value}
                                <tr>
                                    <td class="text-center">{$key+1}</td>
                                    <td class="">{$value.sTenNganh}</td>
                                    <td class="text-center">{$value.iSoLuongSV}</td>
                                    <td class="text-center">
										<form action="{$url}dssv" method="post" target="blank">
                                            <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                                            <input type="hidden" name="PK_iMaNganh" value="{$value.PK_iMaNganh}" />
                                            <input type="hidden" name="FK_iNamTN" value="{$value.FK_iNamTN}" />
                                            
											<button class="btn btn-sm btn-primary" type="submit" title="Xem chi tiết" value="ok" name="seeDetail">
												<i class="fa fa-eye" aria-hidden="true" title="Xem chi tiết"></i> Xem chi tiết
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
                </div>
            </div>
        </div>

        
        <div class="col-xl-7 col-12">
            <div class="card">
                <div class="card-header">
                    <span class="float-left text-uppercase">Tổng quát</span>
                </div>
                <div class="card-body">
                    <table id="tbl" class="table table-striped table-inverse table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%">STT</th>
                                <th class="text-center" width="">Hệ</th>
                                <th class="text-center">Ngành</th>
                                <th class="text-center">Khoá</th>
                                <th class="text-center">Só lượng SV</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            {if !empty($statistical)}
                                {$i = 1}
                                {foreach $statistical as $ten_he => $ds_nganh}
                                    {$i2 = 1}
                                    <tr>
                                        <td class="text-center" rowspan="{$rowspan[$ten_he|cat:'_rowspan']}">{$i++}</td>
                                        <td class="" rowspan="{$rowspan[$ten_he|cat:'_rowspan']}">{$ten_he}</td>
                                        {foreach $ds_nganh as $ten_nganh => $ds_khoa}
                                            {$i3 = 1}
                                            {if $i2 > 1} <tr>{/if}
                                            <td class="" rowspan="{$rowspan[$ten_he][$ten_nganh]}">{$ten_nganh}</td>
                                            {foreach $ds_khoa as $ten_khoa => $slsv}
                                                {if $i3 > 1} <tr>{/if}
                                                <td class="text-center">{$ten_khoa}</td>
                                                <td class="text-center">{$slsv}</td>
                                                {if $i3++ > 1} </tr>{/if}
                                            {/foreach}
                                            {if $i2++ > 1} </tr>{/if}
                                        {/foreach}
                                        
                                    </tr>
                                    
                                {/foreach}
                                {else}
                                <tr>
                                    <td colspan="6" class="text-center">
                                    <i>Chưa có sinh viên nào</i>
                                    </td>
                                </tr>
                                {/if}
                        </tbody>
                    </table>
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
