document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function() {
            let paged = 2;
            let isNoMorePhotoShown = false; // To avoid displaying the "aucune photo trouvée" message multiple times when clicking the button "charger plus" 
            let isContentLoaded = false; //To apply the class only once after loading new content

            // Load photos when the homepage loads
            $(".load-btn").on("click", function(e) {
                e.preventDefault();
                const ajaxUrl = $(this).data("url");
                const ajaxNonce = $(this).data("nonce");
                // console.log(ajaxNonce);
                // console.log(ajaxUrl);
                const data = {
                    action: "load_photos",
                    nonce: ajaxNonce,
                    paged: paged,
                };
                console.log("envoi de la requête ajax avec les données:", data);

                // Send AJAX request to load more photos
                $.post(ajaxUrl, data, function(response) {
                    console.log("Réponse reçue:",response); 

                    if (response.success) {
                        if (response.data.no_more_photos) {
                            console.log("Plus de photos à charger");

                            if(!isNoMorePhotoShown) {
                                $(".recommendation-section__photos").append('<p class="no-more-photos">Aucune photo trouvée</p>');
                                isNoMorePhotoShown = true; //Flag to prevent showing the message again
                            }

                        //Hide "Charger plus" button
                        $(".load-btn").hide();
                    } else if (response.data) {
                        console.log("Nouvelles photos reçues, ajout au DOM");

                        //Append new photos to the section
                        $(".recommendation-section__photos").append(response.data);

                        // After appending new photos to the DOM, re-run Lightbox.init() so that the new .fullscreen-icon elements get the correct event listeners
                        Lightbox.init();

                        // Increment the page number for the next AJAX request
                        paged++; 
                    }

                    //Reduce the margin once after adding content to match the design layout
                    if (!isContentLoaded) {
                            $(".recommendation-section__photos").addClass("photos-loaded");
                            isContentLoaded = true;
                    }
                } else {
                    console.error("Erreur dans la réponse AJAX");
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error("Erreur AJAX:", textStatus, errorThrown);
            });
        });
    });   
});