<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
	<?php
        
        if ($this->fal->check_any_fal_exists_yorumcu() == true){
    ?>
    var noties = [];
    var notify_count = 0;

    function update_notification()
    {
        //fal istekleri
        $.ajax({
            url : base_url + "/yorumcu/fal_istek_check",
            contentType : false,
            success : function(result) {
                if (result != "false")
                {
                    var faldata = JSON.parse(result);
                    
                    for (var i = 0; i < faldata.length; i++)
                    {
                        if (noties.includes("fal_"+faldata[i].id) == false)
                        {
                            $(".bildirim-list").append('<a class="dropdown-item unread" href="'
                                +base_url+'yorumcu/falistekleri/'+faldata[i].id+'" >'
                                +faldata[i].name
                                + ' isteği geldi!</a>');

                            notify_count++;
                            $("#notfycount").html("("+notify_count+")");

                            noties.push("fal_"+faldata[i].id);
                        }
                    }
                }
            },
            error : function(r){
                
            }
        });
        var msgurl = base_url + "yorumcu/mesaj_check/";
        if (window.location.pathname.split("/").pop() == "mesajlar")
        {
        	if (cur_id != null)
        	{
        		msgurl += cur_id;
        	}
        }

        //messaging
        $.ajax({
            url : msgurl,
            contentType : false,
            success : function(result) {
                if (result != "false")
                {
                    var msgdata = JSON.parse(result);

                    for (var i = 0; i < msgdata.length; i++)
                    {
                        var no_notify = false;
                       

                        if (window.location.pathname.split("/").pop() == "mesajlar")
                        {
                        	if (cur_id != null)
        					{

		                        if (msgdata[i].message_list == "true")
		                        {
		                            for (var j = 0; j < msgdata[i].messages.length; j++)
		                            {
		                                var msg = msgdata[i].messages[j];

		                                $(".msg_history").append('<div class="gelen_msg">'
		                                  +'<div class="alinan_msg">'
		                                    +'<p>'+msg.message+'</p>'
		                                    +'<span class="time_date">'+msg.date_send+'</span>'
		                                  +'</div>'
		                                +'</div>');
		                            }
		                            no_notify = true;
		                            var messageBody = $('.msg_history')[0];
									messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
		                        }
	                        }
                        }

                        if (noties.includes("msg_"+msgdata[i].id) == false)
                        {
                            if (no_notify == false){
                                $(".bildirim-list").append('<a class="dropdown-item unread" href="'
                                    +base_url+'yorumcu/mesajlar/" >'
                                    +msgdata[i].name
                                    + ' sana mesaj gönderdi</a>');

                                notify_count++;
                                $("#notfycount").html("("+notify_count+")");

                                noties.push("msg_"+msgdata[i].id);
                            }
                        }
                    }
                }
            },
            error : function(){
                
            }
        });
    }

    function keep_online()
    {
        $.ajax({
            url : base_url + "yorumcu/keep_online",
            contentType : false,
            success : function(result) {
                
            },
            error : function(r){
                
            }
        });
    }

update_notification();
setInterval(function(){
 update_notification();
 keep_online();
}, 5000);

<?php }  ?>

</script>