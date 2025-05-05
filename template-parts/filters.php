<form method="post" class="flex-row-container form-select">
    <input type="hidden" name="nonce" id='nonce' value="<?php echo wp_create_nonce('filter_photos_nonce'); ?>">
    <input type="hidden" name="ajaxurl" id='ajaxurl' value="<?php echo admin_url('admin-ajax.php'); ?>">
    <div class="col-1-filter-wrapper">
        <!-- Categories filter -->
        <div class="dropdown-wrapper">
            <select class="dropdown-toggle categories-filter" id="category_id" name="categories">
                <option value=""></option>
                <?php
                $categories = get_terms('categorie', array("hide_empty" => false));
                foreach ($categories as $category) :
                ?>
                    <option value="<?php echo $category->slug ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Formats filter -->
        <div class="dropdown-wrapper">
            <select class="dropdown-toggle formats-filter" id="format_id" name="formats">
                <option value=""></option>
                <?php
                $formats = get_terms('format', array("hide_empty" => false));
                foreach ($formats as $format) :
                ?>
                    <option value="<?php echo $format->slug ?>"><?php echo $format->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>


    </div>
    <div class="col-2-filter-wrapper">
        <!-- Dropdown to sort photos by 2 options: the newest or the oldest featured images-->
        <div class="dropdown-wrapper">
            <select class="dropdown-toggle sort-by-date-filter" id="date_id" name="sort_by">
                <option value=""></option>
                <option value="date_desc">Plus récentes</option>
                <option value="date_asc">Plus anciennes</option>
            </select>
        </div>

    </div>
</form>