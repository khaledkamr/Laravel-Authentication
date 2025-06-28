<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter admin name');
        $email = $this->ask('Enter admin email');
        $password = $this->secret('Enter admin password');
        $phone = $this->ask('Enter admin phone number (optional)', null);

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:3',
            'phone' => 'nullable|string|max:255|unique:users,phone',
        ]);

        if($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->line($error);
            }
            return;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'role' => 'admin',
            'password' => bcrypt($password),
            'account_verified_at' => now(),
            'otp' => rand(100000, 999999),
        ]);
        $this->info('Admin '. $name .' created successfully with email: '. $email);
    }
}
