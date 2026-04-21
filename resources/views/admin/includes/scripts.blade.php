<!-- login js-->
<!-- Plugin used-->
<script>
    let base_url = '<?= url('/') ?>';
</script>
<script src="{{ asset('admin/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/datatables/datatables.min.js') }}"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script> --}}

<script>
    $(document).ready(function() {
        $('#zero_config').DataTable();
    });
</script>
{{-- <script>
        $(document).ready(function () {
            $('#zero_config').DataTable({
                "paging": false,  // Disable DataTables pagination
                "info": false,    // Disable the "showing x of y entries" info
                "searching": true,  // Disable internal searching
                "ordering": true   // Keep the ordering feature if desired
            });
        });
    </script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>


<script src="{{ asset('admin/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('admin/js/productDetail.js') }}"></script>
<script src="{{ asset('admin/js/custom.js') }}"></script>
<script src="{{ asset('admin/js/tooltip.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var editors = document.querySelectorAll('.editor');
        editors.forEach(function(editor) {
            CKEDITOR.replace(editor);
        });
    });
</script>
{{-- @include('admin/includes/ckeditor_config'); --}}

{{-- <script>
    var editors = document.querySelectorAll('.editor');
    editors.forEach(function(editorEl) {

        ClassicEditor
            .create(editorEl, editorConfig)
            .catch(error => {
                console.error(error);
            });
    });
</script> --}}

{{-- <script>
    $(document).on('change', '.editor', function(){
        console.log($(this).val());
    })
</script> --}}

<script>
    $(document).ready(function() {
       var rowIndexForClone = 10000;
       $(".addNewRowTbl").click(function() {
           var isCkeditor = !!jQuery(this).closest('#newTable').attr('isCkeditor');
           var clonedRow = $(this).closest('#newTable').find('tbody').find('tr:last-child').clone();
           let name = clonedRow.find('textarea').attr('name');
           clonedRow.find('input').val('').end();
           if (isCkeditor)
               clonedRow.find('textarea').parent().empty().html(
                   `<textarea name="${name}" id="id${++rowIndexForClone}" class="form-control ckeditor" placeholder="Text" rows="4"></textarea>`
               )
           else
               clonedRow.find('textarea').val('').end();
           clonedRow.find('textarea').val('').end();
           clonedRow.find('td:last-child').html(
               '<td class="text-center"><a href="javascript:void(0)" class="text-primary edit delNewRowTbl" id="delNewRowTbl"><i class="ti ti-minus fs-5"></i></a></td>'
           );
           clonedRow.find('img').attr('src', "{{ asset('/images/no-image.svg') }}");
           $(this).closest('#newTable').before().append(clonedRow);
           if (isCkeditor)
               CKEDITOR.replace(`id${rowIndexForClone}`);
       });
 
       $(document).on('click', '.delNewRowTbl', function() {
           $(this).closest('tr').remove();
       });
       $(document).on('click', '#newImg', function() {
           $(this).closest("#imgDiv").find('#newImgInput').trigger('click');
       });
 
       $(document).on('change', '#newImgInput', function() {
           var preview = $(this).closest("#imgDiv").find("#newImg");
           var oFReader = new FileReader();
           oFReader.readAsDataURL($(this)[0].files[0]);
           oFReader.addEventListener("load", function() {
               preview.attr('src', oFReader.result);
           }, false);
       });
   })

    //
</script>

<script>
    $(document).ready(function() {
        function loadStates(country_id, selected_state = null) {
            if (country_id) {
                $.ajax({
                    url: "{{ route('get.states') }}",
                    method: "GET",
                    data: {
                        country_id: country_id
                    },
                    success: function(response) {
                        var states = JSON.parse(response);
                        $('#state_id').html(states);

                        if (selected_state) {
                            $('#state_id').val(selected_state);
                        }
                    }
                });
            } else {
                $('#state_id').html('<option value="">No States Available!</option>');
            }
        }

        $('#country_id').on('change', function() {
            loadStates($(this).val());
        });

        // Load states on edit mode
        @if (!empty($row->country_id))
            loadStates("{{ $row->country_id }}", "{{ $row->state_id }}");
        @endif
    });
</script>
