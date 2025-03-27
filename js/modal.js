jQuery(document).ready(function($) {
    $('#contact-modal').removeClass('modal-is-visible');
    //  Check if the clicked link is the "Contact" link from the main menu
    $('.menu-item-49 a').click(function (e) {
        e.preventDefault();
        $('#contact-modal').addClass('modal-is-visible');

        // Verify if the click is coming from the navigation link in the header
        if ($(this).closest('header').length > 0) {
            $('#contact-modal').show();
        }
    });
    //Opening the modal if the user clicks on the contact button
    $('.contact-btn').click(function() {
        $('#contact-modal').addClass('modal-is-visible');
        $('#contact-modal').show(); 
    });

    // Filling the modal field with the reference value
    if (typeof photoData !== 'undefined' && photoData.reference) {
        $('#reference-input').val(photoData.reference);
    }

    // Close the modal
    $('#close-modal').click(function() {
        $('#contact-modal').hide();
    });

    // Close modal when clicking outside
    $(window).click(function(e) {
        if ($(e.target).is('#contact-modal')) {
            $('#contact-modal').hide();
        }
    });
});