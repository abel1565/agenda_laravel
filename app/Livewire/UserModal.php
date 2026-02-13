<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\DB;


class UserModal extends Component
{
    public $isOpen = false;
    public $user;
    public $userId;
    public $name,$lastname,$email,$phone,$status_id,$rol_id;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->userId,
            'phone' => 'required|string|min:10|max:10',
            'status_id' => 'required|integer',
            'rol_id' => 'required|integer'
        ];
    }

    #[On('open-modal-user')] 
    public function openModal($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->userId = $userId;
        $this->name = $this->user->name;
        $this->lastname = $this->user->lastname;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->status_id = $this->user->status_id;
        $this->rol_id = $this->user->rol_id;
        $this->isOpen = true;
    }
    public function save(){
        $validatedData = $this->validate();

       
        $user = UsersController::update($this->userId, $validatedData);

        if ($user) {
            $this->isOpen = false;
            $this->dispatch('pg:eventRefresh-userTable'); 
            $this->dispatch('swal', [
            'title' => '¡Logrado!',
            'text'  => 'Usuario actualizado correctamente',
            'icon'  => 'success',
        ]);
        } else {
            session()->flash('error', 'Error al actualizar.');
        }

        // Avisar a PowerGrid que refresque la tabla
        $this->dispatch('pg:eventRefresh-default'); 
        
        session()->flash('message', 'Usuario actualizado con éxito.');

    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.user-modal');
    }
}
?>