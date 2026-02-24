// Admin panel JS customizations

(function () {
    if (!window.heliosThemeMissing) { return; }

    // When the Helios theme is missing, auto-reload the page after any successful
    // admin AJAX action (e.g. theme activation) so the warning banner is cleared
    function scheduleReload() {
        setTimeout(function () { window.location.reload(); }, 800);
    }

    // Intercept XMLHttpRequest responses
    var origOpen = XMLHttpRequest.prototype.open;
    XMLHttpRequest.prototype.open = function () {
        this.addEventListener('load', function () {
            if (this.status === 200) {
                try {
                    var data = JSON.parse(this.responseText);
                    if (data.status === 'success') { scheduleReload(); }
                } catch (e) {}
            }
        });
        origOpen.apply(this, arguments);
    };

    // Intercept fetch API responses
    if (window.fetch) {
        var origFetch = window.fetch;
        window.fetch = function () {
            return origFetch.apply(this, arguments).then(function (response) {
                if (response.ok) {
                    response.clone().json().then(function (data) {
                        if (data.status === 'success') { scheduleReload(); }
                    }).catch(function () {});
                }
                return response;
            });
        };
    }
})();
