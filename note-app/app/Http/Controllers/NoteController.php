<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Label;
use League\CommonMark\CommonMarkConverter;

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
            'user_id'=> auth()->id(),
        ]);

        if  ($request->has('labels')) {
            $note->labels()->attach($request->labels);
        }

        return redirect()->route('notes.index');
    }

    public function show(Note $note)
    {
        $converter = new CommonMarkConverter();
        $htmlContent = $converter->convert($note->content);

        return view('note.show',['note'=>$note,'htmlContent'=>$htmlContent,]);
    }

}
