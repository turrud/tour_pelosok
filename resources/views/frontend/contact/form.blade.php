<div class="pt-10"></div>
<div class="container max-w-screen-md  mx-auto px-4 py-12">
  <!-- Page Title -->
    <div class="text-center mb-12">
    <h2 class="text-4xl font-bold text-gray-900 dark:text-white">Contact Us</h2>
    <p class="text-gray-700 dark:text-gray-300 mt-5">We'd love to hear from you! Find us on the map or fill out the form below to get in touch.</p>
    </div>

    <!-- Contact Form -->
    <div class="bg-white rounded-lg mt-8">
        <form method="POST" action="#">
            @csrf

            <!-- Name -->
            <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full p-3 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your Name" required>
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>

            <!-- Phone -->
            <div class="mb-6">
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="w-full p-3 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your Phone" required>
            @error('phone')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full p-3 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your Email" required>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>

            <!-- Subject -->
            <div class="mb-6">
            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="w-full p-3 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Subject" required>
            @error('subject')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>

            <!-- Message -->
            <div class="mb-6">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
            <textarea id="message" name="message" rows="5" class="w-full p-3 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Your Message" required>{{ old('message') }}</textarea>
            @error('message')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center">
            <button type="submit" class="px-6 py-3 bg-gray-400 text-white rounded-lg hover:bg-gray-700 focus:ring focus:ring-gray-300 dark:bg-gray-500 dark:hover:bg-gray-600">Send Message</button>
            </div>
        </form>
    </div>

</div>

<hr class="max-w-screen-xl mx-auto my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
<div class="container max-w-screen-xl  mx-auto px-4 py-1">
    <!-- Map Section -->
    <div class="rounded-lg overflow-hidden shadow-md mb-12">
    <div style="max-width:100%;overflow:hidden;color:red;width:1300px;height:500px;"><div id="display-google-map" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=stp+itb&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe></div><a class="code-for-google-map" rel="nofollow" href="https://www.bootstrapskins.com/themes" id="auth-map-data">premium bootstrap themes</a><style>#display-google-map img{max-width:none!important;background:none!important;font-size: inherit;font-weight:inherit;}</style></div>
    </div>
</div>

