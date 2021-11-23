		<footer class="main-footer">
			<div class="footer-left">
			  Powered by Bagja Indonesia &copy; <?php echo date('Y') ?>
			</div>
			<div class="footer-right">
			  1.0.0
			</div>
		</footer>
	</div>
</div>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/js/stisla.js"></script>

<!-- Template JS File -->
<script src="<?php echo base_url() ?>assets/template/js/scripts.js"></script>
<script src="<?php echo base_url() ?>assets/template/js/custom.js"></script>

<!-- datatables -->
<script src="<?php echo base_url(); ?>assets/template/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/template/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/numeric/jquery.numeric-only.js"></script>
<script src="<?php echo base_url(); ?>assets/number_divider/dist/number-divider.min.js"></script>

<!-- select2 -->
<script src="<?php echo base_url(); ?>assets/template/modules/select2/dist/js/select2.full.min.js"></script>

<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/daterangepicker/daterangepicker.js"></script>

<script src="<?php echo base_url(); ?>assets/input_spinner/dist/js/jquery.input-counter.min.js"></script>

<script>
	$('.number_separator').divide({
		delimiter:'.',
		divideThousand: true, // 1,000..9,999
		delimiterRegExp: /[\.\,\s]/g
	});

  	$('.numeric').numericOnly();

	var options = {
		selectors: {
			addButtonSelector		: '.btn-add',
			subtractButtonSelector	: '.btn-subtract',
			inputSelector			: '.counter',
		},
		settings: {
			checkValue: true,
			isReadOnly: false,
		},
	};

	$(".input-counter").inputCounter(options);

	$('body').tooltip({selector: '[data-toggle="tooltip"]', trigger: "hover"});
  
</script>

</body>
</html>
