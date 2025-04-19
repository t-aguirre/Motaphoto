<div class="flex-row-container">
    <div class="col-1-filter-wrapper">
        <div class="dropdown-wrapper">
            <div class="dropdown-toggle">Catégorie <span class="dashicons dashicons-arrow-down-alt2"></span></div>
            <ul class="categories-filter">
                <li>cat 1</li>
            </ul>
        </div>
        <div class="dropdown-wrapper">
            <div class="dropdown-toggle">Formats <span class="dashicons dashicons-arrow-down-alt2"></span></div>
            <ul class="formats-filter">
                <?php
                $formats = get_terms('format', array("hide_empty" => false));
                // var_dump($formats);
                foreach ($formats as $format) :
                ?>
                    <li><?php echo $format->name; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-2-filter-wrapper">
        <div class="dropdown-wrapper">
            <div class="dropdown-toggle">Trier par <span class="dashicons dashicons-arrow-down-alt2"></span></div>
            <ul class="category-list">
                <li>trier 1</li>
            </ul>
        </div>
    </div>


</div>