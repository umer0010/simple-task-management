<?php

namespace App\Livewire\Tasks;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ImportTasksAssignment extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $file;
    public $importProgress = 0;
    public $importStatus = null; // null, 'processing', 'completed', 'failed'

    protected $rules = [
        'file' => 'required|file|mimes:csv,txt,xlsx,xls|max:10240', // 10MB max
    ];

    public function openModal()
    {
        $this->showModal = true;
        $this->resetImportState();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetImportState();
    }

    protected function resetImportState()
    {
        $this->resetErrorBag();
        $this->reset(['file', 'importProgress', 'importStatus']);
    }

    public function import()
    {
        $this->validate();
        $this->importStatus = 'processing';
        
        try {
            $path = $this->file->getRealPath();
            $file = fopen($path, 'r');
            
            // Skip header
            fgetcsv($file);
            
            $totalLines = count(file($path));
            $currentLine = 0;
            
            while ($row = fgetcsv($file)) {
                $currentLine++;
                $this->importProgress = ($currentLine / $totalLines) * 100;
                
                $data = [
                    'title' => $row[0] ?? null,
                    'description' => $row[1] ?? null,
                    'tags' => isset($row[2]) ? array_map('trim', explode(',', $row[2])) : [],
                ];
                
                // Validate row data
                Validator::make($data, [
                    'title' => 'required|string|max:255',
                    'description' => 'nullable|string',
                ])->validate();
                
                $task = Task::create([
                    'user_id' => Auth::id(),
                    'title' => $data['title'],
                    'description' => $data['description'],
                ]);
                
                $tagIds = [];
                foreach ($data['tags'] as $tagName) {
                    if (!empty($tagName)) {
                        $tag = Tag::firstOrCreate(['name' => $tagName]);
                        $tagIds[] = $tag->id;
                    }
                }
                
                if (!empty($tagIds)) {
                    $task->tags()->attach($tagIds);
                }
                
                // Small delay for UI progress visibility
                usleep(50000);
            }
            
            fclose($file);
            $this->importStatus = 'completed';
            $this->dispatch('tasks-imported');
            
        } catch (\Exception $e) {
            $this->importStatus = 'failed';
            $this->addError('import', 'Failed to import tasks: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.tasks.import-tasks-assignment');
    }
}