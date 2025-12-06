<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class QrCodeController extends Controller
{
    public function generate(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $link = $request->input('link');
        $filename = 'qrcode_' . Str::random(10) . '.png';
        $qrPath = storage_path('app/public/qrcodes/' . $filename);

        // === GENERATE QR CODE HITAM PUTIH ===
        $qrContent = QrCode::format('png')
            ->size(500)
            ->margin(2)
            ->errorCorrection('H')
            ->generate($link);

        file_put_contents($qrPath, $qrContent);

        // === TAMBAHKAN LOGO ===
        if ($request->hasFile('logo')) {

            $logoFile = $request->file('logo');
            $logoPath = $logoFile->getPathName();

            // --- KONVERSI JPG -> PNG (supaya ada transparansi) ---
            $ext = $logoFile->getClientOriginalExtension();
            if ($ext === 'jpg' || $ext === 'jpeg') {
                $jpegImg = imagecreatefromjpeg($logoPath);
                $pngTemp = storage_path('app/temp_logo_' . time() . '.png');
                imagepng($jpegImg, $pngTemp);
                imagedestroy($jpegImg);
                $logoPath = $pngTemp;
            }

            // Buka QR dan logo
            $qrImage = imagecreatefrompng($qrPath);
            $logoImage = imagecreatefrompng($logoPath);

            $qrWidth = imagesx($qrImage);
            $qrHeight = imagesy($qrImage);

            // === FIX PENTING: KONVERSI QR KE TRUECOLOR AGAR LOGO TIDAK HITAM PUTIH ===
            $true = imagecreatetruecolor($qrWidth, $qrHeight);
            imagealphablending($true, true);
            imagesavealpha($true, true);
            imagecopy($true, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);

            $qrImage = $true;

            // Hitung ukuran logo
            $logoWidth = imagesx($logoImage);
            $logoHeight = imagesy($logoImage);

            $newLogoWidth = $qrWidth * 0.50;
            $scale = $newLogoWidth / $logoWidth;
            $newLogoHeight = $logoHeight * $scale;

            $dstX = ($qrWidth - $newLogoWidth) / 2;
            $dstY = ($qrHeight - $newLogoHeight) / 2;

            // Tempel logo
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

            // Simpan
            imagepng($qrImage, $qrPath);

            // Bersihkan memory
            imagedestroy($qrImage);
            imagedestroy($logoImage);
        }

        // Preview base64
        $qrBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($qrPath));

        return back()->with([
            'success' => 'QR Code berhasil dibuat!',
            'link' => $link,
            'qrPath' => 'storage/qrcodes/' . $filename,
            'qrCode' => "<img src='{$qrBase64}' class='mx-auto' alt='QR Code'>"
        ]);
    }

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
