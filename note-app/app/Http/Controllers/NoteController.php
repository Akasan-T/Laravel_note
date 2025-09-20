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
        $note=Note::create([
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
        $labels = Label::all();

        return view('note.show', ['note'=> $note, 'htmlContent' => $htmlContent, 'labels'=> $labels,]);
    }

    public function edit(Note $note)
    {
        $note ->load('labels');
        $labels = Label::all();
        return view('note.edit', compact('note','labels'));

    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255', 
            'content' => 'required|string',
        ]);

        $note->update([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);

        $note->labels()->sync($request->labels ?? []);

        return redirect()->route('notes.show' ,$note)->with('success', 'ノートを更新しました');

    }
}
