<x-app-layout>
    <x-title title="Perfil de {{ $user->name }}" />


    
    <div class="w-full bg-white shadow-xl rounded-3xl p-8 flex flex-col md:flex-row gap-8 mt-6">

        <!-- SVG Usuario (1/3) -->
        <div class="w-full md:w-1/3 flex justify-center items-center border-r">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-48 h-48 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0" />
            </svg>
        </div>

        <!-- Información Usuario (2/3) -->
        <div class="w-full md:w-2/3">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Información del Usuario
            </h2>

            <ul class="text-gray-700 space-y-4">

                <li class="flex justify-between border-b pb-2">
                    <span class="font-semibold">Nombre:</span>
                    <span>{{ $user->name }}</span>
                </li>
                <li class="flex justify-between border-b pb-2">
                    <span class="font-semibold">Apellido:</span>
                    <span>{{ $user->lastname }}</span>
                </li>


                <li class="flex justify-between border-b pb-2">
                    <span class="font-semibold">Correo:</span>
                    <span>{{ $user->email }}</span>
                </li>

                <li class="flex justify-between border-b pb-2">
                    <span class="font-semibold">Teléfono:</span>
                    <span>{{ $user->phone }}</span>
                </li>

                <li class="flex justify-between border-b pb-2">
                    <span class="font-semibold">Rol:</span>
                    <span>{{ $user->rol_id}}</span>
                </li>

                <li class="flex justify-between border-b pb-2">
                    <span class="font-semibold">Estado:</span>
                    <span>{{ $user->status_id}}</span>
                </li>

                <li class="flex justify-between border-b pb-2">
                    <span class="font-semibold">Fecha de Registro:</span>
                    <span>{{ $user->created_at->format('d/m/Y') }}</span>
                </li>

            </ul>

            

        </div>
        

    
    </div>
    <div class=" py-4 bg-blue-500 rounded-full w-36 mt-6   ">
                <a href="{{ route('datatable') }}"
                   class="text-white hover:underline font-medium flex justify-center">
                    ← Volver a la lista
                </a>
    </div>

</x-app-layout>
    