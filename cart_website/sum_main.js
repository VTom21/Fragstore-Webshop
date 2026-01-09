// Get cart items from URL
const parameters = new URLSearchParams(window.location.search);
const cart_items = JSON.parse(parameters.get("cart") || "[]");
console.log(cart_items);
sessionStorage.setItem('cart', JSON.stringify(cart_items));

let currency_local = localStorage.getItem("currency");

const deliveryRadios = document.querySelectorAll('input[name="delivery"]');

const addressSection = document.getElementById('address-section');

const shippingCost = document.getElementById('shipping-amount');

const paymentRadios = document.querySelectorAll('input[name="payment"]');

const cardSection = document.getElementById('card-section');

const paypalSection = document.querySelector('.paypal-section');

function isEmpty(value) {
    return value === null || value === undefined || value.toString().trim() === '';
}

function fail(message) {
    alert(message);
    return false;
}

function UpdateCurrency() {


    const tax = subtotal * taxRate;
    const total = subtotal + tax + currentShipping;


    document.getElementById('subtotal-amount').textContent = `${subtotal.toFixed(2)} ${currency_local}`;
    document.getElementById('tax-amount').textContent = `${tax.toFixed(2)} ${currency_local}`;
    document.getElementById('total-amount').textContent = `${total.toFixed(2)} ${currency_local}`;
}

document.querySelectorAll('.summary-item-price').forEach(el => {
    el.textContent = `${el.textContent} ${currency_local}`;
});


//Validator Functions

function ValidateDelivery() {
    const delivery = document.querySelector('input[name="delivery"]:checked');
    if (!delivery) {
        return fail('Please select a delivery method.');
    }
    return true;
}

function ValidateAddress() {
    if (addressSection.classList.contains("hidden")) {
        return true;
    }

    const fields = [
        { id: 'full-name', name: 'Full Name' },
        { id: 'street-address', name: 'Street Address' },
        { id: 'city', name: 'City' },
        { id: 'postal-code', name: 'Postal Code' },
        { id: 'country', name: 'Country' },
        { id: 'phone', name: 'Phone' }
    ];

    for (const field of fields) {
        if (isEmpty(document.getElementById(field.id).value)) {
            fail(`${field.name} is required!`);
            return false;
        }
    }
    return true;
}

function ValidatePayment() {
    let payment = document.querySelector('input[name="payment"]:checked');
    if (!payment) return fail('Please select a delivery method.');

    const cardNumber = document.getElementById('card-number');
    const cardName = document.getElementById('card-name');
    const cardExpiry = document.getElementById('card-expiry');
    const cardCvc = document.getElementById('card-cvc');
    const cardEmail = document.getElementById('card-email');

    const paypalNumber = document.getElementById('paypal-number');
    const paypalEmail = document.getElementById('paypal-email');

    switch (payment.value) {
        case 'card':
            if (cardSection.style.display !== 'block') break; // skip if hidden
            if (isEmpty(cardNumber.value) || isEmpty(cardName.value) || isEmpty(cardExpiry.value) || isEmpty(cardCvc.value) || isEmpty(cardEmail.value)) {
                return fail("Please fill in all card details.");
            }
            break;
    
        case 'paypal':
            if (paypalSection.style.display !== 'block') break; // skip if hidden
            if (isEmpty(paypalNumber.value) || isEmpty(paypalEmail.value)) {
                return fail("Please fill in all PayPal details.");
            }
            break;
    
        case 'cash':
            // nothing extra
            break;
    }
    

    return true;

}

let currentShipping = 0;

function updateShipping() {
    const selectedRadio = document.querySelector('input[name="delivery"]:checked');
    const selected = selectedRadio ? selectedRadio.value : 'digital';

    const cashOn = document.querySelector('input[name="payment"][value="cash"]');

    
    const cashOnDiv = cashOn.closest('.radio-card');

    let shipping = 0;
    if (selected === 'digital') {
        addressSection.classList.add('hidden');
        cashOnDiv.classList.add('hidden');
        shipping = 0;
    } else if (selected === 'home') {
        addressSection.classList.remove('hidden');
        cashOnDiv.classList.remove('hidden');
        shipping = 5.99;
    } else if (selected === 'pickup') {
        addressSection.classList.add('hidden');
        cashOnDiv.classList.add('hidden');
        shipping = 2.99;
    }

    currentShipping = shipping; // store numeric value
    shippingCost.textContent = shipping === 0 ? 'Free' : `${shipping.toFixed(2)} ${currency_local}`;

    const tax = subtotal * taxRate;
    const total = subtotal + tax + currentShipping;

    UpdateCurrency();
}


// Payment section toggle
function updatePaymentSections() {
    const selectedRadio = document.querySelector('input[name="payment"]:checked');
    if (!selectedRadio) return;

    if (selectedRadio.value === 'card') {

        cardSection.style.display = 'block';

        paypalSection.style.display = 'none';

    } else if (selectedRadio.value === 'paypal') {

        cardSection.style.display = 'none';

        paypalSection.style.display = 'block';
    } else {

        cardSection.style.display = 'none';

        paypalSection.style.display = 'none';
    }
}

// Event listeners
deliveryRadios.forEach(radio => radio.addEventListener('change', updateShipping));
paymentRadios.forEach(radio => radio.addEventListener('change', updatePaymentSections));

// Initial call on page load
updateShipping();
updatePaymentSections();
UpdateCurrency();

function processCheckout() {
    // 1️⃣ Validation
    if(!ValidateDelivery()) return;
    if(!ValidateAddress()) return;
    if(!ValidatePayment()) return;

    // 2️⃣ Prepare payload
    const payload = {
        cart: cart_items.map(item => {
            const newItem = {...item};
            delete newItem.$$hashKey;
            if(newItem.gameRef) delete newItem.gameRef.$$hashKey;
            return newItem;
        }),
        delivery: document.querySelector('input[name="delivery"]:checked').value,
        payment: document.querySelector('input[name="payment"]:checked').value,
        currency: currency_local,
        address: {
            full_name: document.getElementById('full-name')?.value || '',
            street: document.getElementById('street-address')?.value || '',
            city: document.getElementById('city')?.value || '',
            postal: document.getElementById('postal-code')?.value || '',
            country: document.getElementById('country')?.value || '',
            phone: document.getElementById('phone')?.value || ''
        },
        card: {
            name: document.getElementById('card-name')?.value || '',
            email: document.getElementById('card-email')?.value || ''
        },
        paypal: {
            email: document.getElementById('paypal-email')?.value || '',
            number: document.getElementById('paypal-number')?.value || ''
        },
        subtotal: subtotal,
        tax: subtotal * taxRate,
        shipping: currentShipping,
        total: subtotal + subtotal * taxRate + currentShipping,
        timestamp: new Date().toISOString(),
        status: "pending"
    };

    // 3️⃣ Store order info in sessionStorage for success page
    sessionStorage.setItem('cart', JSON.stringify(payload.cart));
    sessionStorage.setItem('currency', payload.currency);
    sessionStorage.setItem('subtotal', payload.subtotal);
    sessionStorage.setItem('tax', payload.tax);
    sessionStorage.setItem('shipping', payload.shipping);
    sessionStorage.setItem('total', payload.total);
    sessionStorage.setItem('user_email', payload.card.email || payload.paypal.email);

    // 4️⃣ Push to Firebase
    const ordersRef = firebase.database().ref('orders');
    const newOrderRef = ordersRef.push();
    newOrderRef.set(payload)
        .then(() => {
            // 5️⃣ Redirect to success page
            window.location.href = `../order_successful/success.php?order_id=${newOrderRef.key}`;
        })
        .catch(err => {
            console.error(err);
            alert("An error occurred while saving your order.");
        });
}




