import currencyToLocale from '../index.js';

// valid currency code with single locale ID
console.assert(
  currencyToLocale('USD') === 'en-US',
  "Expected 'en-US' for USD"
);

// valid currency code with multiple locale IDs
console.assert(
  currencyToLocale('CHF', 'fr') === 'fr-CH',
  "Expected 'fr-CH for CHF, fr"
); 
console.assert(
    currencyToLocale('EUR', 'es') === 'es-ES',
    "Expected 'es-ES' for EUR, es"
); 

// valid currency code with multiple locale IDs, no language code provided - default returned
console.assert(
  currencyToLocale('EUR') === 'de-DE',
  "Expected 'de-DE' for EUR"
)

// valid currency code, irrelevant language code
console.assert(
  currencyToLocale('AUD', 'en') === 'en-AU',
  "Expected 'en-AU' for AUD, en"
); 

// valid currency code, irrelevant & invalid/not-found language code (ignores)
console.assert(
  // language code not found in function's mapping
  currencyToLocale('USD', 'xy') === 'en-US',
  "Expected 'en-US' for USD, xy"
);
console.assert(
  // invalid language code length
  currencyToLocale('USD', 'xyz') === 'en-US',
  "Expected 'en-US' for USD, xyz"
)
console.assert(
  // invalid language code type
  currencyToLocale('USD', 1) === 'en-US',
  "Expected 'en-US' for USD, 1"
)

// invalid/not-found currency code
console.assert(
  // currency code not found in function's mapping
  currencyToLocale('XYZ') === 'Currency code not found.',
  "Expected 'Currency code not found.' for XYZ"
);
console.assert(
  // invalid currency code length
  currencyToLocale('ACAT') === 'Please provide a valid currency code.',
  "Expected 'Please provide a valid currency code.' for ACAT"
);
console.assert(
  // invalid currency code type (number)
  currencyToLocale(1) === 'Please provide a valid currency code.',
  "Expected 'Please provide a valid currency code.' for 1"
); 

// invalid currency code type (number), valid language code
console.assert(
  currencyToLocale(1, 'fr') === 'Please provide a valid currency code.',
  "Expected 'Please provide a valid currency code.' for 1, fr"
); 

// valid currency code, invalid language code
console.assert(
  // existing language code, not mapped to provided currency code
  currencyToLocale('CHF', 'zh') === 'Language code not found for CHF.',
  "Expected 'Language code not found for CHF.' for CHF, zh"
); 
console.assert(
  // invalid language code length
  currencyToLocale('EUR', 'c') === 'Please provide a valid language code.',
  "Expected 'Please provide a valid language code.' for EUR, c"
); 
console.assert(
  // invalid language code type
  currencyToLocale('EUR', 1) === 'Please provide a valid language code.',
  "Expected 'Please provide a valid language code.' for EUR, 1"
); 

// lowercase valid currency code
console.assert(
  currencyToLocale('usd') === 'en-US',
  "Expected 'en-US' for usd"
); 

// uppercase valid language code
console.assert(
  currencyToLocale('EUR', 'FR') === 'fr-FR',
  "Expected 'fr-FR' for EUR, FR"
);

// lowercase valid currency code & uppercase valid language code
console.assert(
  currencyToLocale('chf', 'IT') === 'it-CH',
  "Expected 'it-CH' for chf, IT"
); 

// no input
console.assert(
  currencyToLocale() === 'Please provide a currency code.',
  "Expected 'Please provide a currency code.' for no input"
);
