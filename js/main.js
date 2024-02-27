window.onload = function () {
    jQuery(".feedback-form").submit(function(e) {
        var form = jQuery(this);
        console.log(form.serialize());
        jQuery.ajax({
            type: "POST",
            url: "/wp-admin/admin-ajax.php",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
              //alert(data);
              alert('Объект добавлен на сайт.');
            }
        });
        e.preventDefault();
    }); 
}
