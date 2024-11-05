<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use App\Models\Package;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PackageOrdersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Package $package;
    public Order $order;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Order';

    protected $rules = [
        'order.name' => ['required', 'max:255', 'string'],
        'order.address' => ['required', 'max:255', 'string'],
        'order.phone' => ['required', 'max:255', 'string'],
        'order.person' => ['required', 'numeric'],
        'order.total_price' => ['required', 'max:255'],
        'order.status' => ['required', 'in:Unpaid,Paid'],
    ];

    public function mount(Package $package): void
    {
        $this->package = $package;
        $this->resetOrderData();
    }

    public function resetOrderData(): void
    {
        $this->order = new Order();

        $this->order->status = 'Unpaid';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newOrder(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.package_orders.new_title');
        $this->resetOrderData();

        $this->showModal();
    }

    public function editOrder(Order $order): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.package_orders.edit_title');
        $this->order = $order;

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

        if (!$this->order->package_id) {
            $this->authorize('create', Order::class);

            $this->order->package_id = $this->package->id;
        } else {
            $this->authorize('update', $this->order);
        }

        $this->order->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Order::class);

        Order::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetOrderData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->package->orders as $order) {
            array_push($this->selected, $order->id);
        }
    }

    public function render(): View
    {
        return view('livewire.package-orders-detail', [
            'orders' => $this->package->orders()->paginate(20),
        ]);
    }
}