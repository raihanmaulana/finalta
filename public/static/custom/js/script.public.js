function loadSearchedBooks(judulBuku) {
    var url = "/cari-buku/" + encodeURIComponent(judulBuku);

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
    window.location.href = "/books/" + bookId + "/detail";
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

function searchAnggotaByNumber(nomorAnggota) {
    var url = "/cari-anggota/" + nomorAnggota;

    var table = $("#anggota_perpustakaan-results"),
        table_parent_div = table.parents("table"),
        default_tpl = _.template($("#search_anggota").html());

    table_parent_div.show();

    $.ajax({
        url: url,
        success: function (data) {
            if ($.isEmptyObject(data)) {
                table.html(
                    '<tr><td colspan="99">No such anggota found in library</td></tr>'
                );
            } else {
                table.html("");
                for (var anggotas in data) {
                    var anggota = data[anggotas];
                    table.append(default_tpl(anggota));
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

function showAnggota(button) {
    var idAnggota = $(button).data("id");
    window.location.href = "/list-anggota/" + idAnggota;
}

$(document).ready(function () {
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
    });
    $(".close-form").click(function () {
        var form = $(this).parents(".module").find("form");
        form.trigger("reset"); // Mengosongkan formulir
        $(this).parents(".module").hide(); // Menyembunyikan modul
    });
});

function showFormModule(formid) {
    var form = $("body").find("#" + formid),
        module = form.parents(".module");
    parent_div = module.parents(".content");

    parent_div.children(".module").hide();
    module.show();
}
