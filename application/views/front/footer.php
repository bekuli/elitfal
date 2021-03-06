<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<footer class="page-footer font-small special-color-dark pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-copyright py-3 footer-copyrigt-yazi">© 2020 Copyright: Elit Fal |
                    <a href="mailto:bekuli@protonmail.com"> Web Tasarım: Deyalita</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="icerik-footer">
                    <ul class="list-unstyled list-inline linkler-footer">

                        <li class="list-inline-item facebook">
                            <a class="btn-floating btn-fb mx-1">
                                <i class="fa fa-facebook-square"></i>
                            </a> 
                        </li>
                        <li class="list-inline-item twitter">
                            <a class="btn-floating btn-fb mx-1">
                                <i class="fa fa-twitter-square"></i>
                            </a> 
                        </li>
                        <li class="list-inline-item google">
                            <a class="btn-floating btn-fb mx-1">
                                <i class="fa fa-google-plus-square"></i>
                            </a> 
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div> 
</footer>

<div class="modal fade login-register-form" id="login-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" id="login-form-a" href="#login-form"> Giriş <span class="glyphicon glyphicon-user"></span></a></li>
                    <li><a data-toggle="tab" id="registration-form-a" href="#registration-form"> Kayıt <span class="glyphicon glyphicon-pencil"></span></a></li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                	<!--<div class="devam-etmek">Devam Etmek İçin Lütfen Giriş Yapın</div>-->
                    <div id="login-form" class="tab-pane fade in active">
                        <form action="" id="login-modal-form">
                            <div class="form-group">
                                <label for="email">Eposta:</label>
                                <input type="email" class="form-control" id="email" placeholder="Eposta Adresinizi Giriniz" name="email">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Şifre</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Şifrenizi Giriniz" name="password">
                            </div>
                            <button type="submit" class="btn btn-login-form-submit">Giriş Yap</button>
                            <a href="#" id="giris-hesap-yok">Hesabın Yok mu? Üye Olmak İçin Tıkla</a>
                        </form>
                    </div>
                    <div id="registration-form" class="tab-pane fade">
                        <form action="" method="post" id="register-modal-form" >
                        	<div class="row">
                        		<div class="col-md-6">
		                            <div class="form-group">
		                                <label for="name">Ad</label>
		                                <input type="text" class="form-control" id="name" placeholder="Adınızı Giriniz" name="ad">
		                            </div>
	                            </div>
	                            <div class="col-md-6">
	                            	<div class="form-group">
		                                <label for="surname">Soyad</label>
		                                <input type="text" class="form-control" id="surname" placeholder="Soyadınızı Giriniz" name="soyad">
		                            </div>
	                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tel">Telefon Numarası</label>
                                        <input type="number" class="form-control" id="tel" placeholder="Telefon Numarası" name="tel">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="neweposta">Eposta</label>
                                        <input type="email" class="form-control" id="neweposta" placeholder="Eposta Adresinizi Giriniz" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newpwd">Şifre</label>
                                <input type="password" class="form-control" id="newpwd" placeholder="Şifrenizi Giriniz" name="password">
                            </div>
                            <div class="form-group">
                                <label for="newpwdr">Şifre Tekrar</label>
                                <input type="password" class="form-control" id="newpwdr" placeholder="Tekrar Şifrenizi Giriniz" name="password-repeat">
                            </div>
                            <button type="submit" class="btn btn-register-form-submit">Üye Ol</button>
                            <a href="#" id="giris-hesap-var">Hesabın Var mı? Giriş Yapmak İçin Tıkla</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<link href="<?=base_url()?>src/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<script src="<?=base_url()?>src/js/jquery-ui/jquery-ui.min.js" type="text/javascript" ></script>
<script src="<?=base_url()?>src/js/notify.min.js" type="text/javascript" ></script>

<script>
	var submitting_giris = false;
    var submitting_register = false;
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown();

        $("#giris-hesap-yok").click(function(e){
        	e.preventDefault();
        	$("#registration-form-a").click();
        });

        $("#giris-hesap-var").click(function(e){
        	e.preventDefault();
        	$("#login-form-a").click();
        });

        $("#register-modal-form").submit(function(e){
            e.preventDefault();
            $(".btn-register-form-submit").val("Gönderiliyor...");
            $(".btn-register-form-submit").attr("disabled", "");
            if (submitting_register == true)
                return;
            submitting_register = true;
            var form_data = new FormData($(this)[0]);

            $.ajax({
                url : base_url + "kayit-ajax",
                type : "post",
                data : form_data,
                contentType : false,
                processData : false,
                success : function(result) {
                    submitting_register = false;
                    if (result.substring(0,7) == "success")
                    {
                        $(".btn-register-form-submit").val("Üye Ol");
                        $(".btn-register-form-submit").removeAttr("disabled", "");
                        $('#login-modal').modal('hide');
                        $(".btn-submit-fal").click();
                        $.notify("Kayıt başarılı!", "success");
                        update_login();
                        <?php

                            if ($page !== "fal-sayfasi"){
                                ?>
                                location.href = base_url + "profil";
                                <?php
                            }

                        ?>
                    }
                    else
                    {
                        $(".btn-register-form-submit").val("Üye Ol");
                        $(".btn-register-form-submit").removeAttr("disabled", "");
                        process_output_data_reg_modal(result);
                    }
                },
                error : function(){
                    $(".btn-register-form-submit").val("Üye Ol");
                    $(".btn-register-form-submit").removeAttr("disabled", "");
                    submitting_register = false;
                    process_output_data_reg_modal("error");
                }
            });
        });

        $("#login-modal-form").submit(function(e){
			e.preventDefault();
			$(".btn-login-form-submit").val("Giriş Yapılıyor...");
			$(".btn-login-form-submit").attr("disabled", "");

			if (submitting_giris == true)
				return;
			submitting_giris = true;
			var form_data = new FormData($(this)[0]);

			$.ajax({
				url : base_url + "giris-ajax",
				type : "post",
				data : form_data,
				contentType : false,
				processData : false,
				success : function(result) {
					submitting_giris = false;
					if (result == "success")
					{
						$(".btn-login-form-submit").val("Giriş Yap");
						$(".btn-login-form-submit").removeAttr("disabled", "");
						$('#login-modal').modal('hide');
						$(".btn-submit-fal").click();
                        $.notify("Giriş başarılı!", "success");
						update_login();
                        <?php

                            if ($page !== "fal-sayfasi"){
                                ?>
                                location.href = base_url + "profil";
                                <?php
                            }

                        ?>
					}
					else
					{
						$(".btn-login-form-submit").val("Giriş Yap");
						$(".btn-login-form-submit").removeAttr("disabled", "");
						process_output_data_login_modal(result);
					}
				},
				error : function(){
					$(".btn-login-form-submit").val("Giriş Yap");
						$(".btn-login-form-submit").removeAttr("disabled", "");
					submitting_giris = false;
					process_output_data_login_modal("error");
				}
			});
		});
    });

     function process_output_data_reg_modal(data)
    {
        if (data == "error" || data == "no_data"){
            $.notify("Bilinmeyen bir hata oluştu tekrar deneyiniz", "error");
        }else if (data == "tel"){
            $.notify("Bu telefon geçerli değil!", "error");
        }else if (data == "email"){
            $.notify("Bu email adresi geçerli değil!", "error");
        }else if (data == "bos"){
            $.notify("Gerekli alanlar doldurulmalıdır!", "error");
        }else if (data == "no_match"){
            $.notify("Girdiğiniz şifreler birbirleriyle eşleşmiyor!", "error");
        }else if (data == "exists"){
            $.notify("Bu eposta ile açılmış bir hesap var!", "error");
        }
    }

    function process_output_data_login_modal(data)
    {
    	if (data == "error" || data == "no_data"){
            $.notify("Bilinmeyen bir hata oluştu tekrar deneyiniz", "error");
        }else if (data == "hata"){
        	$.notify("Eposta adresi veya şifre yanlış!", "error");
        }else if (data == "email"){
        	$.notify("Bu email adresi geçerli değil!", "error");
        }else if (data == "bos"){
        	$.notify("Gerekli alanlar doldurulmalıdır!", "error");
        }
    }

    function update_login()
    {
    	$.ajax({
				url : base_url + "profil/get-data",
				contentType : false,
				success : function(result) {
					if (result == "error"){
						process_output_data_login_modal("error");
						return;
					}
					var profil_data = JSON.parse(result);

            		


                    var headerprofil = '<li><a href="<?=base_url()?>profil"><span class="badge kredi-badge">Kredi:'+profil_data["kredi"]
                    +'</span></a></li>'
                    +'<li>'
              +'<div class="dropdown show">'
                +'<a class="bildirim dropdown-toggle" id="bildirim" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i> <span id="notfycount"></span></a>'
                +'<div class="dropdown-menu bildirim-list" aria-labelledby="bildirim">'
                    +'</div>'
                  +'</div>'
                +'</li>'
                +'<li><a href="<?=base_url()?>profil">Fal Geçmişi</a></li>'
                +'<li><a href="<?=base_url()?>profil">'+ profil_data["name"] +' '+ profil_data["surname"] + '</a></li>'
                +'<li><a href="<?=base_url()?>logout">Çıkış Yap</a></li>';
                $(".user-datas ul").html(headerprofil);
                $(".yorumcu-ol-li").remove();
				},
				error : function(){
					process_output_data_login_modal("error");
				}
			});
    }

    $(".login-activate").click(function(e)
    {
        e.preventDefault();
        $(".login-register-form").modal();
        $("#login-form-a").click();
    });

    $(".reg-activate").click(function(e)
    {
        e.preventDefault();
        $(".login-register-form").modal();
        $("#registration-form-a").click();
    });

    var noties = [];
    var notify_count = 0;

    <?php
        if ($this->fal->check_login() !== false){
        if ($this->fal->check_any_fal_exists()){ ?>

    function update_notification()
    {
        //fal istekleri
        $.ajax({
            url : base_url + "fal-istek-check",
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
                                +base_url+'profil/cevap/'+faldata[i].id+'" >'
                                +faldata[i].name
                                + ' cevaplandı!</a>');

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

        //messaging
        $.ajax({
            url : base_url + "mesaj-check<?php if ($page == "mesaj_to_yorumcu"){ echo'/'.$yorumcu->id; }?>",
            contentType : false,
            success : function(result) {
                if (result != "false")
                {
                    var msgdata = JSON.parse(result);

                    for (var i = 0; i < msgdata.length; i++)
                    {
                        var no_notify = false;
                        <?php

                        if ($page == "mesaj_to_yorumcu")
                        {
                            ?>

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

                            <?php
                        }

                        ?>

                        if (noties.includes("msg_"+msgdata[i].id) == false)
                        {
                            if (no_notify == false){
                                $(".bildirim-list").append('<a class="dropdown-item unread" href="'
                                    +base_url+'mesaj/'+msgdata[i].id+'" >'
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

update_notification();
setInterval(function(){
 update_notification();;
}, 5000);

<?php } } ?>

</script>
</body>
<html>