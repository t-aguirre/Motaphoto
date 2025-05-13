 //Implement Select2 to filter and display featured images in home.php
 $(document).ready(function() {

    $('.dropdown-toggle').each(function(){
        let placeholder = "";

        //Condition to display the placeholder by filter
        if ($(this).hasClass('categories-filter')) {
            placeholder = 'Catégories';
        } else if ($(this).hasClass('formats-filter')) {
            placeholder = 'Formats';
        } else if ($(this).hasClass('sort-by-date-filter')) {
            placeholder = 'Trier par';
        }

        // Initialising select2
        $(this).select2 ({
            placeholder: placeholder,
            width: '100%',
            allowClear: true, //causes a clear button ("x" icon) to appear on the select box when a value is selected
            selectionCssClass: 'select-filter',
            dropdownAutoWidth: true, //Automatically adjusts the width of the dropdown to match the width of the select element
            dropdownCssClass: 'select-dropdown-list',
            });
        });

    });

