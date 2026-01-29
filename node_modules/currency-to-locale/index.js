// function to map currency codes to locale identifiers
const currencyToLocale = (currencyCode, languageCode) => {

  // input error handling (language type error handled below)
  if (!currencyCode) {
    return "Please provide a currency code.";
  };

  if (typeof currencyCode !== 'string' || currencyCode.length !== 3) {
    return "Please provide a valid currency code.";
  }

  // ensure correct formatting
  currencyCode = currencyCode.toUpperCase();
  
  const currencyLocales = {
    "AUD": "en-AU",
    "BGN": "bg-BG",
    "BRL": "pt-BR",
    "CAD": "en-CA", 
    "CHF": ["de-CH", "fr-CH", "it-CH"], // multiple locales array
    "CNY": "zh-CN",
    "CZK": "cs-CZ",
    "DKK": "da-DK",
    "EUR": ["de-DE", "fr-FR", "es-ES", "it-IT"], // multiple locales array
    "GBP": "en-GB",
    "HKD": "zh-HK",
    "HUF": "hu-HU",
    "IDR": "id-ID",
    "ILS": "he-IL",
    "INR": "en-IN",
    "ISK": "is-IS",
    "JPY": "ja-JP",
    "KRW": "ko-KR",
    "MXN": "es-MX",
    "MYR": "ms-MY",
    "NOK": "no-NO",
    "NZD": "en-NZ",
    "PHP": "en-PH",
    "PLN": "pl-PL",
    "RON": "ro-RO",
    "SEK": "sv-SE",
    "SGD": "en-SG",
    "THB": "th-TH",
    "TRY": "tr-TR",
    "USD": "en-US",
    "ZAR": "en-ZA"
  };

  // multiple locale IDs
  // check for values that are multi-value arrays
  if (
    Array.isArray(currencyLocales[currencyCode]) && 
    currencyLocales[currencyCode].length > 1
  ) {
    if (languageCode) {
      // language code input type error handling
      if (typeof languageCode !== 'string' || languageCode.length !== 2) {
        return "Please provide a valid language code."
      }
      // ensure correct formatting
      languageCode = languageCode.toLowerCase();
      // loop through currencyLocales object
      for (const key in currencyLocales) {
         {
          // match currency code
          if (currencyCode === key) {
            // extract language from locale ID 
            for (const [k, localeID] of Object.entries(currencyLocales[key])) {
              let localeLang = localeID.split('-')[0];
              // match beginning of locale ID
              if (languageCode === localeLang) {
                // return matching locale ID
                return localeID;
              }
            }
            return (`Language code not found for ${currencyCode}.`);
          }
        }
      }
    }
    // if no lang provided, return default locale
    return currencyLocales[currencyCode][0];
  }
  
  return currencyLocales[currencyCode] || "Currency code not found.";
}

// ES module export
export default currencyToLocale;