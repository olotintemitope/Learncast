(function ($) {
    $.fn.videoCategoryPlugin = function() {
        return $(this).each(function() {
            category = new Category();
            category.makeAjaxRequest();
            category.deActivateCategory();
        });
    }

    function Category() {

        this.makeAjaxRequest  = function(url, parameters, request) {
            return $.ajax({
                url:url,
                data:parameters,
                type: request == '' ? 'GET' : 'POST',
                beforeSend:function() {
                },
                error:function() {
                }
            });
        }
        
        this.deActivateCategory = function() {
            category = new Category();
            handle = $(".activate");
            ParentTable = $("#active_categories table");

            handle.on("change", function() {
                id = $(this).attr('id')
                status = $(this).val();
                current = $(this);

                swal({ title: "Are you sure?",    
                   type: "warning",   showCancelButton: true,   
                   confirmButtonColor: "#DD6B55",   
                   confirmButtonText: "Yes!",   
                   cancelButtonText: "No!",   
                   closeOnConfirm: false,   
                   closeOnCancel: false 
               }, function(isConfirm) { 
                if (isConfirm) { 
                    category.makeAjaxRequest('/dashboard/category/delete/'+id, {'status': status}, '')
                    .done(function(response) {
                        if (response.statuscode === 200) {
                            swal("Successful!", response.message , "success");
                            current.parents("tr")
                            .fadeOut('fast')
                            .remove();
                            window.location = '/dashboard/category/view'
                        } else {
                            swal("Failed!", response.message, "error");
                        }
                    })
                } else { 
                    swal("Cancelled", "Operation cancelled)", "error"); 
                } 
            });
            });
        }
    }
}) (jQuery)