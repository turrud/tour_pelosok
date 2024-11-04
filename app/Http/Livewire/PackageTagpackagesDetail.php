<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Package;
use Illuminate\View\View;
use App\Models\Tagpackage;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PackageTagpackagesDetail extends Component
{
    use AuthorizesRequests;

    public Package $package;
    public Tagpackage $tagpackage;
    public $tagpackagesForSelect = [];
    public $tagpackage_id = null;

    public $showingModal = false;
    public $modalTitle = 'New Tagpackage';

    protected $rules = [
        'tagpackage_id' => ['required', 'exists:tagpackages,id'],
    ];

    public function mount(Package $package): void
    {
        $this->package = $package;
        $this->tagpackagesForSelect = Tagpackage::pluck('name', 'id');
        $this->resetTagpackageData();
    }

    public function resetTagpackageData(): void
    {
        $this->tagpackage = new Tagpackage();

        $this->tagpackage_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTagpackage(): void
    {
        $this->modalTitle = trans('crud.package_tagpackages.new_title');
        $this->resetTagpackageData();

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

        $this->authorize('create', Tagpackage::class);

        $this->package->tagpackages()->attach($this->tagpackage_id, []);

        $this->hideModal();
    }

    public function detach($tagpackage): void
    {
        $this->authorize('delete-any', Tagpackage::class);

        $this->package->tagpackages()->detach($tagpackage);

        $this->resetTagpackageData();
    }

    public function render(): View
    {
        return view('livewire.package-tagpackages-detail', [
            'packageTagpackages' => $this->package
                ->tagpackages()
                ->withPivot([])
                ->paginate(20),
        ]);
    }
}
