<div x-data="{ show: @entangle('isOpen') }" 
     x-show="show" 
     x-cloak
     class="fixed inset-0 z-[110] overflow-y-auto" 
     style="display: none;">
    
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm" x-on:click="show = false"></div>

    <div class="flex min-h-full items-center justify-center p-4">
        <div class="w-full max-w-2xl bg-white border shadow-xl rounded-xl pointer-events-auto transform transition-all"
             x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="scale-95 opacity-0"
             x-transition:enter-end="scale-100 opacity-100">
            
            <form wire:submit.prevent="save">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 class="font-bold text-gray-800 text-lg">Crear Nuevo Usuario</h3>
                    <button type="button" x-on:click="show = false" class="size-8 inline-flex justify-center items-center rounded-full bg-gray-100 hover:bg-gray-200">
                        <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" wire:model="name" class="w-full border-gray-200 rounded-lg shadow-sm">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input type="text" wire:model="lastname" class="w-full border-gray-200 rounded-lg shadow-sm">
                        @error('lastname') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" wire:model="email" class="w-full border-gray-200 rounded-lg shadow-sm">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" wire:model="phone" class="w-full border-gray-200 rounded-lg shadow-sm">
                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t bg-gray-50 rounded-b-xl">
                    <button type="button" x-on:click="show = false" class="py-2 px-3 text-sm font-medium bg-white border rounded-lg hover:bg-gray-50">Cancelar</button>
                    <button type="submit" class="py-2 px-3 text-sm font-medium bg-blue-600 text-white rounded-lg hover:bg-blue-700">Registrar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>