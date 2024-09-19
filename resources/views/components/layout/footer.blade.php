<div class="footer">
    <!-- <div class="copyright">
        <p>Copyright © Designed &amp; Developed by <a href="http://dexignlab.com/" target="_blank">DexignLab</a> 2023
        </p>
    </div> -->
</div>



<script src="<?php echo asset('/'); ?>vendor/global/global.min.js"></script>
<script src="<?php echo asset('/'); ?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

<!-- Datatable -->
<script src="<?php echo asset('/'); ?>vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo asset('/'); ?>js/pluginsinit/datatables.init.js"></script>

<!-- Svganimation scripts -->
<script src="<?php echo asset('/'); ?>vendor/svganimation/vivus.min.js"></script>
<script src="<?php echo asset('/'); ?>vendor/svganimation/svg.animation.js"></script>

<script src="<?php echo asset('/'); ?>js/custom.min.js"></script>
<script src="<?php echo asset('/'); ?>js/dlabnav-init.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<style> 
.direct-chat-text::selection {
  background: #e74c3c;
}

.direct-chat-text a::selection {
  background: #e74c3c;
}
.download-attachment{
  cursor: pointer;
}
</style>
<script> 

function downloadFromUrl(url){
  window.open(
  url,
  '_blank' // <- This is what makes it open in a new window.
);
}

function ltrim(str) {
  if(!str) return str;
    str = str.replace(/(\r\n|\n|\r)/gm, "");
   str = str.replace(/^\s+/g, '');
   alert('--'+str+'___');
   return str;
}
$(document).ready(function(){
    $( ".direct-chat-text" ).find('a').removeAttr('href')
});
$( ".direct-chat-text" ).on( "dblclick", function(e) {
    var span = e.target;
    window.getSelection().selectAllChildren(e.target);
    document.execCommand("copy");
});
</script>

<script>
	$ = jQuery;
	$(function() {
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

		$("#start_date").datepicker({
			autoclose: true,
			startDate: today,
			dateFormat: 'yy-mm-dd', // Set the date format to yyyy-mm-dd
		}).on('change', function() {
			$('#start_date_error').hide(); // Hide error message on change
			validateDates(); // Check date validation after any change
		});

		$("#end_date").datepicker({
			autoclose: true,
			dateFormat: 'yy-mm-dd', // Set the date format to yyyy-mm-dd
		}).on('change', function() {
			$('#end_date_error').hide(); // Hide error message on change
			validateDates(); // Check date validation after any change
		});

		// Custom function to handle form submission
		function handleFormSubmission() {
			var startDate = $("#start_date").val();
			var endDate = $("#end_date").val();

			// Validate date format before submission
			/*if (!isValidDateFormat(startDate)) {
				$('#start_date_error').text('Start date cannot be greater than end date.').show();
				return false;
			}
			if (!isValidDateFormat(endDate)) {
				$('#end_date_error').show();
				return false;
			}*/

			// Validate start date should not be greater than end date
			if (new Date(startDate) > new Date(endDate)) {
				$('#start_date_error').text('Start date cannot be greater than end date.').show();
				return false;
			}

			// Proceed with form submission if dates are valid
			return true;
		}

		// Function to validate date format (YYYY-MM-DD)
		function isValidDateFormat(dateString) {
			var regex = /^\d{4}-\d{2}-\d{2}$/;
			return regex.test(dateString);
		}

		// Function to validate and update error messages
		function validateDates() {
			var startDate = $("#start_date").val();
			var endDate = $("#end_date").val();

			if (new Date(startDate) > new Date(endDate)) {
				$('#start_date_error').text('Start date cannot be greater than end date.').show();
				$('#end_date_error').text('End date cannot be less than start date.').show();
			} else {
				$('#start_date_error').hide();
				$('#end_date_error').hide();
			}
		}

		// Optionally, bind to a button click event to trigger form validation
		$('#submit_button').on('click', function(e) {
			//e.preventDefault();
			if (handleFormSubmission()) {
				// Submit the form if validation passes
				$('#export_form').submit();
			}
		});
	});
</script>
<!-- JS confirm Override -->
</body>
</html>
