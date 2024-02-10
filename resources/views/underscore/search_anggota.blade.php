<tr>

    <td><%= obj.nama_anggota %></td>
    <td><%= obj.nomor_anggota %></td>
    <td><%= obj.email %></td>
    <td><%= obj.jurusan %></td>
    <td><%= obj.kelas %></td>
    <td>
        <button class="btn btn-info btn-detail" data-id="<%= obj.id_anggota %>" onclick="showAnggota(this)">Detail</button>
    </td>
</tr>