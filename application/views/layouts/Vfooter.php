
		</div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


    </div>
	<!-- End of Content Wrapper -->
	
	</div>
	<!-- Footer -->
	<footer class="border-radius-top bg-white p-3 text-center mx-4">
		<span class="text-secondary">Xây dựng & phát triển bởi <strong>Tổ phát triển - FFCTeam</strong></span>
	</footer>
	<!-- End of Footer -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Đăng xuất</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Chọn "Đăng xuất" nếu bạn muốn kết thúc phiên làm việc.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
          <a class="btn btn-primary" href="{$url}logout">Đăng xuất</a>
        </div>
      </div>
    </div>
  </div>
	<!-- Mainly scripts -->
	<script src="assets/plugins/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script src="assets/plugins/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<!-- Custom and plugin javascript -->
	<script src="assets/plugins/js/inspinia.js"></script>
	<script src="assets/plugins/js/plugins/pace/pace.min.js"></script>
	<script src="assets/plugins/js/plugins/dataTables/datatables.min.js"></script>
	<script src="assets/plugins/js/plugins/iCheck/icheck.min.js"></script>
	<script src="assets/plugins/js/plugins/select2/select2.full.min.js"></script>
	<script src="assets/plugins/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
	<script src="assets/plugins/js/plugins/toastr/toastr.min.js"></script>
	<script type="text/javascript">
		toastr.options = {
			top: 5000,
			closeButton: true,
			progressBar: true,
			showMethod: 'slideDown',
			timeOut: 5000,
			preventDuplicates: true
		};
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $(".select2").select2({
            placeholder: "",
            width: "100%"
        });
        $('.datepicker').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: "dd/mm/yyyy"
        });
	</script>
	{if !empty($message)}
	<script type="text/javascript">
		$(document).ready(function() {
			setTimeout(function() {
				toastr.{$message.type}('{$message.message}');
			}, 200);
		});
	</script>
	{/if}
</body>
</html>