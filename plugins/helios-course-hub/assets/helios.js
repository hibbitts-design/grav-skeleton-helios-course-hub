// Frontend JS customizations

(function () {
  var theme = localStorage.getItem("helios-theme") || "system";
  var isDark =
    theme === "dark" ||
    (theme === "system" &&
      window.matchMedia("(prefers-color-scheme: dark)").matches);
  var cardTheme = isDark ? "dark" : "light";

  var embeds = document.querySelectorAll(".embedly-card");
  for (var i = 0; i < embeds.length; i++) {
    embeds[i].setAttribute("data-card-theme", cardTheme);
  }

  // Load Embedly platform.js if embedly cards are present
  if (embeds.length > 0) {
    var script = document.createElement("script");
    script.src = "https://cdn.embedly.com/widgets/platform.js";
    script.async = true;
    document.body.appendChild(script);

    // Reload on theme class change so Embedly cards re-render with the correct theme
    window.addEventListener("load", function () {
      var observer = new MutationObserver(function () {
        observer.disconnect();
        window.location.reload();
      });
      observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ["class"],
      });
    });
  }

  // --- BEGIN: HTMX Embedly fix --- (remove this block if it causes issues)
  window.addEventListener("helios:content-loaded", function (evt) {
    var container = evt.detail && evt.detail.container;
    if (!container) return;

    var newEmbeds = container.querySelectorAll(".embedly-card");
    if (newEmbeds.length === 0) return;

    for (var i = 0; i < newEmbeds.length; i++) {
      newEmbeds[i].setAttribute("data-card-theme", cardTheme);
    }

    if (window.embedly) {
      // platform.js already loaded — process new cards
      window.embedly("card", newEmbeds);
    } else {
      // platform.js not yet loaded — load it (auto-scans all cards on load)
      var s = document.createElement("script");
      s.src = "https://cdn.embedly.com/widgets/platform.js";
      s.async = true;
      document.body.appendChild(s);
    }
  });
  // --- END: HTMX Embedly fix ---
})();
