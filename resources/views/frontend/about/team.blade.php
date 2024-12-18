<div class="pt-10"></div>
<div class="container max-w-screen-xl mx-auto px-4 py-12">
  <!-- Section Title -->
  <div class="text-center mb-12">
    <h2 class="text-4xl font-bold text-gray-900 dark:text-white">Our Team</h2>
    <p class="text-gray-700 dark:text-gray-300 mt-2">Meet the people behind our success.</p>
  </div>

  <!-- Team Grid -->
  <div class="mt-10 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    <!-- Team Member Card -->
    @foreach($allPeople as $people)
        <div class="bg-white rounded-lg">
        <img src="{{ $people->image ? \Storage::url($people->image) : '' }}" alt="{{$people->name}}" class="w-32 h-32 rounded-full mx-auto mb-4">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-center">{{ $people->name }}</h3>
        <p class="text-gray-700 dark:text-gray-300 text-center">{{ $people->job_title }}</p>
        </div>
    @endforeach
  </div>
</div>
<div class="container mx-auto pt-20">
    <h1 class="text-2xl font-bold text-center">---</h1>
</div>
