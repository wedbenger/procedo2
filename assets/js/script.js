jQuery(function($){
    //jump to the section that the user has clicked
    $('.nav-link').click(function(){
        var target = $(this).attr('target');
        $('html, body').animate({ scrollTop: $(target).offset().top-100 }, 500);
    });

    //set active the item of menu that is shown in the window
    function selectTitle(win, scroll) {
        var win = $(this).height();
        var scroll = $(this).scrollTop();

        var maxPos = 0;
        var title = '';
        $('.sub-title-content').each(function(){
            var pos = parseInt($(this).offset().top);
            if (win+scroll > parseInt(pos+300)) {
                //get the last item of menu
                if (parseInt(pos+300) > parseInt(maxPos)) {
                    maxPos = parseInt(pos);
                    title = '.'+$(this).prop('id');
                }
            }
        });  
        $('.nav-link').removeClass('active');
        $(title).addClass('active');
    }

    //call the functions
    $(window).scroll(function(){
        selectTitle();
    });

    //send the form
    //page: action of the form
    //data: data of the form
    //target: div that the result will be show
    function ajaxForm(page,data,target){
        $.post(page,data,function(result,status){
            if(status == 'success'){
                $(target).html(result);
            }
        });
    }

    //send form
    $('.form-ajax').submit(function(event){
        $(this).find('.message-form').html('');
        ajaxForm($(this).prop('action'),$(this).serialize(),$(this).find('.message-form'));
        event.preventDefault();
        return false;
    });

    //delete contacts, send the id to the confirm
    $('.delete-contact').click(function(){
        $('#deleteContact').prop('href',$(this).prop('href'));
    });

    //call for the first time
    selectTitle();
});