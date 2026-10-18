/* Frontend behaviours (vanilla, no framework dependency). */
(function () {
    "use strict";

    var doc = document;
    var body = doc.body;

    function qs(sel, root) {
        return (root || doc).querySelector(sel);
    }

    function qsa(sel, root) {
        return Array.prototype.slice.call((root || doc).querySelectorAll(sel));
    }

    /* ---------------------------------------------------------- drawer */
    var drawer = qs(".fb-drawer");
    var backdrop = qs(".fb-drawer-backdrop");

    function openDrawer() {
        body.classList.add("fb-drawer-open");
        if (drawer) {
            drawer.setAttribute("aria-hidden", "false");
            var first = qs("a, button", drawer);
            if (first) {
                first.focus();
            }
        }
    }

    function closeDrawer() {
        body.classList.remove("fb-drawer-open");
        if (drawer) {
            drawer.setAttribute("aria-hidden", "true");
        }
    }

    qsa("[data-fb-drawer-open]").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            openDrawer();
        });
    });

    qsa("[data-fb-drawer-close]").forEach(function (el) {
        el.addEventListener("click", function (e) {
            e.preventDefault();
            closeDrawer();
        });
    });

    if (backdrop) {
        backdrop.addEventListener("click", closeDrawer);
    }

    if (drawer) {
        qsa("a[href]", drawer).forEach(function (a) {
            a.addEventListener("click", function () {
                closeDrawer();
            });
        });
    }

    doc.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeDrawer();
        }
    });

    /* ---------------------------------------------------------- header */
    var header = qs(".fb-header");
    var toTop = qs(".fb-float__top");
    var progress = qs(".fb-progress");

    function onScroll() {
        var y = window.pageYOffset || doc.documentElement.scrollTop;
        if (header) {
            header.classList.toggle("is-stuck", y > 8);
        }
        if (toTop) {
            toTop.classList.toggle("is-show", y > 480);
        }
        if (progress) {
            var total = doc.documentElement.scrollHeight - window.innerHeight;
            progress.style.width = (total > 0 ? Math.min(100, (y / total) * 100) : 0) + "%";
        }
    }

    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();

    if (toTop) {
        toTop.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    /* ---------------------------------------------------------- reveal */
    var revealItems = qsa(".fb-reveal");
    var revealAll = function () {
        revealItems.forEach(function (el) {
            el.classList.add("is-in");
        });
    };
    if (revealItems.length && "IntersectionObserver" in window) {
        doc.documentElement.classList.add("fb-js");
        var ro = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    en.target.classList.add("is-in");
                    ro.unobserve(en.target);
                }
            });
        }, { rootMargin: "0px 0px -6% 0px", threshold: 0.05 });
        revealItems.forEach(function (el) {
            ro.observe(el);
        });
        // safety net: nothing stays hidden if the observer never fires
        window.setTimeout(revealAll, 2500);
    } else {
        revealAll();
    }

    /* ---------------------------------------------------------- counters */
    function runCounter(el) {
        var target = parseFloat(el.getAttribute("data-count"));
        var decimals = parseInt(el.getAttribute("data-decimals") || "0", 10);
        var prefix = el.getAttribute("data-prefix") || "";
        var suffix = el.getAttribute("data-suffix") || "";
        var duration = 1400;
        var start = null;

        if (isNaN(target)) {
            return;
        }

        function frame(ts) {
            if (!start) {
                start = ts;
            }
            var p = Math.min(1, (ts - start) / duration);
            var eased = 1 - Math.pow(1 - p, 3);
            var val = target * eased;
            el.textContent = prefix + val.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ",") + suffix;
            if (p < 1) {
                window.requestAnimationFrame(frame);
            }
        }

        window.requestAnimationFrame(frame);
    }

    var counters = qsa("[data-count]");
    if (counters.length && "IntersectionObserver" in window) {
        var co = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    runCounter(en.target);
                    co.unobserve(en.target);
                }
            });
        }, { threshold: 0.4 });
        counters.forEach(function (el) {
            co.observe(el);
        });
    } else {
        counters.forEach(runCounter);
    }

    /* ---------------------------------------------------------- testimonial scroller */
    qsa("[data-fb-scroller]").forEach(function (wrap) {
        var track = qs(".fb-testi-scroller", wrap);
        if (!track) {
            return;
        }
        qsa("[data-fb-scroll]", wrap).forEach(function (btn) {
            btn.addEventListener("click", function () {
                var card = qs(".fb-testi", track);
                var step = card ? card.getBoundingClientRect().width + 16 : 320;
                var dir = btn.getAttribute("data-fb-scroll") === "prev" ? -1 : 1;
                track.scrollBy({ left: dir * step, behavior: "smooth" });
            });
        });
    });

    /* ---------------------------------------------------------- legal TOC */
    var legalBody = qs(".fb-legal__body");
    var legalToc = qs(".fb-legal__toc ol");
    if (legalBody && legalToc) {
        var heads = qsa("h3", legalBody);
        heads.forEach(function (h, i) {
            if (!h.id) {
                h.id = "sec-" + (i + 1);
            }
            var li = doc.createElement("li");
            var a = doc.createElement("a");
            a.href = "#" + h.id;
            a.textContent = h.textContent.replace(/\s+/g, " ").trim();
            li.appendChild(a);
            legalToc.appendChild(li);
        });

        if (heads.length && "IntersectionObserver" in window) {
            var links = qsa("a", legalToc);
            var to = new IntersectionObserver(function (entries) {
                entries.forEach(function (en) {
                    if (en.isIntersecting) {
                        links.forEach(function (l) {
                            l.classList.toggle("is-active", l.getAttribute("href") === "#" + en.target.id);
                        });
                    }
                });
            }, { rootMargin: "-20% 0px -70% 0px", threshold: 0 });
            heads.forEach(function (h) {
                to.observe(h);
            });
        }
    }

    /* ---------------------------------------------------------- sticky cta */
    if (qs(".fb-sticky-cta")) {
        body.classList.add("has-sticky-cta");
    }
})();

/* ---------------------------------------------------------- quick apply (hero) */
(function () {
    "use strict";

    var doc = document;

    function qsa(sel, root) {
        return Array.prototype.slice.call((root || doc).querySelectorAll(sel));
    }

    var KEY = "fl_quick_phone";

    qsa("[data-fb-quick]").forEach(function (box) {
        var form = box.querySelector(".fb-quick__form");
        var input = box.querySelector("input[name=phone]");
        var hint = box.querySelector(".fb-quick__hint");
        if (!form || !input) {
            return;
        }

        qsa(".fb-mode button[data-mode]", box).forEach(function (btn) {
            btn.addEventListener("click", function () {
                qsa(".fb-mode button", box).forEach(function (b) {
                    b.classList.toggle("is-active", b === btn);
                });
                form.setAttribute("data-mode", btn.getAttribute("data-mode"));
                input.focus();
            });
        });

        input.addEventListener("input", function () {
            input.value = input.value.replace(/\D/g, "").slice(0, 10);
            if (hint) {
                hint.classList.remove("is-show");
            }
        });

        form.addEventListener("submit", function (e) {
            e.preventDefault();
            var phone = input.value.replace(/\D/g, "");
            if (!/^[6-9][0-9]{9}$/.test(phone)) {
                if (hint) {
                    hint.textContent = "Please enter a valid 10 digit Indian mobile number.";
                    hint.classList.add("is-show");
                }
                input.focus();
                return false;
            }
            try {
                window.sessionStorage.setItem(KEY, phone);
            } catch (err) {
                /* storage unavailable: the user types the number again on the next step */
            }
            var mode = form.getAttribute("data-mode") === "consultant" ? "consultant" : "self";
            var url = form.getAttribute("data-" + mode) || form.getAttribute("data-self");
            if (url) {
                window.location.href = url;
            }
            return false;
        });
    });

    /* pre-fill the verify step with the number typed in the hero */
    var verify = doc.getElementById("fl-verify-form");
    if (verify) {
        var phoneField = verify.querySelector("input[name=phone]");
        try {
            var saved = window.sessionStorage.getItem(KEY);
            if (saved && phoneField && !phoneField.value && !phoneField.readOnly) {
                phoneField.value = saved;
                var nameField = verify.querySelector("input[name=name]");
                if (nameField && !nameField.value) {
                    nameField.focus();
                }
            }
            window.sessionStorage.removeItem(KEY);
        } catch (err) {
            /* ignore */
        }
    }

    /* partner grid: load more / view less */
    qsa("[data-fb-more]").forEach(function (btn) {
        var grid = doc.querySelector("[data-fb-partners]");
        if (!grid) {
            return;
        }
        var open = false;
        var hidden = qsa(".fb-partners-grid__item", grid).filter(function (el) {
            return el.classList.contains("is-hidden");
        });
        btn.addEventListener("click", function () {
            open = !open;
            hidden.forEach(function (el) {
                el.classList.toggle("is-hidden", !open);
            });
            btn.innerHTML = (open ? btn.getAttribute("data-less-text") : btn.getAttribute("data-more-text"))
                + ' <i class="bi ' + (open ? "bi-chevron-up" : "bi-chevron-down") + '"></i>';
        });
    });
})();
