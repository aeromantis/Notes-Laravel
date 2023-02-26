<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Log;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create(Request $request) {
        $validated = $request->validate([
            'note' => 'required'
        ]);
        $note = new Note;
        $note->note = $request->note;
        $note->user_id = auth()->id();
        $note->save();

        $log = new Log;
        $log->note_id = $note->id;
        $log->action = "Create";
        $log->user_id = auth()->id();
        $log->save();
        return 'success';
    }

    public function delete(Request $request) {
        $noteToDelete = Note::where('id', $request->note)->first();
        $log = new Log;
        $log->note_id = $noteToDelete->id;
        $log->action = "Delete";
        $log->user_id = auth()->id();
        $log->save();
        $noteToDelete->delete();
        return 'success';
    }
}
