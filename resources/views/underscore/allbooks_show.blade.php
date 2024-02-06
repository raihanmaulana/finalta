<tr>
    <td><%= obj.id_buku %></td>
    <td class="hide-on-small"><%= obj.nomor_buku %></td>
    <td><%= obj.judul_buku %></td>
    <td class="hide-on-small"><%= obj.penerbit %></td>
    <td class="hide-on-small"><%= obj.pengarang %></td>
    <td class="hide-on-small"><%= obj.tahun_terbit %></td>
    <td class="hide-on-small"><%= obj.kategori %></td>
    <td class="hide-on-small"><a class="btn btn-warning"><%= obj.stok %></a></td>

    <td><a class="btn btn-success"><%= obj.available %></a></td>
    <td>
        <div class="center-block" style="display: flex;
        flex-direction: column;
        align-items: center;">
            <button class="btn btn-primary btn-sm" style="margin-bottom: 2px; width: 60px;" data-id="<%= obj.id_buku %>" onclick="editBook(this)">Edit</button>
            <button class="btn btn-info btn-sm" style="margin-bottom: 2px; width: 60px;" data-id="<%= obj.id_buku %>" onclick="showBookDetail(this)">Detail</button>
            <button class="btn btn-danger btn-sm" style="width: 60px;" data-id="<%= obj.id_buku %>" onclick="destroyBook(this)">Hapus</button>
        </div>
    </td>
</tr>