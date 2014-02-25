function ajaxGet(route, successCallback, errorCallback)
{
    $.ajax({
        type: 'GET',
        url: route,
        cache: false,
        success: function(data)
        {
            //$.unblockUI();
            if (successCallback !== null)
                successCallback(data);
            else
                console.log(data);
        },
        error: function(xhr, ajaxOptions, thrownError)
        {
            //$.unblockUI();
            if (errorCallback !== null)
                errorCallback(thrownError);
            else
                console.log(data);
        }
    });
}

function ajaxPost(route, data, successCallback, errorCallback)
{
    $.blockUI({
        message: '<i class="fa fa-spinner fa-spin fa-5x"></i>',
        css: {
            border: 'none',
            background: 'transparent'
        }
    });

    $.ajax({
        type: 'POST',
        url: route,
        cache: false,
        dataType: 'json',
        data: data,
        success: function(data)
        {
            $.unblockUI();
            if (successCallback !== null)
                successCallback(data);
            else
                console.log(data);
        },
        error: function(xhr, ajaxOptions, thrownError)
        {
            $.unblockUI();
            if (errorCallback !== null)
                errorCallback(thrownError);
            else
                console.log(data);
        }
    });
}
