<tr>
	<td><%= obj.id_buku %></td>
	<td><%= obj.isbn %></td>
	<td><%= obj.judul_buku %></td>
	<td><%= obj.pengarang %></td>
	<td><%= obj.tahun_terbit %></td>
	<td><%= obj.kategori %></td>
	<td><a class="btn btn-success"><%= obj.stok %></a></td>
	<td><a class="btn btn-warning"><%= obj.tersedia %></td>
	<td>
		<button class="btn btn-info btn-detail" data-id="<%= obj.id_buku %>" onclick="showBookDetail(this)">Detail</button>
	</td>
</tr>