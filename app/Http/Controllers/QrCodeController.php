<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show($token)
    {
        // Buat URL pendaftaran dengan token
        $url = route('siswa.add', ['token' => $token]);

        // Generate QR Code SVG
        $qrCode = QrCode::size(250)->generate($url);

        return view('qrcode', compact('qrCode', 'url'));
    }
}
