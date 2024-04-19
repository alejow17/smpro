<?php

namespace App\Livewire;

use App\Models\Dato;
use Livewire\Component;

class FormUser extends Component
{
    public $nombre = '';

    public $email = '';

    public $telefono = '';

    public $categoria = '';

    public function save()
    {
        Dato::create([
            'nombre' => $this->nombre,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'categoria' => $this->categoria,
        ]);

        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.form-user');
    }
}
