<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    Routs::resource('notes', NoteController::class)->middleware("auth");
}
