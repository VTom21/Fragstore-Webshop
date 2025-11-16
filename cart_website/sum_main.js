// sum_main.js
// subtotal and taxRate are already defined in global scope from PHP

// Get cart items from URL
const parameters = new URLSearchParams(window.location.search);
const cart_items = JSON.parse(parameters.get("cart") || []);
console.log(cart_items);

const deliveryRadios = document.querySelectorAll('input[name="delivery"]');
const addressSection = document.getElementById('address-section');
const shippingCost = document.getElementById('shipping-amount');

const paymentRadios = document.querySelectorAll('input[name="payment"]');
const cardSection = document.getElementById('card-section');

function updateShipping() {
    const selectedRadio = document.querySelector('input[name="delivery"]:checked');
    const selected = selectedRadio ? selectedRadio.value : 'digital';
    console.log('Selected delivery:', selected);

    let shipping = 0;
    if (selected === 'digital') {
        addressSection.classList.add('hidden');
        shipping = 0;
    } else if (selected === 'home') {
        addressSection.classList.remove('hidden');
        shipping = 5.99;
    } else if (selected === 'pickup') {
        shipping = 2.99;
    }

    shippingCost.textContent = shipping === 0 ? 'Free' : `$${shipping.toFixed(2)}`;

    const tax = subtotal * taxRate;
    const total = subtotal + tax + shipping;

    document.getElementById('subtotal-amount').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('tax-amount').textContent = `$${tax.toFixed(2)}`;
    document.getElementById('total-amount').textContent = `$${total.toFixed(2)}`;

}

// Event listeners
deliveryRadios.forEach(radio => radio.addEventListener('change', updateShipping));
paymentRadios.forEach(radio => {
    radio.addEventListener('change', () => {
        cardSection.style.display = radio.value === 'card' ? 'block' : 'none';
    });
});

// Call on load
updateShipping();

function processCheckout() {
    const delivery = document.querySelector('input[name="delivery"]:checked').value;
    const payment = document.querySelector('input[name="payment"]:checked').value;

    const shipping = shippingCost.textContent === 'Free' ? 0 : parseFloat(shippingCost.textContent.replace('$', ''));
    const tax = subtotal * taxRate;
    const total = subtotal + tax + shipping;

    const cartItemsParams = encodeURIComponent(JSON.stringify(cart_items));
    const TotalParams = encodeURIComponent(total.toFixed(2));

    window.location.href = `../order_successful/success.php?cart=${cartItemsParams}&total=${TotalParams}`;
}
