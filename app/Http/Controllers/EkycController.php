<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EkycRegistration;
use Illuminate\Support\Facades\Auth;

class EkycController extends Controller
{
    //
    public function step1()
    {
        // ambil data draft user jika ada
    $ekyc = EkycRegistration::where('user_id', Auth::id())
        ->where('status', 'draft')
        ->first();

        // simpan session agar data draft bisa diakses di step berikutnya
        if ($ekyc) {
            session(['ekyc_id' => $ekyc->id]);
        }

        return view('ekyc.step1', compact('ekyc'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:500',
        ]);

            // buat data draft baru
            $ekyc = EkycRegistration::updateOrCreate(
            [
                'id' => session('ekyc_id'),
                'user_id' => Auth::id(),
            ],
            [
                'name' => $request->name,
                'nik' => $request->nik,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                // provide safe defaults for file columns because the migration had typos
                // (e.g. 'nulable' instead of 'nullable') so the DB may require a value
                'file_ktp' => $request->input('file_ktp', ''),
                'file_kk' => $request->input('file_kk', ''),
                'file_ijazah' => $request->input('file_ijazah', ''),
                'file_selfie' => $request->input('file_selfie', ''),
                'status' => 'draft',
            ]
            );

            // simpan id draft di session
        session(['ekyc_id' => $ekyc->id]);

        return redirect()->route('ekyc.step2');
    }

}
