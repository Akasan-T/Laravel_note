<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Label;

class LabelController extends Controller
{
    public function create()
    {
        $labels = Label::all();
        return view('label.create', compact('labels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:labels,name',
        ]);

        Label::create([
            'name' => $request->name,
        ]);

        return redirect()->route('notes.create')->with('success', 'ラベルを追加しました');
    }

    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:labels,name,' . $label->id,
        ]);

        $label->update(['name' => $request->name]);
        return redirect()->route('label.create')->with('success','ラベルを更新しました');
    }

    public function destroy(Label $label)
    {
        $label->delete();
        return redirect()->route('label.create')->with('success','ラベルを消去しました');
    }
}
