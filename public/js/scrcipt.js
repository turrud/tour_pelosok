//Homecaraosel
document.addEventListener('DOMContentLoaded', function() {
    const carouselElement = document.getElementById('homes-carousel');
    const noResultsElement = document.getElementById('no-results');
    const tagButtons = document.querySelectorAll('.tag-button');
    let carousel;

    function initializeCarousel() {
        if (carousel) {
            carousel.destroy();
        }

        // Only initialize carousel if there are visible items
        const visibleItems = document.querySelectorAll('.carousel-item:not(.filtered)');
        if (visibleItems.length > 0) {
            carousel = new Carousel(carouselElement, {
                // Add any carousel configuration options here
                loop: false,
                slidesPerView: 1
            });
        }
    }

    function removeEmptySlides() {
        const slides = document.querySelectorAll('.carousel-item');
        let validSlideFound = false;

        slides.forEach(slide => {
            if (!slide.classList.contains('filtered')) {
                slide.style.display = '';
                validSlideFound = true;
            } else {
                slide.style.display = 'none';
            }
        });

        return validSlideFound;
    }

    function filterSlides(selectedTag) {
        const items = document.querySelectorAll('.carousel-item');
        let visibleCount = 0;

        items.forEach(item => {
            const itemTags = item.dataset.tags.split(',').map(tag => tag.trim());

            if (selectedTag === 'all' || itemTags.includes(selectedTag)) {
                item.classList.remove('filtered');
                item.classList.add('visible-slide');
                visibleCount++;
            } else {
                item.classList.add('filtered');
                item.classList.remove('visible-slide');
            }
        });

        // Show/hide no results message
        if (visibleCount === 0) {
            noResultsElement.classList.remove('hidden');
            carouselElement.style.display = 'none';
        } else {
            noResultsElement.classList.add('hidden');
            carouselElement.style.display = '';

            // Remove empty slides and reinitialize carousel
            removeEmptySlides();
            initializeCarousel();

            // Ensure we start from the first visible slide
            if (carousel) {
                const firstVisibleSlide = document.querySelector('.carousel-item:not(.filtered)');
                const slideIndex = Array.from(items).indexOf(firstVisibleSlide);
                carousel.slideTo(slideIndex);
            }
        }
    }

    // Event listeners for tag buttons
    tagButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedTag = this.dataset.tag;

            // Update active button state
            tagButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Apply filtering
            filterSlides(selectedTag);
        });
    });

    // Initialize carousel on page load
    initializeCarousel();
});
//HomeCaraoselEnd

// modal contact

// Fungsi untuk menutup modal
document.getElementById('close-button').addEventListener('click', function () {
    const modal = document.getElementById('success-modal');
        modal.style.display = 'none'; // Menyembunyikan modal
    });


document.getElementById('close-button').addEventListener('click', function () {
    const modal = document.getElementById('success-modal');
        modal.style.display = 'none'; // Menyembunyikan modal
    });
