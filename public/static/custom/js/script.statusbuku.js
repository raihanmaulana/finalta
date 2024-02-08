function filterBooks() {
    var input,
        filter,
        table,
        tr,
        td,
        i,
        txtValue,
        selectedCategory,
        selectedYear;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("buku-tidak-aktif");
    tr = table.getElementsByTagName("tr");
    selectedCategory = document
        .getElementById("kategoriFilter")
        .value.toUpperCase();
    selectedYear = document.getElementById("tahunFilter").value;

    var found = false;
    var noResultRow = document.getElementById("noResultRow");

    function shouldDisplayRow(
        txtValueTitle,
        txtValueNumber,
        txtValuePengarang,
        txtValueCategory,
        txtValueYear
    ) {
        return (
            (txtValueTitle.toUpperCase().indexOf(filter) > -1 ||
                txtValueNumber.toUpperCase().indexOf(filter) > -1 ||
                txtValuePengarang.toUpperCase().indexOf(filter) > -1) &&
            (selectedCategory === "ALL" ||
                txtValueCategory.toUpperCase().indexOf(selectedCategory) >
                    -1) &&
            (selectedYear === "ALL" || txtValueYear === selectedYear)
        );
    }

    for (i = 0; i < tr.length; i++) {
        tdPengarang = tr[i].getElementsByTagName("td")[5];
        tdTitle = tr[i].getElementsByTagName("td")[3];
        tdNumber = tr[i].getElementsByTagName("td")[2];
        tdCategory = tr[i].getElementsByTagName("td")[7];
        tdYear = tr[i].getElementsByTagName("td")[6];

        if (tdTitle || tdNumber || tdPengarang || tdCategory || tdYear) {
            txtValuePengarang =
                tdPengarang.textContent || tdPengarang.innerText;
            txtValueTitle = tdTitle.textContent || tdTitle.innerText;
            txtValueNumber = tdNumber.textContent || tdNumber.innerText;
            txtValueCategory = tdCategory.textContent || tdCategory.innerText;
            txtValueYear = tdYear.textContent || tdYear.innerText;

            if (
                shouldDisplayRow(
                    txtValueTitle,
                    txtValueNumber,
                    txtValuePengarang,
                    txtValueCategory,
                    txtValueYear
                )
            ) {
                tr[i].style.display = "";
                found = true;
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    if (!found && !noResultRow) {
        noResultRow = document.createElement("tr");
        noResultRow.id = "noResultRow";
        var noResultCell = document.createElement("td");
        noResultCell.setAttribute("colspan", "8");
        noResultCell.textContent = "Tidak ada buku dengan kriteria tersebut";
        noResultRow.appendChild(noResultCell);
        table.appendChild(noResultRow);
    } else if (found && noResultRow) {
        table.removeChild(noResultRow);
    }
}

function searchBooks() {
    filterBooks();
}

function categoryHasBook(category) {
    var table = document.getElementById("buku-tidak-aktif");
    var tr = table.getElementsByTagName("tr");
    var found = false;
    var selectedCategory = category.toUpperCase();

    for (var i = 0; i < tr.length; i++) {
        var tdCategory = tr[i].getElementsByTagName("td")[6];
        var txtValueCategory = tdCategory.textContent || tdCategory.innerText;

        if (txtValueCategory.toUpperCase().indexOf(selectedCategory) > -1) {
            found = true;
            break;
        }
    }

    return found;
}

document
    .getElementById("kategoriFilter")
    .addEventListener("change", function () {
        var selectedCategory = this.value;
        if (selectedCategory === "ALL" || categoryHasBook(selectedCategory)) {
            filterBooks();
        } else {
            var table = document.getElementById("buku-tidak-aktif");
            var tbody = table.getElementsByTagName("tbody")[0];
            tbody.innerHTML = ""; // Clear table body
            var noResultRow = document.createElement("tr");
            var noResultCell = document.createElement("td");
            noResultCell.setAttribute("colspan", "8");
            noResultCell.textContent = "Tidak ada buku dalam kategori ini";
            noResultRow.appendChild(noResultCell);
            tbody.appendChild(noResultRow);
        }
    });
