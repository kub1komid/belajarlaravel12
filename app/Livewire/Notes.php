<?php

namespace App\Livewire;

use Flux\Flux;
use App\Models\Note;
use Livewire\Component;
use Livewire\WithPagination;

class Notes extends Component
{
    use WithPagination;

    public $noteId;
    public function render()
    {
        // menampilkan data dari database(model)
        $notes = Note::orderByDesc('created_at', 'desc')->paginate(6);
        return view('livewire.notes', [
            'notes' => $notes
        ]);
    }

    public function edit($id)
    {
        // dd('ok');
        $this->dispatch('edit-note', $id);
    }

    public function delete($id)
    {
        // dd("delete id : {$id}");
        $this->noteId = $id;
        // tampil Modal
        Flux::modal('delete-note')->show();
    }

    public function deleteNote()
    {
        // Perintah Delete
        Note::find($this->noteId)->delete();
        // Tampilkan pesan berhasil
        session()->flash('success', 'Note deleted susccessfuly');
        // Redirect to note
        $this->redirectRoute('notes', navigate: true);
    }
}
