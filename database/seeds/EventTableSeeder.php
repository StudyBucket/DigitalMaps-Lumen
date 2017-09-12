<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Event;
class EventTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
        Event::create([
            'title' => 'Example A',
            'start_date' => '2014-01-01',
            'end_date' => '2014-01-03',
            'event_data' => NULL
        ]);
        Event::create([
            'title' => 'Example B',
            'start_date' => '2014-01-01',
            'end_date' => '2014-01-03',
            'event_data' => NULL
        ]);
    }
}