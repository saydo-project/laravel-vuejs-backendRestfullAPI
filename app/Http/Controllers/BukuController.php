<?php

namespace App\Http\Controllers;

use App\Models\buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get data from table buku
        $buku = buku::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Buku',
            'data'    => $buku  
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'judul_buku'        => 'required',
            'author'            => 'required',
            'sinopsis'          => 'required',
            'tanggal_terbit'    => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $buku = buku::create([
            'judul_buku'     => $request->judul_buku,
            'author'         => $request->author,
            'sinopsis'       => $request->sinopsis,
            'tanggal_terbit' => $request->tanggal_terbit
        ]);

        //success save to database
        if($buku) {

            return response()->json([
                'success' => true,
                'message' => 'Data Buku Telah Ditambah',
                'data'    => $buku  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success'   => false,
            'message'   => 'Data Buku Gagal Ditambah',
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find buku by ID
        $buku = buku::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Buku',
            'data'    => $buku 
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, buku $buku)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'judul_buku'        => 'required',
            'author'            => 'required',
            'sinopsis'          => 'required',
            'tanggal_terbit'    => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find buku by ID
        $buku = buku::findOrFail($buku->id);

        if($buku) {

            //update buku
            $buku->update([
                'judul_buku'     => $request->judul_buku,
                'author'         => $request->author,
                'sinopsis'       => $request->sinopsis,
                'tanggal_terbit' => $request->tanggal_terbit
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Buku Terupdate',
                'data'    => $buku  
            ], 200);
        }

        //data buku not found
        return response()->json([
            'success' => false,
            'message' => 'Data Buku Tidak Ditemukan!',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find buku by ID
        $buku = buku::findOrfail($id);

        if($buku) {

            //delete buku
            $buku->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Buku Terhapus!',
            ], 200);

        }

        //data buku not found
        return response()->json([
            'success' => false,
            'message' => 'Data Buku Tidak Ditemukan!',
        ], 404);
    }
}
