let currentLang = "en";
const translationsCache = {};
const selected = document.querySelector(".selected-lang");
const elements = document.querySelectorAll("[data-translate]");

function translateContent(targetLang) {
  if (currentLang === targetLang) return;

  const key = `${currentLang}_${targetLang}`;

  if (translationsCache[key]) {
    // Apply cached translations immediately
    elements.forEach(el => el.textContent = translationsCache[key][el.dataset.original]);
    currentLang = targetLang;
  } else {
    // Prepare original text if missing
    elements.forEach(el => {
      if (!el.dataset.original) el.dataset.original = el.textContent;
    });

    // Create translator and translate all elements
    Translator.create({ sourceLanguage: currentLang, targetLanguage: targetLang })
      .then(translator => {
        translationsCache[key] = {};
        elements.forEach(el => {
          translator.translate(el.dataset.original)
            .then(translated => {
              translationsCache[key][el.dataset.original] = translated;
              el.textContent = translated;
            })
            .catch(err => console.error(err));
        });
        currentLang = targetLang;
      })
      .catch(err => console.error("Translation failed:", err));
  }
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