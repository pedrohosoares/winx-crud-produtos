<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user to use API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = 'pedrohosoares@gmail.com';
        $password = '123456';
        $user = User::updateOrCreate(
            [
                'email'=>$email
            ],
            [
                'name'=>'Pedro Soares',
                'password'=>Hash::make($password)
            ]
        );
        $user->tokens()->delete();
        $token = $user->createToken($user->email,[
            'categories.index','categories.store','categories.show','categories.update','categories.destroy',
            'products.index','products.store','products.details','products.show','products.update','products.destroy',
        ]);
        $token = $token->plainTextToken;
        $this->info("Usuário criado: $email, senha = $password, token da api: $token");
    }
}
