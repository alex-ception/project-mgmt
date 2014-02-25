(function($)
{
    $.fn.book = function()
    {
        this.edit = function(id, successCallback, errorCallback)
        {
            ajaxGet(Routing.generate('ajax_book_update', {'id': id}), successCallback, errorCallback);
        };

        this.update = function(id, data, successCallback, errorCallback)
        {
            ajaxPost(Routing.generate('ajax_book_update', {'id': id}), data, successCallback, errorCallback);
        };

        return this;
    };
})(jQuery);

$(function() {
    $('#book-name')
        .hover(function() {
           $(this).css('cursor', 'pointer'); 
        })
        .click(function() {
            if ($(this).hasClass('editing'))
                return;

            $(this).addClass('editing');

            var id          = $(this).attr('name');
            var selector    = '#book-name[name="'+id+'"]';
            
            $(this).book().edit(id, function(data) {
                $(selector).html(data);
                $(selector + ' input').focus();
                $(selector + ' form').submit(function(e) {
                    e.preventDefault();
                    $(this).book().update(id, $(this).serializeArray(), function(dataFinal) {
                        $(selector).html(JSON.parse(dataFinal['result'])['name']).removeClass('editing');
                    }, function(data) {
                        alert(data);
                    });
                });
            }, function(data) {
                $(this).removeClass('editing');
            });
        });
});