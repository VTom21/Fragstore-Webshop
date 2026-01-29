import currencyToLocale from '../index.js';

// Example 1: Simple usage
console.log(
    "Example 1: Simple usage"
);
console.log("currencyCode: 'USD'\n     RETURNS:", currencyToLocale('USD')); // prints 'en-US'

// Example 2: Currency code with multiple locale IDs
console.log(
    "\nExample 2: Currency code with multiple locale IDs"
);
console.log(
    "currencyCode: 'EUR', languageCode: 'fr'\n     RETURNS:", 
    currencyToLocale('EUR', 'fr')
); // prints 'fr-FR'
console.log(
    "currencyCode: 'EUR', languageCode: 'es'\n     RETURNS:", 
    currencyToLocale('EUR', 'es')
); // prints 'es-ES'

// Example 3: Currency code with multiple locale IDs, no language code provided 
// (default locale ID returned)
console.log(
    "\nExample 3: Currency code with multiple locale IDs, " +
    "no language code provided (default locale ID returned)"
);
console.log(
    "currencyCode: 'EUR', no language code\n     RETURNS:", 
    currencyToLocale('EUR')
); // prints 'de-DE'

// Example 4: Currency code with only one locale ID 
// (language code ignored if provided)
console.log(
    "\nExample 4: Currency code with only one locale ID " +
    "(language code ignored if provided)"
);
console.log(
    "currencyCode: 'HKD', languageCode: 'de'\n     RETURNS:", 
    currencyToLocale('HKD', 'de'),
    "(incorrect language code for HKD, but ignored)"
); // prints 'zh-HK'
console.log(
    "currencyCode: 'HKD', languageCode: 'xyz'\n     RETURNS:", 
    currencyToLocale('HKD', 'xyz'),
    "(invalid language code, but ignored)"
); // prints 'zh-HK'
console.log(
    "currencyCode: 'HKD', languageCode: 1\n     RETURNS:", 
    currencyToLocale('HKD', 1),
    "(invalid language code type, but ignored)"
); // prints 'zh-HK'

// Example 5: Improperly formatted currency or language code (accepted)
console.log(
    "\nExample 5: Improperly formatted currency or language code (accepted)"
);
console.log(
    "currencyCode: 'jpy'\n     RETURNS:", 
    currencyToLocale('jpy'),
    "(handles improper formatting: lowercase currency code)"
); // prints 'ja-JP'
console.log(
    "currencyCode: 'CHF', languageCode: 'IT'\n     RETURNS:", 
    currencyToLocale('CHF', 'IT'),
    "(handles improper formatting: uppercase language code)"
); // prints 'it-CH'

// Example 6: Invalid or not-found currency code
console.log(
    "\nExample 6: Invalid currency code"
);
console.log(
    "currencyCode: 1\n     RETURNS:", 
    currencyToLocale(1)
); // prints 'Please provide a valid currency code.'
console.log(
    "currencyCode: 'ABCD' (not 3-character)\n     RETURNS:", 
    currencyToLocale('ABCD')
); // prints 'Please provide a valide currency code.'
console.log(
    "currencyCode 'XYZ'\n     RETURNS:", 
    currencyToLocale('XYZ'), 
    "(currency code might be valid, just missing from function's mapping)"
); // prints 'Currency code not found.'

// Example 7: Invalid or not-found language code with valid currency code
console.log(
    "\nExample 7: Invalid or not-found language code with valid currency code"
);
console.log(
    "currencyCode: 'EUR', languageCode: 1\n     RETURNS:", 
    currencyToLocale('EUR', 1)
); // prints 'Please provide a valid language code.'
console.log(
    "currencyCode: 'EUR', languageCode: 'xyz' (not 2-character)\n     RETURNS:", 
    currencyToLocale('EUR', 'xyz')
); // prints 'Please provide a valid language code.'
console.log(
    "currencyCode: 'EUR', languageCode 'zh'\n     RETURNS:", 
    currencyToLocale('EUR', 'zh'), 
    "(language code might be valid, just missing from function's mapping)"
); // prints 'Language code not found for EUR.'

// Example 8: No input
console.log(
    "\nExample 8: No input"
);
console.log(
    "No input\n     RETURNS:", 
    currencyToLocale()
); // prints 'Please provide a currency code.'
