<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class CreateFirstAccessToAllProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-first-access-to-all-project';

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
        $projects = Project::all();

        foreach ($projects as $proj) {
            if ($proj->accesses()->count() == 0) {
                $proj->accesses()->create([
                    'role_id' => Role::$ADMINISTRATOR_ID,
                    'user_id' => User::find(2)->id
                ]);
                Self::printerm([
                    $proj->key => [
                        'access_count' => $proj->accesses()->count()
                    ]
                ]);
            }
        }
    }

    public function printerm(array $data)
    {
        $this->line(json_encode($data, JSON_PRETTY_PRINT));
    }
}
