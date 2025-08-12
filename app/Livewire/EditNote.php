<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Note;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;

class EditNote extends Component
{

    public $title, $content, $noteId;

    #[On('edit-note')]
    public function editNote($id)
    {
        // dd("edit-note with id : {$id}");
        // edit berdasarkan ID
        $note = Note::findOrFail($id);
        $this->noteId = $id;
        $this->title = $note->title;
        $this->content = $note->content;
        // tampilkan modal
        Flux::modal('edit-note')->show();
    }

    public function update()
    {
        // dd('ok');
        $this->validate([
            'title' => ['required', 'string', 'max:255', Rule::unique('notes', 'title')->ignore($this->noteId)],
            'content' => ['required', 'string'],
        ]);

        // cari id yang akan diupdate
        $note = Note::find($this->noteId);
        $note->title = $this->title;
        $note->content = $this->content;
        $note->save();
        // menapilkan pesan berhasil diupdate
        session()->flash('success', 'Note Update Successfully');
        // Redirect To Notes
        $this->redirectRoute('notes', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-note');
    }
}
