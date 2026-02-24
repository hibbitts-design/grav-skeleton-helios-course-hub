// Admin panel JS customizations

(function () {
    if (!window.heliosThemeMissing) { return; }

    // After a successful theme/license/GPM action, reload once any open dialog has closed
    function onSuccess() {
        var startTime = Date.now();
        function poll() {
            var elapsed = Date.now() - startTime;
            var modalOpen = document.body.classList.contains('remodal-is-opened') ||
                            document.body.classList.contains('modal-open') ||
                            !!document.querySelector('[role="dialog"]:not([aria-hidden="true"])');
            // Wait at least 2s and until no modal is open (30s maximum)
            if ((modalOpen || elapsed < 2000) && elapsed < 30000) {
                setTimeout(poll, 500);
            } else {
                window.location.reload();
            }
        }
        poll();
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
