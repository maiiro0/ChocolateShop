import EmblaCarousel from 'embla-carousel';

const carousel = document.querySelector('[data-product-carousel]');

if (carousel) {
    const viewport = carousel.querySelector('[data-carousel-viewport]');
    const previousButton = carousel.querySelector('[data-carousel-prev]');
    const nextButton = carousel.querySelector('[data-carousel-next]');
    const dotsContainer = carousel.querySelector('[data-carousel-dots]');

    if (viewport && previousButton && nextButton && dotsContainer) {
        const embla = EmblaCarousel(viewport, { align: 'start' });

        previousButton.addEventListener('click', () => embla.scrollPrev());
        nextButton.addEventListener('click', () => embla.scrollNext());

        const updateControls = () => {
            previousButton.disabled = !embla.canScrollPrev();
            nextButton.disabled = !embla.canScrollNext();

            const selectedSnap = embla.selectedScrollSnap();
            dotsContainer.querySelectorAll('button').forEach((dot, index) => {
                dot.setAttribute('aria-current', index === selectedSnap ? 'true' : 'false');
            });
        };

        const renderDots = () => {
            dotsContainer.replaceChildren();

            embla.scrollSnapList().forEach((_, index) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'h-3 w-3 rounded-full bg-[#351C17] opacity-40 aria-[current=true]:opacity-100';
                dot.setAttribute('aria-label', `Afficher la page ${index + 1} de produits`);
                dot.addEventListener('click', () => embla.scrollTo(index));
                dotsContainer.append(dot);
            });

            updateControls();
        };

        embla.on('select', updateControls);
        embla.on('reInit', renderDots);
        renderDots();
    }
}
