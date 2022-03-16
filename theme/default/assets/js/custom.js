
  $(document).on('click', '#check-update', function () {

    

    var $this = $(this);

    $this.text('please wait...');
    $this.attr('disabled','disabled');
    
    $.ajax({
        type: "GET",
        url: PROOT + '/ajax',
        data: 'type=check-update',
        cache: false,
        success: function (data) {
            if(data.success)
            {
                $this.text('Update Now');
                $("#change-logs").html(data.logs);
                $this.attr('id', 'update-now');
                displayAlert('<b>Great News ! Newer version is available :) -> [v'+data.version+']</b>', 'info');
            }
            else
            {
                $this.text('Check updates');

                displayAlert(' <b>GDplyr is up to date :)</b>', 'success');
            }
            $this.removeAttr('disabled');
        },
        error: function (xhr) { // if error occured
            alert("Error occured.please try again");
            $this.text('Check updates');
        }
    });



  });

  function displayAlert(msg , type)
  {
    
                                
                            
    var html = '<div class="alert alert-'+type+' dismissible-alert" role="alert">';

    html += msg +'  <i class="alert-close mdi mdi-close"></i>';

    html += '</div>  ';

    $("#alert-wrap").html(html);

  }


  $(document).on('click', '#update-now', function () {
  

    var $this = $(this);

    $this.text('Updating...');
    $this.attr('disabled','disabled');
    
    $.ajax({
        type: "GET",
        url: PROOT + '/ajax',
        data: 'type=script-update',
        cache: false,
        success: function (data) {
            if(data.success)
            {
                $this.text('Check updates');
                $this.attr('id', 'check-update');
                displayAlert('<b>Script was successfully updated. Enjoy the new features! :) </b>', 'success');
            }
            else
            {
                $this.text('Update now');

                displayAlert(' <b>Update Failed !</b> '+data.error+' ', 'danger');
            }
            $this.removeAttr('disabled');
        },
        error: function (xhr) { // if error occured
            alert("Error occured.please try again");
            $this.text('Update now');
        }
    });

   

});



$(document).on('click', '#add-vast-tag', function () {
  

  

    $("#vast-id").val('');
    $("#vast-title").val('');
    $("#vast-offset").val('');
    $("#vast-file").val('');
    var $sv = $('#vast-type option[value="video"]');
    var attr = $sv.attr('selected');

    if(typeof attr !== typeof undefined && attr !== false)
    {
        $sv.removeAttr('selected');
    }
    $('#vast-type option[value="nonlinear"]').attr("selected", "selected");

    if(!$(".skipoff-input").hasClass('d-none'))
    {
        $(".skipoff-input").addClass('d-none'); 
    }

    $('#new-vast-form').modal('show')



});



$(document).on('click', '.edit-vast', function () {
  

    var vid = $(this).attr("data-id");
    var vtitle = $(this).attr("data-title");
    var voffset = $(this).attr("data-offset");
    var vskipoffset = $(this).attr("data-skipoffset");
    var vtype = $(this).attr("data-type");
    var vfile = $(this).attr("data-file");

    $("#vast-id").val(vid);
    $("#vast-title").val(vtitle);
    $("#vast-offset").val(voffset);
    $("#vast-file").val(vfile);
    $('#vast-type option[value="'+vtype+'"]').attr("selected", "selected");

    if(vtype == 'video')
    {
        $(".skipoff-input").removeClass('d-none');
    }

    $('#new-vast-form').modal('show')



});


$('#vast-type').on('change', function () {
    //ways to retrieve selected option and text outside handler
    if(this.value == 'video')
    {
        $(".skipoff-input").removeClass('d-none');
    }
    else
    {
        if(!$('.skipoff-input').hasClass('d-none'))
        {
            $(".skipoff-input").addClass('d-none');
        }
    }
  });

$(document).on('click', '.del-link', function () {
  
    var id = $(this).attr('data-id');

    $("#delete-confirmation .s-del-link").attr('data-id', id);

    $('#delete-confirmation').modal('show');


});


$(document).on('click', '.s-del-link', function () {
  
    var id = $(this).attr('data-id');
    var $this = $(this);
    $this.attr('disabled','disabled');
    $.ajax({
        type: "GET",
        url: PROOT + '/ajax',
        data: 'id=' + id + '&type=delete-link',
        cache: false,
        success: function (data) {
            if(data.success)
            {
                $('#link-'+id).remove();
                resetToastPosition();
                $.toast({
                    text: '',
                    icon: 'info',
                    allowToastClose: false,
                    heading: 'Link is deleted successfully !',
                    position: 'bottom-left',
                    loader: false
                })
            }
            $this.removeAttr('disabled');
            
            $('#delete-confirmation').modal('hide');
        },
        error: function (xhr) { // if error occured
            alert("Error occured.please try again");
            $this.removeAttr('disabled');
        }
    });


});





$(document).on('click', '.copy-plyr-link', function () {
    var url = $(this).attr('data-url');
    copyToClipboard(url);
    
    resetToastPosition();
    $.toast({
        text: '',
        icon: 'success',

        allowToastClose: false,
        heading: 'Player Link copied to clipboard !',
        position: 'bottom-left',
        loader: false
    })

});

$(document).on('click', '.copy-stream-link', function () {
    var url = $(this).attr('data-url');
    copyToClipboard(url);
    
    resetToastPosition();
    $.toast({
        text: '',
        icon: 'warning',

        allowToastClose: false,
        heading: 'Stream Link copied to clipboard !',
        position: 'bottom-left',
        loader: false
    })

});


$("#check-proxy").on('click', function(){

    var proxyList = $("#proxy-list").val().split(',');

    var proxy = [];



    for (var i=0; i < proxyList.length; i++) {
        if (/\S/.test(proxyList[i])) {
            proxy.push($.trim(proxyList[i]));
        }
    }


    if(proxy.length > 0)
    {
        var totalProxy = proxy.length;
        $('.t-proxy').text(totalProxy);
        // $('.t-links, .p-links').text(totalLinks);
        checking();
        checkProxy(proxy);

        $('.proxy-progress').removeClass('d-none');

       console.log(proxy);

    }
    
});



function checking()
{
    var html = '<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>&nbsp;checking...';
    $("#check-proxy").html(html);
    $("#check-proxy").attr('disabled','disabled');
}

function checked()
{
    var html = 'Check proxies';
    $("#check-proxy").html(html);
    $("#check-proxy").removeAttr('disabled');
}


function checkProxy(proxy)
{

    if(typeof proxy[0] !== 'undefined') {

        var v_ip = proxy[0];
        proxy.splice(0,  1);

        $.ajax({
            type: "GET",
            url: PROOT + '/ajax',
            data: 'ip=' + v_ip + '&type=check-proxy',
            cache: false,
            success: function (data) {
                updateCheckedStatus();
                checkProxy(proxy);
                
                
            },
            error: function (xhr) { // if error occured
                console.log("Error occured.please try again. -> " + v_ip );
                updateCheckedStatus();
                checkProxy(proxy);
              
            }
        });


    }
    else {
        // does exist
        checked();
        window.location.reload();


    }




}

function updateCheckedStatus()
{
    var p_proxy = $('.p-proxy').text();
    var t_proxy = $('.t-proxy').text();

    if(p_proxy != t_proxy)
    {
        $('.p-proxy').text(parseInt(p_proxy)+1);

      
        var st = Math.round(((parseInt(p_proxy) + 1) * 100) / parseInt(t_proxy));
        $(".progress .progress-bar").text(st + '% completed');
       


        $(".progress .progress-bar").attr('style', 'width:' + st + '%');
        $(".progress .progress-bar").attr('aria-valuenow', st);

        

        



    }
   



}






$("#import-link").on('click', function(){

    var linkList = $("#link-list").val().split(',');

    var links = [];



    for (var i=0; i < linkList.length; i++) {
        if (/\S/.test(linkList[i])) {
            links.push($.trim(linkList[i]));
        }
    }


    if(links.length > 0)
    {
        var totalLinks = links.length;
        $('.t-links, .p-links').text(totalLinks);
        importing();
        addLinks(links);

        $('.df').removeClass('d-none');

    }
    
});

function updateImportStatus(success = false)
{
    var p_link = $('.p-links').text();
    var s_link = $('.s-links').text();
    var f_link = $('.f-links').text();

    if(p_link != 0)
    {
        $('.p-links').text(parseInt(p_link)-1);
    }
if(success)
{
    $('.s-links').text(parseInt(s_link)+1);
}
else
{
    $('.f-links').text(parseInt(f_link)+1);
}
   


}


function importing()
{
    var html = '<div class="spinner-border spinner-border-sm text-white" role="status"><span class="sr-only">Loading...</span></div>&nbsp;Importing';
    $("#import-link").html(html);
    $("#import-link").attr('disabled','disabled');
}

function imported()
{
    var html = 'Import';
    $("#import-link").html(html);
    $("#import-link").removeAttr('disabled');
}


function addLinks(links)


{


    if(typeof links[0] !== 'undefined') {
        

        var v_url = links[0];

        
        links.splice(0,  1);
       


 


        $.ajax({
            type: "GET",
            url: PROOT + '/ajax',
            data: 'url=' + v_url + '&type=import-link',
            cache: false,
            success: function (data) {
                if(data.success)
                {
                    if(data.title.length == 0)
                    {
                        data.title = v_url ;
                    }
                    bi_add_response(data.title, 'success');
                }
                else
                {
                    bi_add_response(v_url , 'danger',data.error);
                }
                updateImportStatus(data.success);
                addLinks(links);
                
            },
            error: function (xhr) { // if error occured
                console.log("Error occured.please try again. -> " + v_url );
                updateImportStatus(false);
                addLinks(links);
              
            }
        });


    }
    else {
        // does exist
        imported();
    }




}


function bi_add_response(msg, type='',  error ='')
{

    if(type == 'danger')
    { 
        mtype = 'failed';
    }
    else
    {
        mtype = 'success';
    }

    var html = '<li> '+msg+ '<b class="float-right text-'+type+'" >'+mtype+'</b> ';
    if(type = 'danger')
    {
        html += '<br> <small class="text-danger">'+error+'</small>';
    }
    html += '  </li>';
    
    $("#mi-response").append(html);
}



$(document).on('click', '.copy-embed-code', function () {
    var url = $(this).attr('data-url');
    var embed = '<iframe src="'+url+'" frameborder="0" allowFullScreen="true" width="640" height="320"></iframe>';
    copyToClipboard(embed);
    
    resetToastPosition();
    $.toast({
        text: '',
        icon: 'info',

        allowToastClose: false,
        heading: 'embed code copied to clipboard !',
        position: 'bottom-left',
        loader: false
    })

});


$("#removeLogo").on('click', function(){
    $("#logoVal").val('');
    $("#logoImg").remove();
    $(this).remove();
});

$("#removeFav").on('click', function(){
    $("#favVal").val('');
    $("#favIco").remove();
    $(this).remove();
});

$("#copyPlyrLink").on('click', function(){
    var txt = $("#plyrLink").val();
    var $this = $(this);
    copyToClipboard(txt);
    $this.text('copied');
    setTimeout(
        function()
        { 
            $this.text('copy');
         }, 3000
    );
});

$("#copyStreamLink").on('click', function(){
    var txt = $("#streamLink").val();
    var $this = $(this);
    copyToClipboard(txt);
    $this.text('copied');
    setTimeout(
        function()
        { 
            $this.text('copy');
         }, 3000
    );
});

$("#copyEmbedCode").on('click', function(){
    var txt = $("#embedCode").val();
    var $this = $(this);
    copyToClipboard(txt);
    $this.text('copied');
    setTimeout(
        function()
        { 
            $this.text('copy');
         }, 3000
    );
});

$("#copyDownloadLink").on('click', function(){
    var txt = $("#downloadLink").val();
    var $this = $(this);
    copyToClipboard(txt);
    $this.text('copied');
    setTimeout(
        function()
        { 
            $this.text('copy');
         }, 3000
    );
});

function copyToClipboard(text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
}



if ($("#summernoteExample").length) {
    $('#summernoteExample').summernote({
        height: 300,
        tabsize: 2
    });
}