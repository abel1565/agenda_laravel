<x-app-layout>
    <x-title title=" Mi Agenda" />
    
    <livewire:calendar-component>

   @stack('scripts')
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