document.querySelectorAll(".slider").forEach((slider) => {
    const prevBtn = slider.querySelector('img[alt="Left"]');
    const nextBtn = slider.querySelector('img[alt="Right"]');
    const container = slider.querySelector(".slider-container");
    const track = slider.querySelector(".slider-container__content");
    const slides = Array.from(track.children);

    let currentIndex = 0;
    let slideWidth = 0;
    let visibleCount = 0;
    let maxIndex = 0;

    // Пересчитать размеры
    function calcDims() {
        if (!slides.length) return;
        // получаем gap из flex-контейнера
        const trackStyle = getComputedStyle(track);
        // gap в современных браузерах может быть в свойстве gap или columnGap
        const gap =
            parseFloat(trackStyle.gap) || parseFloat(trackStyle.columnGap) || 0;

        const rect = slides[0].getBoundingClientRect();
        slideWidth = rect.width + gap;
        visibleCount = Math.floor(container.clientWidth / slideWidth) || 1;
        maxIndex = Math.max(0, slides.length - visibleCount);
    }

    // Обновить позицию и видимость стрелок
    function update() {
        calcDims();
        // зажать текущий индекс в [0; maxIndex]
        currentIndex = Math.min(Math.max(currentIndex, 0), maxIndex);
        // сдвинуть трек
        track.style.transform = `translateX(${-currentIndex * slideWidth}px)`;
        // скрыть/показать стрелки
        prevBtn.style.visibility = currentIndex <= 0 ? "hidden" : "visible";
        nextBtn.style.visibility =
            currentIndex >= maxIndex ? "hidden" : "visible";
    }

    // листаем по одному
    prevBtn.addEventListener("click", () => {
        currentIndex--;
        update();
    });
    nextBtn.addEventListener("click", () => {
        currentIndex++;
        update();
    });

    // инициализация + пересчёт при ресайзе
    update();
    window.addEventListener("resize", update);
});
