$(document).ready(function() {
    var url = $("#base_url").val();
    var dt = $('#data-tables').DataTable( {
        oLanguage: {
                sProcessing: "<img src='"+url+"assets/backend/img/loading.gif'>"
         },
        "processing": true,
        "serverSide": true,
        "ajax": url+"admin/flats/getFlatsData",
        "columns": [
            { "data": "chk" },
            { "data": "id" },
            { "data": "flatNo" },
            { "data": "wingPhase" },  //columns that you want to show in table
            { "data": "flatSize" },
            { "data": "flatType" },
            { "data": "created" },
            { "data": "status" },
            { "data": "action" }
        ],
        "order": [],
        columnDefs: [
           { orderable: true, targets: [1,2,3,4,5,6] },
           { orderable: false, targets: [0,8] },
           { "width": "5%", "targets": [0,1] },
           { "width": "10%", "targets": [5] },
           { "width": "15%", "targets": [2,6] }
        ],
        "fnDrawCallback": function (oSettings) {
           nbr=0;
            $(".details-control").each(function()
            {
                if(nbr > 0)
                {
                    $(this).html('<img src="<?php echo base_url();?>backend_assets/img/details_open.png">');
                }
                nbr++;
            });

            $('tbody').css('border', '1px solid #eee');
            $('[data-rel^="switch"]').bootstrapSwitch();
        }
    });

	"use strict";

    var add_new_flat = $('#add-new-flat');
    var error_register = $('.alert-danger', add_new_flat);
    var success_register = $('.alert-success', add_new_flat);

    add_new_flat.validate({
        errorElement: 'div', //default input error message container
        errorClass: 'vd_red', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            flatNo: {
                required: true
            },
            wingPhase: {
                required: true
            },
            flatSize: {
                number: true,
                required: true
            },
            flatType: {
                required: true
            },
        },

		errorPlacement: function(error, element) {
			if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")){
				element.parent().append(error);
			} else if (element.parent().hasClass("vd_input-wrapper")){
				error.insertAfter(element.parent());
			}else {
				error.insertAfter(element);
			}
		},

        invalidHandler: function (event, validator) { //display error alert on form submit
				success_register.fadeOut(500);
				error_register.fadeIn(500);
				scrollTo(add_new_flat,-100);

        },

        highlight: function (element) { // hightlight error inputs

			$(element).addClass('vd_bd-red');
			$(element).siblings('.help-inline').removeClass('help-inline fa fa-check vd_green mgl-10');

        },

        unhighlight: function (element) { // revert the change dony by hightlight
            $(element)
                .closest('.control-group').removeClass('error'); // set error class to the control group
        },

        success: function (label, element) {
            label
                .addClass('valid').addClass('help-inline fa fa-check vd_green mgl-10') // mark the current input as valid and display OK icon
            	.closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
			$(element).removeClass('vd_bd-red');
        },

        submitHandler: function (form) {
				success_register.fadeIn(500);
				error_register.fadeOut(500);
				scrollTo(add_new_flat,-100);
                submitForm();
        }
    });
});

function submitForm(){
    BASEURL = $("#base_url").val();
    $('#submit-register-flat').prop("disabled", true);
    var add_new_flat = $('#add-new-flat');
    var error_register_2 = $('.alert-danger', add_new_flat);
    var success_register_2 = $('.alert-success', add_new_flat);
    var formData = $( "#add-new-flat" ).serialize();
    alert(formData);
    $.ajax({
        url: BASEURL+"admin/flats/addNewFlat",
        type: 'POST',
        data:  formData
    }).done(function(responce)
    {
        alert(responce);
        $('.fa-spinner').remove();
        var data = jQuery.parseJSON(responce);
        if(data.status=='error')
        {
            $.each(data.errorfields, function()
            {
                $.each(this, function(name, value)
                {
                    $('[name*="'+name+'"]').parent().after('<div class="vd_red">'+value+'</div>');
                });
            });
            $('#submit-register-flat').prop("disabled", false);
        }
        else
        {
            if(data.status=='success')
            {
                $('.alert-success').show();
                $('.alert-danger').hide();
                $('.alert-success').html('<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="icon-cross"></i></button><span class="vd_alert-icon"><i class="fa fa-check-circle append-icon"></i></span><strong>Well done! </strong>'+data.message+'. ');
                document.getElementById("login-form").reset();
                //$("#myModal").
                //alert("Hi");
                //window.location.href = BASEURL+'admin/dashboard';
            }
            else
            {
                if(data.status == 'fail')
                {
                    $('.alert-danger').html('<button class="close" aria-hidden="true" data-dismiss="alert" type="button"><i class="icon-cross"></i></button><span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap! </strong>'+data.message+'. ');
                    $('.fa-spinner').remove();
                    success_register_2.hide();
                    error_register_2.show();
                    $('#submit-register-flat').prop("disabled", false);
                }
                else
                {
                    $('.fa-spinner').remove();
                    success_register_2.hide();
                    error_register_2.show();
                    $('#submit-register-flat').prop("disabled", false);
                }
            }
        }
    }).fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        $('#submit-register-flat').prop("disabled", false);
    });
}
