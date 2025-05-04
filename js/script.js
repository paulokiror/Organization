$(document).ready(function () {
    // Navigation active state
    $('ul.nav > li').click(function (e) {
        $('ul.nav > li').removeClass('active');
        $(this).addClass('active');
    });

    // Fetch images for carousel
    fetch('fetch_images.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(images => {
            const carouselInner = document.getElementById('carousel-inner');
            const carouselIndicators = document.getElementById('carousel-indicators');

            // Fallback if no images
            if (!images || images.length === 0) {
                console.warn('No images found, using fallback images');
                images = [
                    { filename: 'OPH-1.JPG' },
                    { filename: 'Screenshot 2024-01-26 101832.png' }
                ];
            }

            images.forEach((image, index) => {
                // Create carousel item
                const carouselItem = document.createElement('div');
                carouselItem.className = `carousel-item ${index === 0 ? 'active' : ''}`;
                carouselItem.style.backgroundImage = `url('images/${image.filename}')`;
                carouselItem.innerHTML = `
                    <h1 style="text-align: center;color: white;padding-top: 20%;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                        ${index === 0 ? '...............WELCOME TO AGAPEO ORPHANAGE...............' : '_____________.......SAFE HOME FOR CHILDREN......._____________'}
                    </h1>
                `;
                carouselInner.appendChild(carouselItem);

                // Create indicator
                const indicator = document.createElement('li');
                indicator.setAttribute('data-target', '#myCarousel');
                indicator.setAttribute('data-slide-to', index);
                if (index === 0) indicator.className = 'active';
                carouselIndicators.appendChild(indicator);
            });
        })
        .catch(error => {
            console.error('Error fetching images:', error);
            // Load fallback images
            const carouselInner = document.getElementById('carousel-inner');
            const carouselIndicators = document.getElementById('carousel-indicators');
            const fallbackImages = [
                { filename: 'OPH-1.JPG' },
                { filename: 'Screenshot 2024-01-26 101832.png' }
            ];

            fallbackImages.forEach((image, index) => {
                const carouselItem = document.createElement('div');
                carouselItem.className = `carousel-item ${index === 0 ? 'active' : ''}`;
                carouselItem.style.backgroundImage = `url('images/${image.filename}')`;
                carouselItem.innerHTML = `
                    <h1 style="text-align: center;color: white;padding-top: 20%;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
                        ${index === 0 ? '...............WELCOME TO AGAPEO ORPHANAGE...............' : '_____________.......SAFE HOME FOR CHILDREN......._____________'}
                    </h1>
                `;
                carouselInner.appendChild(carouselItem);

                const indicator = document.createElement('li');a
                indicator.setAttribute('data-target', '#myCarousel');
                indicator.setAttribute('data-slide-to', index);
                if (index === 0) indicator.className = 'active';
                carouselIndicators.appendChild(indicator);
            });
        });
});