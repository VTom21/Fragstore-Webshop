var translatorCache = {};
var currentLang = "en"; 

function translateContent(targetLang) {
  var elements = document.querySelectorAll("[data-translate]");
  var key = currentLang + "_" + targetLang;

  if (currentLang === targetLang) return;

  if (translatorCache[key]) {

    for (var i = 0; i < elements.length; i++) {
      var el = elements[i];
      if (!el.dataset.original) el.dataset.original = el.textContent;

      translatorCache[key].translate(el.dataset.original)
        .then((function(el){ return function(t){ el.textContent = t; }; })(el))
        .catch(function(err){ console.error(err); });
    }
    currentLang = targetLang; 
  } else {

    Translator.create({ sourceLanguage: currentLang, targetLanguage: targetLang })
      .then(function(translator){
        translatorCache[key] = translator;

        for (var i = 0; i < elements.length; i++) {
          var el = elements[i];
          if (!el.dataset.original) el.dataset.original = el.textContent;

          translator.translate(el.dataset.original)
            .then((function(el){ return function(t){ el.textContent = t; }; })(el))
            .catch(function(err){ console.error(err); });
        }

        currentLang = targetLang;
      })
      .catch(function(err){ console.error("Translation failed:", err); });
  }
}

var selected = document.querySelector(".selected-lang");

var langLinks = document.querySelectorAll(".lang-menu a");
for (var i = 0; i < langLinks.length; i++) {
  langLinks[i].addEventListener("click", function(e){
    e.preventDefault();
    var targetLang = this.className;

    selected.textContent = this.textContent;
    selected.style.setProperty("--flag", "url(" + this.dataset.flag + ")");
    document.querySelector(".lang-menu ul").style.display = "none";

    translateContent(targetLang);
  });
}

selected.addEventListener("click", function(){
  var menu = document.querySelector(".lang-menu ul");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
});