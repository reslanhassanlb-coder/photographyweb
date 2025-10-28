document.addEventListener("DOMContentLoaded", function () {
    let startTime = Date.now();

    // Visitor UUID
    let visitor_uuid = localStorage.getItem("visitor_uuid");
    if (!visitor_uuid) {
        visitor_uuid = crypto.randomUUID();
        localStorage.setItem("visitor_uuid", visitor_uuid);
    }

    // Only send once on page unload
    window.addEventListener("beforeunload", function () {
        const endTime = Date.now();
        const timeSpent = Math.floor((endTime - startTime) / 1000);

        fetch("/track-visit", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                visitor_uuid: localStorage.getItem('visitor_uuid'),
                page_url: window.location.pathname,
                time_spent: timeSpent
            }),
            keepalive: true // ensures fetch completes even when page closes
        });
    });
});
