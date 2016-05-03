(function ($) {
    $.fn.videoCategoryPlugin = function() {
        return $(this).each(function() {
            category = new Category();
            category.makeAjaxRequest();
            category.deActivateCategory();
            category.switchTabs();
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

        this.switchTabs = function() {
            tabHead = $(".tabs a");
            $("#pending_categories").fadeOut('fast');
            tabHead.on("click", function() {
                 if (! $(this).hasClass('active')) {
                    $(this).addClass('active');
                    currentTab = $(this).attr('href').split('#');

                    nextTab = $(".tabs").find('a').not($(this));
                    blindTab = nextTab.attr('href').split('#');
                    nextTab.removeClass('active');

                    $("#"+blindTab[1]).fadeOut('fast');
                    $("#"+currentTab[1]).fadeIn('fast');
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
                   cancelButtonText: "No, cancel plx!",   
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