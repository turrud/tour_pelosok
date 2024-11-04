@php $editing = isset($order) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $order->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address"
            label="Address"
            :value="old('address', ($editing ? $order->address : ''))"
            maxlength="255"
            placeholder="Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="phone"
            label="Phone"
            :value="old('phone', ($editing ? $order->phone : ''))"
            maxlength="255"
            placeholder="Phone"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="person"
            label="Person"
            :value="old('person', ($editing ? $order->person : ''))"
            max="255"
            placeholder="Person"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="total_price"
            label="Total Price"
            :value="old('total_price', ($editing ? $order->total_price : ''))"
            maxlength="255"
            placeholder="Total Price"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $order->status : '')) @endphp
            <option value="Unpaid" {{ $selected == 'Unpaid' ? 'selected' : '' }} >Unpaid</option>
            <option value="Paid" {{ $selected == 'Paid' ? 'selected' : '' }} >Paid</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
