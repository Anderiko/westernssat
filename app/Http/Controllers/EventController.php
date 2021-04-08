<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Label;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventController extends Controller
{
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
        ]);

        return view('events.index', [
            'events' => $shown
        ]);
    }


    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'overview' => 'required',
            'description' => 'required',
            'start' => 'required|date',
            'inscription_start' => 'nullable|date',
            'max_participants' => 'nullable',
            'price' => 'nullable',
            'photo' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['description'] = clean($data['description'], [
            'HTML.Allowed' => 'h1[class|style],h2[class|style],h3[class|style],h4[class|style],h5[class],div[class|style],b,strong,i,em,a[href|title|class|style],ul,ol,li,p[style|class],br,span[style|class],table[class|style],th[class|style],tr[class|style],td[class|style],hr,blockquote'
        ]);

        $data['photo_path'] = 'default.png';

        if ($request->photo !== null)
        {
            $data['photo_path'] = time().'.'.$request->photo->extension();

            $request->photo->move(public_path('uploads'), $data['photo_path']);

            unset($data['photo']);
        }

        Event::create($data);

        return redirect()->route('events.index')->with([
            'message' => [
                'title' => 'Événement',
                'message' => 'Un événement a bien été ajouté'
            ]
        ]);
    }


    public function show(Request $request, Event $event)
    {
        if ($request->user() === null || $request->user()->cannot('create_event'))
        {
            if ($event->inscription_start !== null && Carbon::create($event->inscription_start) > Carbon::now())
            {
                abort(404);
            }
        }
        return view('events.show', [
            'event' => $event
        ]);
    }

    public function edit(Event $event)
    {
        return view('events.edit', [
            'event' => $event,
            'labels' => Label::all()
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'name' => 'required',
            'overview' => 'required',
            'description' => 'required',
            'start' => 'required',
            'inscription_start' => 'nullable',
            'max_participants' => 'nullable',
            'price' => 'nullable',
            'photo' => 'mimes:png,jpg,jpeg|max:2048',
            'label_id' => 'required'
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['description'] = clean($data['description'], [
            'HTML.Allowed' => 'h1[class|style],h2[class|style],h3[class|style],h4[class|style],h5[class],div[class|style],b,strong,i,em,a[href|title|class|style],ul,ol,li,p[style|class],br,span[style|class],table[class|style],th[class|style],tr[class|style],td[class|style],hr,blockquote'
        ]);

        if ($request->photo !== null)
        {
            $data['photo_path'] = time().'.'.$request->photo->extension();

            $request->photo->move(public_path('uploads'), $data['photo_path']);

            unset($data['photo']);
        }

        $event->update($data);

        return redirect()->route('events.show', $event->id)->with([
            'message' => [
                'title' => 'Événement',
                'message' => 'Un événement a bien été modifié'
            ]
        ]);
    }

    public function delete(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with([
            'message' => [
                'title' => 'Événement',
                'message' => 'Un événement a bien été supprimé'
            ]
        ]);
    }

    public function forceDelete(Event $event)
    {
        $event->forceDelete();

        return redirect()->route('events.index')->with([
            'message' => [
                'title' => 'Événement',
                'message' => 'Un événement a bien été supprimé définitevement'
            ]
        ]);
    }
}
