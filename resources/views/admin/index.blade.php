@extends('layouts.admin')
@section('content')
    <div class="span9">
        <div class="content">
            <div class="btn-controls">
                <div class="btn-box-row row-fluid">
                    <div class="btn-box big span4">
                        <i class="icon-check"></i></i><b>65%</b>
                        <p class="text-muted">Gabah Hari Ini</p>
                    </div>
                    <div class="btn-box big span4">
                        <i class="icon-user"></i><b>15</b>
                        <p class="text-muted">Jumlah User</p>
                    </div>
                    <div class="btn-box big span4">
                        <i class="icon-money"></i><b>Rp 7.350.000</b>
                        <p class="text-muted">Transaksi Hari Ini</p>
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
                                <h3>Daftar User</h3>
                            </div>
                            <div class="" style="text-align: right; margin-top: -22px;">
                                <a href="#modaltambah" role="button" class="btn btn-success" data-toggle="modal">Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="module-body table" style="overflow-x: auto;">
                        <table cellpadding="0" cellspacing="0" border="0"
                            class="table table-bordered table-striped display" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Level</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($user_data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td class="center">{{ $item->level === 1 ? 'petugas' : 'admin' }}</td>
                                        <td><a href="#modaledit" role="button" class="btn btn-warning modalUser"
                                                data-toggle="modal" data-id="{{ $item->id }}">Edit</a></td>
                                        <td>
                                            <form action="{{ baseUrl() }}/admin/user/{{ $item->id }}" method="POST">
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
    <!-- Modal Tambah -->
    <div id="modaltambah" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <form action="/admin/user" method="post">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Tambah User</h3>
            </div>
            <div class="modal-body">
                @csrf
                <div class="control-group">
                    <label class="control-label" for="username">Username</label>
                    <div class="controls">
                        <input type="text" name="username" id="username" placeholder="" class="span5">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email</label>
                    <div class="controls">
                        <input type="text" name="email" id="email" placeholder="" class="span5">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="pw">Password</label>
                    <div class="controls">
                        <input type="password" name="password" id="pw" placeholder="" class="span5">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                <button class="btn btn-success" type="submit">Tambah</button>
            </div>
        </form>
    </div>
    <!-- Akhir Modal Tambah -->
    <!-- Modal Edit -->
    <div id="modaledit" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <form action="" method="post" id="editUser">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit User</h3>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label" for="name">Username</label>
                    <div class="controls">
                        <input type="text" id="name" name="name" placeholder="" class="span5">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="eemail">Email</label>
                    <div class="controls">
                        <input type="text" id="eemail" name="eemail" placeholder="" class="span5">
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
    <!--/.wrapper-->

    <script src="{{ asset('') }}document/scripts/myscript.js" type="text/javascript"></script>
@endsection
