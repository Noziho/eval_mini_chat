const errorOrSuccessMessage = document.querySelector('.error-message');
const logoMenu = document.getElementById('hoveredMenu');

if (errorOrSuccessMessage) {
    setTimeout(function () {
    $('.error-message').slideUp('fast');
    },1000)
}


logoMenu.addEventListener('click', () => {

    $('#responsive-menu').toggleClass('show', 'hide');

} )
