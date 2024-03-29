function loadSearchedBooks(string) {
    var url = "/books/" + string;

    var table = $("#book-results"),
        table_parent_div = table.parents("table"),
        default_tpl = _.template($("#search_book").html());

    table_parent_div.show();

    $.ajax({
        url: url,
        success: function (data) {
            if ($.isEmptyObject(data)) {
                table.html(
                    '<tr><td colspan="99">No such books found in library</td></tr>'
                );
            } else {
                table.html("");
                for (var books in data) {
                    var book = data[books];
                    book.status_buku =
                        book.available > 0 ? "Available" : "Not Available";
                    buku.kategori = buku.kategori.nama_kategori;
                    table.append(default_tpl(book));
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

function findBorrowedBook($peminjamanID) {
    var url = "/find-borrowed-book/" + $peminjamanID;
    var module_box = $("#module-body-results");

    var default_tpl = _.template($("#search_issue").html());

    module_box.html("");

    $.ajax({
        url: url,
        success: function (data) {
            module_box.append(default_tpl(data));
        },
        error: function (xhr, _status, error) {
            var err = eval("(" + xhr.responseText + ")");
            module_box.prepend(
                templates.alert_box({
                    type: "danger",
                    message: err.error.message,
                })
            );
        },
        beforeSend: function () {
            table.css({ opacity: 0.4 });
        },
        complete: function () {
            table.css({ opacity: 1.0 });
        },
    });
}

function showFormModule(formid) {
    var form = $("body").find("#" + formid),
        module = form.parents(".module");
    parent_div = module.parents(".content");

    parent_div.children(".module").hide();
    module.show();
}

$(document).ready(function () {
    $(".homepage-form-box").click(function () {
        var formid = $(this).attr("id");

        formid = formid.substring(0, formid.length - 3) + "form";
        showFormModule(formid);
    });
});

// Tambahkan fungsi pencarian anggota
function searchAnggotaByNumber(nomorAnggota) {
    var url = "/cari-anggota/" + nomorAnggota;

    var table = $("#anggota_perpustakaan-results"), // Ganti dengan id yang sesuai pada halaman Anda
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
                var searched_book = form.find("input").val(),
                    module_box = form
                        .parents(".module")
                        .find("#module-body-results");

                if (searched_book != "")
                    findBorrowedBook(searched_book, module_box);
                break;

            case "anggota":
                var search_query = form.find("textarea").val();
                if (search_query != "") searchAnggotaByNumber(search_query);
                break;
        }
    });
});

function showBookDetail(button) {
    var bookId = $(button).data("id");
    // Redirect to the detail page using the bookId
    window.location.href = "/books/" + bookId + "/detail";
}
