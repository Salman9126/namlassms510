$(document).ready(function() {
    var base_url = $("#base_url").val();

    $("#check").click(function(){
        var checked_status = this.checked;
        $("#myform input[type=checkbox]").each(function(){
            this.checked = checked_status;
        });
    });

    var dt = $('#data-tables').DataTable( {
        oLanguage: {
                sProcessing: "<img src='"+base_url+"assets/backend/img/loading.gif'>"
         },
        "processing": true,
        "serverSide": true,
        "ajax": base_url+"admin/members/getFlatsData",
        "columns": [
            { "data": "chk" },
            { "data": "id" },
            { "data": "flatNo" },
            { "data": "name" },  //columns that you want to show in table
            { "data": "contactNo" },
            { "data": "emailId" },
            //{ "data": "created" },
            { "data": "status" },
            { "data": "action" }
        ],
        "order": [],
        columnDefs: [
           { orderable: true, targets: [1,2,3,4,5] },
           { orderable: false, targets: [0,7] },
           { "width": "5%", "targets": [0,1] },
           { "width": "10%", "targets": [4] },
           { "width": "15%", "targets": [2,5] }
        ],
        "fnDrawCallback": function (oSettings) {
           nbr=0;
            $(".details-control").each(function()
            {
                if(nbr > 0)
                {
                    $(this).html('<img src="'+base_url+'backend_assets/img/details_open.png">');
                }
                nbr++;
            });

            $('tbody').css('border', '1px solid #eee');
            $('[data-rel^="switch"]').bootstrapSwitch();
        }
    });

	"use strict";

    var add_new_flat_member = $('#add-new-flat-member');
    var error_register = $('.alert-danger', add_new_flat_member);
    var success_register = $('.alert-success', add_new_flat_member);

    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Letters only please"); 

    add_new_flat_member.validate({
        errorElement: 'div', //default input error message container
        errorClass: 'vd_red', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            memberType: {

                required: function(element) {
                    // activate/disable method A
                    return ($('#memberType').prop('disable')!=true) ? true : false;
                }
            },
            flatNo: {
                required: true
            },
            firstName: {
                lettersonly: true,
                required: true
            },
            middleName: {
                lettersonly: true
            },
            lastName: {
                lettersonly: true,
                required: true
            },
            contactNo: {
                number: true,
                required: true,
                minlength: 10,
                maxlength: 10
            },
            alternateNo: {
                number: true,
                minlength: 10,
                maxlength: 10
            },
            emailId: {
                required: true,
                email: true
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
				scrollTo(add_new_flat_member,-100);
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
				scrollTo(add_new_flat_member,-100);
                submitForm();
        }
    });

    /* START: Add New Member Code */

    /*$("#addMember").click(function(){
        $('#add-new-member').show();
        var rowCnt = $("#rowCnt").val();
        var newMember = '<tr id="rowNO'+rowCnt+'"> <th><input type="text" placeholder="First Name" class="required" required name="rFirstName" id="rFirstName" ></th> <td><input type="text" placeholder="Last Name" class="required" required name="mLastName[]" id="mLastName" ></td> <td><input type="text" placeholder="Contact No." class="required" required name="mContactNo[]" id="mContactNo" ></td> <td><input type="text" placeholder="Email ID" class="required" required name="mEmailId[]" id="mEmailId" ></td> <td><input type="file" name="mPhoto[]" id="mPhoto"></td> <td><select class="required" required name="memberType" id="memberType"> <option value="">Member Type</option> <option value="1">Owner</option> <option value="2">Sub Member</option> <option value="3">Rental</option> </select></td> <td><a href="javascript:void(0);" class="btn vd_btn vd_bg-red" onclick="deleteMemberRow(rowNO'+rowCnt+');"><i class="append-icon fa fa-fw fa-trash-o"></i></a></td> </tr>';
        $('#add-new-member-row').append(newMember);
        $("#rowCnt").val($("#rowCnt").val()+1);
    });*/
    
    /* END: Add New Member Code */
    $('#myModal').on('hidden.bs.modal', function (e) {
        $('#add-new-flat-member')[0].reset();
        //$('#picturePreview').attr('src','');
        //$('.tag').remove();
   })
});

function deleteMemberRow(row){
    $(row).remove();
}

function submitForm(){
    var BASEURL = $("#base_url").val();
    $('#submit-register-flat-member').prop("disabled", true);
    var add_new_flat_member = $('#add-new-flat-member');
    var error_register_2 = $('.alert-danger', add_new_flat_member);
    var success_register_2 = $('.alert-success', add_new_flat_member);
    //var formData = $( "#add-new-flat-member" ).serialize();
    var formData = new FormData($( "#add-new-flat-member" )[0]);
    //formData.append("img", $('#photo')[0]);

    alert(formData);
    $.ajax({
        url: BASEURL+"admin/members/addNewFlatMember",
        type: 'POST',
        data:  formData,
        contentType: false,
        processData: false,
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
            $('#submit-register-flat-member').prop("disabled", false);
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
                    $('#submit-register-flat-member').prop("disabled", false);
                }
                else
                {
                    $('.fa-spinner').remove();
                    success_register_2.hide();
                    error_register_2.show();
                    $('#submit-register-flat-member').prop("disabled", false);
                }
            }
        }
    }).fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        $('#submit-register-flat-member').prop("disabled", false);
    });
}

function openEditForm(memberId)
{
    $('#flatNo').attr('disabled','disabled');
    var BASEURL = $("#base_url").val();
    $.blockUI.defaults.css = {
            padding: 0,
            margin: 0,
            width: 'auto',
            top: '40%',
            left: '45%',
            textAlign: 'center',
            cursor: 'wait'
        };
    $.blockUI({ message: '<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"><div class="modal-dialog" style="width:300px !important;box-shadow:0 6px 7px #000;"><div class="modal-content"><div class="modal-body" style="padding-bottom:15px !important;"><img src="<?php echo base_url();?>backend_assets/img/loadings.gif"></div></div></div></div>' });
    $.ajax({
        url: BASEURL+'admin/members/getEditFormData',
        type: 'POST',
        data: {memberId:memberId},
    })
    .done(function(responce) {
      var data=jQuery.parseJSON(responce);

    $.each(data, function(index, val)
    {
        //alert(index+' '+ val)
        if(index == 'description')
        {
            $('#wysiwyghtml').data("wysihtml5").editor.setValue(val);
        }
        else
        {
            if(index == 'keywords')
            {
                $('.tagsinput').remove();
                $("input[name='"+index+"']").val(val);
                $('.tags').tagsInput({
                                  'height':'100px',
                                  'width':'auto'
                                 });
            }else if( index == 'flatNo'){
                $('<input type="text" name="'+index+'" value="'+val+'" class="'+index+'" readonly>').insertAfter('#'+index);
                $('#'+index).remove();
                $('.'+index).attr('id',index);
            }else if( index == 'memberType'){
                $('#'+index).val(val);
            }else{

                if(index == 'picture')
                {
                    /*var base_url='<?php echo front_base_url();?>';*/
                    var img=base_url+'uploads/members/thumb/'+val;
                    $('#picturePreview').attr('src', img);
                }else if(index == 'alternateNo'){
                    if(val=='' || val==0)
                        $("input[name='"+index+"']").val('');
                    else
                        $("input[name='"+index+"']").val(val);
                }else{
                    $("input[name='"+index+"']").val(val);
                }
            }
        }
    });

     $('#memberId').val(memberId);
     $('#myModal').modal('show');
      $.unblockUI();
    })
    .fail(function() {
      console.log("error");
    })
}

function add_member_pop_up(){
    $('#flatNo').attr('disabled',false);
    $('#parentFlatID').val('');
    $('#memberType').val(1);
    $('#memberType').attr('disabled',true);
    $('#Rental').hide();
    $('#Family').hide();
    $('#Owner').show();
    $('#myModal').modal('show');
}

function sub_member_pop_up(parentFlatID){
    alert(parentFlatID);
    $('#flatNo').val(parentFlatID);
    $('#flatNo').attr('disabled',true);
    $('#parentFlatID').val(parentFlatID);
    $('#memberType').attr('disabled',false);
    $('#memberType').val('');
    $('#Owner').hide();
    $('#Rental').show();
    $('#Family').show();
    $('#myModal').modal('show');
}

function change_status(userId)
{
    var base_url = $("#base_url").val();
    var done = confirm("Are you sure, you want to change the status?");
    if(done == true)
    {
        var pageurl_new = base_url+'admin/members/change_status/'+userId;
        window.location.href = pageurl_new;
    }
    else
    {
        return false;
    }
}

function delete_members(userId)
{   
    var base_url = $("#base_url").val();
    var done = confirm("Are you sure, you want to delete the members?");
    if(done == true)
    {
        var pageurl_new = base_url+'admin/members/delete_members/'+userId;
        window.location.href = pageurl_new;
    }
    else
    {
        return false;
    }
}
