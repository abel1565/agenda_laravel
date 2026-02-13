<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\DB;


class UserCreateModal extends Component
{
    public $isOpen = false;
    public $name,$lastname,$email,$phone,$status_id,$rol_id;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|min:10|max:10'
        ];
    }

    #[On('open-modal-create-user')] 
    public function openModal()
    {
        $this->reset(['name', 'lastname', 'email', 'phone', 'status_id', 'rol_id']); // Limpia el form
        $this->resetValidation();
        $this->isOpen = true;
    }
    public function save(){
        $validatedData = $this->validate();

       
        $user = UsersController::create($validatedData);

        if ($user) {
            $this->isOpen = false;
            $this->dispatch('pg:eventRefresh-userTable'); 
            $this->dispatch('swal', [
            'title' => '¡Logrado!',
            'text'  => 'Usuario creado correctamente',
            'icon'  => 'success',
        ]);
        } else {
            session()->flash('error', 'Error al crear.');
        }

        // Avisar a PowerGrid que refresque la tabla
        $this->dispatch('pg:eventRefresh-default'); 
        
        session()->flash('message', 'Usuario creado con éxito.');

    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
    public function render()
    {
        return view('livewire.user-create-modal');
    }
}
