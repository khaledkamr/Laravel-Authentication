<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class CreateOwnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:owner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new owner user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(!Role::where('name', 'owner')->first())
        {
            Artisan::call('db:seed'. ['--class' => 'RoleAndPermissionSeeder']);
        }
        $name = $this->ask('Enter owner name');
        $email = $this->ask('Enter owner email');
        $password = $this->secret('Enter owner password');
        $phone = $this->ask('Enter owner phone number (optional)', null);

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
            'password' => bcrypt($password),
            'account_verified_at' => now(),
            'otp' => rand(100000, 999999),
        ]);

        $ownerRole = Role::where('name', 'owner')->first();
        $user->roles()->attach($ownerRole->id);
        $this->info('Owner '. $name .' created successfully with email: '. $email);
    }
}
