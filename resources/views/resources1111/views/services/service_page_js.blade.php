<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{asset('summernote/summernote-bs5.js')}}"></script>
<script src="{{asset('summernote/summernote-bs4.js')}}"></script>
<script src="{{asset('summernote/summernote.js')}}"></script>
<script src="{{asset('summernote/summernote-lite.js')}}"></script>
<link rel="stylesheet" href="{{asset('summernote/summernote-bs5.css')}}" />
<link rel="stylesheet" href="{{asset('summernote/summernote-bs4.css')}}" />
<link rel="stylesheet" href="{{asset('summernote/summernote.css')}}" />
<link rel="stylesheet" href="{{asset('summernote/summernote-lite.css')}}" />
<style>
.toolbar {
    float: right;
    margin-left: 10px;
}
</style>
<script>
$(function() {

    $('.editor').summernote({
        toolbar: [

            ['style', ['style']],

            ['font', ['bold', 'underline', 'clear']],

            ['fontname', ['fontname']],

            ['color', ['color']],

            ['para', ['ul', 'ol', 'paragraph']],

            ['table', ['table']],

            ['insert', ['link', 'picture', 'video']],

            ['view', ['fullscreen', 'codeview', 'help']],
        ],
    });

    $('#services').DataTable({
        initComplete: function() {

            this.api().columns([2]).every(function() {
                var column = this;
                var select = $('#custom-select-filter-1')
                    .on('change', function() {
                        var val = $(this).val();
                        column.search(val).draw();
                    });

            });


            this.api().columns([3]).every(function() {
                var column = this;
                var website_type = $('#website_type')
                    .on('change', function() {
                        var val = $(this).val();
                        column.search(val).draw();
                    });
            });


        },
        dom: '<"toolbar">frtip',
        "columns": [{
                data: 'id',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: "service_name"
            },
            {
                data: "status"
            },
            {
                data: "website_type"
            },
            {
                data: "seo_url_slug"
            },
            {
                data: "action"
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": "{{route('services_index')}}"
    });



    document.querySelector('div.toolbar').innerHTML =
        '<?php HtmlHelper::WebsiteDropdown('website_type', '', false, 'height: 31px;padding: -16.625rem .75rem;padding: .200rem .75rem;', 'website_type') ?>';
});

function delete_service(msg, id) {

    if (confirm(msg)) {
        var form = $('#service_form_' + id);
        var token = $('#csrf_' + id).val();
        // Create a hidden input field to send the CSRF token 
        var csrfInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', '_token')
            .val(token);
        // Create a hidden input field to send the DELETE method
        var methodInput = $('<input>')
            .attr('type', 'hidden')
            .attr('name', '_method')
            .val('DELETE');
        // Append the hidden input fields to the form 
        form.append(csrfInput, methodInput);
        // Submit the form 
        form.submit();
    }
}
</script>