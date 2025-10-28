async function startSocialLogin(provider) {
    try {
        // Get visitor UUID from localStorage
        const visitor_uuid = localStorage.getItem('visitor_uuid') || null;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Send UUID to server session
        const res = await fetch(`/auth/${provider}/start`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ visitor_uuid })
        });

        const data = await res.json();
        if (data.redirect) {
            // Redirect to Socialite redirect route
            window.location.href = data.redirect;
        } else {
            console.error('No redirect returned from server.');
        }
    } catch (err) {
        console.error(err);
        alert('Login failed, please try again.');
    }
}