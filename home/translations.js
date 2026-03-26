let currentLang = "en";
const translationsCache = {};
const selected = document.querySelector(".selected-lang");
const elements = document.querySelectorAll("[data-translate]");

// Main translate function
function translateContent(targetLang) {
  if (currentLang === targetLang) return;

  const key = `${currentLang}_${targetLang}`;

  // Prepare original text
  elements.forEach(el => {
    if (!el.dataset.original) el.dataset.original = el.textContent;
  });

  // Use cached translations if available
  if (translationsCache[key]) {
    elements.forEach(el => el.textContent = translationsCache[key][el.dataset.original]);
    currentLang = targetLang;
    return;
  }

  // Create translator and translate
  Translator.create({ sourceLanguage: currentLang, targetLanguage: targetLang })
    .then(translator => {
      translationsCache[key] = {};
      elements.forEach(el => {
        translator.translate(el.dataset.original)
          .then(t => {
            el.textContent = t;
            translationsCache[key][el.dataset.original] = t;
          })
          .catch(err => console.error(err));
      });
      currentLang = targetLang;
    })
    .catch(err => console.error("Translation failed:", err));
}

// Language switcher
document.querySelectorAll(".lang-menu a").forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const targetLang = link.className;

    selected.textContent = link.textContent;
    selected.style.setProperty("--flag", `url(${link.dataset.flag})`);
    document.querySelector(".lang-menu ul").style.display = "none";

    translateContent(targetLang);
  });
});