import AOS from "aos";
AOS.init({
    duration: 1000,
    easing: 'ease-in-out',
    once: false,
    mirror: false
});

import * as fileinput from "bootstrap-fileinput";
window.fileinput = fileinput;
import "bootstrap-fileinput/themes/bs5/theme.min";
import "bootstrap-fileinput/js/locales/de";
import "bootstrap-fileinput/js/plugins/buffer.min";
import "bootstrap-fileinput/js/plugins/piexif.min";
import "bootstrap-fileinput/js/plugins/filetype.min";
import "bootstrap-fileinput/js/plugins/sortable.min";

import PureCounter from "@srexi/purecounterjs/js/purecounter";

import GLightbox from "glightbox/src/js/glightbox";

// Bootstrap Icons
import "../../../node_modules/bootstrap-icons/font/bootstrap-icons.scss";

// Fontawesome
import "../../../node_modules/@fortawesome/fontawesome-free/scss/brands.scss";
import "../../../node_modules/@fortawesome/fontawesome-free/scss/regular.scss";
import "../../../node_modules/@fortawesome/fontawesome-free/scss/solid.scss";
import "../../../node_modules/@fortawesome/fontawesome-free/scss/fontawesome.scss";

// Swiper
import Swiper from 'swiper/bundle';

import "../../../node_modules/datatables.net/js/jquery.dataTables";
import "../../../node_modules/datatables.net-bs5/js/dataTables.bootstrap5";

// Fancybox
import { Fancybox } from "@fancyapps/ui/dist/fancybox/fancybox.esm";
window.Fancybox = Fancybox;

import Isotope from "isotope-layout";
import lozad from "lozad";

$(() => {
    "use strict";

    const observer = lozad();
    observer.observe();

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all)
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener))
            } else {
                selectEl.addEventListener(type, listener)
            }
        }
    }

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener('scroll', listener)
    }

    /**
     * Header fixed top on scroll
     */
    let selectHeader = select('#header')
    if (selectHeader) {
        let headerOffset = selectHeader.offsetTop
        let nextElement = selectHeader.nextElementSibling
        const headerFixed = () => {
            if ((headerOffset - window.scrollY) <= 0) {
                selectHeader.classList.add('fixed-top')
                nextElement.classList.add('scrolled-offset')
            } else {
                selectHeader.classList.remove('fixed-top')
                nextElement.classList.remove('scrolled-offset')
            }
        }
        window.addEventListener('load', headerFixed)
        onscroll(document, headerFixed)
    }

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select('#header a', true)
    const navbarlinksActive = () => {
        let position = window.scrollY + 200
        navbarlinks.forEach(navbarlink => {
            if (!navbarlink.hash) return
            let section = select(navbarlink.hash)
            if (!section) return
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                navbarlink.classList.add('active')
            } else {
                navbarlink.classList.remove('active')
            }
        })
    }
    window.addEventListener('load', navbarlinksActive)
    onscroll(document, navbarlinksActive)

    /**
     * Scrolls to an element with header offset
     */
    const scrollto = (el) => {
        let header = select('#header')
        let offset = header.offsetHeight

        let elementPos = select(el).offsetTop
        window.scrollTo({
            top: elementPos - offset,
            behavior: 'smooth'
        })
    }

    /**
     * Scroll with ofset on page load with hash links in the url
     */
    window.addEventListener('load', () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash)
            }
        }
    });

    /**
     * Back to top button
     */
    let backToTop = select('.back-to-top')
    if (backToTop) {
        const toggleBackToTop = () => {
            if (window.scrollY > 100) {
                backToTop.classList.add('active')
            } else {
                backToTop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBackToTop)
        onscroll(document, toggleBackToTop)
    }

    /**
     * Preloader
     */
    let preloader = select('#preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.remove()
        });
    }

    new PureCounter();

    navigator.serviceWorker.register("./service-worker.js");

    if ("serviceWorker" in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register( "./service-worker.js").then(
                function(erfolg) {
                    console.log( "ServiceWorker wurde registriert.", erfolg);
                }
            ).catch(
                function(fehler) {
                    console.log( "ServiceWorker wurde leider nicht registriert.", fehler);
                }
            );
        });
    }

    /**
     * Porfolio isotope and filter
     */
    window.addEventListener('load', () => {
        let portfolioContainer = select('.portfolio-container');
        if (portfolioContainer) {
            let portfolioIsotope = new Isotope(portfolioContainer, {
                itemSelector: '.portfolio-item',
                layout: 'fitRows'
            });

            let portfolioFilter = select('#portfolio-flters li', true);

            on('click', '#portfolio-flters li', function(e) {
                e.preventDefault();
                portfolioFilter.forEach(function(el) {
                    el.classList.remove('filter-active');
                });
                this.classList.add('filter-active');

                portfolioIsotope.arrange({
                    filter: this.getAttribute('data-filter')
                });
                portfolioIsotope.on('arrangeComplete', function() {
                    AOS.refresh();
                });
            }, true);
        }
    });

    const galerieLightbox = GLightbox({
        selector: '.galerie-lightbox',
        openEffect: 'zoom',
        closeEffect: 'fade',
        loop: true,
    });

    Fancybox.bind('[data-fancybox="images"]', {
        Image: {
            zoom: true,
        },
        Toolbar: {
            display: [
                "zoom",
                "slideshow",
                "fullscreen",
                "download",
                "thumbs",
                "close",
            ],
        }
    });

    new Swiper('.portfolio-details-slider', {
        speed: 400,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        }
    });

    new Swiper(".slider", {
        lazy: {
            loadPrevNext: true,
            // loadPrevNextAmount: 4,
        },
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 5000,
            pauseOnMouseEnter: true,
            disableOnInteraction: false,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 24,
                // slidesPerGroup: 1,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 24,
                // slidesPerGroup: 2,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 24,
                // slidesPerGroup: 3,
            },
            1400: {
                slidesPerView: 4,
                spaceBetween: 24,
                // slidesPerGroup: 4,
            }
        }
    });

    new Swiper('.galerie-slider', {
        speed: 400,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1400: {
                slidesPerView: 5,
                spaceBetween: 20,
            }
        }
    });

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    setTimeout(function () {
        // Adding the class dynamically
        $('#alertGeb').addClass('hide');
    }, 30000);
});
