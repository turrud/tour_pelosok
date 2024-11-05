<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class PackageOrdersController extends Controller
{
    public function index(Request $request, Package $package): OrderCollection
    {
        $this->authorize('view', $package);

        $search = $request->get('search', '');

        $orders = $package
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(Request $request, Package $package): OrderResource
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255', 'string'],
            'person' => ['required', 'numeric'],
            'total_price' => ['required', 'max:255'],
            'status' => ['required', 'in:unpaid,paid'],
        ]);

        $order = $package->orders()->create($validated);

        return new OrderResource($order);
    }
}
