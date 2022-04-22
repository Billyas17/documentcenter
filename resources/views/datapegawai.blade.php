@extends('layouts.admin')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pegawai</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
        <a href="/tambahpegawai" class="btn btn-success">Tambah +</a>


        <div class="row g-3 align-items-center mt-2">
            <div class="col-auto">
                <form action="/pegawai" method="GET">
              <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
                </form>
            </div>
            <div class="col-auto">
                <a href="/exportpdf" class="btn btn-info">Export PDF</a>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-warning">List</a>
            </div>
            <div class="col-auto">
                <a href="/" class="btn btn-secondary">Back</a>
            </div>


          </div>

        <div class="row">
            @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
               {{$message}}
              </div>
              @endif
            <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $index => $row )
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem()}}</th>
                        <td>{{ $row->name}}</td>
                        <td>{{ $row->keterangan}}</td>
                        <td>{{ $row->created_at}}</td>
                        <td>
                            <a href="#" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>                            </a>
                            <a href="/tampilkandata/{{$row->id}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                            <a href="/delete/{{$row->id}}" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </td>
                      </tr>
                    @endforeach


                </tbody>
              </table>
              {{ $data->links() }}
        </div>
    </div>
</div>


</div>

</div>

@endsection












