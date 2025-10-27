<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class QrCodeController extends Controller
{
    public function show($token)
    {
        $url = route('siswa.add', ['token' => $token]);

        // Generate QR code PNG langsung
        $qrContent = QrCode::format('png')->size(300)->generate($url);

        $filename = 'qrcode_preview_' . Str::random(8) . '.png';
        Storage::put('public/qrcodes/' . $filename, $qrContent);

        // Buat preview base64
        $qrBase64 = 'data:image/png;base64,' . base64_encode($qrContent);

        return view('qrcode', [
            'qrPath' => 'storage/qrcodes/' . $filename,
            'url' => $url,
            'qrCode' => "<img src='{$qrBase64}' class='mx-auto' alt='QR Code'>"
        ]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $link = $request->input('link');

        $filename = 'qrcode_' . Str::random(10) . '.png';
        $qrPath = storage_path('app/public/qrcodes/' . $filename);

        // Generate QR code dasar PNG
        $qrContent = QrCode::format('png')->size(300)->generate($link);
        file_put_contents($qrPath, $qrContent);

        // Jika ada logo, gabungkan dengan GD Library
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoPath = $logoFile->getPathName();

            $qrImage = imagecreatefromstring($qrContent);
            $logoImage = imagecreatefromstring(file_get_contents($logoPath));

            $qrWidth = imagesx($qrImage);
            $qrHeight = imagesy($qrImage);
            $logoWidth = imagesx($logoImage);
            $logoHeight = imagesy($logoImage);

            // Skala logo menjadi 25% dari lebar QR
            $newLogoWidth = $qrWidth * 0.25;
            $scale = $newLogoWidth / $logoWidth;
            $newLogoHeight = $logoHeight * $scale;

            // Posisi logo di tengah QR
            $dstX = ($qrWidth - $newLogoWidth) / 2;
            $dstY = ($qrHeight - $newLogoHeight) / 2;

            imagecopyresampled(
                $qrImage,
                $logoImage,
                $dstX,
                $dstY,
                0,
                0,
                $newLogoWidth,
                $newLogoHeight,
                $logoWidth,
                $logoHeight
            );

            // Simpan hasil akhir ke storage
            imagepng($qrImage, $qrPath);

            imagedestroy($qrImage);
            imagedestroy($logoImage);
        }

        // Buat preview base64
        $qrBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($qrPath));

        return back()->with([
            'success' => 'QR Code berhasil dibuat!',
            'link' => $link,
            'qrPath' => 'storage/qrcodes/' . $filename,
            'qrCode' => "<img src='{$qrBase64}' class='mx-auto' alt='QR Code'>"
        ]);
    }

    /**
     * Download QR Code dari storage
     */
    public function download($filename)
    {
        $filePath = storage_path('app/public/qrcodes/' . $filename);

        if (!file_exists($filePath)) {
            return back()->withErrors('File QR Code tidak ditemukan.');
        }

        return response()->download($filePath, $filename, [
            'Content-Type' => 'image/png'
        ]);
    }
}
