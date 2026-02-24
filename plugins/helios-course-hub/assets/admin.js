// Admin panel JS customizations

(function () {
    if (!window.heliosThemeMissing) { return; }

    // Auto-reload after a successful admin action, but only once any open modal has closed
    var successPending = false;

    function tryReload() {
        if (!successPending) { return; }
        if (document.body.classList.contains('remodal-is-opened')) { return; }
        window.location.reload();
    }

    // Watch for Remodal's remodal-is-opened class being removed from <body>
    var observer = new MutationObserver(function () { tryReload(); });
    observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });

    function onSuccess() {
        successPending = true;
        tryReload();
    }

    // Intercept XMLHttpRequest responses
    var origOpen = XMLHttpRequest.prototype.open;
    XMLHttpRequest.prototype.open = function () {
        this.addEventListener('load', function () {
            if (this.status === 200) {
                try {
                    var data = JSON.parse(this.responseText);
                    if (data.status === 'success') { onSuccess(); }
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
                        if (data.status === 'success') { onSuccess(); }
                    }).catch(function () {});
                }
                return response;
            });
        };
    }
})();
