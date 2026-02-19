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
  const elements = document.querySelectorAll("[data-translate]");

  elements.forEach(el => {
    if (!el.dataset.original) el.dataset.original = el.textContent;

    translate(el.dataset.original, "en", lang)
      .then(translated => {
        el.textContent = translated;
      })
      .catch(err => {
        console.error("Translation error:", err);
      });
  });
}

const selected = document.querySelector(".selected-lang");

document.querySelectorAll(".lang-menu a").forEach(link => {
  link.addEventListener("click", function(e) {
    e.preventDefault();
    const lang = link.className;

    selected.textContent = link.textContent;
    selected.style.setProperty("--flag", `url(${link.dataset.flag})`);
    document.querySelector(".lang-menu ul").style.display = "none";

    translateContent(lang);
  });
});

selected.addEventListener("click", function() {
  const menu = document.querySelector(".lang-menu ul");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
});
