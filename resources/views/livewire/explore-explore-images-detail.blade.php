<div>
    <div>
        @can('create', App\Models\ExploreImage::class)
        <button class="button" wire:click="newExploreImage">
            <i class="mr-1 icon ion-md-add text-primary"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\ExploreImage::class)
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
                        <x-inputs.number
                            name="exploreImage.order_number"
                            label="Order Number"
                            wire:model="exploreImage.order_number"
                            max="255"
                            placeholder="Order Number"
                        ></x-inputs.number>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <x-inputs.text
                            name="exploreImage.caption"
                            label="Caption"
                            wire:model="exploreImage.caption"
                            maxlength="255"
                            placeholder="Caption"
                        ></x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="w-full">
                        <div
                            image-url="{{ $editing && $exploreImage->image ? \Storage::url($exploreImage->image) : '' }}"
                            x-data="imageViewer()"
                            @refresh.window="refreshUrl()"
                        >
                            <x-inputs.partials.label
                                name="exploreImageImage"
                                label="Image"
                            ></x-inputs.partials.label
                            ><br />

                            <!-- Show the image -->
                            <template x-if="imageUrl">
                                <img
                                    :src="imageUrl"
                                    class="
                                        object-cover
                                        rounded
                                        border border-gray-200
                                    "
                                    style="width: 100px; height: 100px;"
                                />
                            </template>

                            <!-- Show the gray box when image is not available -->
                            <template x-if="!imageUrl">
                                <div
                                    class="
                                        border
                                        rounded
                                        border-gray-200
                                        bg-gray-100
                                    "
                                    style="width: 100px; height: 100px;"
                                ></div>
                            </template>

                            <div class="mt-2">
                                <input
                                    type="file"
                                    name="exploreImageImage"
                                    id="exploreImageImage{{ $uploadIteration }}"
                                    wire:model="exploreImageImage"
                                    @change="fileChosen"
                                />
                            </div>

                            @error('exploreImageImage')
                            @include('components.inputs.partials.error')
                            @enderror
                        </div>
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
                    <th class="px-4 py-3 text-right">
                        @lang('crud.explore_explore_images.inputs.order_number')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.explore_explore_images.inputs.caption')
                    </th>
                    <th class="px-4 py-3 text-left">
                        @lang('crud.explore_explore_images.inputs.image')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($exploreImages as $exploreImage)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 text-left">
                        <input
                            type="checkbox"
                            value="{{ $exploreImage->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="px-4 py-3 text-right">
                        {{ $exploreImage->order_number ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        {{ $exploreImage->caption ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-left">
                        <x-partials.thumbnail
                            src="{{ $exploreImage->image ? \Storage::url($exploreImage->image) : '' }}"
                        />
                    </td>
                    <td class="px-4 py-3 text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $exploreImage)
                            <button
                                type="button"
                                class="button"
                                wire:click="editExploreImage({{ $exploreImage->id }})"
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
                    <td colspan="4">
                        <div class="mt-10 px-4">
                            {{ $exploreImages->render() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
