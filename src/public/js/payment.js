const stripe = Stripe("pk_test_51Pm677RrWkpTIcj79mxthfFzddcx1kqoO1NNG55E1jYSZiKc1NumMlZJtHrgFL9FrCUccdmenZ3WLCsJUi9Oc4gJ00SDDYYnJA");

const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');

const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');

cardButton.addEventListener('click', async (e) => {
    e.preventDefault()
    const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );

    if (error) {
        // Display "error.message" to the user...
        console.log(error);
    } else {
        // The card has been verified successfully...
        stripePaymentIdHandler(paymentMethod.id);
    }
});

function stripePaymentIdHandler(paymentMethodId) {
    // Insert the paymentMethodId into the form so it gets submitted to the server
    const form = document.getElementById('setup-form');

    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'paymentMethodId');
    hiddenInput.setAttribute('value', paymentMethodId);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
}