# currency-to-locale

### **Author**
This project was built and is maintained by Laura Gates, [https://github.com/laurapg1214](https://github.com/laurapg1214).

Feel free to reach out with any questions or contributions!

### **Description**

Converts currency codes to locale identifiers following format specified in IETF BCP 47 standard, comprised of a two-letter ISO 639-1 language code and ISO 3166-1 alpha-2 country code.

For currency codes with multiple locales/language codes, defaults have been selected.

Currency codes initially compiled using Frankfurter's [https://api.frankfurter.app/currencies](https://api.frankfurter.app/currencies).

Additional currency code and locale ID additions are welcome; please see "Contributing" section below.

---

### **Installation**

Install via npm:

```bash
npm install currency-to-locale
```

This will add the package to your project's dependencies.

---

### **Usage**
To use the `currencyToLocale` function in your project, import it as follows:

```javascript
import currencyToLocale from 'currency-to-locale';
```

**Function usage: currencyToLocale**
```javascript
currencyToLocale(currencyCode, languageCode)
```

The `currencyToLocale` function accepts two arguments:
- **currencyCode** (required): The 3-letter currency code (e.g. "USD", "EUR").
- **languageCode** (optional): The 2-letter language code (e.g. "en", "de").

It returns the corresponding locale identifier (e.g. "en-US", "de-DE").

**Examples**

// Example 1: Simple usage
const locale = currencyToLocale('USD'); // returns 'en-US'

// Example 2: Currency code with multiple locales, returns locale based on language code provided
const locale = currencyToLocale('EUR', 'fr'); // returns 'fr-FR'

// Example 3: Currency code with multiple locales, no language code provided (default locale returned)
console.log("EUR with no language code:", currencyToLocale('EUR')); // returns 'de-DE'

// Example 4: Invalid or not-found currency code
const locale = currencyToLocale('XYZ'); // returns 'Currency code not found.'
const locale = currencyToLocale(1); // returns 'Please provide a valid currency code.'


**Run examples**

To see these and additional examples in action, run the following command:

```bash
node examples/examples.js
```

This will execute the example script provided in the `examples` folder and show the output.

---

### **Contributing**
I welcome contributions! If you'd like to improve or add to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch (e.g., `feature-xyz` or `bugfix-123`).
3. Make your changes, ensuring they align with the project’s goals and style.
4. Test your changes to ensure they work correctly.
5. Submit a pull request with a description of your changes.

**Code of Conduct**
Please be respectful and follow the [Contributor Covenant Code of Conduct](https://www.contributor-covenant.org/).

I appreciate your contributions and look forward to collaborating with you!

---

### **License**

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.



