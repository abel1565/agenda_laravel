<div>
    {{-- Contenedor del Calendario --}}
    <div class="p-6 bg-white rounded-xl shadow-md">
        <div wire:ignore id='calendar'></div>
    </div>

    {{-- Modal para Citas --}}
    <div x-data="{ show: @entangle('isOpen') }" 
         x-show="show" 
         x-cloak 
         class="fixed inset-0 z-[100] overflow-y-auto" 
         style="display: none;">
        
        <div class="fixed inset-0 bg-gray-900/50" @click="show = false"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl z-[110] p-6 text-left transform transition-all">
                
                <h3 class="text-lg font-bold mb-4">
                    <span x-show="!$wire.citaId">Nueva Cita</span>
                    <span x-show="$wire.citaId">Editar Cita</span>
                </h3>
                
                <form wire:submit.prevent="save" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" wire:model="title" class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
    <label class="block text-sm font-medium text-gray-700">Asignar a:</label>
    {{-- Agregamos una llave que cambie cada vez que la lista cambie --}}
    <div>
        <label class="block text-sm font-medium text-gray-700">Asignar a:</label>
        {{-- Usamos el ID del último usuario para que la llave cambie sí o sí --}}
        <div wire:key="select-user-container-{{ count($usuarios) }}-{{ $usuarios->last()->id ?? 0 }}">
            <select wire:model="assignedto" class="w-full border-gray-300 rounded-lg">
                <option value="">Seleccione Usuario</option>
                @foreach($usuarios as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->lastname }}</option>
                @endforeach
            </select>
        </div>
        @error('assignedto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
    @error('assignedto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>
                        <div class="mt-6 flex justify-end">
                            <div>
                                <button 
                                    x-data 
                                    x-on:click="$dispatch('open-modal-create-user')"
                                    class="py-2 px-4 inline-flex items-center cursor-pointer gap-x-2 text-sm font-medium rounded-full bg-blue-500 text-white hover:bg-blue-700 w-36">
                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                    Nuevo Usuario
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estatus:</label>
                            <select wire:model="status_id" class="w-full border-gray-300 rounded-lg">
                                @foreach($statuses as $st)
                                    <option value="{{ $st->id }}">{{ $st->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                            <input type="datetime-local" wire:model="start_date" class="w-full border-gray-300 rounded-lg">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                            <input type="datetime-local" wire:model="end_date" class="w-full border-gray-300 rounded-lg">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea wire:model="description" class="w-full border-gray-300 rounded-lg" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-x-2">
                        <button type="button" @click="show = false" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Guardar Cita
                        </button>
                    </div>
                    </form>
                    {{-- Solo mostrar si estamos editando --}}
                    @if($citaId)
                  

                      <button type="button" 
                                wire:click="deleteCita" 
                                wire:confirm="¿Estás seguro de eliminar esta cita?"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Eliminar
                        </button>
                    @endif
            </div>
        </div>
    </div>

   @push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    // Función para inicializar que podemos llamar en varios eventos
    function initCalendar() {
        const calendarEl = document.getElementById('calendar');
        if (!calendarEl) return;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            selectable: true,
            dropable: true,
            editable: true,
            //evento para arrastar una cita a otro día o hora
            eventDrop: function(info) {
                @this.updateCitaDates(
                    info.event.id, 
                    info.event.startStr, 
                    info.event.endStr
                );
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            select: function(info) {
                
                let start = info.startStr.includes('T') ? info.startStr.substring(0, 16) : info.startStr + 'T09:00';
                let end = info.endStr.includes('T') ? info.endStr.substring(0, 16) : info.startStr + 'T10:00';
                
                // USAR Window.Livewire para asegurar que encuentre el objeto
                window.Livewire.dispatch('open-modal-cita', { startDate: start, endDate: end });
            },
            eventClick: function(info) {
                window.Livewire.dispatch('open-modal-cita', { idCita: info.event.id });
            },
            events: @json($events) 
        });

        calendar.render();
    }

    // Escuchar tanto la navegación como la carga inicial
    document.addEventListener('livewire:navigated', initCalendar);
    document.addEventListener('DOMContentLoaded', initCalendar);

    // Escuchar el refresh
    window.addEventListener('calendar-refresh', () => {
        window.location.reload(); 
    });
</script>
@endpush


    <livewire:user-create-modal />
</div>