<div class="wrapper wrapper-content">

    <div class="row">
		<!-- Thêm file excel -->
        <div class="col-lg-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <div class="form-group mb-0" id="customFile" lang="vi">
                        <form action="" method="POST" class="float-left" enctype="multipart/form-data">
                            <button name="download_demo" value="1" class="btn btn-sm btn-success mr-5" type="submit"><i class="fa fa-download"></i> Tải file Excel mẫu</button>
                            <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                        </form>
                        <form action="" method="POST" class="float-right" enctype="multipart/form-data">
                            <div class="float-right">
                                <input id="fileExcel" type="file" class="d-none" name="importExcel" multiple accept=".xlsx, .xls" required>
                                <span id="file-name" class="mr-1"></span>
                                <label id="file-label" class="btn btn-success btn-sm cursor-pointer mb-0 mr-2" for="fileExcel"><i class="fa fa-upload"></i>Thêm file Excel</label>
                                <button type="button" id="btn_preview" class="btn btn-sm btn-primary mr-2"><i class="fa fa-eye"></i> Xem trước file excel</button>
                                <button type="button" id="btn_submit" class="btn btn-sm btn-primary mr-2"><i class="fa fa-save"></i> Lưu bằng ajax</button>
                                <button name="submit_import" id="submit_import" value="1" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Lưu vào hệ thống</button>
                            </div>
                            <input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
                        </form>
                    </div>
                </div>
                <div id="card-body" class="card-body d-none">
                        <div class="float-left">
							<div class="form-inline">
								<div id="prv_bac" class="mr-3"></div>
								<div id="prv_he" class="mr-3"></div>
								<div id="prv_nganh" class="mr-3"></div>
								<div id="prv_namhoc" class="mr-3"></div>
								<div id="prv_khoa" class="mr-3"></div>
								<div id="prv_khoahoc" class="mr-3"></div>
							</div>
                        </div>
						<div class="float-right mb-3">
							<button name="undo_preview_excel" id="undo_preview_excel" value="1" type="button" class="btn btn-sm btn-warning">Huỷ</button>
						</div>
                    <table id="excel_preview" class="table table-striped table-inverse table-bordered m-0" style="display: block; overflow: auto; overflow-x: auto; overflow-y: auto;white-space: nowrap; max-height: 650px !important;">
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
