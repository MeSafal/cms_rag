(function () {
			function maybePrefixUrlField() {
				const value = this.value.trim()
				if (value !== '' && value.indexOf('http') !== 0) {
					this.value = 'http://' + value
				}
			}

			const urlFields = document.querySelectorAll('.mc4wp-form input[type="url"]')
			for (let j = 0; j < urlFields.length; j++) {
				urlFields[j].addEventListener('blur', maybePrefixUrlField)
			}
		})();
		const lazyloadRunObserver = () => {
			const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
			const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
				entries.forEach((entry) => {
					if (entry.isIntersecting) {
						let lazyloadBackground = entry.target;
						if (lazyloadBackground) {
							lazyloadBackground.classList.add('e-lazyloaded');
						}
						lazyloadBackgroundObserver.unobserve(entry.target);
					}
				});
			}, { rootMargin: '200px 0px 200px 0px' });
			lazyloadBackgrounds.forEach((lazyloadBackground) => {
				lazyloadBackgroundObserver.observe(lazyloadBackground);
			});
		};
		const events = [
			'DOMContentLoaded',
			'elementor/lazyload/observe',
		];
		events.forEach((event) => {
			document.addEventListener(event, lazyloadRunObserver);
		});
		(function () {
			var c = document.body.className;
			c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
			document.body.className = c;
		})();

		document.addEventListener("DOMContentLoaded", function () {
			const section = document.getElementById("slideshow-section");
			const overlay = document.getElementById("overlay");
			const subtitle = document.getElementById("slideshow-subtitle");
			const title = document.getElementById("slideshow-title");
			const description = document.getElementById("slideshow-description");
			const buttonText = document.getElementById("slideshow-btn-text");
			const buttonLink = document.getElementById("slideshow-btn-link");

			// Get all the slides from HTML
			const slides = document.querySelectorAll("#slideshow-items .slide");
			let currentIndex = 0;

			// Set the initial content (the first slide)
			function changeSlideshowContent() {
				const slide = slides[currentIndex];

				// Update the background image and content from data-* attributes
				section.style.backgroundImage = `url('${slide.getAttribute('data-image')}')`;
				overlay.style.transition = 'opacity 1s ease-in-out'; // Smooth overlay fade
				overlay.style.opacity = 0.8;  // Set overlay opacity

				subtitle.textContent = slide.getAttribute('data-subtitle');
				title.textContent = slide.getAttribute('data-title');
				description.textContent = slide.getAttribute('data-description');
				buttonText.textContent = slide.getAttribute('data-button-text');
				buttonLink.href = slide.getAttribute('data-button-link');

				// Move to the next slide
				currentIndex = (currentIndex + 1) % slides.length;
			}

			// Fade effect for all content (image, text, and buttons)
			function fadeContent() {
				// Apply fade-out effect to all content
				section.style.transition = 'opacity 1s ease-in-out';
				section.style.opacity = 0;  // Fade out the entire section

				overlay.style.transition = 'opacity 1s ease-in-out';
				overlay.style.opacity = 0;  // Fade out the overlay

				subtitle.style.transition = 'opacity 1s ease-in-out';
				subtitle.style.opacity = 0;  // Fade out the subtitle

				title.style.transition = 'opacity 1s ease-in-out';
				title.style.opacity = 0;  // Fade out the title

				description.style.transition = 'opacity 1s ease-in-out';
				description.style.opacity = 0;  // Fade out the description

				buttonText.style.transition = 'opacity 1s ease-in-out';
				buttonText.style.opacity = 0;  // Fade out the button text

				buttonLink.style.transition = 'opacity 1s ease-in-out';
				buttonLink.style.opacity = 0;  // Fade out the button link

				// After fade-out, change the image and fade it back in
				setTimeout(function () {
					changeSlideshowContent();

					// Fade in all content
					section.style.transition = 'opacity 1s ease-in-out';
					section.style.opacity = 1;  // Fade in the image

					overlay.style.transition = 'opacity 1s ease-in-out';
					overlay.style.opacity = 0.8;  // Fade in the overlay

					subtitle.style.transition = 'opacity 1s ease-in-out';
					subtitle.style.opacity = 1;  // Fade in the subtitle

					title.style.transition = 'opacity 1s ease-in-out';
					title.style.opacity = 1;  // Fade in the title

					description.style.transition = 'opacity 1s ease-in-out';
					description.style.opacity = 1;  // Fade in the description

					buttonText.style.transition = 'opacity 1s ease-in-out';
					buttonText.style.opacity = 1;  // Fade in the button text

					buttonLink.style.transition = 'opacity 1s ease-in-out';
					buttonLink.style.opacity = 1;  // Fade in the button link
				}, 1000); // Wait for fade-out to complete (1 second)
			}

			// Set initial content
			changeSlideshowContent();

			// Change content every 5 seconds with fade effect for the image
			setInterval(fadeContent, 5000);

			// After the content is loaded, remove the loading slide and start the slideshow
			const loadingSlide = document.getElementById('loading-slide');
			loadingSlide.style.display = 'none'; // Hide loading slide
		});

