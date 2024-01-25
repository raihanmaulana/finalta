<tr>
	<td><%= obj.id_buku %></td>
	<td><%= obj.nomor_buku %></td>
	<td><%= obj.judul_buku %></td>
	<!-- <td><%= obj.penerbit %></td> -->
	<td><%= obj.pengarang %></td>
	<td><%= obj.tahun_terbit %></td>
	<td><%= obj.kategori %></td>
	<td><a class="btn btn-success"><%= obj.stok %></a></td>
	<td><%= obj.status_buku %></td> <!-- Kolom Status -->
	<td>
		<button class="btn btn-info btn-detail" data-id="<%= obj.id_buku %>" onclick="showBookDetail(this)">Detail</button>
	</td>
</tr>