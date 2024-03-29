function loadSearchedBooks(judulBuku) {
    var url = "/offline/cari-buku/" + encodeURIComponent(judulBuku);

    var table = $("#buku-results"),
        table_parent_div = table.parents("table"),
        default_tpl = _.template($("#caribuku_offline").html());

    table_parent_div.show();

    $.ajax({
        url: url,
        success: function (data) {
            if ($.isEmptyObject(data)) {
                table.html(
                    '<tr><td colspan="99">No such book found in library</td></tr>'
                );
            } else {
                table.html("");
                for (var bukus in data) {
                    var buku = data[bukus];
                    table.append(default_tpl(buku));
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

function showBookDetail(button) {
    var bookId = $(button).data("id");
    // Redirect to the detail page using the bookId
    window.location.href = "/offline/cari-buku/" + bookId + "/detail";
}

function findBorrowedBook(nomorBuku) {
    var url = "/find-issued-book/" + nomorBuku;

    var table = $("#issue-results"),
        table_parent_div = table.parents("table"),
        default_tpl = _.template($("#search_issue").html());

    table_parent_div.show();

    $.ajax({
        url: url,
        success: function (data) {
            console.log("Data diterima:", data); // Tambahkan pesan debug untuk melihat data yang diterima
            if ($.isEmptyObject(data)) {
                table.html(
                    '<tr><td colspan="3">No issued book found with this number</td></tr>'
                );
            } else {
                table.html("");
                for (var i = 0; i < data.length; i++) {
                    var issuedBook = data[i];

                    if (issuedBook.status !== null) {
                        statusText =
                            issuedBook.status === 0
                                ? "Belum Disetujui"
                                : "Sudah Disetujui";
                        statusClass =
                            issuedBook.status === 0
                                ? "badge-warning"
                                : "badge-success";
                    }

                    issuedBook.statusText = statusText;
                    issuedBook.statusClass = statusClass;

                    var row = default_tpl(issuedBook);
                    table.append(row);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", xhr.responseText); // Tambahkan pesan debug untuk melihat pesan error
        },
        beforeSend: function () {
            table.css({ opacity: 0.4 });
        },
        complete: function () {
            table.css({ opacity: 1.0 });
        },
    });
}

function showAnggota(button) {
    var idAnggota = $(button).data("id");
    window.location.href = "/list-anggota/" + idAnggota;
}

$(document).ready(function () {
    var formOpen = localStorage.getItem("formOpen"); // Ambil status terakhir formulir dari localStorage
    if (formOpen === "true") {
        $("#pinjambukuform").parent().show(); // Tampilkan formulir jika terakhir kali terbuka
    }

    $(".homepage-form-box").click(function () {
        var formid = $(this).attr("id");
        formid = formid.substring(0, formid.length - 3) + "form";
        showFormModule(formid);
    });

    $(".homepage-form-submit").click(function () {
        var form = $(this).parents("form");
        mode = form.attr("id");
        mode = mode.substring(4, mode.length - 4);

        switch (mode) {
            case "book":
                var search_query = form.find("textarea").val();
                if (search_query != "") loadSearchedBooks(search_query);
                break;

            case "issue":
                var search_query = form.find("textarea").val();
                if (search_query != "") findBorrowedBook(search_query);
                break;

            case "anggota":
                var search_query = form.find("textarea").val();
                if (search_query != "") searchAnggotaByNumber(search_query);
                break;
        }

        // Simpan status terakhir formulir ke localStorage
        localStorage.setItem("formOpen", "true");

        // Periksa apakah tombol submit mengarah ke formulir pinjam buku
        if (mode === "pinjam") {
            form.parent().show(); // Tampilkan formulir setelah melakukan peminjaman
        }
    });

    $(".close-form").click(function () {
        var form = $(this).parents(".module").find("form");
        form.trigger("reset"); // Mengosongkan formulir
        $(this).parents(".module").hide(); // Menyembunyikan modul

        // Simpan status terakhir formulir ke localStorage
        localStorage.setItem("formOpen", "false");
    });
});

function showFormModule(formid) {
    var form = $("body").find("#" + formid),
        module = form.parents(".module");
    parent_div = module.parents(".content");

    parent_div.children(".module").hide();
    module.show();
}

document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("bukutamuform")
        .addEventListener("submit", function (event) {
            event.preventDefault(); // Mencegah formulir untuk melakukan submit secara default

            // Kirim permintaan AJAX untuk menyimpan data anggota
            fetch(this.action, {
                method: this.method,
                body: new FormData(this),
            })
                .then((response) => response.json()) // Ubah respons menjadi objek JSON
                .then((data) => {
                    if (data.success) {
                        // Jika permintaan berhasil, tampilkan pesan berhasil
                        Swal.fire({
                            title: "Berhasil!",
                            text: data.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000, // Waktu tampilan popup dalam milidetik (ms)
                        });
                        // Reset nilai input
                        this.reset();
                    } else {
                        // Jika terjadi kesalahan, tampilkan pesan kesalahan
                        Swal.fire({
                            title: "Gagal!",
                            text: data.message,
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    // Tampilkan pesan kesalahan jika terjadi kesalahan pada permintaan
                    Swal.fire({
                        title: "Gagal!",
                        text: "Nomor Anggota Tidak Terdaftar!",
                        icon: "error",
                        showConfirmButton: true,
                    });
                });
        });
});

// Ambil elemen form
const pinjamForm = document.getElementById("pinjambukuform");

document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("pinjambukuform")
        .addEventListener("submit", function (event) {
            event.preventDefault();

            fetch(this.action, {
                method: this.method,
                body: new FormData(this),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: data.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(() => {
                            // Redirect or do something else after success
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: data.message,
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        title: "Gagal!",
                        text: "Terjadi kesalahan saat memproses permintaan.",
                        icon: "error",
                        showConfirmButton: true,
                    });
                });
        });
});
