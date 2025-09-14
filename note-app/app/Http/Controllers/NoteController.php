<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    function index() {
        $notes = Note::all();
        return view("note.index", compact('notes'));
    }

    public function create()
    {
        return view('note.create');
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
