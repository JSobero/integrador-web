function toggleAccordion(targetId) {
    const content = document.getElementById(targetId);
    const button = content.previousElementSibling.querySelector('.modern-accordion-button');

    // Cerrar otros acordeones
    document.querySelectorAll('.modern-accordion-content').forEach(item => {
        if (item.id !== targetId) {
            item.classList.remove('show');
            item.previousElementSibling.querySelector('.modern-accordion-button').classList.add('collapsed');
        }
    });

    // Toggle el acordeón actual
    content.classList.toggle('show');
    button.classList.toggle('collapsed');
}

// Animación de entrada para los elementos
document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.modern-accordion-item');
    items.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
    });
});

// Efecto de paralaje sutil
window.addEventListener('scroll', function () {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.main-panel');
    const speed = scrolled * 0.1;

    if (parallax) {
        parallax.style.transform = `translateY(${speed}px)`;
    }
});