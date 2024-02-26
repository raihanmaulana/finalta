@extends('layout.index')

@section('custom_top_script')
@stop

@section('content')
<div class="content">
    <div class="module">
        <div class="module-head">
            <h3>Tambah Kategori</h3>
        </div>
        <div class="module-body">
            <form class="form-horizontal row-fluid" method="POST" action="{{ route('bookcategory.store') }}">
                @csrf
                <div class="control-group">
                    <label class="control-label">Kategori</label>
                    <div class="controls">
                        <input type="text" name="kategori" id="kategori" data-form-field="kategori" placeholder="Masukkan kategori baru..." class="span8" required>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-inverse">Tambah</button>
                        <a href="{{ URL::route('all-books') }}" class="btn btn-inverse">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('custom_bottom_script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- <script type="text/javascript" src="{{ asset('static/custom/js/script.addbookcategory.js') }}"></script> -->
<script>
    $(document).ready(function() {
        // Listen for form submission
        $("form").submit(function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Serialize the form data
            var formData = $(this).serialize();

            // Submit the form data using AJAX
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                success: function(response) {
                    // If the request is successful, show a success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Kategori berhasil ditambahkan!'
                    });

                    // You can also redirect the user to another page if needed
                    // window.location.href = "{{ route('add-book-category') }}";
                },
                error: function(xhr, status, error) {
                    // If the request fails, show an error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...gagal!',
                        text: 'Jangan menggunakan kategori yang sama. Silakan coba lagi.'
                    });
                }
            });
        });
    });

    function clearform() {
        $("#kategori").val("");
    }
</script>
@stop