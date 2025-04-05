<div class="recommendation-section__single-photo">
    <?php
    the_post_thumbnail('medium_large');
    ?>
    <div class="recommendation-section__single-photo-overlay">
        <a href="#" class="fullscreen-icon" title="Agrandir">
            <img src="<?php echo get_template_directory_uri(); ?>/icons/fullscreen-icon.png" alt="Icone Agrandissement qui mène vers la visionneuse">
        </a>
        <a href="<?php echo get_permalink(get_the_ID()); ?>" class="visibility-icon" title="Voir">
            <img src="<?php echo get_template_directory_uri(); ?>/icons/visibility-icon.png" alt="Icone d'un oeil qui mène vers la page d'information de la photo">
        </a>
        <div class="photo-data-container">
            <p><?php echo get_field("reference"); ?></p>
            <p><?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie')); ?></p>
        </div>
    </div>
</div>