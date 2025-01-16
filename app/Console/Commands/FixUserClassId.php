<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixUserClassId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:user_class_id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix inconsistent class_id values in users table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Delete users with invalid class_id 
        DB::table('users')->whereNotIn('class_id', function ($query) {
            $query->select('id')->from('classes');
        })->delete();
        $this->info('Inconsistent class_id values have been fixed.');
        return 0;
    }
}
