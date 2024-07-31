$("#btnEndStep1").click(function () {
    $("#step1").addClass('hideMe');
    $("#step2").removeClass('hideMe');
});
$("#btnEndStep2").click(function () {
    $("#step2").addClass('hideMe');
    $("#step3").removeClass('hideMe');
});
$("#btnEndStep3").click(function () {
    // Whatever your final validation and form submission requires
    $("#sampleModal").modal("hide");
});
function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}
$(document).ready(function() {
    function updateIndicators(activeModalId) {
        $('.carousel-indicator').each(function() {
            if ($(this).data('target') === activeModalId) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    }

    $('.modal').on('show.bs.modal', function() {
        const modalId = $(this).attr('id');
        updateIndicators(`#${modalId}`);
    });

    updateIndicators('#crearPublicacionModal');
});