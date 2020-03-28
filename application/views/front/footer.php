<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<footer class="page-footer font-small special-color-dark pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-copyright py-3 footer-copyrigt-yazi">© 2020 Copyright: Elit Fal |
                    <a href="https://mdbootstrap.com/"> Web Tasarım: Deyalita</a>
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
                        <form action="" method="post" >
                        	<div class="row">
                        		<div class="col-md-6">
		                            <div class="form-group">
		                                <label for="name">Ad</label>
		                                <input type="text" class="form-control" id="name" placeholder="Adınızı Giriniz" name="ad">
		                            </div>
	                            </div>
	                            <div class="col-md-6">
	                            	<div class="form-group">
		                                <label for="sirname">Soyad</label>
		                                <input type="text" class="form-control" id="sirname" placeholder="Soyadınızı Giriniz" name="soyad">
		                            </div>
	                            </div>
                            </div>
                            <div class="form-group">
                                <label for="neweposta">Eposta</label>
                                <input type="email" class="form-control" id="neweposta" placeholder="Eposta Adresinizi Giriniz" name="newemail">
                            </div>
                            <div class="form-group">
                                <label for="newpwd">Şifre</label>
                                <input type="password" class="form-control" id="newpwd" placeholder="Şifrenizi Giriniz" name="password">
                            </div>
                            <div class="form-group">
                                <label for="newpwdr">Şifre Tekrar</label>
                                <input type="password" class="form-control" id="newpwdr" placeholder="Tekrar Şifrenizi Giriniz" name="password-repeat">
                            </div>
                            <button type="submit" class="btn">Üye Ol</button>
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
					if (result.substring(0,7) == "success")
					{
						$(".btn-login-form-submit").val("Giriş Yap");
						$(".btn-login-form-submit").removeAttr("disabled", "");
						$('#login-modal').modal('hide');
						$(".btn-submit-fal").click();
						update_login();
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
					submitting = false;
					process_output_data_login_modal("error");
				}
			});
		});
    });

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

					var headerprofil = '<li><a href="<?=base_url()?>profil">'+ profil_data["name"] +' '+ profil_data["surname"] + '</a></li>'+
            '<li><a href="<?=base_url()?>profil" class="buton-red">Profil</a></li>'+
            '<li><a href="<?=base_url()?>logout" class="buton-red">Çıkış Yap</a></li>';
            		$(".header-right").html(headerprofil);
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
</script>
</body>
<html>