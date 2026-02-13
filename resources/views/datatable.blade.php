<x-app-layout>
   <x-title title="Usuarios" />


        <div class="mt-6 flex justify-end">
            <button 
                x-data 
                x-on:click="$dispatch('open-modal-create-user')"
                class="py-2 px-4 inline-flex items-center cursor-pointer gap-x-2 text-sm font-medium rounded-full bg-blue-500 text-white hover:bg-blue-700 w-36">
                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Nuevo Usuario
            </button>
        </div>
        <

    <div class="flex mt-4"> 
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl p-6">
            
            <livewire:user-table/>
            <livewire:user-modal />  
            <livewire:user-create-modal />
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Escuchamos el evento personalizado 'swal'
        window.addEventListener('swal', event => {
            Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].text,
                icon: event.detail[0].icon,
                timer: 5000,
                showConfirmButton: true
            });
        });
    </script>

</x-app-layout>