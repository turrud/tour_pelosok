<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Package;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\PackageImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PackagePackageImagesDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Package $package;
    public PackageImage $packageImage;
    public $packageImageImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New PackageImage';

    protected $rules = [
        'packageImage.order_number' => ['required', 'numeric'],
        'packageImage.caption' => ['nullable', 'max:255', 'string'],
        'packageImageImage' => ['nullable', 'image', 'max:1024'],
    ];

    public function mount(Package $package): void
    {
        $this->package = $package;
        $this->resetPackageImageData();
    }

    public function resetPackageImageData(): void
    {
        $this->packageImage = new PackageImage();

        $this->packageImageImage = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPackageImage(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.package_package_images.new_title');
        $this->resetPackageImageData();

        $this->showModal();
    }

    public function editPackageImage(PackageImage $packageImage): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.package_package_images.edit_title');
        $this->packageImage = $packageImage;

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

        if (!$this->packageImage->package_id) {
            $this->authorize('create', PackageImage::class);

            $this->packageImage->package_id = $this->package->id;
        } else {
            $this->authorize('update', $this->packageImage);
        }

        if ($this->packageImageImage) {
            $this->packageImage->image = $this->packageImageImage->store(
                'public'
            );
        }

        $this->packageImage->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', PackageImage::class);

        collect($this->selected)->each(function (string $id) {
            $packageImage = PackageImage::findOrFail($id);

            if ($packageImage->image) {
                Storage::delete($packageImage->image);
            }

            $packageImage->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPackageImageData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->package->packageImages as $packageImage) {
            array_push($this->selected, $packageImage->id);
        }
    }

    public function render(): View
    {
        return view('livewire.package-package-images-detail', [
            'packageImages' => $this->package->packageImages()->paginate(20),
        ]);
    }
}
