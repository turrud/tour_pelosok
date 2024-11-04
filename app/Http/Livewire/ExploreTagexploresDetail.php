<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Explore;
use Illuminate\View\View;
use App\Models\Tagexplore;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ExploreTagexploresDetail extends Component
{
    use AuthorizesRequests;

    public Explore $explore;
    public Tagexplore $tagexplore;
    public $tagexploresForSelect = [];
    public $tagexplore_id = null;

    public $showingModal = false;
    public $modalTitle = 'New Tagexplore';

    protected $rules = [
        'tagexplore_id' => ['required', 'exists:tagexplores,id'],
    ];

    public function mount(Explore $explore): void
    {
        $this->explore = $explore;
        $this->tagexploresForSelect = Tagexplore::pluck('name', 'id');
        $this->resetTagexploreData();
    }

    public function resetTagexploreData(): void
    {
        $this->tagexplore = new Tagexplore();

        $this->tagexplore_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTagexplore(): void
    {
        $this->modalTitle = trans('crud.explore_tagexplores.new_title');
        $this->resetTagexploreData();

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

        $this->authorize('create', Tagexplore::class);

        $this->explore->tagexplores()->attach($this->tagexplore_id, []);

        $this->hideModal();
    }

    public function detach($tagexplore): void
    {
        $this->authorize('delete-any', Tagexplore::class);

        $this->explore->tagexplores()->detach($tagexplore);

        $this->resetTagexploreData();
    }

    public function render(): View
    {
        return view('livewire.explore-tagexplores-detail', [
            'exploreTagexplores' => $this->explore
                ->tagexplores()
                ->withPivot([])
                ->paginate(20),
        ]);
    }
}
