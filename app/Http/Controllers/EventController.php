<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function index() {
        $data = [
            'events' => Event::all(),
            'types' => EventType::all()
        ];
        return view('home', compact('data'));
    }

    public function create(Request $request) {
        $event = new Event();
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->user_id = Auth::user()->id;
        $event->event_type_id = $request->event_type_id;
        $event->save();
        if($request->apiFetch == 'true') {
            return response()->json($event);
        }
        $data = [
            'events' => Event::all(),
            'types' => EventType::all()
        ];
        return view('home', compact('data'));
    }

    public function store(Request $request) {
        $event = new Event();
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->user_id = Auth::user()->id;
        $event->save();
        return back();
    }

    // public function show($id) {
    //     $event = Event::find($id);
    //     return view('events.show', compact('event'));
    // }

    // public function edit($id) {
    //     $event = Event::find($id);
    //     return view('events.edit', compact('event'));
    // }

    public function update(Request $request, $id) {
        $event = Event::find($id);
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->user_id = $request->user_id;
        $event->save();
        return view('events.index');
    }

    public function destroy($id) {
        $event = Event::find($id);
        $event->delete();
        return response()->json($event);
    }

}
