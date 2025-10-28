document.addEventListener("DOMContentLoaded", () => {
    "use strict";
    const e = document.getElementById("gallery");
    e && lightGallery(e, { selector: "a" }),
        (window.filterGallery = function (e, t) {
            document.querySelectorAll(".filter-btn").forEach((e) => e.classList.remove("active")), t.classList.add("active");
            document.querySelectorAll(".masonry-item").forEach((t) => {
                "all" === e || t.dataset.category === e ? (t.style.display = "block") : (t.style.display = "none");
            });
        });
    const t = document.querySelector("nav.navbar");
    t &&
        window.addEventListener("scroll", () => {
            window.scrollY > 50 ? t.classList.add("scrolled") : t.classList.remove("scrolled");
        });
    const o = document.getElementById("loader-wrapper");
    window.addEventListener("load", function () {
        o.classList.add("fade-out");
    });
    const i = document.querySelector("#header");
    if (i) {
        let e = i.offsetTop,
            t = i.nextElementSibling;
        const o = () => {
            e - window.scrollY <= 0 ? (i.classList.add("sticked"), t && t.classList.add("sticked-header-offset")) : (i.classList.remove("sticked"), t && t.classList.remove("sticked-header-offset"));
        };
        window.addEventListener("load", o), document.addEventListener("scroll", o);
    }
    const l = document.querySelector("#header");
    if (l) {
        const e = function () {
            window.scrollY > 100 ? l.classList.add("stikcy-menu") : l.classList.remove("stikcy-menu");
        };
        window.addEventListener("load", e), document.addEventListener("scroll", e), l.addEventListener("click", window.scrollTo({ top: 0, behavior: "smooth" }));
    }
    let n = document.querySelectorAll("#navbar a");
    function s() {
        n.forEach((e) => {
            if (!e.hash) return;
            let t = document.querySelector(e.hash);
            if (!t) return;
            let o = window.scrollY + 10;
            o >= t.offsetTop && o <= t.offsetTop + t.offsetHeight ? e.classList.add("active") : e.classList.remove("active");
        });
    }
    window.addEventListener("load", s), document.addEventListener("scroll", s);
    const r = document.querySelector("#preloader");
    r &&
        window.addEventListener("load", () => {
            r.remove();
        });
    GLightbox({ selector: ".glightbox" });
    const a = document.querySelector(".mobile-nav-show"),
        c = document.querySelector(".mobile-nav-hide");
    function d() {
        document.querySelector("body").classList.toggle("mobile-nav-active"), a.classList.toggle("d-none"), c.classList.toggle("d-none");
    }
    document.querySelectorAll(".mobile-nav-toggle").forEach((e) => {
        e.addEventListener("click", function (e) {
            e.preventDefault(), d();
        });
    }),
        document.querySelectorAll("#navbar a").forEach((e) => {
            if (!e.hash) return;
            document.querySelector(e.hash) &&
                e.addEventListener("click", () => {
                    document.querySelector(".mobile-nav-active") && d();
                });
        });
    document.querySelectorAll(".navbar .dropdown > a").forEach((e) => {
        e.addEventListener("click", function (e) {
            if (document.querySelector(".mobile-nav-active")) {
                e.preventDefault(), this.classList.toggle("active"), this.nextElementSibling.classList.toggle("dropdown-active");
                let t = this.querySelector(".dropdown-indicator");
                t.classList.toggle("bi-chevron-up"), t.classList.toggle("bi-chevron-down");
            }
        });
    });
    const u = document.querySelector(".scroll-top");
    if (u) {
        const e = function () {
            window.scrollY > 100 ? u.classList.add("active") : u.classList.remove("active");
        };
        window.addEventListener("load", e), document.addEventListener("scroll", e), u.addEventListener("click", window.scrollTo({ top: 0, behavior: "smooth" }));
    }
    let p = document.querySelector(".portfolio-isotope");
    if (p) {
        let e = p.getAttribute("data-portfolio-filter") ? p.getAttribute("data-portfolio-filter") : "*",
            t = p.getAttribute("data-portfolio-layout") ? p.getAttribute("data-portfolio-layout") : "masonry",
            o = p.getAttribute("data-portfolio-sort") ? p.getAttribute("data-portfolio-sort") : "original-order";
        window.addEventListener("load", () => {
            let i = new Isotope(document.querySelector(".portfolio-container"), { itemSelector: ".portfolio-item", layoutMode: t, filter: e, sortBy: o });
            document.querySelectorAll(".portfolio-isotope .portfolio-flters li").forEach(function (e) {
                e.addEventListener(
                    "click",
                    function () {
                        document.querySelector(".portfolio-isotope .portfolio-flters .filter-active").classList.remove("filter-active"), this.classList.add("filter-active"), i.arrange({ filter: this.getAttribute("data-filter") }), w();
                    },
                    !1
                );
            });
        });
    }
    function w() {
        AOS.init({ duration: 1e3, easing: "ease-in-out", once: !0, mirror: !1 });
    }
    new Swiper(".clients-slider", {
        speed: 400,
        loop: !0,
        autoplay: { delay: 5e3, disableOnInteraction: !1 },
        slidesPerView: "auto",
        pagination: { el: ".swiper-pagination", type: "bullets", clickable: !0 },
        breakpoints: { 320: { slidesPerView: 2, spaceBetween: 40 }, 480: { slidesPerView: 3, spaceBetween: 60 }, 640: { slidesPerView: 3, spaceBetween: 80 }, 992: { slidesPerView: 5, spaceBetween: 120 } },
    }),
        new Swiper(".slides-1", {
            speed: 600,
            loop: !0,
            autoplay: { delay: 5e3, disableOnInteraction: !1 },
            slidesPerView: "auto",
            pagination: { el: ".swiper-pagination", type: "bullets", clickable: !0 },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        }),
        new Swiper(".slides-3", {
            speed: 600,
            loop: !0,
            autoplay: { delay: 5e3, disableOnInteraction: !1 },
            slidesPerView: "auto",
            pagination: { el: ".swiper-pagination", type: "bullets", clickable: !0 },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            breakpoints: { 320: { slidesPerView: 1, spaceBetween: 40 }, 1200: { slidesPerView: 1 } },
        }),
        window.addEventListener("load", () => {
            w();
        });
});
