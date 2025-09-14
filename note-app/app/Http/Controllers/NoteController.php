<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    function index() {
        $notes = auth()->user()->notes()->latest()->get();

        return view("note.index", compact('notes'));
    }
}
