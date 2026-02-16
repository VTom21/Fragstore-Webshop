function translate(text, from = "en", to = "auto") {
  if (from === to) return Promise.resolve(text);
  if (!("Translator" in window)) return Promise.resolve(text);

  // Create the translator immediately on user gesture
  return Translator.create({ sourceLanguage: from, targetLanguage: to })
    .then(translator => translator.translate(text))
    .catch(err => {
      console.error("Translation failed:", err);
      return text;
    });
}

function translateContent(lang) {
  const elements = document.querySelectorAll("[data-i18n]");

  // Trigger translation for all elements immediately (concurrently)
  elements.forEach(el => {
    if (!el.dataset.original) el.dataset.original = el.textContent;

    // Each call happens directly inside the click handler
    translate(el.dataset.original, "en", lang)
      .then(translated => {
        el.textContent = translated;
      })
      .catch(err => {
        console.error("Translation error:", err);
      });
  });
}

// Language selection
const selected = document.querySelector(".selected-lang");

document.querySelectorAll(".lang-menu a").forEach(link => {
  link.addEventListener("click", function(e) {
    e.preventDefault();
    const lang = link.className;

    // Update UI immediately
    selected.textContent = link.textContent;
    selected.style.setProperty("--flag", `url(${link.dataset.flag})`);
    document.querySelector(".lang-menu ul").style.display = "none";

    // ⚡ Trigger all translations immediately here
    translateContent(lang);
  });
});

selected.addEventListener("click", function() {
  const menu = document.querySelector(".lang-menu ul");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
});
