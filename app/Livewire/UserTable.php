<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Illuminate\Database\Eloquent\Model;

final class UserTable extends PowerGridComponent
{
    public string $tableName = 'userTable';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('lastname')
            ->add('phone')
            ->add('status_id')
            ->add('rol_id')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Lastname', 'lastname')
                ->sortable()
                ->searchable(),


            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('Status id', 'status_id'),
            Column::make('Rol id', 'rol_id'),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(User $row): array
    {
    return [
        Button::add('view')
            ->slot('Ver')
            ->class('bg-green-500 text-white rounded-lg px-2 py-1 hover:bg-green-600')
            ->route('datatable.profile', ['user' => $row->id]) ,

        Button::add('edit')
            ->slot('Editar')
            ->class('bg-blue-500 text-white rounded-lg px-2 py-1 hover:bg-blue-600')
            ->dispatch('open-modal-user', ['userId' => $row->id]),
            
        Button::add('delete')
                ->slot('Eliminar ')
                ->id()
                ->class('bg-red-500 text-white rounded-lg px-2 py-1 hover:bg-red-600')
                ->dispatch('deleteUser', ['rowid' => $row->id])
                ->confirm('¿Estás seguro de que deseas eliminar este usuario?')
    ];
}

    public function onUpdatedEditable(string|int $id, string $field, string $value): void
    {
        User::query()->find($id)->update([
            $field => e($value),
        ]);
    }
    #[\Livewire\Attributes\On('deleteUser')]

    public function deleteUser(int $rowid): void
    {
        // Encuentra el usuario por su ID y lo elimina.
        // Usamos findOrFail para que falle si el ID no existe.
        $user = User::findOrFail($rowid);
        $user->delete();

        // (Opcional) Puedes mostrar una notificación de éxito.
        $this->js('alert("Usuario eliminado correctamente.")');
    }
    public function viewUser(int $rowid): void
    {
        $user = User::findOrFail($rowid);
        $this->js('alert('.$user->name.')');
    }


    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
