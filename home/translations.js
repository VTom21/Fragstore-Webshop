function translate(text, from = "en", to = "auto") {

  if (!("Translator" in window)) {
    return Promise.resolve(text);
  }

  return Translator.create({ sourceLanguage: from, targetLanguage: to })
    .then(translator => translator.translate(text))
    .catch(err => {
      console.error("Translation failed:", err);
      return text; 
    });
}

function translateContent(lang) {
  var elements = document.querySelectorAll("[data-i18n]");

  elements.forEach(function(el) {
    if (!el.dataset.original) {
      el.dataset.original = el.textContent;
    }
    
    translate(el.dataset.original, "en", lang)
      .then(function(translated) {
        el.textContent = translated;
      })
      .catch(function(err) {
        console.error("Translation error:", err);
      });
  });
}

var selected = document.querySelector(".selected-lang");

document.querySelectorAll(".lang-menu a").forEach(function(link) {
  link.addEventListener("click", function(e) {
    e.preventDefault();
    var lang = link.className;

    selected.textContent = link.textContent;
    selected.style.setProperty("--flag", "url(" + link.dataset.flag + ")");
    document.querySelector(".lang-menu ul").style.display = "none";

    translateContent(lang); 
  });
});

selected.addEventListener("click", function() {
  var menu = document.querySelector(".lang-menu ul");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
});
