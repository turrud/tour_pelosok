<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Explore;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\ExploreImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ExploreExploreImagesDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Explore $explore;
    public ExploreImage $exploreImage;
    public $exploreImageImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New ExploreImage';

    protected $rules = [
        'exploreImage.order_number' => ['required', 'numeric'],
        'exploreImage.caption' => ['nullable', 'max:255', 'string'],
        'exploreImageImage' => ['nullable', 'image', 'max:1024'],
    ];

    public function mount(Explore $explore): void
    {
        $this->explore = $explore;
        $this->resetExploreImageData();
    }

    public function resetExploreImageData(): void
    {
        $this->exploreImage = new ExploreImage();

        $this->exploreImageImage = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newExploreImage(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.explore_explore_images.new_title');
        $this->resetExploreImageData();

        $this->showModal();
    }

    public function editExploreImage(ExploreImage $exploreImage): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.explore_explore_images.edit_title');
        $this->exploreImage = $exploreImage;

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

        if (!$this->exploreImage->explore_id) {
            $this->authorize('create', ExploreImage::class);

            $this->exploreImage->explore_id = $this->explore->id;
        } else {
            $this->authorize('update', $this->exploreImage);
        }

        if ($this->exploreImageImage) {
            $this->exploreImage->image = $this->exploreImageImage->store(
                'public'
            );
        }

        $this->exploreImage->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', ExploreImage::class);

        collect($this->selected)->each(function (string $id) {
            $exploreImage = ExploreImage::findOrFail($id);

            if ($exploreImage->image) {
                Storage::delete($exploreImage->image);
            }

            $exploreImage->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetExploreImageData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->explore->exploreImages as $exploreImage) {
            array_push($this->selected, $exploreImage->id);
        }
    }

    public function render(): View
    {
        return view('livewire.explore-explore-images-detail', [
            'exploreImages' => $this->explore->exploreImages()->paginate(20),
        ]);
    }
}
