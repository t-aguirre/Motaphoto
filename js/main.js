document.addEventListener("DOMContentLoaded", function(){
    // DISPLAY THE FEATURED THUMBNAIL OF THE PREVIOUS ANS NEXT POST IN single-photos.php
    let photoThumbnail = document.querySelectorAll(".photo-thumbnail");
    let previousPic =  document.querySelector(".previous");
    let nextPic =  document.querySelector(".next");

    let arrowPrev = document.querySelector(".nav-prev");
    let arrowNext = document.querySelector(".nav-next");

    photoThumbnail.forEach(function(item){
        item.style.display = "none";
    })

    if (arrowPrev && previousPic) {
        arrowPrev.addEventListener("mouseenter", function () {
            previousPic.style.display = "block";
        });
        arrowPrev.addEventListener("mouseleave", function () {
            previousPic.style.display = "none";
        });
    }
    if (arrowNext && nextPic) {
        arrowNext.addEventListener("mouseenter", function () {
            nextPic.style.display = "block";
        });
        arrowNext.addEventListener("mouseleave", function () {
            nextPic.style.display = "none";
        });
    }

    // FILTERING FEATURED IMAGES IN home.php FORM
    $(document).ready(function () {
      let paged = 1;

      // Handle changes in the select fields
      $(".form-select").change(function () {
        $(".load-btn").hide();
        let categorie = $("#category_id").val();
        let format = $("#format_id").val();
        let order = $("#date_id").val();

        // Send an AJAX request to retrieve filtered photos with security
        const nonce = $("#nonce").val();
        const ajaxurl = $("#ajaxurl").val();

        // Data to send via AJAX
        let ajaxData = {
          action: "filter_photos",
          nonce: nonce,
          category: categorie,
          format: format,
          order: order,
          paged: paged,
        };
        console.log("envoi de la requête ajax avec les données:", ajaxData);

        $.ajax({
          url: ajaxurl,
          type: "post",
          datatype: "html",
          data: ajaxData,
          success: function (response) {
            console.log("Réponse reçue:",response); 
          
            // Update the gallery content with the new results
            if (response.success) {
              $(".recommendation-section__photos").html(response.data);

              /**
              * Initializes the Lightbox by selecting all unbound image links with the class `.fullscreen-icon`,
              * binding click events to them, and preparing the gallery of image URLs.
              * Ensures each link is only initialized once by adding a 'lightbox-bound' marker class.
              */
              Lightbox.init();

              paged = 1;
            }
          },
          error: function (xhr, status, error) {
            console.error("Erreur AJAX :", error);
          },
        });
      });
    });
});