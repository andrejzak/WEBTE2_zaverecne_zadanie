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

    public function generateRandomTask()
    {
        $currentDate = date('Y-m-d');
        $files = LatexFile::where('start_date', '<=', $currentDate)
                      ->orWhereNull('start_date')
                      ->get();

        // Extrahovanie príkladov z každého súboru a uloženie ich do poľa.
        $tasksAndSolutions = [];
        foreach ($files as $file) {
            $content = file_get_contents(public_path('latex_files/' . $file->file_path));

            // Predpokladajme, že úlohy a odpovede sú oddelené tagmi \begin{task}, \end{task}, \begin{solution}, \end{solution}.
            preg_match_all('/\\\\section\*\{(.*?)\}.*?\\\\begin{task}(.*?)\\\\end{task}.*?\\\\begin{solution}(.*?)\\\\end{solution}/s', $content, $matches, PREG_SET_ORDER);
            //preg_match_all('/\\\\begin{task}(.*?)\\\\end{task}.*?\\\\begin{solution}(.*?)\\\\end{solution}/s', $content, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $taskId = $match[1];
                $task = $match[2];
                $solution = $match[3];
    
                // Spracovanie matematických výrazov v úlohe a riešení.
                preg_match_all('/\\\\begin{equation\*}(.*?)\\\\end{equation\*}/s', $task, $taskMatches);
                preg_match_all('/\\\\begin{equation\*}(.*?)\\\\end{equation\*}/s', $solution, $solutionMatches);
    
                // Nahradenie matematických výrazov za tagy, ktore davaju latex kompilatoru vediet ze sa jedna o vyrazy
                foreach ($taskMatches[0] as $i => $match) {
                    $task = str_replace($match, '\(' . $taskMatches[1][$i] . '\)', $task);
                }
                foreach ($solutionMatches[0] as $i => $match) {
                    $solution = str_replace($match, '\(' . $solutionMatches[1][$i] . '\)', $solution);
                }

                // Spracovanie obrázkov v úlohe.
                preg_match('/\\\\includegraphics\{(.*?)\}/s', $task, $taskImageMatches);
                // Ulozenie nazvu obrazka do premennej, pripadne vlozenie prazdneho retazca ak obrazok v danom priklade nie je 
                $taskImagePaths = $taskImageMatches[1] ?? '';
                $task = preg_replace('/\\\\includegraphics\{(.*?)\}/s', '', $task);
                $tasksAndSolutions[] = ['id' => $taskId, 'task' => $task, 'solution' => $solution, 'taskImage' => $taskImagePaths];
            }
        }
    
        // Generovanie náhodnej úlohy a jej odpovede.
        if (!empty($tasksAndSolutions)) {
            $randomIndex = array_rand($tasksAndSolutions);
            $randomTask = $tasksAndSolutions[$randomIndex]['task'];
            $randomSolution = $tasksAndSolutions[$randomIndex]['solution'];
            $randomTaskId = $tasksAndSolutions[$randomIndex]['id'];
            $randomTaskImages = $tasksAndSolutions[$randomIndex]['taskImage'];
        } else {
            $randomTask = 'Žiadne dostupné úlohy na vygenerovanie.';
            $randomSolution = '';
            $randomTaskId = '';
            $randomTaskImages = '';
        }

        return view('student', ['task' => $randomTask, 'solution' => $randomSolution, 'taskId' => $randomTaskId, 'image' => $randomTaskImages]);
    }
}
