let startTime = Date.now();

if (!localStorage.getItem('visitor_uuid')) {
    localStorage.setItem('visitor_uuid', crypto.randomUUID());
}

window.addEventListener('beforeunload', function () {
    let timeSpent = Math.floor((Date.now() - startTime) / 1000);

    navigator.sendBeacon('/track-visit', JSON.stringify({
        visitor_uuid: localStorage.getItem('visitor_uuid'),
        page_url: window.location.pathname,
        time_spent: timeSpent
    }));
});
