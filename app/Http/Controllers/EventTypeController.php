<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventType;

class EventTypeController extends Controller
{
    public function index() {
        $types = EventType::all();
        return view('types-event.types-table', compact('types'));
    }

    public function create(Request $request) {
        $type = new EventType();
        $type->name = $request->name;
        $type->background = $request->background;
        $type->border = $request->border;
        $type->text = $request->text;
        $type->save();
        return back();
    }

    public function store(Request $request) {
        $type = new EventType();
        $type->name = $request->name;
        $type->background = $request->background;
        $type->border = $request->border;
        $type->text = $request->text;
        $type->save();
        return back();
    }

    public function show($id) {
        $type = EventType::find($id);
        return view('events.show', compact('type'));
    }

    public function edit($id) {
        $type = EventType::find($id);
        return view('types-event.types-table', compact('type'));
    }

    public function update(Request $request, $id) {
        $type = EventType::find($id);
        $type->name = $request->name;
        $type->background = $request->background;
        $type->border = $request->border;
        $type->text = $request->text;
        $type->save();
        return back();
    }

    public function destroy($id) {
        $type = EventType::find($id);
        $type->delete();
        return back();
    }
}
