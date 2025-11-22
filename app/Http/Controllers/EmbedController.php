<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmbedController extends Controller
{
    public function index()
    {
        return view('konversiembed');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'url' => 'required|string'
        ]);

        $url = $request->url;
        $embed = $this->convertToEmbed($url);

        return view('konversiembed', compact('url', 'embed'));
    }

    private function convertToEmbed($url)
    {
        // YouTube watch?v=
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $m)) {
            return "https://www.youtube.com/embed/" . $m[1];
        }

        // YouTube youtu.be
        if (preg_match('#youtu\.be/([^?]+)#', $url, $m)) {
            return "https://www.youtube.com/embed/" . $m[1];
        }

        // Vimeo
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $m)) {
            return "https://player.vimeo.com/video/" . $m[1];
        }

        // Dailymotion
        if (preg_match('#dailymotion.com/video/([^_]+)#', $url, $m)) {
            return "https://www.dailymotion.com/embed/video/" . $m[1];
        }

        // Google Drive open?id=
        if (preg_match('/drive\.google\.com\/open\?id=([^&]+)/', $url, $m)) {
            return "https://drive.google.com/file/d/" . $m[1] . "/preview";
        }

        // Google Drive file/d/
        if (preg_match('#drive\.google\.com\/file\/d\/([^/]+)#', $url, $m)) {
            return "https://drive.google.com/file/d/" . $m[1] . "/preview";
        }

        // Scratch Project
        if (preg_match('#scratch\.mit\.edu\/projects\/(\d+)#', $url, $m)) {
            return "https://scratch.mit.edu/projects/" . $m[1] . "/embed";
        }

        // TikTok
        if (preg_match('#tiktok\.com/.*/video/(\d+)#', $url, $m)) {
            return "https://www.tiktok.com/embed/" . $m[1];
        }

        // Instagram
        if (preg_match('#instagram\.com/(p|reel)/([^/]+)/#', $url, $m)) {
            return "https://www.instagram.com/" . $m[1] . "/" . $m[2] . "/embed";
        }

        // Facebook
        if (str_contains($url, 'facebook.com')) {
            return "https://www.facebook.com/plugins/video.php?href=" . urlencode($url);
        }

        // SoundCloud
        if (str_contains($url, 'soundcloud.com')) {
            return "https://w.soundcloud.com/player/?url=" . urlencode($url);
        }

        // Spotify
        if (preg_match('#spotify\.com/(track|album|playlist)/([^?]+)#', $url, $m)) {
            return "https://open.spotify.com/embed/" . $m[1] . "/" . $m[2];
        }

        // PDF
        if (str_ends_with($url, '.pdf')) {
            return $url;
        }

        return $url; // default jika tak bisa convert
    }
}
