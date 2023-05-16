<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LatexFile;

class LatexFileController extends Controller
{
    public function showFiles()
    {
        $filesInput = scandir(public_path('latex_files')); //files('latex_files');
        $files = array_slice($filesInput, 2);
        //dd($files);

        return view('teacher', ['files' => $files]);
    }

    public function addFile(Request $request)
    {
        $data = [
            'file_path' => $request->file,
            'start_date' => $request->start_date ? new \DateTime($request->start_date) : null,
            'points' => $request->points,
        ];
    
        LatexFile::create($data);

        return back()->with('success', 'Súbor bol pridaný.');
    }
}
