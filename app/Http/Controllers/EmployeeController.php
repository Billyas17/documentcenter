<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Illuminate\Http\Request;
use PDF;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = Employee::paginate(5);
        }

        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai()
    {
        return view('tambahdata');
    }

    public function insertdata(Request $request)
    {
        //dd($request->all());
        $data = Employee::create($request->all());
        if ($request->hasfile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilkandata($id)
    {
        $data = Employee::find($id);
        //dd($data);
        return view('tampildata', compact('data'));
    }

    // //public function show(Request $request ,$id){
    //     $data = Employee::find($id);
    //     $data->
    // }

    public function updatedata(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());
        return redirect()->route('pegawai')->with('success', 'Data Berhasil DiUpdate');
    }

    public function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success', 'Data Berhasil DiHapus');
    }

    public function exportpdf()
    {
        $data = Employee::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('data.pdf');
    }

    // public function proses_upload(Request $request)
    // {
    //     $this->validate($request, [
    //         'file' => 'required|file|mimes:xlsx,pdf,doc,jpeg,png,jpg|max:2048',
    //         'keterangan' => 'required',
    //     ]);

    //     // menyimpan data file yang diupload ke variabel $file
    //     $file = $request->file('file');

    //     $nama_file = time() . "_" . $file->getClientOriginalName();

    //     // nama file
    //     'File Name: ' . $file->getClientOriginalName();
    //     '<br>';

    //     // ekstensi file
    //     'File Extension: ' . $file->getClientOriginalExtension();
    //     '<br>';

    //     // real path
    //     'File Real Path: ' . $file->getRealPath();
    //     '<br>';

    //     // ukuran file
    //     'File Size: ' . $file->getSize();
    //     '<br>';

    //     // tipe mime
    //     'File Mime Type: ' . $file->getMimeType();

    //     // isi dengan nama folder tempat kemana file diupload
    //     $tujuan_upload = 'data_file';
    //     $file->move($tujuan_upload, $nama_file);


    //     Gambar::create([
    //         'file' => $nama_file,
    //         'keterangan' => $request->keterangan,
    //     ]);

    //     return redirect()->back();

    //     // upload file
    //     $file->move($tujuan_upload, $file->getClientOriginalName());
    // }
}
