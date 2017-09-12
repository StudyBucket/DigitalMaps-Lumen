<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Event;
class EventUserPivotSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
        DB::table('event_user')->insert([
            'event_id'  => Event::select('id')->orderByRaw("RAND()")->first()->id,
            'user_id'   => User::select('id')->orderByRaw("RAND()")->first()->id,
            'follows'   => 1,
            'attended'  => 1
        ]);

        DB::table('event_user')->insert([
            'event_id'  => Event::select('id')->orderByRaw("RAND()")->first()->id,
            'user_id'   => User::select('id')->orderByRaw("RAND()")->first()->id,
            'follows'   => 0,
            'attended'  => 1
        ]);

        DB::table('event_user')->insert([
            'event_id'  => Event::select('id')->orderByRaw("RAND()")->first()->id,
            'user_id'   => User::select('id')->orderByRaw("RAND()")->first()->id,
            'follows'   => 1,
            'attended'  => 0
        ]);

        DB::table('event_user')->insert([
            'event_id'  => Event::select('id')->orderByRaw("RAND()")->first()->id,
            'user_id'   => User::select('id')->orderByRaw("RAND()")->first()->id,
            'follows'   => 1,
            'attended'  => 0
        ]);
    }
}