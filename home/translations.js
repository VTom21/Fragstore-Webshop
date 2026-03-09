let translatorCache = {};
let currentLang = "en";

function translateContent(targetLang) {
  if (currentLang === targetLang) return;

  const elements = document.querySelectorAll("[data-translate]");
  const key = `${currentLang}_${targetLang}`;

  const translateElements = (translation_key) => {
    elements.forEach(el => {
      if (!el.dataset.original) el.dataset.original = el.textContent;
      translator.translate(el.dataset.original)
        .then(t => el.textContent = t)
        .catch(err => console.error(err));
    });
    currentLang = targetLang;
  };

  if (translatorCache[key]) {
    translateElements(translatorCache[key]);
  } else {
    Translator.create({ sourceLanguage: currentLang, targetLanguage: targetLang })
      .then(translation_key => {
        translatorCache[key] = translation_key;
        translateElements(translation_key);
      })
      .catch(err => console.error("Translation failed:", err));
  }
}

// Language switcher
const selected = document.querySelector(".selected-lang");

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