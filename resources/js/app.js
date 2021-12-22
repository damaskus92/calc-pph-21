require('./bootstrap');

/**
 * Input format mata uang
 */
function formatCurrency(number) {
    return number.toLocaleString('id-ID', {
        currency: 'IDR',
        style: 'decimal',
        minimumFractionDigits: 0,
    });
}

document.querySelectorAll('input[format-currency="IDR"]').forEach((element) => {
    element.addEventListener('keyup', function (e) {
        let cursorPostion = this.selectionStart;
        let value = parseInt(this.value.replace(/[^,\d]/g, ''));
        let originalLenght = this.value.length;

        if (isNaN(value)) {
            this.value = null;
        } else {
            this.value = formatCurrency(value);

            cursorPostion = this.value.length - originalLenght + cursorPostion;
            this.setSelectionRange(cursorPostion, cursorPostion);
        }
    });
});
