@extends('layouts.default')
@section('content')
    <section class="content">
        <div class="row">
            <!-- left column -->

            <div class="col-md-4">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
            @endif
            <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Register</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {{ Form::open(array('url' => 'home/post', 'method' => 'post', 'id' => 'form-input')) }}
                    {{--<form role="form">--}}
                    <div class="box-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" id="nama" class="form-control" name="nama" placeholder="Masukan Nama Anda">
                        </div>
                        <div class="form-group">
                            <label>No Telpon</label>
                            <input type="text" id="no_telp" class="form-control" name="no_telp"
                                   placeholder="Masukan Nomor Telpon Anda">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Masukan Email Anda">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" id="keterangan" class="form-control" name="keterangan" placeholder="Masukan Keterangan">
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" id="btn-reset" class="btn btn-danger">Reset</button>
                    </div>
                    {{--</form>--}}
                    {{ Form::close() }}
                </div>
            </div>


            <div class="col-md-8">
                <!-- general form elements -->

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Data Peserta <select name="keterangan" id="cbo-keterangan"><option value="Hadir">Hadir</option><option value="Tidak Hadir">Tidak Hadir</option><option value="Semua">Semua</option></select> </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No Hp</th>
                                <th>Email</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php(
                            $a=1
                            )
                            @foreach ($Register as $r)
                                <tr>
                                    <td>{{$a++}}</td>
                                    <td>{{$r->nama}}</td>
                                    <td>{{$r->no_telp}}</td>
                                    <td>{{$r->email}}</td>
                                    <td>{{$r->keterangan}}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm btn-edit" data-id="{{ $r->id }}">Edit</a>
                                        <a href="{{ url('/hapus/' . $r->id) }}" class="btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

        <!-- /.row -->
    </section>
@stop