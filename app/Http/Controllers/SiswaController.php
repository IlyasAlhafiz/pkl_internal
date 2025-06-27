<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $siswa = [
        ['id' => 1, 'nama' => 'Budi', 'kelas' => 'XII RPL 1'],
        ['id' => 2, 'nama' => 'Siti', 'kelas' => 'XII RPL 2'],
    ];

    public function index()
    {
        if (!Session::has('siswa')) {
            Session::put('siswa', $this->siswa);
        }
        $data = Session::get('siswa', []);
        $data2 = "halo";
        return view('siswa.index', compact('data'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
        ]);

        $siswa = Session::get('siswa', []);
        $siswa[] = [
            'id' => count($siswa) + 1,
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
        ];
        Session::put('siswa', $siswa);
        return redirect()->route('siswa.index');
    }

    public function destroy($id)
    {
        $siswa = Session::get('siswa', []);
        $siswa = array_filter($siswa, function ($item) use ($id) {
            return $item['id'] != $id;
        });
        Session::put('siswa', array_values($siswa));
        return redirect()->route('siswa.index');
    }
}