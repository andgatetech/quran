<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    // View PDF in Browser
    public function view($filename)
    {
        $path = public_path("{$filename}");

        if (!file_exists($path)) {
            abort(404, "PDF file not found.");
        }

        return response()->file($path);
    }

    // Download PDF
    public function download($filename)
    {
        $path = public_path("{$filename}");

        if (!file_exists($path)) {
            abort(404, "PDF file not found.");
        }

        return response()->download($path);
    }
}
