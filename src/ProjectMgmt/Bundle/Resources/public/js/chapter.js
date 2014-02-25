(function($)
{
    $.fn.chapter = function()
    {
        this.edit = function(id, field, successCallback, errorCallback)
        {
            ajaxGet(Routing.generate('ajax_chapter_update', {'id': id, 'field': field}), successCallback, errorCallback);
        };

        this.update = function(id, field, data, successCallback, errorCallback)
        {
            ajaxPost(Routing.generate('ajax_chapter_update', {'id': id, 'field': field}), data, successCallback, errorCallback);
        };

        return this;
    };
})(jQuery);

$(function() {
    $('.chapter-name')
        .hover(function() {
           $(this).css('cursor', 'pointer'); 
        })
        .click(function() {
            if ($(this).hasClass('editing'))
                return;

            $(this).addClass('editing');
            
            var id          = $(this).attr('name');
            var selector    = '.chapter-name[name="'+id+'"]';

            $(this).chapter().edit(id, 'name', function(data) {
                $(selector).html(data);
                $(selector + ' input').focus();
                $(selector + ' form').submit(function(e) {
                    e.preventDefault();
                    $(this).chapter().update(id, 'name', $(this).serializeArray(), function(dataFinal) {
                        $(selector).html(JSON.parse(dataFinal['result'])['name']).removeClass('editing');
                    }, function(data) {
                        alert(data);
                    });
                });
            }, function(data) {
                $(this).removeClass('editing');
            });
        });
    $('.chapter-content')
        .hover(function() {
           $(this).css('cursor', 'pointer'); 
        })
        .click(function() {
            if ($(this).hasClass('editing'))
                return;

            $(this).addClass('editing');
            
            var id          = $(this).attr('name');
            var selector    = '.chapter-content[name="'+id+'"]';
            var height      = $(selector).height();
            
            $(this).chapter().edit(id, 'content', function(data) {
                $(selector).html(data);
                $(selector + ' textarea').focus();
                $(selector + ' textarea').height(height);
                $(selector + ' form').focusout(function(e) {
                    e.preventDefault();
                    $(this).chapter().update(id, 'content', $(this).serializeArray(), function(dataFinal) {
                        $(selector).html(JSON.parse(dataFinal['result'])['content']).removeClass('editing');
                    }, function(data) {
                        alert(data);
                    });
                });
            }, function(data) {
                $(this).removeClass('editing');
            });
        });
});