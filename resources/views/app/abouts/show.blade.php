<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.abouts.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('abouts.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.abouts.inputs.title')
                        </h5>
                        <span>{{ $about->title ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.abouts.inputs.description')
                        </h5>
                        <span>{{ $about->description ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.abouts.inputs.main_image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $about->main_image ? \Storage::url($about->main_image) : '' }}"
                            size="150"
                        />
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('abouts.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\About::class)
                    <a href="{{ route('abouts.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>

            @can('view-any', App\Models\AboutImage::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> About Images </x-slot>

                <livewire:about-about-images-detail :about="$about" />
            </x-partials.card>
            @endcan @can('view-any', App\Models\about_tagabout::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Tagabouts </x-slot>

                <livewire:about-tagabouts-detail :about="$about" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
