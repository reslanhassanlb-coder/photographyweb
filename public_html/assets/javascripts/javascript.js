// --- MASONRY GRID FUNCTIONS (Outside DOMContentLoaded) ---

/**
 * Calculates and sets the row span for a single grid item based on its content height.
 */
function resizeGridItem(item) {
    const grid = document.querySelector('.gallery-grid');
    if (!grid) return;

    // Use row height and gap from CSS computed styles
    const rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
    let rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('gap'));
    if (isNaN(rowGap)) {
        rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-gap')); // Fallback
    }
    
    // 1. Handle hidden items (Optimization from user's new code)
    // If the item is hidden or transitioning out, reset its span and exit.
    if (item.style.display === 'none' || item.style.opacity === '0') {
        item.style.gridRowEnd = 'span 1'; 
        return;
    }

    const img = item.querySelector('img');
    const contentWrapper = item.querySelector('.gallery-content');
    
    // 2. Handle image loading (Robustness from user's new code)
    // Ensure image is present and loaded before calculating height
    if (!img || !img.complete) {
        // Fallback: If image isn't loaded, wait a bit and try again
        // We check 'img' is not null before setting onload
        img && (img.onload = () => resizeGridItem(item));
        return;
    }

    let itemContentHeight;
    
    // 3. ROBUST HEIGHT CALCULATION (Merged logic)
    // Prioritize measuring the dedicated content wrapper if it exists (for captions/text).
    if (contentWrapper) {
        itemContentHeight = contentWrapper.getBoundingClientRect().height;
    } else {
        // Fallback to image height if no specific content wrapper is found.
        itemContentHeight = img.getBoundingClientRect().height;
    }

    // Calculate how many rows the item should span (removed the arbitrary +20 buffer)
    const rowSpan = Math.ceil((itemContentHeight + rowGap) / (rowHeight + rowGap));

    // Apply the calculated span to the grid item
    item.style.gridRowEnd = `span ${rowSpan}`;
}

/**
 * Runs the resize calculation on all visible gallery items.
 */
function resizeAllGridItems() {
    // Target all gallery items (resizeGridItem handles visibility checks internally)
    const items = document.querySelectorAll('.gallery-item');
    items.forEach(item => resizeGridItem(item));
}


// --- LOADER HIDING LOGIC (Runs when ALL resources are loaded) ---
window.addEventListener('load', () => {
    const loader = document.getElementById('loader-wrapper');
    if (loader) {
        setTimeout(() => {
            loader.classList.add('hidden');
        }, 500); 
    }
    // Run masonry resize after images are loaded
    resizeAllGridItems();
    window.addEventListener('resize', resizeAllGridItems);
});


// --- MAIN DOM CONTENT LOADED BLOCK ---
document.addEventListener('DOMContentLoaded', () => {
    const e = document.getElementById("gallery");
    e && lightGallery(e, { selector: "a" }),
        (window.filterGallery = function (e, t) {
            document.querySelectorAll(".filter-btn").forEach((e) => e.classList.remove("active")), t.classList.add("active");
            document.querySelectorAll(".masonry-item").forEach((t) => {
                "all" === e || t.dataset.category === e ? (t.style.display = "block") : (t.style.display = "none");
            });
        });
    // ==========================================================
    // 1. ELEMENT REFERENCES
    // ==========================================================
    const header = document.getElementById('main-header');
    
    // Menu References
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('main-nav-menu');
    
    // Booking References
    const bookingIconToggle = document.getElementById('booking-icon-toggle');
    const bookingFlyoutPanel = document.getElementById('booking-flyout-panel');
    const mobileBookingPanel = document.getElementById('mobile-booking-panel'); 
    const bookingPanelClose = document.getElementById('booking-panel-close');    

    // User Access References (Desktop Flyout)
    const userIconToggle = document.getElementById('user-icon-toggle');
    const userFlyoutPanel = document.getElementById('user-flyout-panel');
    const loggedOutStateDesktop = document.getElementById('logged-out-state');
    const loggedInStateDesktop = document.getElementById('logged-in-state');
    const userDisplayName = document.getElementById('user-display-name');
    
    // User Access References (Mobile Contact Section)
    const loggedOutStateMobile = document.querySelector('.logged-out-state-mobile');
    const loggedInStateMobile = document.querySelector('.logged-in-state-mobile');

    // Gallery References
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');


   


    // ==========================================================
    // 3. RESPONSIVE PANEL MANAGEMENT FUNCTIONS
    // ==========================================================

    /**
     * Central function to manage the main menu state (Menu Icon).
     * @param {boolean} closeOnly If true, forces the menu closed without toggling.
     */
    const toggleMenu = (closeOnly = false) => {
        const isOpen = navMenu.classList.contains('is-open');
        const targetState = closeOnly ? false : !isOpen; 
        
        if (isOpen === targetState) return; 

        // CRITICAL: Close booking panel if main menu is opening
        if (targetState && mobileBookingPanel && mobileBookingPanel.classList.contains('is-open')) {
            mobileBookingPanel.classList.remove('is-open');
        }
        
        menuToggle.classList.toggle('is-active', targetState);
        navMenu.classList.toggle('is-open', targetState);
        document.body.classList.toggle('no-scroll', targetState);
    };
    
    /**
     * Central function to manage the booking panel state (Calendar Icon).
     * @param {boolean} closeOnly If true, forces the panel closed without toggling.
     */
    const toggleBookingPanel = (closeOnly = false) => {
        if (!mobileBookingPanel) return;
        
        const isOpen = mobileBookingPanel.classList.contains('is-open');
        const targetState = closeOnly ? false : !isOpen; 
        
        if (isOpen === targetState) return; 
        
        // CRITICAL: Close main menu if booking panel is opening
        if (targetState && navMenu && navMenu.classList.contains('is-open')) {
            toggleMenu(true); // Force menu closed
        }
        
        mobileBookingPanel.classList.toggle('is-open', targetState);
        document.body.classList.toggle('no-scroll', targetState);
    };

    // ==========================================================
    // 4. ICON EVENT LISTENERS (The core separation logic)
    // ==========================================================
    
    // --- MENU ICON LOGIC (Works on all screen sizes) ---
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', () => toggleMenu()); 
        
        // Close menu when a link is clicked
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (navMenu.classList.contains('is-open')) {
                    toggleMenu(true); 
                }
            });
        });
    }

    // --- USER ICON LOGIC (Desktop: Flyout, Mobile: Redirect) ---
    if (userIconToggle) {
        userIconToggle.addEventListener('click', (e) => {
            const isMobile = window.innerWidth <= 600;

            if (isMobile) {
                // MOBILE: Redirect to login form location
                e.preventDefault();
                window.location.href = '#contact'; 
                
                // Close any open panels
                if (navMenu && navMenu.classList.contains('is-open')) toggleMenu(true);
                if (mobileBookingPanel && mobileBookingPanel.classList.contains('is-open')) {
                    toggleBookingPanel(true); 
                }
            } else {
                // DESKTOP: Toggle the flyout panel
                e.preventDefault();
                e.stopPropagation();
                if(userFlyoutPanel) userFlyoutPanel.classList.toggle('is-open');
                if (bookingFlyoutPanel) bookingFlyoutPanel.classList.remove('is-open'); // Close other flyout
            }
        });
    }

    // --- CALENDAR ICON LOGIC (Desktop: Flyout, Mobile: DEDICATED PANEL) ---
    if (bookingIconToggle && bookingFlyoutPanel && mobileBookingPanel) {
        bookingIconToggle.addEventListener('click', (e) => {
            e.preventDefault();
            const isMobile = window.innerWidth <= 600; 

            if (isMobile) {
                // MOBILE: Open the dedicated booking panel
                toggleBookingPanel(); 
                
            } else {
                // DESKTOP: Toggle the flyout panel
                e.stopPropagation();
                bookingFlyoutPanel.classList.toggle('is-open');
                if (userFlyoutPanel) userFlyoutPanel.classList.remove('is-open'); 
            }
        });
        
        // --- MOBILE PANEL CLOSE LISTENER ---
        if (bookingPanelClose) {
            bookingPanelClose.addEventListener('click', () => {
                toggleBookingPanel(true); 
            });
        }
        
        // Close desktop flyout when a link inside is clicked
        bookingFlyoutPanel.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => bookingFlyoutPanel.classList.remove('is-open'));
        });
    }


    // ==========================================================
    // 5. UNIFIED CLOSE FLYOUTS ON DOCUMENT CLICK (Desktop Only)
    // ==========================================================
    document.addEventListener('click', (e) => {
        const isMobile = window.innerWidth <= 600;
        if (isMobile) return; 

        // Check and close Booking Flyout
        if (bookingFlyoutPanel && bookingFlyoutPanel.classList.contains('is-open') && 
            !bookingFlyoutPanel.contains(e.target) && e.target !== bookingIconToggle) {
            bookingFlyoutPanel.classList.remove('is-open');
        }

        // Check and close User Flyout
        if (userFlyoutPanel && userFlyoutPanel.classList.contains('is-open') && 
            !userFlyoutPanel.contains(e.target) && e.target !== userIconToggle) {
            userFlyoutPanel.classList.remove('is-open');
        }
    });

    // ==========================================================
    // 6. SCROLL EFFECTS & GALLERY FILTERING
    // ==========================================================
    
    // --- Header Scroll Effect ---
    window.addEventListener('scroll', () => {
        if (header) {
            if (window.scrollY > 50) {
                header.classList.add('nav-scrolled');
            } else {
                header.classList.remove('nav-scrolled');
            }
        }
    });

    // --- Gallery Filtering Logic ---
    if (filterButtons.length > 0 && galleryItems.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const filter = e.target.dataset.filter;

                // Update active button state
                filterButtons.forEach(btn => btn.classList.remove('active'));
                e.target.classList.add('active');

                // Filter and show/hide items with transition
                galleryItems.forEach(item => {
                    // Check if the item has the category class OR if the filter is 'all'
                    const shouldShow = filter === 'all' || item.dataset.category === filter; // Changed from classList.contains to dataset.category

                    if (shouldShow) {
                        item.style.display = 'block';
                        item.style.opacity = '0';
                        item.classList.add('animated'); 
                        
                        // Use a short timeout to re-apply opacity 1 after display: block
                        setTimeout(() => {
                            item.style.opacity = '1';
                            // Recalculate masonry layout after item is visible
                            resizeGridItem(item); 
                        }, 50); 
                    } else {
                        // Hide with transition
                        item.style.opacity = '0';
                        item.classList.remove('animated');
                        // Set display: none after the opacity transition is complete
                        setTimeout(() => {
                            item.style.display = 'none';
                            // Recalculate layout after item is hidden
                            resizeAllGridItems();
                        }, 300); // Should match CSS transition duration
                    }
                });
                
                // Re-run full masonry layout as a fallback
                setTimeout(resizeAllGridItems, 350); 
            });
        });
        
        // Ensure the 'all' filter is active on load
        const initialFilterButton = document.querySelector('.filter-btn[data-filter="all"]') || filterButtons[0];
        if (initialFilterButton) {
            // Use .click() to run the filter logic
            initialFilterButton.click(); 
        }
    }
    
    // --- SCROLL ANIMATION LOGIC ---
    const observerOptions = { threshold: 0.1 };
    
    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                // Optional: add a slight delay based on the element's order in the parent
                const index = Array.from(entry.target.parentNode.children).indexOf(entry.target);
                entry.target.style.animationDelay = `${index * 0.1}s`;
                
                observer.unobserve(entry.target);
            }
        });
    };

    const observer = new IntersectionObserver(observerCallback, observerOptions);
    // Find all elements meant to be animated and start watching them
    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
});

// --- WINDOW LOAD & RESIZE EVENTS (CRITICAL FOR MASONRY RELIABILITY) ---

// 1. Run Masonry when the entire page (including images) has fully loaded.
// This is the most reliable moment to calculate correct image heights.
// The listener is added again here to ensure it catches the very last moment of image loading.
window.addEventListener('load', resizeAllGridItems);

// 2. Rerun Masonry layout when the window is resized to handle responsive changes.
window.addEventListener('resize', resizeAllGridItems);
