<tr>
    <td><%= obj.id_buku %></td>
    <td><%= obj.isbn %></td>
    <td><%= obj.judul_buku %></td>
    <td><%= obj.penerbit %></td>
    <td><%= obj.pengarang %></td>
    <td><%= obj.tahun_terbit %></td>
    <td><%= obj.kategori %></td>
    <td>
        <% if (obj.stok > 0) { %>
        <a class="btn btn-success">Available</a>
        <% } else { %>
        <a class="btn btn-danger">Not Available</a>
        <% } %>
    </td>
    <!-- <td><a class="btn btn-warning"><%= obj.available %></a></td> -->
    <td>
        <img src="<%= obj.image_path %>" alt="Gambar Buku" style="max-width: 900px; max-height: 500px;">
    </td>
    <!-- <td>
        <button class="btn btn-primary btn-sm" data-id="<%= obj.id_buku %>" onclick="editBook(this)">Edit</button>
        <button class="btn btn-info btn-sm" data-id="<%= obj.id_buku %>" onclick="showBookDetail(this)">Detail</button>
        <button class="btn btn-danger btn-sm" data-id="<%= obj.id_buku %>" onclick="destroyBook(this)">Hapus</button>
    </td> -->
</tr>