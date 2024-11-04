<?php

namespace App\Http\Livewire;

use App\Models\Home;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\HomeImage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HomeHomeImagesDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Home $home;
    public HomeImage $homeImage;
    public $homeImageImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New HomeImage';

    protected $rules = [
        'homeImage.order_number' => ['required', 'numeric'],
        'homeImage.caption' => ['nullable', 'max:255', 'string'],
        'homeImageImage' => ['nullable', 'image', 'max:1024'],
    ];

    public function mount(Home $home): void
    {
        $this->home = $home;
        $this->resetHomeImageData();
    }

    public function resetHomeImageData(): void
    {
        $this->homeImage = new HomeImage();

        $this->homeImageImage = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newHomeImage(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.home_home_images.new_title');
        $this->resetHomeImageData();

        $this->showModal();
    }

    public function editHomeImage(HomeImage $homeImage): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.home_home_images.edit_title');
        $this->homeImage = $homeImage;

        $this->dispatchBrowserEvent('refresh');

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

        if (!$this->homeImage->home_id) {
            $this->authorize('create', HomeImage::class);

            $this->homeImage->home_id = $this->home->id;
        } else {
            $this->authorize('update', $this->homeImage);
        }

        if ($this->homeImageImage) {
            $this->homeImage->image = $this->homeImageImage->store('public');
        }

        $this->homeImage->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', HomeImage::class);

        collect($this->selected)->each(function (string $id) {
            $homeImage = HomeImage::findOrFail($id);

            if ($homeImage->image) {
                Storage::delete($homeImage->image);
            }

            $homeImage->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetHomeImageData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->home->homeImages as $homeImage) {
            array_push($this->selected, $homeImage->id);
        }
    }

    public function render(): View
    {
        return view('livewire.home-home-images-detail', [
            'homeImages' => $this->home->homeImages()->paginate(20),
        ]);
    }
}
