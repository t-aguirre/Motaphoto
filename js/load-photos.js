document.addEventListener("DOMContentLoaded", function() {
        $(document).ready(function() {
            let paged = 2;
            let isNoMorePhotoShown = false; //Pour éviter d'afficher plusieurs fois le message "aucune photo trouvée" lors du clic sur le bouton charger plus
            let isContentLoaded = false; //Pour appliquer la classe une seule fois

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

                // Envoi de la requête ajax pour charger plus de photos
                $.post(ajaxUrl, data, function(response) {
                    console.log("Réponse reçue:",response); 

                    if (response.success) {
                        if (response.data.no_more_photos) {
                            console.log("Plus de photos à charger");

                            if(!isNoMorePhotoShown) {
                                $(".recommendation-section__photos").append('<p class="no-more-photos">Aucune photo trouvée</p>');
                                isNoMorePhotoShown = true; //Marque que le message a été affiché
                            }

                            //On cache le bouton
                            $(".load-btn").hide();
                    } else if (response.data) {
                        console.log("Nouvelles photos reçues, ajout au DOM");

                        //On ajoute les nouvelles photos
                        $(".recommendation-section__photos").append(response.data);

                        //On incrémente la page pour la prochaine requête
                        paged++; 
                    }

                    //Réduire la marge une seule fois après avoir ajouté du contenu
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