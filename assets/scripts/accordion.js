document.querySelectorAll(".accordion").forEach(initAccordion);

function initAccordion(accordion) {
    const header = accordion.querySelector(".accordion__header");
    const content = accordion.querySelector(".accordion__content");

    content.style.maxHeight = "0";

    header.addEventListener("click", () => toggle(accordion, content));
}

function toggle(accordion, content) {
    const isOpen = accordion.classList.contains("is-open");

    const startHeight = content.getBoundingClientRect().height;

    if (content.style.maxHeight === "none")
        content.style.maxHeight = startHeight + "px";

    if (!isOpen) {
        accordion.classList.add("is-open");

        content.style.maxHeight = startHeight + "px";

        requestAnimationFrame(() => {
            const h = content.scrollHeight;
            content.style.maxHeight = h + "px";
        });

        content.addEventListener("transitionend", function tEnd(e) {
            if (e.propertyName !== "max-height") return;
            content.style.maxHeight = "none";
            content.removeEventListener("transitionend", tEnd);
        });
    } else {
        content.style.maxHeight = startHeight + "px";

        void content.offsetHeight;

        content.style.maxHeight = "0px";
        accordion.classList.remove("is-open");
    }
}
