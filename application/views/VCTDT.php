<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<form action="" method="post" class="form-horizontal">
		<input type="hidden" name="{$csrf['name']}" value="{$csrf['hash']}" />
			<div class="col-md-12">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
						<h5>Thẩm định CTĐT, NCKH, Ngoại Ngữ, Tỷ lệ phiếu tín nhiệm</h5>
					</div>
					<div class="ibox-content">
            <!-- <div class="container"> -->
              <div class="row">
                <div class="form-group">
                <div class="col-md-8">
						      Kết quả thẩm định Phát triển chương trình đào tạo, khoa học và công nghệ [19]
                </div>
                <div class="col-md-4">
                <textarea type="text" class="form-control" name="data[sKetQuaDaoTao]" placeholder="" value="{$thamdinh.sKetQuaDaoTao}">{$thamdinh.sKetQuaDaoTao}</textarea>
                </div>
                </div>
                </div>
						<!-- </div> -->
					</div>
          <div class="ibox-content">
            <!-- <div class="container"> -->
              <div class="row">
                <div class="form-group">
                <div class="col-md-8">
                  Ngoại ngữ thành thạo (Đ/KĐ) [37]
                </div>
                <div class="col-md-4">
                <input type="text" class="form-control" name="data[sNgoaiNguThanhThao]" placeholder="" value="{$thamdinh.sNgoaiNguThanhThao}">
                </div>
              </div>
              <div class="row m-t">
                <div class="col-md-8">
                Giao tiếp tiếng Anh (Đ/KĐ) [38]
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control" name="data[sGiaoTiepTiengAnh]" placeholder="" value="{$thamdinh.sGiaoTiepTiengAnh}">
                </div>
              </div>
						</div>
            <!-- </div> -->
					</div>
          <div class="ibox-content">
            <!-- <div class="container"> -->
              <div class="row">
            <div class="form-group">
            <div class="col-md-8">Tỷ lệ phiếu tín nhiệm [39]</div>
            <div class="col-md-4">
              <input type="text" class="form-control" name="data[sTyLePhieuTinNhiem]" placeholder="" value="{$thamdinh.sTyLePhieuTinNhiem}">
            </div>
            </div>
            </div>
            <div class="row text-center">
              <button class="btn btn-primary" type="submit" value="thamdinh" name="thamdinh">Thẩm định</button>
            </div>
          </div>
					<!-- </div> -->
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        if (CKEDITOR.instances["data[sKetQuaDaoTao]"]) {
            CKEDITOR.remove(CKEDITOR.instances["data[sKetQuaDaoTao]"]);
        }
        CKEDITOR.config.width = '100%';
		CKEDITOR.config.height = '40%';
		CKEDITOR.replace("data[sKetQuaDaoTao]", {});

		

    });
</script>