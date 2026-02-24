// Admin panel JS customizations

(function () {
    if (!window.heliosThemeMissing) { return; }

    // Auto-reload after a successful theme/license/GPM action, but only once any open modal has closed
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

    // Only trigger for theme, license, or GPM admin endpoints
    function isRelevantUrl(url) {
        return typeof url === 'string' && (
            url.indexOf('/admin/themes') !== -1 ||
            url.indexOf('/admin/gpm') !== -1 ||
            url.indexOf('/admin/license') !== -1
        );
    }

    // Intercept XMLHttpRequest responses
    var origOpen = XMLHttpRequest.prototype.open;
    XMLHttpRequest.prototype.open = function (method, url) {
        var reqUrl = url;
        this.addEventListener('load', function () {
            if (this.status === 200 && isRelevantUrl(reqUrl)) {
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
        window.fetch = function (url, opts) {
            var reqUrl = typeof url === 'string' ? url : (url && url.url) || '';
            return origFetch.apply(this, arguments).then(function (response) {
                if (response.ok && isRelevantUrl(reqUrl)) {
                    response.clone().json().then(function (data) {
                        if (data.status === 'success') { onSuccess(); }
                    }).catch(function () {});
                }
                return response;
            });
        };
    }
})();
