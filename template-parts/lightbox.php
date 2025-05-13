<div class="lightbox">
    <button class="lightbox-close">&times;</button>
    <div class="lightbox-img-navigation">
        <button class="lightbox-prev"><span class="prev-arrow">&larr;</span>Précédent</button>
        <div class="lightbox-img">
            <img src="<?php echo get_the_post_thumbnail_url(65, 'full'); ?>" alt="">
            <div class="lightbox-data">
                <p>reference <?php echo get_field("reference"); ?></p>
                <p>categorie<?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie')); ?></p>
            </div>
        </div>
        <button class="lightbox-next">Suivant<span class="next-arrow">&rarr;</span></button>
    </div>
</div>