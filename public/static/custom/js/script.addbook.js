function loadResults() {
    var url = "/books?kategori_id=" + $("#kategori_fill").val();
    var table = $("#all-books");
    var default_tpl = _.template($("#allbooks_show").html());

    $.ajax({
        url: url,
        success: function (data) {
            console.log(data);
            if ($.isEmptyObject(data)) {
                table.html(
                    '<tr><td colspan="99">No Books in this category</td></tr>'
                );
            } else {
                table.html("");
                for (var buku in data) {
                    table.append(default_tpl(data[buku]));
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
        var url = "/bookBycategory/" + $("#kategori_fill").val();
        var table = $("#all-books");
        var default_tpl = _.template($("#allbooks_show").html());

        $.ajax({
            url: url,
            success: function (data) {
                console.log(data);
                if ($.isEmptyObject(data)) {
                    table.html(
                        '<tr><td colspan="99">No Books in this category</td></tr>'
                    );
                } else {
                    table.html("");
                    for (var buku in data) {
                        table.append(default_tpl(data[buku]));
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
    });

    $(document).on("click", "#addbooks", function () {
        var form = $(this).parents("form"),
            module_body = $(this).parents(".module-body"),
            sendJSON = {},
            send_flag = true,
            f$ = function (selector) {
                return form.find(selector);
            };

        title = f$("input[data-form-field~=title]").val();
        author = f$("input[data-form-field~=author]").val();
        description = f$("textarea[data-form-field~=description]").val();
        category_id = f$("select[data-form-field~=category]").val();
        number = parseInt(f$("input[data-form-field~=number]").val());
        auth_user = f$("input[data-form-field~=auth_user]").val();
        _token = f$("input[data-form-field~=token]").val();

        if (
            title == "" ||
            author == "" ||
            description == "" ||
            number == null
        ) {
            module_body.prepend(
                templates.alert_box({
                    type: "danger",
                    message: "Book Details Not Complete",
                })
            );
            send_flag = false;
        }

        if (send_flag == true) {
            $.ajax({
                type: "POST",
                data: formData,
                processData: false, // Prevent jQuery from processing data
                contentType: false, // Set content type to false as FormData will handle it
                url: "/books",
                success: function (data) {
                    module_body.prepend(
                        templates.alert_box({ type: "success", message: data })
                    );
                    clearform();
                },
                error: function (xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    module_body.prepend(
                        templates.alert_box({
                            type: "danger",
                            message: err.error.message,
                        })
                    );
                },
                beforeSend: function () {
                    form.css({ opacity: "0.4" });
                },
                complete: function () {
                    form.css({ opacity: "1.0" });
                },
            });
        }
    }); // add books to database

    loadResults();
});

function clearform() {
    $("#title").val("");
    $("#author").val("");
    $("#description").val("");
    $("#number").val("");
    $("#category").val("");
}

function editBook(button) {
    var bookId = $(button).data("id");
    // Redirect to the edit page using the bookId
    window.location.href = "/books/" + bookId + "/edit";
}

function showBookDetail(button) {
    var bookId = $(button).data("id");
    // Redirect to the detail page using the bookId
    window.location.href = "/books/" + bookId + "/detail";
}

// Tambahkan fungsi destroyBook
function destroyBook(button) {
    var bookId = $(button).data("id");

    if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: "/all-books/" + bookId + "/delete",
            type: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (result) {
                $(button).closest("tr").remove();
                alert("Buku berhasil dihapus.");
            },
            error: function (error) {
                alert("Gagal menghapus buku. Silakan coba lagi.");
            },
        });
    }
}
