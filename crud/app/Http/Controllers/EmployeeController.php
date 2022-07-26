<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Employee;
use PDF;

class EmployeeController extends Controller
{
    //
    public function index(Request $req) {
        if ($req->has('seacrh')){
            $data = Employee::where('nama', 'LIKE', '%' .$req->search. '%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Employee::paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }
        
        return view('pegawai', compact('data'));
    }

    public function tambah() {
        return view('crud.tambah');
    }

    public function postpegawai(Request $req) {
        $data = Employee::create($req->all());
        if($req->hasFile('foto')) {
            $req->file('foto')->move('fotopegawai/', $req->file('foto')->getClientOriginalName());
            $data->foto = $req->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampildata($id) {
        $data = Employee::find($id);
        return view('crud.edit', compact('data'));
    }

    public function updatedata(Request $req, $id) {
        $data = Employee::find($id);
        $data->update($req->all());
        if(session('halaman_url')) {
            return redirect(session('halaman_url'))->with('success', 'Data Berhasil Diupdate');
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id) {
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Dihapus');
    }

    public function exportpdf() {
        $data = Employee::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('crud.datapegawai_pdf');
        return $pdf->download('data.pdf');
    }
}
