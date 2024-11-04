<?php

namespace App\Http\Livewire;

use App\Models\About;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\AboutImage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AboutAboutImagesDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public About $about;
    public AboutImage $aboutImage;
    public $aboutImageImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New AboutImage';

    protected $rules = [
        'aboutImage.order_number' => ['required', 'numeric'],
        'aboutImage.caption' => ['nullable', 'max:255', 'string'],
        'aboutImageImage' => ['nullable', 'image', 'max:1024'],
    ];

    public function mount(About $about): void
    {
        $this->about = $about;
        $this->resetAboutImageData();
    }

    public function resetAboutImageData(): void
    {
        $this->aboutImage = new AboutImage();

        $this->aboutImageImage = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAboutImage(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.about_about_images.new_title');
        $this->resetAboutImageData();

        $this->showModal();
    }

    public function editAboutImage(AboutImage $aboutImage): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.about_about_images.edit_title');
        $this->aboutImage = $aboutImage;

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

        if (!$this->aboutImage->about_id) {
            $this->authorize('create', AboutImage::class);

            $this->aboutImage->about_id = $this->about->id;
        } else {
            $this->authorize('update', $this->aboutImage);
        }

        if ($this->aboutImageImage) {
            $this->aboutImage->image = $this->aboutImageImage->store('public');
        }

        $this->aboutImage->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', AboutImage::class);

        collect($this->selected)->each(function (string $id) {
            $aboutImage = AboutImage::findOrFail($id);

            if ($aboutImage->image) {
                Storage::delete($aboutImage->image);
            }

            $aboutImage->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAboutImageData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->about->aboutImages as $aboutImage) {
            array_push($this->selected, $aboutImage->id);
        }
    }

    public function render(): View
    {
        return view('livewire.about-about-images-detail', [
            'aboutImages' => $this->about->aboutImages()->paginate(20),
        ]);
    }
}
