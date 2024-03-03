<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CreateUsersFromCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create-from-csv {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create users from CSV file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         $file = $this->argument('file');

         $users = array_map('str_getcsv', file($file));

         foreach ($users as $user) {
         DB::table('users')->insert([
         'name' => $user[1],
         'email' => $user[4],
         'dui' => $user[3],
         'password' => Hash::make($user[6]),
         ]);
         }

         $this->info('Users created successfully!');
    }
}
