<div x-data="{ show: @entangle('isOpen').live }" 
     x-show="show" 
     x-on:keydown.escape.window="show = false" 
     x-cloak
     class="fixed inset-0 z-[100] overflow-y-auto" 
     style="display: none;">
    
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" 
         x-show="show" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0"
         x-on:click="show = false"></div>

    <div class="flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-2xl flex flex-col bg-white border border-gray-200 shadow-xl rounded-xl pointer-events-auto transform transition-all"
             x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="scale-95 opacity-0"
             x-transition:enter-end="scale-100 opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="scale-100 opacity-100"
             x-transition:leave-end="scale-95 opacity-0">
            
            <form wire:submit.prevent="save">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">
                        Editar Usuario
                    </h3>
                    <button type="button" x-on:click="show = false" class="size-8 inline-flex justify-center items-center rounded-full bg-gray-100 border border-transparent text-gray-800 hover:bg-gray-200 focus:outline-hidden">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700">Nombre</label>
                            <input type="text" wire:model="name" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 shadow-sm border">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700">Apellido</label>
                            <input type="text" wire:model="lastname" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 shadow-sm border">
                            @error('lastname') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
                            <input type="email" wire:model="email" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 shadow-sm border">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700">Teléfono</label>
                            <input type="text" wire:model="phone" class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 shadow-sm border">
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                    <button type="button" x-on:click="show = false" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-white border border-gray-200 text-gray-800 shadow-xs hover:bg-gray-50 focus:outline-hidden">
                        Cancelar
                    </button>
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-600 border border-transparent text-white hover:bg-blue-700 focus:outline-hidden">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>