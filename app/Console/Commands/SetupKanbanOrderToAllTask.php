<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Workflow;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetupKanbanOrderToAllTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup-kanban-order-to-all-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Use a transaction to ensure all updates succeed or none do.
        DB::transaction(function () {
            // Eager load the relationships (this part was already correct)
            $projects = Project::with('workflows.tasks')->get();

            foreach ($projects as $project) {
                foreach ($project->workflows as $workflow) {
                    // Initialize a counter for each workflow's tasks
                    $order = 1;

                    foreach ($workflow->tasks as $task) {
                        // Assign the sequential order and increment the counter
                        $task->kanban_order = $order;
                        $task->save(); // This still saves one by one, but within a transaction

                        $order++;
                    }
                }
            }
        });
    }
}
