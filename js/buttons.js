function changeX(button){
    document.getElementById('x_field').value = button.value;
    if ($('input:checkbox:checked').length === 0) {
        document.getElementById('x_field').value = 100;
    }
}

$('input[type="checkbox"]').on('change', function() {
    $('input[type="checkbox"]').not(this).prop('checked', false);
});