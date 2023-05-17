<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LatexFile;
use App\Models\Task;

class LatexFileController extends Controller
{
    public function showFiles()
    {
        $filesInput = scandir(public_path('latex_files'));
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

    // Zobrazenie aktualne riesitelnych datasetov
    public function showAvailableTaskSets() {
        $currentDate = date('Y-m-d');
        $files = LatexFile::where('start_date', '<=', $currentDate)
                      ->orWhereNull('start_date')
                      ->get();
    
        // Extrahovanie názvov sád úloh z každého súboru a uloženie ich do poľa.
        $taskSets = [];
        foreach ($files as $file) {
            $taskSets[] = $file;
        }
        return view('student', ['taskSets' => $taskSets]);
    }

    // Generovanie nahodneho prikladu zo zvoleneho rozsahu datasetov
    public function generateRandomTask(Request $request)
    {
        $selectedFiles = $request->input('selectedFiles');
        $files = LatexFile::whereIn('id', $selectedFiles)->get();

        $generatedTasks = Task::where('student_id', auth()->user()->id)->pluck('task_id');
        // Extrahovanie príkladov z každého súboru a uloženie ich do poľa.
        $tasksAndSolutions = [];
        foreach ($files as $file) {
            $content = file_get_contents(public_path('latex_files/' . $file->file_path));

            // Predpokladajme, že úlohy a odpovede sú oddelené tagmi \begin{task}, \end{task}, \begin{solution}, \end{solution}.
            preg_match_all('/\\\\section\*\{(.*?)\}.*?\\\\begin{task}(.*?)\\\\end{task}.*?\\\\begin{solution}(.*?)\\\\end{solution}/s', $content, $matches, PREG_SET_ORDER);
            
            // Získanie počtu úloh v súbore.
            $taskCount = count($matches);

            // Získanie bodov priradených k súboru.
            $filePoints = $file->points;

            // Rozdelenie bodov medzi úlohy a zaokrúhlenie na dve desatinné miesta.
            $taskPoints = $taskCount > 0 ? round($filePoints / $taskCount, 2) : 0;

            foreach ($matches as $match) {
                $taskId = $match[1];

                if($generatedTasks->contains($taskId)){
                    continue;
                }

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
                $tasksAndSolutions[] = [
                                        'id' => $taskId, 
                                        'task' => $task, 
                                        'solution' => $solution, 
                                        'taskImage' => $taskImagePaths,
                                        'points' => $taskPoints, 
                                        'latex_file_id' => $file->id,
                                    ];
            }
        }
    
        // Generovanie náhodnej úlohy a jej odpovede.
        if (!empty($tasksAndSolutions)) {
            $randomIndex = array_rand($tasksAndSolutions);
            $randomTask = $tasksAndSolutions[$randomIndex]['task'];
            $randomSolution = $tasksAndSolutions[$randomIndex]['solution'];
            $randomTaskId = $tasksAndSolutions[$randomIndex]['id'];
            $randomTaskImages = $tasksAndSolutions[$randomIndex]['taskImage'];
            $randomTaskPoints = $tasksAndSolutions[$randomIndex]['points'];
            $randomTaskFileId = $tasksAndSolutions[$randomIndex]['latex_file_id'];

            // Uložíme informáciu o vygenerovanej úlohe do databázy
            $newTask = Task::create([
                'student_id' => auth()->user()->id,
                'task_id' => $randomTaskId,
                'task' => $randomTask,
                'points_max' => $randomTaskPoints,
                'points_given' => null,
                'task_image' => $randomTaskImages,
                'solution' => $randomSolution,
                'latex_file_id' => $randomTaskFileId,
            ]);
        } else {
            $randomTask = 'Žiadne dostupné úlohy na vygenerovanie.';
            $randomSolution = '';
            $randomTaskId = '';
            $randomTaskImages = '';
        }
        return redirect()->route('task.show', ['task_id' => $newTask->id]);

        //return view('student', ['task' => $randomTask, 'solution' => $randomSolution, 'taskId' => $randomTaskId, 'image' => $randomTaskImages]);
        // return redirect()->route('task.show')
        //     ->with('task', $randomTask)
        //     ->with('solution', $randomSolution)
        //     ->with('taskId', $randomTaskId)
        //     ->with('image', $randomTaskImages);
    }
}
