@extends('layouts.admin')
@section('content')
    <div class="span9">
        <div class="content">
            <div class="btn-controls">
                <div class="btn-box-row row-fluid">
                    <div class="btn-box big">
                        <i class="icon-user"></i><b>15</b>
                        <p class="text-muted">Jumlah Customer</p>
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>success!</strong> {{ session('success') }}
                    </div>

                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="module">
                    <div class="module-head">
                        <div class="row-fluid">
                            <div class="">
                                <h3>Daftar Customer</h3>
                            </div>
                            <div class="" style="text-align: right; margin-top: -22px">
                                <a href="#modaltambah" role="button" class="btn btn-success" data-toggle="modal">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="module-body table" style="overflow-x: auto;">
                        <table cellpadding="0" cellspacing="0" border="0"
                            class="table table-bordered table-striped display" width="100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No telp</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($customer as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td class="center">{{ $item->no_telp }}</td>
                                        <td><a href="#modaledit" role="button" class="btn btn-warning modalCustomer"
                                                data-id="{{ $item->id_customer }}" data-toggle="modal">Update</a></< /td>
                                        <td>
                                            <form action="{{ baseUrl() }}/admin/customer/{{ $item->id_customer }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/.module-->
            </div>
            <!--/.content-->
        </div>
        <!--/.span9-->
    </div>
    </div>
    <!--/.container-->
    </div>
    <!--/.wrapper-->
    <!-- Modal Edit -->
    <div id="modaledit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <form action="" method="post" id="editCustomer">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Customer</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label" for="nama">Nama Customer</label>
                    <div class="controls">
                        <input type="text" id="nama" name="unama" placeholder="" class="span5">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="alamat">Alamat</label>
                    <div class="controls">
                        <input type="text" id="alamat" name="ualamat" placeholder="" class="span5">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="no">No Telp</label>
                    <div class="controls">
                        <input type="text" id="no" name="uno" placeholder="" class="span5">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                <button class="btn btn-success" type="submit">Simpan</button>
            </div>
        </form>
    </div>
    <!-- Akhir Modal Edit -->
    <!-- Modal Tambah -->
    <div id="modaltambah" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <form action="/admin/customer" method="post">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Tambah Customer</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label" for="nama">Nama Customer</label>
                    <div class="controls">
                        <input type="text" id="nama" name="anama" placeholder="" class="span5">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="alamat">Alamat</label>
                    <div class="controls">
                        <input type="text" id="alamat" name="aalamat" placeholder="" class="span5">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="no">No Telp</label>
                    <div class="controls">
                        <input type="text" id="no" name="ano" placeholder="" class="span5">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                <button class="btn btn-success" type="submit">Tambah</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('document/scripts/customer.js') }}"></script>
    <!-- Akhir Modal Tambah -->
@endsection
