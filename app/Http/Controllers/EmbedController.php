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

        return $url;
    }
}
