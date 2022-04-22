<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Yajra\DataTables;
use App\gambar;
use File;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables;

class UploadController extends Controller
{
    public function upload()
    {
        $gambar = gambar::get();
        return view('upload.upload', ['gambar' => $gambar]);
    }

    public function index()
    {
        // mengambil data dari table pegawai
        $gambar = DB::table('gambars')->paginate(1);

        // mengirim data pegawai ke view index
        return view('index', ['gambars' => $gambar]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:xlsx,pdf,doc,jpeg,png,jpg|max:2048',
            'keterangan' => 'required',
        ]);
        $model = gambar::create($request->all());
        return $model;
    }

    public function show($id)
    {
        $model = gambar::findOrFail($id);
        return view('data.show', compact('model'));
    }



    public function proses_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|mimes:xlsx,pdf,doc,jpeg,png,jpg|max:2048',
            'keterangan' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        // nama file
        'File Name: ' . $file->getClientOriginalName();
        '<br>';

        // ekstensi file
        'File Extension: ' . $file->getClientOriginalExtension();
        '<br>';

        // real path
        'File Real Path: ' . $file->getRealPath();
        '<br>';

        // ukuran file
        'File Size: ' . $file->getSize();
        '<br>';

        // tipe mime
        'File Mime Type: ' . $file->getMimeType();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload, $nama_file);


        Gambar::create([
            'file' => $nama_file,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back();

        // upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());
    }

    public function hapus($id)
    {
        // hapus file
        $gambar = Gambar::where('id', $id)->first();
        File::delete('data_file/' . $gambar->file);

        // hapus data
        Gambar::where('id', $id)->delete();

        return redirect()->back();
    }
    public function dataTable()
    {
        $model = User::all();
        return DataTables::of($model)
            ->addColumn('action', function ($model) {
                return view('upload._action', [
                    'model' => $model,
                    'url_show' => route('gambars.show', $model->email),
                    'url_edit' => route('gambars.edit', $model->email),
                    'url_destroy' => route('gambars.destroy', $model->email)

                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }
}
