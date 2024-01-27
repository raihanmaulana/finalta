<div class="" style="background:#025E9B; color:#fff">
    <center>Book Details</center>
</div>
<dl class="dl-horizontal">
    <dt>Nomor buku</dt>
    <dd><%= obj.nomor_buku %></dd>
    <dt>Author</dt>
    <dd><%= obj.judul_buku %></dd>
    <dt>Book Category</dt>
    <dd><%= obj.nomor_anggota %></dd>
    <dt>Available Status</dt>
    <dd><%= obj.created_at %></dd>
    <dt>Date of addition</dt>
    <dd><%= obj.status %></dd>
</dl>

<%
    if(obj.hasOwnProperty('anggota')){
%>
<div class="" style="background:#025E9B; color:#fff">
    <center>Student Details</center>
</div>
<dl class="dl-horizontal">
    <dt>Student ID</dt>
    <dd><%= obj.student.student_id %></dd>
    <dt>Student Name</dt>
    <dd><%= obj.student.first_name %> <%= obj.student.last_name %></dd>
    <dt>Student Category</dt>
    <dd><%= obj.student.category %></dd>
    <dt>Roll Number</dt>
    <dd><%= obj.student.roll_num %></dd>
</dl>
<%
    }
%>