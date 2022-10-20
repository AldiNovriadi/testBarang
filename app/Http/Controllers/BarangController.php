<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return view('crudDashboard.index', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all();
        return view('crudDashboard.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'fotoBarang' => 'required|mimes:jpg,png|file|max:100',
            'namaBarang' => 'required|unique:barangs',
            'hargaBeli' => 'required',
            'hargaJual' => 'required',
            'stok' => 'required'
        ]);

        if (!$validation){
            return redirect('/create');
        }

        $data = Barang::create($request->all());
        if ($request->hasFile('fotoBarang')){
            $request->file('fotoBarang')->move('gambarBarang/', $request->file('fotoBarang')->getClientOriginalName());
            $data->fotoBarang = $request->file('fotoBarang')->getClientOriginalName();
            $data->save();
        }
        return redirect('/dashboard')->with('success', 'Data Barang berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('crudDashboard.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        $validation = $request->validate([
            'fotoBarang' => 'mimes:jpg,png|file|max:100',
            'namaBarang' => 'required|unique:barangs',
            'hargaBeli' => 'required',
            'hargaJual' => 'required',
            'stok' => 'required'
        ]);

        if (!$validation){
            return redirect('/create');
        }

        $editBarang = $barang->fotoBarang;
        if (is_uploaded_file($editBarang)){
            $data = [
                'fotoBarang' => $editBarang,
                'namaBarang' => $request['namaBarang'],
                'hargaBeli' => $request['hargaBeli'],
                'hargaJual' => $request['hargaJual'],
                'stok' => $request['stok']
            ];
            $request->fotoBarang->move(public_path().'/gambarBarang', $editBarang);
        } else {
            $data = [
                'namaBarang' => $request['namaBarang'],
                'hargaBeli' => $request['hargaBeli'],
                'hargaJual' => $request['hargaJual'],
                'stok' => $request['stok']
            ];

        }
        
        $barang->update($data);
        return redirect('/dashboard')->with('success', 'Data Barang berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect('/dashboard')->with('success', 'Data Barang berhasil dihapus');
    }
}
