<tr>
    <td><%= obj.id_buku %></td>
    <td><%= obj.nomor_buku %></td>
    <td><%= obj.judul_buku %></td>
    <td><%= obj.penerbit %></td>
    <td><%= obj.pengarang %></td>
    <td><%= obj.tahun_terbit %></td>
    <td><%= obj.kategori %></td>
    <td><a class="btn btn-success"><%= obj.available %></a></td>
    <td><a class="btn btn-inverse"><%= obj.available %></a></td>
    <td>
        <button class="btn btn-primary btn-sm">Edit</button>
        <button class="btn btn-info btn-sm">Detail</button>
        <button class="btn btn-danger btn-sm">Hapus</button>
    </td>
</tr>