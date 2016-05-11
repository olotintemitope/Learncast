(function ($) {
    $.fn.videoPlugin = function() {
        return $(this).each(function() {
            video = new Video();
            video.makeAjaxRequest();
            video.deActivateVideo();
            video.switchTabs();
            video.processVideoFavourite();
            video.addComment();
            video.deleteComment();
            video.appendCommentForm();
            video.cancelForm();
            video.updateComment();
        });
    }

    function Video() {

        var generateEditForm  = function(id, comment) {
            var updateForm = '<form class="form-horizontal" role="form" id="form'+id+'">';
            updateForm     += '<div class="form-group"><div class="col-sm-10"><textarea class="form-control" name="coment" id="comment">'+comment+'</textarea></div>';
            updateForm     += '</div><div class="form-group"><div class="col-sm-offset-2 col-sm-10">';
            updateForm     += '<button type="submit" class="btn btn-default cancel-comment" id='+id+'>Cancel</button><button type="submit" class="btn btn-default update-comment" id='+id+'>Update</button>';
            updateForm     += '</div></div></form>';

            return updateForm;
        }

        this.updateComment  = function() {
            video = new Video();
            $(document).delegate(".update-comment", "click", function() {
                obj = $(this);
                commentId = obj.attr('id');
                commentHolder = obj.parents(".comment_form").siblings("#comment"+commentId);
                comment = $("#form"+commentId ).find("textarea").val();

                if (comment.length === 0) {
                    $("#form"+commentId).slideUp('fast');
                } else {
                    video.makeAjaxRequest('/video/comment/update/'+commentId, {'comment':comment}, '')
                    .done(function(response) {
                        if (response.statuscode === 200) {
                            $(".comment").fadeIn('slow');
                            commentHolder.html(comment);
                            $("#form"+commentId).slideUp('fast');
                        } else {
                            obj.html('Failed!').css('color', 'red');
                        }
                    });
                }

                return false;
            });
        } 

        this.cancelForm  = function() {
            $(document).delegate(".cancel-comment", "click", function() {
                $(".comment").fadeIn('slow');
                $("#form"+$(this).attr('id')).slideUp('fast');

                return false;
            });
        }

        this.appendCommentForm = function() {
            editBtn = $(".edit-comment");
            editBtn.on("click", function() {
                commentId       = $(this).attr('id');
                recentComment   = $(this).parents(".pull-right").siblings(".comment");
                commentForm     = generateEditForm(commentId, recentComment.text());
                commentPosition = $(this).parents(".pull-right").siblings(".comment_form");
                recentComment.fadeOut('slow');
                $(commentPosition).slideDown('fast').html(commentForm);
                
                return false;
            });
        }

        var swalAlert = function(video, url, dom, parameters) {
             swal({ title: "Are you sure?",    
                 type: "warning",   showCancelButton: true,   
                 confirmButtonColor: "#DD6B55",   
                 confirmButtonText: "Yes!",   
                 cancelButtonText: "No, cancel plx!",   
                 closeOnConfirm: false,   
                 closeOnCancel: false 
             }, function(isConfirm) { 
                if (isConfirm) { 
                    video.makeAjaxRequest(url, parameters, '')
                    .done(function(response) {
                        if (response.statuscode === 200) {
                            swal("Successful!", response.message , "success");
                            dom
                            .parents("li.media")
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
        }

        this.deleteComment = function() {
            videoObject = new Video();
            deleteBtn = $(".delete-comment");

            deleteBtn.on("click", function() {
                commentId = $(this).attr('id');

                swalAlert(videoObject, '/video/comment/delete/'+commentId, $(this), {});

                return false;

            });
        }

        this.addComment = function() {
            videoObject = new Video();
            loader = $(".preloader-wrapper");
            sendBtn  = $("#send");
            
            sendBtn.on("click", function() {
                video   = $(this).data('video');
                user    = $(this).data('user');
                comment = $("#comment").val();
                avatar  = $(this).data('avatar');
                username = $(this).data('username');
                commentWrapper = $(".media-list");

                token = $("#comment_form").find('input[type="hidden"]').val();
                if (comment.length == 0) {
                    loader
                    .html('<strong>*</strong> Did you forget to enter your comment')
                    .css({'color':'#A00', 'font-size': '14px', 'padding':'10px'})
                    .show('fast');
                } else {
                    loader.show('fast');
                    videoObject.makeAjaxRequest('/video/comment/add', {
                        'video':video, 
                        'user':user, 
                        'comment':comment,
                        '_token':token
                    }, 'POST').done(function(response) {
                        if (response.statuscode === 201) {
                            commentWrapper
                            .slideDown()
                            .append(drawComment(username, avatar, comment ));
                            loader.hide('fast');
                            $("#comment").val('');
                        } else {
                            loader
                            .html('<strong>*</strong>' + response.message)
                            .css({'color':'#A00', 'font-size': '14px', 'padding':'10px'})
                            .show('fast');
                        }
                    })
                }

                return false;
            });
        }

        var drawComment = function(username, avatar, comment) {
            var liComment  = "<li class='media'><div class='media-body'><div class='media'>";
                liComment += "<a class='pull-left' href='#'>";
                liComment += "<img class='media-object img-circle' src="+avatar+"></a>";
                liComment += "<div class='media-body'>"+comment+"<br><br><small class='text-muted'>"+ username + " | posted " + jQuery.timeago(new Date()); + "</small>";
                liComment += "<hr></div></div></div></li>";

            return liComment;
        }

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
                        favPlaceholder.html(response.favourites);
                    } else if (response.statuscode == 201){
                        favPlaceholder.html(response.favourites);
                    } else {
                        console.log("error", response.message);
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
            tabHead = $(".vtabs a");
            $("#pending_videos").fadeOut('fast');
            tabHead.on("click", function() {
               if (! $(this).hasClass('active')) {
                $(this).addClass('active');
                currentTab = $(this).attr('href').split('#');

                nextTab = $(".vtabs").find('a').not($(this));
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
                            window.location = '/dashboard/video/view'
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