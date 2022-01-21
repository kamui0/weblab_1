let inpY = document.querySelector('.field[id="y"]');
let inpZ = document.querySelector('.field[id="r"]');

$('.forms').on('submit', function(event) {
    //event.preventDefault();
    if (!validate(inpY, 'Y')) {
        $('.field[id="y"]').addClass("is-invalid")

        if (!validate(inpZ, 'R')) {
            $('.field[id="r"]').addClass("is-invalid")
        } else {
            $('.field[id="r"]').removeClass("is-invalid")
        }

        return false;
    } else {
        $('.field[id="y"]').removeClass("is-invalid")
    }

    if (!validate(inpZ, 'R')) {
        $('.field[id="r"]').addClass("is-invalid")
        return false;
    } else {
        $('.field[id="r"]').removeClass("is-invalid")
    }

    return true;

})

function validate(inp, s) {

    if (s === 'Y') {
        if ((inp.value <= 3) && (inp.value >= -5)) {
            return true
        }
        return false
    } else {
        if ((inp.value <= 5) && (inp.value >= 2)) {
            return true
        }
        return false
    }
}