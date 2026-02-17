<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Citas;
use App\Models\User; // Necesario para la lista de usuarios
use App\Models\Status_Citas; // Necesario para los estatus
use App\Http\Controllers\CitasController;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalendarComponent extends Component
{
    public $isOpen = false;
    public $citaId; // Mejor usa citaId para no confundir con otros IDs
    public $title, $description, $createdby, $assignedto, $status_id, $start_date, $end_date;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'assignedto' => 'required|integer',
            'status_id' => 'required|integer',
            'description' => 'nullable|string|max:255',
            'start_date' => 'required|after:today',
            'end_date' => 'required',
        ];
    }
    #[On('user-created')] 
    public function refreshUsers($userId=null)
    {
       if ($userId) {
        $this->assignedto = $userId;
    }
    }

    // El evento debe coincidir con el que mandas desde JS
    #[On('open-modal-cita')] 
    public function openModal($startDate = null, $idCita = null)
    {
        $this->reset(['title', 'description', 'assignedto', 'status_id', 'start_date', 'end_date', 'citaId']);
        $this->resetValidation();

        if ($idCita) {
            
            $cita = Citas::findOrFail($idCita);
            $this->citaId = $cita->id;
            $this->title = $cita->title;
            $this->description = $cita->description;
            $this->assignedto = $cita->assignedto;
            $this->status_id = $cita->status_id;
            $this->start_date = $cita->start_date;
            $this->end_date = $cita->end_date;
        } else {
            
            $this->start_date = $startDate;
            $this->status_id = 1; 
        }
        $this->isOpen = true;
    }

    public function save()
    {
        $validatedData = $this->validate();

        if ($this->citaId) {
            $res = CitasController::edit($this->citaId, $validatedData);
        } else {
            $validatedData['createdby'] = Auth::id();
            $res = CitasController::create($validatedData);
        }

        if ($res) {
            $this->isOpen = false;
            // Refresca el JS de FullCalendar (Crea este evento en tu JS)
            $this->dispatch('calendar-refresh'); 
            $this->dispatch('swal', [
                'title' => '¡Éxito!',
                'text'  => 'Cita procesada correctamente',
                'icon'  => 'success',
            ]);
        }
    }
    public function deleteCita() 
    {
        if (!$this->citaId) {
            return;
        };

    $res = CitasController::destroy($this->citaId);

    if ($res) {
        $this->isOpen = false;
        $this->reset(['citaId', 'title', 'description']); // Limpiamos rastro
        
        $this->dispatch('calendar-refresh');
        
        $this->dispatch('swal', [
            'title' => '¡Éxito!',
            'text'  => 'Cita eliminada correctamente',
            'icon'  => 'success',
        ]);
    }
}
    public function updateCitaDates($id, $start, $end = null)
    {
        
        $data = [
            'start_date' => date('Y-m-d H:i:s', strtotime($start)),
            'end_date'   => $end ? date('Y-m-d H:i:s', strtotime($end)) : date('Y-m-d H:i:s', strtotime($start . ' +1 hour')),
        ];

        $res = CitasController::edit($id, $data);

        if ($res) {
            $this->dispatch('swal', [
                'title' => 'Cita movida',
                'icon'  => 'success',
                'timer' => 1500
            ]);
            
        }
    }


    public function render()
    {
        

        return view('livewire.calendar-component', [
            $events = Citas::with('status')->get()->map(fn($c) => [
            'id' => $c->id,
            'title' => $c->title,
            'start' => $c->start_date,
            'end' => $c->end_date,
            'color' => $c->status->color ?? '#3b82f6'
            ]),
            'usuarios' => User::orderBy('name', 'asc')->get(),
            'statuses' => Status_Citas::all(),
            'events'   => $events 
        ]);
    }
}