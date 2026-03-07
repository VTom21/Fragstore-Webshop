var translatorCache = {};
var currentLang = "en";

var elements = document.querySelectorAll("[data-translate]");
var selected = document.querySelector(".selected-lang");
var langMenu = document.querySelector(".lang-menu ul");

function translateContent(targetLang) {

  if (currentLang === targetLang) return;

  var key = currentLang + "_" + targetLang;

  function runTranslation(translator) {

    for (var i = 0; i < elements.length; i++) {

      var el = elements[i];

      if (!el.dataset.original) {
        el.dataset.original = el.textContent;
      }

      translator.translate(el.dataset.original)
        .then(function(result) {
          this.el.textContent = result;
        }.bind({ el: el }))
        .catch(console.error);
    }

    currentLang = targetLang;
  }

  if (translatorCache[key]) {
    runTranslation(translatorCache[key]);
  } else {

    Translator.create({
      sourceLanguage: currentLang,
      targetLanguage: targetLang
    })
    .then(function(translator) {

      translatorCache[key] = translator;
      runTranslation(translator);

    })
    .catch(function(err) {
      console.error("Translation failed:", err);
    });
  }
}


/* language selector */

var langLinks = document.querySelectorAll(".lang-menu a");

for (var i = 0; i < langLinks.length; i++) {

  langLinks[i].addEventListener("click", function(e) {

    e.preventDefault();

    var targetLang = this.className;

    selected.textContent = this.textContent;
    selected.style.setProperty("--flag", "url(" + this.dataset.flag + ")");
    langMenu.style.display = "none";

    translateContent(targetLang);
  });

}