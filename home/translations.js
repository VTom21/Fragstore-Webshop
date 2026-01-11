const translations = {
  games: { us: "Games", de: "Spiele", it: "Giochi", es: "Juegos", ru: "Игры", fr: "Jeux", in: "खेल", jp: "ゲーム" },
  giftcards: { us: "Gift Cards", de: "Geschenkkarten", it: "Carte Regalo", es: "Tarjetas de Regalo", ru: "Подарочные карты", fr: "Cartes Cadeaux", in: "उपहार कार्ड", jp: "ギフトカード" },
  genres: { us: "Genres", de: "Genres", it: "Generi", es: "Géneros", ru: "Жанры", fr: "Genres", in: "शैलियाँ", jp: "ジャンル" },
  contact: { us: "Contact", de: "Kontakt", it: "Contatto", es: "Contacto", ru: "Контакты", fr: "Contact", in: "संपर्क करें", jp: "お問い合わせ" },
  about_us: { us: "About Us", de: "Über uns", it: "Chi Siamo", es: "Nosotros", ru: "О нас", fr: "À propos", in: "हमारे बारे में", jp: "私たちについて" },
  log_in: { us: "Log in", de: "Einloggen", it: "Accedi", es: "Acceso", ru: "Войти", fr: "Se connecter", in: "लॉग इन करें", jp: "ログイン" },
  sign_up: { us: "Sign up", de: "Registrieren", it: "Registrati", es: "Registrarse", ru: "Регистрация", fr: "S'inscrire", in: "साइन अप करें", jp: "サインアップ" },
  log_out: { us: "Log out", de: "Abmelden", it: "disconnettersi", es: "desconectarse", ru: "выйти", fr: "déconnexion", in: "लॉग ऑफ़", jp: "ログアウト" },
  hero_heading: { us: "Unlock the Future of Gaming", de: "Entdecke die Zukunft des Gamings", it: "Scopri il Futuro del Gaming", es: "Desbloquea el Futuro del Gaming", ru: "Откройте будущее гейминга", fr: "Déverrouillez l'avenir du gaming", in: "गेमिंग का भविष्य खोलें", jp: "ゲームの未来を解き放つ" },
  hero_content: { us: "Discover exclusive deals, rare collectibles, and your next favorite adventure — all in one place.", de: "Entdecken Sie exklusive Angebote, seltene Sammlerstücke und Ihr nächstes Lieblingsabenteuer – alles an einem Ort.", it: "Scopri offerte esclusive, collezionabili rari e la tua prossima avventura preferita — tutto in un unico posto.", es: "Descubre ofertas exclusivas, coleccionables raros y tu próxima aventura favorita — todo en un solo lugar.", ru: "Откройте эксклюзивные предложения, редкие коллекционные предметы и ваше следующее любимое приключение — всё в одном месте.", fr: "Découvrez des offres exclusives, des objets de collection rares et votre prochaine aventure préférée — tout en un seul endroit.", in: "विशेष ऑफ़र, दुर्लभ संग्रहणीय और आपका अगला पसंदीदा रोमांच — सब एक ही जगह।", jp: "限定の特典やレアコレクション、次の冒険を一箇所で発見しよう。" },
  explore: { us: "Explore Games", de: "Spiele erkunden", it: "Esplora Giochi", es: "Explorar Juegos", ru: "Исследовать игры", fr: "Explorer les jeux", in: "खेल खोजें", jp: "ゲームを探索" },
  buy: { us: "Buy Gift Cards", de: "Geschenkkarten kaufen", it: "Acquista Carte Regalo", es: "Comprar Tarjetas de Regalo", ru: "Купить подарочные карты", fr: "Acheter des cartes cadeaux", in: "उपहार कार्ड खरीदें", jp: "ギフトカードを購入" },
  intro_heading: { us: "Power Up Your Play", de: "Verstärke dein Spiel", it: "Potenzia il Tuo Gioco", es: "Potencia tu Juego", ru: "Улучшите вашу игру", fr: "Boostez votre jeu", in: "अपने खेल को बढ़ाएँ", jp: "プレイをパワーアップ" },
  intro_content: { us: "Upgrade your setup with elite gaming gear built for speed, precision, and performance. Crafted for those who demand more from every frame.", de: "Rüste dein Setup mit High-End-Gaming-Hardware auf, die für Geschwindigkeit, Präzision und Leistung entwickelt wurde. Für alle, die in jedem Frame mehr erwarten.", it: "Aggiorna il tuo setup con hardware da gaming d'élite progettato per velocità, precisione e prestazioni. Creato per chi esige il massimo da ogni frame.", es: "Mejora tu configuración con hardware de élite diseñado para velocidad, precisión y rendimiento. Creado para quienes exigen lo máximo en cada frame.", ru: "Обновите вашу игровую установку с помощью элитного оборудования, созданного для скорости, точности и производительности. Разработано для тех, кто требует максимума от каждого кадра.", fr: "Améliorez votre configuration avec du matériel de jeu haut de gamme conçu pour la vitesse, la précision et la performance. Conçu pour ceux qui exigent le meilleur à chaque image.", in: "उच्च-गुणवत्ता गेमिंग हार्डवेयर के साथ अपनी सेटअप को अपग्रेड करें, जो गति, सटीकता और प्रदर्शन के लिए डिज़ाइन किया गया है। हर फ्रेम में अधिक की मांग करने वालों के लिए बनाया गया।", jp: "スピード、精度、パフォーマンスに優れたエリートゲーミングギアでセットアップを強化しましょう。" },
  intro_heading2: { us: "Style Meets Performance", de: "Stil trifft auf Leistung", it: "Stile Incontra Prestazioni", es: "Estilo y Rendimiento", ru: "Стиль встречает производительность", fr: "Le style rencontre la performance", in: "शैली मिलती है प्रदर्शन से", jp: "スタイルとパフォーマンスの融合" },
  intro_content2: { us: "Designed with precision and passion, each product blends function, form, and futuristic design — so your gear performs as good as it looks.", de: "Mit Präzision und Leidenschaft entworfen, vereint jedes Produkt Funktion, Form und futuristisches Design – damit deine Ausrüstung so gut performt, wie sie aussieht.", it: "Progettato con precisione e passione, ogni prodotto unisce funzione, forma e design futuristico — così il tuo equipaggiamento performa quanto appare.", es: "Diseñado con precisión y pasión, cada producto combina función, forma y diseño futurista — para que tu equipo rinda tan bien como se ve.", ru: "Создано с точностью и страстью, каждый продукт сочетает функцию, форму и футуристический дизайн — чтобы ваше оборудование работало так же хорошо, как выглядит.", fr: "Conçu avec précision et passion, chaque produit allie fonction, forme et design futuriste — pour que votre équipement soit aussi performant qu’il en a l’air.", in: "सटीकता और जुनून के साथ डिज़ाइन किया गया, प्रत्येक उत्पाद फ़ंक्शन, रूप और भविष्यवादी डिज़ाइन को जोड़ता है — ताकि आपका गियर दिखने जितना अच्छा काम करे।", jp: "精密さと情熱でデザインされた各製品は、機能、形、未来的デザインを融合し、ギアが見た目と同じくらい優れた性能を発揮します。" },
  intro_heading3: { us: "Collect the Rare", de: "Sammle die Seltenen", it: "Colleziona i Rari", es: "Colecciona lo Raro", ru: "Соберите редкие предметы", fr: "Collectionnez les objets rares", in: "दुर्लभ संग्रह करें", jp: "レアを集めよう" },
  intro_content3: { us: "From limited-edition drops to iconic collaborations — bring home exclusive collectibles that define the next era of gaming culture.", de: "Von limitierten Editionen bis zu legendären Kooperationen – sichere dir exklusive Sammlerstücke, die die nächste Ära der Gaming-Kultur prägen.", it: "Dalle edizioni limitate alle collaborazioni iconiche — porta a casa collezionabili esclusivi che definiscono la prossima era della cultura del gaming.", es: "Desde ediciones limitadas hasta colaboraciones icónicas — lleva a casa coleccionables exclusivos que definen la próxima era de la cultura gamer.", ru: "От ограниченных выпусков до легендарных коллабораций — получите эксклюзивные коллекционные предметы, которые определяют новую эру игровой культуры.", fr: "Des éditions limitées aux collaborations emblématiques — rapportez chez vous des objets exclusifs qui définissent la prochaine ère de la culture gaming.", in: "सीमित संस्करणों से लेकर प्रतिष्ठित सहयोगों तक — विशेष संग्रहणीय घर लाएँ जो गेमिंग संस्कृति के अगले युग को परिभाषित करते हैं।", jp: "限定版リリースから象徴的なコラボレーションまで、次のゲーミング文化の時代を形作る限定コレクションを手に入れましょう。" },
  customers_title: { us: "What Our Customers Say", de: "Was unsere Kunden sagen", it: "Cosa Dicono i Nostri Clienti", es: "Lo Que Dicen Nuestros Clientes", ru: "Что говорят наши клиенты", fr: "Ce que disent nos clients", in: "हमारे ग्राहक क्या कहते हैं", jp: "お客様の声" },
  feedback: { us: "Real feedback from gamers and collectors around the world.", de: "Echtes Feedback von Gamern und Sammlern weltweit.", it: "Feedback reali da gamer e collezionisti di tutto il mondo.", es: "Comentarios reales de gamers y coleccionistas de todo el mundo.", ru: "Реальные отзывы от геймеров и коллекционеров со всего мира.", fr: "Avis réels de gamers et collectionneurs du monde entier.", in: "दुनिया भर के गेमर्स और संग्रहकर्ताओं से वास्तविक प्रतिक्रिया।", jp: "世界中のゲーマーやコレクターからのリアルなフィードバック。" },
  egiftcards: { us: "eGift Cards", de: "E-Geschenkkarten", it: "Carte Regalo Elettroniche", es: "Tarjetas de Regalo Electrónicas", ru: "Электронные подарочные карты", fr: "Cartes Cadeaux Électroniques", in: "ई-उपहार कार्ड", jp: "電子ギフトカード" },
  show_all: { us: "Show all", de: "Alle anzeigen", it: "Mostra tutto", es: "Mostrar todo", ru: "Показать все", fr: "Tout afficher", in: "सभी दिखाएँ", jp: "すべて表示" },
  top_games: { us: "Top Games", de: "Top-Spiele", it: "Giochi Top", es: "Juegos Top", ru: "Топ игры", fr: "Meilleurs jeux", in: "शीर्ष खेल", jp: "人気ゲーム" },
  upcoming_game: { us: "Upcoming Games", de: "Kommende Spiele", it: "Prossimi Giochi", es: "Próximos Juegos", ru: "Скоро игры", fr: "Prochains jeux", in: "आगामी खेल", jp: "今後のゲーム" },
  genre: { us: "Genre", de: "Genre", it: "Genere", es: "Género", ru: "Жанр", fr: "Genre", in: "शैली", jp: "ジャンル" },
  faq: { us: "FAQ", de: "Fakten und Fragen", it: "fatti e domande", es: "Preguntas Frecuentes", ru: "Вопросы и ответы", fr: "faits et questions", in: "सामान्य प्रश्न", jp: "よくある質問" },
  from_people: { us: "From People", de: "Von Menschen", it: "Dalle Persone", es: "De la Gente", ru: "От людей", fr: "Des gens", in: "लोगों से", jp: "ユーザーの声" },
  from_people_content: { us: "Hear from gamers, creators, and enthusiasts who love shopping at Fragstore.", de: "Höre, was Gamer, Kreative und Enthusiasten sagen, die gerne bei Fragstore einkaufen.", it: "Ascolta i gamer, creatori ed appassionati che amano fare shopping su Fragstore.", es: "Escucha a gamers, creadores y entusiastas que aman comprar en Fragstore.", ru: "Слушайте геймеров, создателей и энтузиастов, которые любят делать покупки в Fragstore.", fr: "Écoutez les gamers, créateurs et passionnés qui adorent faire leurs achats sur Fragstore.", in: "सुनें कि गेमर्स, क्रिएटर्स और उत्साही लोग Fragstore में खरीदारी के बारे में क्या कहते हैं।", jp: "Fragstoreでの買い物を愛するゲーマー、クリエイター、愛好者の声を聞こう。" },
  about: { us: "About", de: "Über", it: "Chi Siamo", es: "Sobre", ru: "О нас", fr: "À propos", in: "हमारे बारे में", jp: "会社情報" },
  help: { us: "Help", de: "Hilfe", it: "Aiuto", es: "Ayuda", ru: "Помощь", fr: "Aide", in: "मदद", jp: "ヘルプ" },
  refund_policy: { us: "Refund Policy", de: "Rückerstattungsrichtlinie", it: "Politica di Rimborso", es: "Política de Reembolso", ru: "Политика возврата", fr: "Politique de remboursement", in: "रिफंड नीति", jp: "返金ポリシー" },
  legal: { us: "Legal", de: "Rechtlich", it: "Legale", es: "Legal", ru: "Юридическая информация", fr: "Mentions légales", in: "कानूनी", jp: "法的情報" },
  privacy_policy: { us: "Privacy Policy", de: "Datenschutzrichtlinie", it: "Informativa sulla Privacy", es: "Política de Privacidad", ru: "Политика конфиденциальности", fr: "Politique de confidentialité", in: "गोपनीयता नीति", jp: "プライバシーポリシー" },
  terms_and_conditions: { us: "Terms & Conditions", de: "Geschäftsbedingungen", it: "Termini e Condizioni", es: "Términos y Condiciones", ru: "Условия и положения", fr: "Termes et conditions", in: "नियम और शर्तें", jp: "利用規約" }
};



function translate(lang) {
  document.querySelectorAll("[data-i18n]").forEach(el => {
    const key = el.getAttribute("data-i18n");
    if(translations[key] && translations[key][lang]) {
      el.textContent = translations[key][lang];
    }
  });
}


const selected = document.querySelector(".selected-lang");
document.querySelectorAll(".lang-menu a").forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    const lang = link.className;
    selected.textContent = link.textContent;
    selected.style.setProperty("--flag", `url(${link.dataset.flag})`);
    document.querySelector(".lang-menu ul").style.display = "none";
    translate(lang);
  });
});

selected.addEventListener("click", () => {
  const menu = document.querySelector(".lang-menu ul");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
});
