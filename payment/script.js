function showPaymentFields() {
    let selectedPayment = document.querySelector('input[name="payment"]:checked').value;

    document.getElementById("card-fields").classList.add("hidden");
    document.getElementById("netbanking-fields").classList.add("hidden");
    document.getElementById("upi-fields").classList.add("hidden");
    document.getElementById("giftcard-fields").classList.add("hidden");

    if (selectedPayment === "credit" || selectedPayment === "debit") {
        document.getElementById("card-fields").classList.remove("hidden");
    } else if (selectedPayment === "netbanking") {
        document.getElementById("netbanking-fields").classList.remove("hidden");
    } else if (selectedPayment === "paytm" || selectedPayment === "gpay") {
        document.getElementById("upi-fields").classList.remove("hidden");
    } else if (selectedPayment === "giftcard") {
        document.getElementById("giftcard-fields").classList.remove("hidden");
    }
}

function validateForm() {
    let selectedPayment = document.querySelector('input[name="payment"]:checked');
    if (!selectedPayment) {
        alert("Please select a payment method!");
        return false;
    }
    return true;
}
