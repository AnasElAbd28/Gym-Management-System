const navSlide = () => {
    const burgers = document.querySelectorAll('.burger');
    burgers.forEach((burger) => {
        burger.addEventListener('click', () => {
            const nav = burger.parentElement.querySelector('.nav-links');
            nav.classList.toggle('nav-active');
            const navLinks = nav.querySelectorAll('li');
            navLinks.forEach((link, index) => {
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.5}s`;
            });
        });
    });
};

navSlide();




