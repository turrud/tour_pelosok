<?php

namespace App\Http\Livewire;

use App\Models\About;
use Livewire\Component;
use App\Models\Tagabout;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AboutTagaboutsDetail extends Component
{
    use AuthorizesRequests;

    public About $about;
    public Tagabout $tagabout;
    public $tagaboutsForSelect = [];
    public $tagabout_id = null;

    public $showingModal = false;
    public $modalTitle = 'New Tagabout';

    protected $rules = [
        'tagabout_id' => ['required', 'exists:tagabouts,id'],
    ];

    public function mount(About $about): void
    {
        $this->about = $about;
        $this->tagaboutsForSelect = Tagabout::pluck('name', 'id');
        $this->resetTagaboutData();
    }

    public function resetTagaboutData(): void
    {
        $this->tagabout = new Tagabout();

        $this->tagabout_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTagabout(): void
    {
        $this->modalTitle = trans('crud.about_tagabouts.new_title');
        $this->resetTagaboutData();

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

        $this->authorize('create', Tagabout::class);

        $this->about->tagabouts()->attach($this->tagabout_id, []);

        $this->hideModal();
    }

    public function detach($tagabout): void
    {
        $this->authorize('delete-any', Tagabout::class);

        $this->about->tagabouts()->detach($tagabout);

        $this->resetTagaboutData();
    }

    public function render(): View
    {
        return view('livewire.about-tagabouts-detail', [
            'aboutTagabouts' => $this->about
                ->tagabouts()
                ->withPivot([])
                ->paginate(20),
        ]);
    }
}
