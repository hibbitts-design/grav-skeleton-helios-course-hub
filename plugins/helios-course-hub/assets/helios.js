// Admin panel JS customizations

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

    // Watch for dark class changes on <html> via MutationObserver,
    // since the Helios theme toggle buttons directly manipulate the
    // class list without dispatching the helios-theme-change event.
    // Only start observing after page has fully loaded, so we skip
    // the initial class mutations during page setup and only react
    // to user-initiated theme toggles.
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
})();
