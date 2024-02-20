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

    $(document).ready(function() {
        $("#kategori_fill").change(function() {
            loadResults();
        });

        $(document).on("click", "#addbookcategory", function() {
            var form = $(this).parents("form"),
                module_body = $(this).parents(".module-body"),
                send_flag = true,
                f$ = function(selector) {
                    return form.find(selector);
                };

            var kategori = f$("input[data-form-field~=kategori]").val();
            var _token = f$("input[data-form-field~=token]").val();

            if (kategori == "") {
                module_body.prepend(
                    templates.alert_box({
                        type: "danger",
                        message: "Kategori harus diisi",
                    })
                );
                send_flag = false;
            }

            if (send_flag == true) {
                $.ajax({
                    type: "POST",
                    data: {
                        kategori: kategori,
                        _token: _token,
                    },
                    url: "{{ route('bookcategory.store') }}",
                    success: function(data) {
                        module_body.prepend(
                            templates.alert_box({
                                type: "success",
                                message: "Kategori berhasil ditambahkan.",
                            })
                        );
                        clearform(); // Panggil clearform() setelah berhasil menambahkan kategori
                    },
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        module_body.prepend(
                            templates.alert_box({
                                type: "danger",
                                message: err.message.kategori,
                            })
                        );
                        clearform(); // Panggil clearform() jika terjadi kesalahan dalam menambahkan kategori
                    },
                    beforeSend: function() {
                        form.css({
                            opacity: "0.4"
                        });
                    },
                    complete: function() {
                        form.css({
                            opacity: "1.0"
                        });
                    },
                });
            }
        });

        $(".alert_box").hide().delay(5000).fadeOut();
    });

    function clearform() {
        $("#kategori").val("");
    }
</script>
@stop