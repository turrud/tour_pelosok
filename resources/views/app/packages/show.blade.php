<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.packages.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('packages.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.packages.inputs.title')
                        </h5>
                        <span>{{ $package->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.packages.inputs.description')
                        </h5>
                        <span>{{ $package->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.packages.inputs.price')
                        </h5>
                        <span>{{ $package->price ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.packages.inputs.main_image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $package->main_image ? \Storage::url($package->main_image) : '' }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('packages.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Package::class)
                    <a href="{{ route('packages.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\PackageImage::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Package Images </x-slot>

                <livewire:package-package-images-detail :package="$package" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\package_tagpackage::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Tagpackages </x-slot>

                <livewire:package-tagpackages-detail :package="$package" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
