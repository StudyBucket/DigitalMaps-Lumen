<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run(){
         User::create([
             'name' => 'Pete Houston',
             'username' => 'petehouston',
             'password' => 'password'
         ]);
        User::create([
            'name' => 'Taylor Otwell',
            'username' => 'taylorotwell',
            'password' => 'password'
        ]);
    }
}