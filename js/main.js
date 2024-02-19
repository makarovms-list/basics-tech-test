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


/*
    jQuery.ajax({
		url: '/wp-admin/admin-ajax.php',
		type: 'POST',
		data: 'action=add_estate&user_id='+user_id+'&job_title='+job_title+'&job_salary_from='+job_salary_from+'&job_salary_up_to='+job_salary_up_to+'&job_text='+job_text+'&job_link='+job_link,
		beforeSend: function( xhr ) {
			
		},
		success: function( data ) {
			//var answer = jQuery.parseJSON(data);
			//console.log(data);
			location.reload();
		}
	});
*/




