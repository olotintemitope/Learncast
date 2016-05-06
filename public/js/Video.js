(function ($) {
    $.fn.videoPlugin = function() {
        return $(this).each(function() {
            video = new Video();
            video.makeAjaxRequest();
            video.deActivateVideo();
            video.switchTabs();
            video.processVideoFavourite();
        });
    }

    function Video() {

        this.processVideoFavourite = function() {
            video = new Video();
            favBtn = $(".favourites");
            favPlaceholder = $(".fa-thumbs-up");
            nOfFavourites = 0;
            flag = 0;
            a = $(".favourites").attr('data-fav');

            favBtn.on("click", function() {
                currentObj = $(this);
                videoId = currentObj.attr('id');
                userId  = currentObj.data('user');
                nOfFavourites = currentObj.data('fav');

                flag = toggleFavourite($(this), flag);

                video.makeAjaxRequest('/favourite/video/'+videoId, 
                {'user' : userId,'flag' : flag }, '')
                .done(function(response) {
                    if (response.statuscode == 200) {
                        if (flag === 1) {
                            $(".favourites").attr('data-fav', a);
                            favPlaceholder.html(parseInt(nOfFavourites) + 1);
                        } else {
                            $(".favourites").attr('data-fav', a);
                            favPlaceholder.html(a);
                        }
                    }
                }); 

                return false;
            });
        }

        var toggleFavourite = function(obj, flag) {
            if (!obj.hasClass('click')) {
                obj.addClass('click');
                obj.removeClass('unclick');
                flag++;
                } else {
                    obj.addClass('unclick');
                    obj.removeClass('click');
                    flag--;
                }

            return flag;
        }

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
            $("#pending_videos").fadeOut('fast');
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

        this.deActivateVideo = function() {
            video = new Video();
            handle = $(".activate_video");
            ParentTable = $("#active_videos table");

            handle.on("change", function() {
                id = $(this).attr('id')
                status = $(this).val()
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
                    video.makeAjaxRequest('/dashboard/video/delete/'+id, {'status': status}, '')
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