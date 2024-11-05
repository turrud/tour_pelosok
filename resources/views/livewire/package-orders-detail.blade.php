<div>
    <div>
        @can('create', App\Models\Order::class)
        <button class="button" wire:click="newOrder">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Order::class)
        <button
            class="button button-danger"
             {{ empty($selected) ? 'disabled' : '' }}
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="mr-1 icon ion-md-trash text-primary"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal wire:model="showingModal">
        <div class="px-6 py-4">
            <div class="text-lg font-bold">{{ $modalTitle }}</div>

            <div class="mt-5">
                <div>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="order.name"
                            label="Name"
                            wire:model="order.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="order.address"
                            label="Address"
                            wire:model="order.address"
                            maxlength="255"
                            placeholder="Address"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="order.phone"
                            label="Phone"
                            wire:model="order.phone"
                            maxlength="255"
                            placeholder="Phone"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.number
                            name="order.person"
                            label="Person"
                            wire:model="order.person"
                            max="255"
                            placeholder="Person"
                        ></x-inputs.number>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="order.total_price"
                            label="Total Price"
                            wire:model="order.total_price"
                            maxlength="255"
                            placeholder="Total Price"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.select
                            name="order.status"
                            label="Status"
                            wire:model="order.status"
                        >
                            <option value="Unpaid" {{ $selected == 'Unpaid' ? 'selected' : '' }} >Unpaid</option>
                            <option value="Paid" {{ $selected == 'Paid' ? 'selected' : '' }} >Paid</option>
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-gray-50 flex justify-between">
            <button
                type="button"
                class="button"
                wire:click="$toggle('showingModal')"
            >
                <i class="mr-1 icon ion-md-close"></i>
                @lang('crud.common.cancel')
            </button>

            <button
                type="button"
                class="button button-primary"
                wire:click="save"
            >
                <i class="mr-1 icon ion-md-save"></i>
                @lang('crud.common.save')
            </button>
        </div>
    </x-modal>

    <div class="block w-full overflow-auto scrolling-touch mt-4">
        <table class="w-full max-w-full mb-4 bg-transparent">
            <thead class="text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left w-1">
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.package_orders.inputs.name')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.package_orders.inputs.address')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.package_orders.inputs.phone')
                    </th>
                    <th class="px-4 py-3 text-right">
                        @lang('crud.package_orders.inputs.person')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.package_orders.inputs.total_price')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.package_orders.inputs.status')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($orders as $order)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $order->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $order->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $order->address ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $order->phone ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $order->person ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $order->total_price ? 'Rp ' . number_format($order->total_price, 0, ',', '.') : '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $order->status ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $order)
                            <button
                                type="button"
                                class="button"
                                wire:click="editOrder({{ $order->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">
                        <div class="mt-10 px-4">{{ $orders->render() }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
