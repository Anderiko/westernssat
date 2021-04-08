<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Label;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public $escapeGame = '2021-03-18T12:00:00';

    public function index()
    {
        if(auth()->user() !== null && auth()->user()->can('create_event'))
        {
            $shown = Event::all();
        }
        else
        {
            $shown = Event::where('inscription_start', '<=', Carbon::now()->toDateString())->get();

            $shown = $shown->merge(Event::whereNull('inscription_start')->get());
        }

        $shown = $shown->sortBy([
            ['label_id', 'asc'],
            ['start', 'desc']
        ])->take(3);

        $time = Event::whereDate('inscription_start', '>', Carbon::now()->toDateString())->orderBy('inscription_start')->limit(1)->get();

        return view('welcome', [
            'time' => count($time) > 0 ? $time[0]->inscription_start : false,
            'events' => $shown
        ]);
    }

    public function game()
    {
        $count = $this->countdown();

        if ($count !== false && auth()->user()->cannot('game')) {
            return view('western_game.countdown', [
                'time' => $count
            ]);
        } else {
            return view('western_game.game');
        }
    }

    public function countdown()
    {
        $dday = new DateTime($this->escapeGame, new DateTimeZone('Europe/Paris'));
        $today = new DateTime('now', new DateTimeZone('Europe/Paris'));

        return $today > $dday ? false : $this->escapeGame;
    }
}
