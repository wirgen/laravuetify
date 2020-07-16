<?php

use App\User;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
  $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('init-admin {password?}', function ($password = null) {
  if (User::query()->first()) {
    $this->error("Users table is not empty");
  } else {
    if (!$password) {
      $password = Str::random();
    }
    User::create([
      'name' => 'Admin',
      'email' => 'admin@example.com',
      'password' => Hash::make($password),
    ]);
    $this->comment("User created successfully!\nUsername: Admin\nEmail: admin@example.com\nPassword: $password");
  }
})->describe('Create first admin user');
