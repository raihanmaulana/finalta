function loadResults() {
    var url =
        config.path.ajax + "/buku?kategori_id=" + $("#kategori_fill").val();

    var table = $("#all-books");

    var default_tpl = _.template($("#allbook_show").html());

    $.ajax({
        url: url,
        success: function (data) {
            if ($.isEmptyObject(data)) {
                table.html(
                    '<tr><td colspan="99">No Books in this kategori</td></tr>'
                );
            } else {
                table.html("");
                for (var book in data) {
                    table.append(default_tpl(data[book]));
                }
            }
        },
        beforeSend: function () {
            table.css({ opacity: 0.4 });
        },
        complete: function () {
            table.css({ opacity: 1.0 });
        },
    });
}

$(document).ready(function () {
    $("#kategori_fill").change(function () {
        loadResults();
    });

    $(document).on("click", "#addbookcategory", function () {
        var form = $(this).parents("form"),
            module_body = $(this).parents(".module-body"),
            send_flag = true,
            f$ = function (selector) {
                return form.find(selector);
            };

        var kategori = f$("input[data-form-field~=kategori]").val();
        var _token = f$("input[data-form-field~=token]").val();

        if (kategori == "") {
            // Menampilkan popup SweetAlert2 jika kategori kosong
            Swal.fire({
                title: "Gagal!",
                text: "Kategori tidak boleh kosong.",
                icon: "error",
                timer: 2000, // Menampilkan pesan selama 2 detik
            });
            send_flag = false;
        }

        if (send_flag) {
            $.ajax({
                type: "POST",
                data: {
                    kategori: kategori,
                    _token: _token,
                },
                url: "/kategoribuku",
                success: function (data) {
                    // Menampilkan popup SweetAlert2 jika berhasil menambahkan kategori
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Kategori berhasil ditambahkan.",
                        icon: "success",
                        timer: 2000, // Menampilkan pesan selama 2 detik
                    });
                    clearform();
                },
                error: function (xhr, status, error) {
                    // Menampilkan popup SweetAlert2 jika gagal menambahkan kategori
                    Swal.fire({
                        title: "Gagal!",
                        text: "Gagal menambahkan kategori.",
                        icon: "error",
                        timer: 2000, // Menampilkan pesan selama 2 detik
                    });
                },
                beforeSend: function () {
                    form.css({ opacity: "0.4" });
                },
                complete: function () {
                    form.css({ opacity: "1.0" });
                },
            });
        }
    });

    // add books to database

    loadResults();
});

function clearform() {
    $("#kategori").val("");
}
