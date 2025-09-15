<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Label;

class NoteController extends Controller
{
    function index() {
        $notes = Note::all();
        return view("note.index", compact('notes'));
    }

    public function create()
    {
        $labels = Label::all();
        return view('note.create', compact('labels'));
    }

    public function store(Request $request)
    {
        Note::create([
            'title' => $request -> title,
            'content' => $request -> content,
        ]);

        return redirect()->route('notes.index');
    }
}
