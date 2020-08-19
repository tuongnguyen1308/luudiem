			<!-- <div class="footer">
	            <div class="pull-right">
	                <strong>Hỗ trợ: 0987654321<span class="hidden-xs">(chuyên môn)</span>/0987654321<span class="hidden-xs">(kỹ thuật)</span></strong>
	            </div>
	            <div class="pull-right-xs">
	                <strong>Hướng dẫn sử dụng: <a target="_blank" href="">PDF</a>/<a target="_blank" href="">Video</a></strong>
	            </div>
	        </div> -->
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