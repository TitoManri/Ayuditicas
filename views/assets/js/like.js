$(document).ready(function() {
    $('.heart-icon').on('click', function() {
        $(this).toggleClass('fa-heart-filled');
        $(this).toggleClass('fa-regular fa-heart');
        $(this).toggleClass('fa-solid fa-heart');
    });
});
