<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Order::class);

        $search = $request->get('search', '');

        $orders = Order::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.orders.index', compact('orders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Order::class);

        return view('app.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderStoreRequest $request): RedirectResponse
    {
        // $this->authorize('create', Order::class);

        // $validated = $request->validated();

        // // Ambil harga paket berdasarkan package_id yang dipilih
        // $package = Package::find($validated['package_id']);
        // if ($package) {
        //     $validated['total_price'] = $validated['person'] * $package->price;
        // }

        // $order = Order::create($validated);

        // return redirect()
        //     ->route('orders.edit', $order)
        //     ->withSuccess(__('crud.common.created'));
        $this->authorize('create', Order::class);

        $validated = $request->validated();

        $order = Order::create($validated);

        return redirect()
            ->route('orders.edit', $order)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Order $order): View
    {
        $this->authorize('view', $order);

        return view('app.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Order $order): View
    {
        $this->authorize('update', $order);

        return view('app.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        OrderUpdateRequest $request,
        Order $order
    ): RedirectResponse {
        // $this->authorize('update', $order);

        // $validated = $request->validated();

        // $package = Package::find($validated['package_id']);
        // if ($package) {
        //     $validated['total_price'] = $validated['person'] * $package->price;
        // }

        // $order->update($validated);

        // return redirect()
        //     ->route('orders.edit', $order)
        //     ->withSuccess(__('crud.common.saved'));
        $this->authorize('update', $order);

        $validated = $request->validated();

        $order->update($validated);

        return redirect()
            ->route('orders.edit', $order)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Order $order): RedirectResponse
    {
        $this->authorize('delete', $order);

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->withSuccess(__('crud.common.removed'));
    }
}