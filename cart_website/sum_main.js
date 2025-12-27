// Get cart items from URL
const parameters = new URLSearchParams(window.location.search);
const cart_items = JSON.parse(parameters.get("cart") || "[]");
console.log(cart_items);

let currency_local = localStorage.getItem("currency");

const deliveryRadios = document.querySelectorAll('input[name="delivery"]');

const addressSection = document.getElementById('address-section');

const shippingCost = document.getElementById('shipping-amount');

const paymentRadios = document.querySelectorAll('input[name="payment"]');

const cardSection = document.getElementById('card-section');

const paypalSection = document.querySelector('.paypal-section');



  function UpdateCurrency(){
    

    const tax = subtotal * taxRate;
    const total = subtotal + tax + currentShipping;



    document.getElementById('subtotal-amount').textContent = `${subtotal.toFixed(2)} ${currency_local}`;
    document.getElementById('tax-amount').textContent = `${tax.toFixed(2)} ${currency_local}`;
    document.getElementById('total-amount').textContent = `${total.toFixed(2)} ${currency_local}`;
  } 
  
document.querySelectorAll('.summary-item-price').forEach(el => {
    el.textContent = `${el.textContent} ${currency_local}`;
});


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

// Checkout button
function processCheckout() {

    const shipping = shippingCost.textContent === 'Free' ? 0 : parseFloat(shippingCost.textContent.replace(currency_local, '').trim());

    const tax = subtotal * taxRate;
    const total = subtotal + tax + shipping;

    const cartItemsParams = encodeURIComponent(JSON.stringify(cart_items));
    const totalParams = encodeURIComponent(total.toFixed(2));

    window.location.href = `../order_successful/success.php?cart=${cartItemsParams}&total=${totalParams}&currency=${currency_local}`;
}
