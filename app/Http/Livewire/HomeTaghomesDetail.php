<?php

namespace App\Http\Livewire;

use App\Models\Home;
use Livewire\Component;
use App\Models\Taghome;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeTaghomesDetail extends Component
{
    use AuthorizesRequests;

    public Home $home;
    public Taghome $taghome;
    public $taghomesForSelect = [];
    public $taghome_id = null;

    public $showingModal = false;
    public $modalTitle = 'New Taghome';

    protected $rules = [
        'taghome_id' => ['required', 'exists:taghomes,id'],
    ];

    public function mount(Home $home): void
    {
        $this->home = $home;
        $this->taghomesForSelect = Taghome::pluck('name', 'id');
        $this->resetTaghomeData();
    }

    public function resetTaghomeData(): void
    {
        $this->taghome = new Taghome();

        $this->taghome_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTaghome(): void
    {
        $this->modalTitle = trans('crud.home_taghomes.new_title');
        $this->resetTaghomeData();

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        $this->authorize('create', Taghome::class);

        $this->home->taghomes()->attach($this->taghome_id, []);

        $this->hideModal();
    }

    public function detach($taghome): void
    {
        $this->authorize('delete-any', Taghome::class);

        $this->home->taghomes()->detach($taghome);

        $this->resetTaghomeData();
    }

    public function render(): View
    {
        return view('livewire.home-taghomes-detail', [
            'homeTaghomes' => $this->home
                ->taghomes()
                ->withPivot([])
                ->paginate(20),
        ]);
    }
}
