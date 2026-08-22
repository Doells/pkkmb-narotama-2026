<?php

namespace App\Http\Livewire;

use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use App\Services\UserDeletionService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class AdminTable extends PowerGridComponent
{
    use ActionButton;

    //Table sort field
    public string $sortField = 'users.created_at';
    public string $sortDirection = 'desc';

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'bulkCheckedDelete',
                'bulkCheckedEdit'
            ]
        );
    }

    public function header(): array
    {
        return [
            Button::add('bulk-checked')
                ->caption(__('Hapus Terpilih'))
                ->class('cine-bulk-delete')
                ->emit('bulkCheckedDelete', []),
        ];
    }

    public function bulkCheckedDelete()
    {
        if (auth()->check()) {
            $ids = $this->checkedValues();

            if (!$ids)
                return $this->dispatchBrowserEvent('showToast', ['success' => false, 'message' => 'Pilih data yang ingin dihapus terlebih dahulu.']);

            if (in_array(auth()->user()->id, $ids))
                return $this->dispatchBrowserEvent('showToast', ['success' => false, 'message' => 'Anda tidak diizinkan untuk menghapus data yang sedang anda gunakan untuk login.']);


            try {
                User::whereIn('id', $ids)->get()->each(function (User $user): void {
                    app(UserDeletionService::class)->delete($user);
                });
                $this->checkboxValues = [];
                $this->checkboxAll = false;
                $this->fillData();
                $this->dispatchBrowserEvent('showToast', ['success' => true, 'message' => 'Data admin berhasil dihapus.']);
            } catch (\Throwable $ex) {
                report($ex);
                $this->dispatchBrowserEvent('showToast', ['success' => false, 'message' => 'Data gagal dihapus, kemungkinan ada data lain yang menggunakan data tersebut.']);
            }
        }
    }

    public function bulkCheckedEdit()
    {
        if (auth()->check()) {
            $ids = $this->checkedValues();

            if (!$ids)
                return $this->dispatchBrowserEvent('showToast', ['success' => false, 'message' => 'Pilih data yang ingin diedit terlebih dahulu.']);

            $ids = join('-', $ids);
            // return redirect(route('student.edit', ['ids' => $ids])); // tidak berfungsi/menredirect
            return $this->dispatchBrowserEvent('redirect', ['url' => route('admin.edit', ['ids' => $ids])]);
        }
    }

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns(),
            Footer::make()
                ->showPerPage(10, [10, 20, 50, 100])
                ->showRecordCount()
                ->pagination('components.pagination'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * Filter untuk hanya menampilkan akun admin (bukan admin/superadmin).
     *
     * @param Builder $query
     * @return Builder
     */
    private function filteradmin($query): Builder
    {
        return $query->whereHas('role', function ($roleQuery) {
            $roleQuery->where('name', '<>', 'user');
        });
    }

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\User>
     */
    public function datasource(): Builder
    {
        return User::query()
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->leftJoin('kelompoks', 'users.kelompok_id', '=', 'kelompoks.id')
            ->select('users.*', 'roles.name as role', 'positions.name as position', 'kelompoks.name as kelompok_name')
            ->when(Auth::user(), function ($query) {
                return $this->filteradmin($query);
            });
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('nim')
            ->addColumn('kelompok_name')
            ->addColumn('role', function (User $model) {
                return ucfirst($model->role);
            })
            ->addColumn('position', function (User $model) {
                return ucfirst($model->position);
            })
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

        public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-blue-500 hover:bg-blue-600 hover:underline rounded-full px-4 py-1 text-white my-2')
                ->target('')
                ->route('admin.edit', ['ids' => 'id']),

            Button::make('destroy', 'Delete')
                    ->class('delete-btn bg-red-500 hover:bg-red-600 hover:underline rounded-full px-4 py-1 text-white my-2')
                    ->target('')
                    ->route('admin.destroy', ['users' => 'id'])
                    ->method('delete')
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id', 'users.id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name', 'users.name')
                ->searchable()
                ->makeInputText()
                ->editOnClick()
                ->sortable(),

            Column::make('NIM', 'nim', 'users.nim')
                ->searchable()
                ->makeInputText()
                ->sortable(),

            Column::make('Kelompok', 'kelompok_name')
                ->makeInputText('kelompoks.name')
                ->searchable()
                ->sortable(),

            Column::make('Posisi', 'position', 'positions.name')
                ->searchable()
                ->makeInputSelect(Position::query()->orderBy('name')->get(), 'name', 'position_id')
                ->sortable(),

            Column::make('Role', 'role', 'roles.name')
                ->searchable()
                ->makeInputSelect(
                    Role::query()->whereIn('id', [User::SUPERADMIN_ROLE_ID, User::ADMIN_ROLE_ID])->orderBy('name')->get(),
                    'name',
                    'role_id'
                )
                ->sortable(),

            Column::make('Created at', 'created_at', 'users.created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'users.created_at')
                ->makeInputDatePicker()
                ->searchable()
        ];
    }
}
