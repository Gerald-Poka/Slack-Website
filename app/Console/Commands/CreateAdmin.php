<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Modules\Auth\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    protected $signature = 'make:admin {email} {name} {password}';
    protected $description = 'Create a new super admin user';

    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->argument('password');

        if (User::where('email', $email)->exists()) {
            $this->error("User with email {$email} already exists!");
            return;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'status' => 'active',
        ]);

        $user->assignRole('super_admin');

        $this->info("Admin user {$name} created successfully!");
    }
}
