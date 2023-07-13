var validator = {
	validateDate : function( date )
    {
		var result = true;
		
        var aTmp = date.split("-");
        if(aTmp.length!=3)
        {
            result = false;
        } else {
			if (aTmp[2].indexOf('_') > 0)
				result = false;
			else
				result = true;
		}
 
        //Границы разрешенного периода. Нельзя ввести дату до 1990-го года и позднее 2020-го.
        if((parseInt(aTmp[2], 10)<= 1900)||(parseInt(aTmp[2], 10)>=2020))
        {
            result = false;
        }
 
		if (result) {
			var sTmp=aTmp[2] +'-'+ aTmp[1]+'-'+ aTmp[0];

			if(new Date(sTmp)=='Invalid Date')
			{
				result = false;
			}
			else
			{
				result = true;
			}
		}
		
		return result;
    }
     
}

function setCookie(name, value, options = {}) {

  options = {
    path: '/',
  };

  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }

  let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

  for (let optionKey in options) {
    updatedCookie += "; " + optionKey;
    let optionValue = options[optionKey];
    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }

  document.cookie = updatedCookie;
}

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function delete_cookie(name) {
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

if($('.projectHero__image').length > 0){
    $('body').addClass('header__transparent');
}
if($('.errorSection1').length > 0){
    $('header').addClass('_dark');
}
$(document).ready(function(){
    var lang = $('body').attr('data-lang');
    if($('[name="UF_BIRTHDAY"]').length > 0) {
		const birthDayMask = new Inputmask({ mask: '99-99-9999'});
		birthDayMask.mask('[name="UF_BIRTHDAY"]');
    }
    $('body').on('click','.pv__photos-item',function(){
        var photo = $(this).attr('data-preview');
        $('[data-fancybox="'+photo+'"]').first().click();
    })
    $('body').on('click','.search__results-tabs__body-item__media-item',function(){
        var photo = $(this).attr('data-preview');
        $('[data-fancybox="'+photo+'"]').first().click();
    })
    $('body').on('click','.search-all-photo',function(){
        var photo = $(this).attr('data-preview');
        $('[data-fancybox="'+photo+'"]').first().click();
    })
    $('.callback form').addClass('callback__wrap');
    $('body').on('submit','.forgot_form',function(e){
        e.preventDefault();
        var form = $(this);
        if($(this).valid()) {
            $.ajax({
                type: "POST",
                url: '/ajax.php',
                data: form.serialize(),
                success: function (data) {
                }
            });
        }
    })
    $('body').on('submit','.footer__subscribe-form',function(e){
        e.preventDefault();
        var form = $(this),
			formData = form.serialize(),
			lang = getCookie("mi_lang");
		formData = formData + '&lang=' + lang;
        if($(this).valid()) {
            $.ajax({
                type: "POST",
                url: '/ajax.php',
                data: formData,
                success: function (data) {
                    if(data == 'true'){
                        $('.subscribe_error').hide();
                        $('.footer__subscribe-form').hide();
                        $('.subscribe_success').show();
                    }else{
                        $('.subscribe_error').text(data);
                        $('.subscribe_error').show();
                    }
                }
            });
        }
    })
    $('.regform form').on('submit',function(e){
        e.preventDefault();
        var form = $(this);
        if($(this).valid()) {
            $.ajax({
                type: "POST",
                url: '/ajax.php',
                data: form.serialize(),
                success: function (data) {
                    $('.regform').hide();
                    $('.regform_success').show();
                }
            });
        }
    })
    $('body').on('submit','.lets__form-wrap form',function(e){
        e.preventDefault();
        if($('.lets__form-policy').hasClass('checked') == false){
            $('.lets__form-policy').addClass('checked_error');
        }else{
            $('.lets__form-policy').removeClass('checked_error');
            var form = $(this);
            if($(this).valid()) {
                $.ajax({
                    type: "POST",
                    url: '/ajax.php',
                    data: form.serialize(),
                    success: function (data) {
                        //let succes = $('.lets__form-wrap').attr('data-succes');
                        //$('.lets__form-wrap').html('<span class="form_succes">'+succes+'</span>');
						$("#lets__form").addClass("hidden");
						$("#lets__success").removeClass("hidden");
                    }
                });
            }
        }
    })
    $('body').on('submit','.callback form',function(e){
        e.preventDefault();
        if($('.callback__form-policy input').is(':checked') == false){
            $('.callback__form-policy label').addClass('checked_error');
        }else{
            $('.callback__form-policy input').removeClass('checked_error');
            var formData = new FormData($(this)[0]);
            if($(this).valid()) {
                $.ajax({
                    type: "POST",
                    url: '/ajax.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        //let succes = $('.lets__form-wrap').attr('data-succes');
                        //$('.lets__form-wrap').html('<span class="form_succes">'+succes+'</span>');
                        $(".callback form").hide();
                        $(".callback__success").removeClass("hidden");
                    }
                });
            }
        }
    });
    $('.form_base_profile').on('submit',function(e){
        e.preventDefault();
        var form = $(this),
			formData = new FormData($(this)[0]);
		console.log(formData);
        if($(this).valid()) {
            $.ajax({
                type: "POST",
				processData: false,
				contentType: false,
                url: '/ajax.php',
                data: formData,
                success: function (data) {
					console.log(data);
                    if(data == 'true' || data == 'truetrue') {
                        location.reload();
                    }
                }
            });
        }
    });
    $('.profile_work_form').on('submit',function(e){
        e.preventDefault();
        var form = $(this);
		console.log(form.serialize());
        if($(this).valid()) {
            $.ajax({
                type: "POST",
                url: '/ajax.php',
                data: form.serialize(),
                success: function (data) {
                    if(data == 'true' || data == 'truetrue') {
                        location.reload();
                    }
                }
            });
        }
    })
    $('.personal_projects_form').on('submit',function(e){
        e.preventDefault();
        var project = $(this).attr('data-project');
        var form = $(this);
        if($(this).valid()) {
            $.ajax({
                type: "POST",
                url: '/ajax.php',
                data: form.serialize(),
                success: function (data) {
                    $(form).hide();
                    $('.project_exist_'+project).show();
                }
            });
        }
    })
    $('.settings_profile_form').on('click','.popup__settings-button',function(){
        var form = $(this).closest('form');
		var formData = form.serialize();
        if($(form).valid()) {
            $.ajax({
                type: "POST",
                url: '/ajax.php',
                data: formData,
                success: function (data) {
					console.log(data);
                    if(data == 'true') {
						if (formData.indexOf("UF_LANG")) {
							
							var values = {};
							$.each(form.serializeArray(), function (i, field) {
								values[field.name] = field.value;
							});

							//Value Retrieval Function
							var getValue = function (valueName) {
								return values[valueName];
							};

							//Retrieve the Values
							var UF_LANG = getValue("UF_LANG");
							switch (UF_LANG) {
								case undefined:
									setCookie("mi_lang","s1");
									break;
								case "EN":
									setCookie("mi_lang","s1");
									break;
								case "RU":
									setCookie("mi_lang","s2");
									break;
								default:
									setCookie("mi_lang","s1");
							}
						}
                        location.reload();
                    }
                }
            });
        }
    })
    $('.settings_profile_form').on('change','.popup__settings-cover__form-input',function(e){
        e.preventDefault();
        var form = $(this).closest('form');
        var formData = new FormData($(this).closest('form')[0]);
        if($(form).valid()) {
            $.ajax({
                type: "POST",
                url: '/ajax.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data == 'true') {
                        location.reload();
                    }
                }
            });
        }
    })
    $('body').on('click','.popup__settings-delete__action a',function(e){
        e.preventDefault();
        var user = $(this).attr('data-user');
        $.ajax({
            type: "POST",
            url: '/ajax.php',
            data: {action:'delete',user: user},
            success: function (data) {
                location.href = '/';
            }
        });
    })
    $('body').on('click','.lets__form-policy',function(){
        if($('.lets__form-policy input').hasClass('checked') == false){
            $('.lets__form-policy').addClass('checked_error');
        }else{
            $('.lets__form-policy').removeClass('checked_error');
            $('.lets__form-button').removeClass('disabled');
        }
    })
    // $('body').on('click','#regterms',function(){
    //     if($('#regterms').is(':checked') == false){
    //         $('.check_terms_login').addClass('checked_error');
    //     }else{
    //         $('.check_terms_login').removeClass('checked_error');
    //     }
    // })
    $('body').on('click','.callback__form-policy',function(){
        if($('.callback__form-policy input').is(':checked') == false){
            $('.callback__form-policy label').addClass('checked_error');
        }else{
            $('.callback__form-policy label').removeClass('checked_error');
            $('.callback__form-button').removeClass('disabled');
        }
    })
	var mask;
    if ($('.tel,input[type="tel"]').length > 0) {
        if($('.tel,input[type="tel"]').val() != '') {
            mask = true;
        }else{
            mask = false;
        }
    }
	// управление аватаркой в ЛК
    $('.profile__acc-box__photo-action[data-type="edit"]').on('click',function(e){
		e.preventDefault();
		if ($('[name="UF_PHOTO"]').length > 0)
			$('[name="UF_PHOTO"]').attr('name','UF_PHOTO1');
		if ($('.profile__acc-box__form .profile__acc-box__media img').length == 0)
			$('.profile__acc-box__form .profile__acc-box__media').append('<img src="" alt=""/>')
        $('[name="UF_PHOTO1"]').click();
		$('[name="UF_PHOTO"]').click();
    })
	$('.profile__acc-box__photo-action[data-type="delete"]').on('click',function(e){
		e.preventDefault();
		$('.profile__acc-box__form .profile__acc-box__media img').remove();
		$('[name="UF_PHOTO1"]').attr('name','UF_PHOTO');
		$('[name="UF_PHOTO1"]').val(null);
		$('[name="UF_PHOTO"]').val(null);
    })
	// открытие окна управления аватаркой
	$(".profile__acc-box__media").click(function(){
		$(".profile__acc-box__photo-actions").toggleClass("show");
	});
	$(document).mouseup( function(e){
		var div = $( ".profile__acc-box__photo-actions" );
		if ( !div.is(e.target) && div.has(e.target).length === 0 && div.hasClass("show") ) {
			div.removeClass("show");
		}
	});
    $('[name="UF_PHOTO1"]').change(function(){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.profile__acc-box__media img').attr('src', e.target.result);
                $('.profile__acc-box__media img').show();
                $('[name="UF_PHOTO1"]').attr('name','UF_PHOTO');
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    $('body').on('change','[name="UF_PHOTO"]',function(){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.profile__acc-box__media img').attr('src', e.target.result);
                $('.profile__acc-box__media img').show();
            }
            reader.readAsDataURL(this.files[0]);
        }
    })
    /*if($('.main_video_block').length > 0) {
        $('.hero__media').on('click', function () {
			if ($(this).find(".main_video_block").prop("nodeName") == "A") {
				window.open($(this).find(".main_video_block").attr("href"), '_blank');
			} else {
            	$('.main_video_block img').hide();
				$(this).addClass("hideImage");
            	$('.main_video_block .projectHero__media-video').show();
			}
        })
    }*/
    $('.lets__form-wrap form').validate({
        errorElement: "small",
        errorClass: "error-send",
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            //return true;
        },
        highlight: function(element) {
            //$(element).closest('.validation').addClass('was-validated').removeClass('was-validated');
            $(element).closest('.form-group').removeClass('has-success');
            $(element).closest('.form-group').addClass('error');
        },
        unhighlight: function(element) {
            //$(element).closest('.validation').removeClass('was-validated').addClass('was-validated');
            if ($(element).closest('.form-group').hasClass('has-success')) {
                $(element).closest('.form-group').removeClass('error');
            }
        },
        success: function(valid, element) {
            $(element).closest('.form-group').addClass('has-success');
        },
        normalizer: function(value) {
            var $t = $(this);
            if($t.hasClass('placeholder') && ($t.val() === $t.attr('placeholder')))
                return '';
            return value;
        },
        rules: {
            fname: {
                required: true,
                minlength: 2
            },
            tel: {
                required: true,
                minlength: 10
            },
            email: {
                email: true
            },
            // subscribe: "required",
            captcha: "required"
        },
        messages: {
            fname: "Необходимо указать Имя",
            lname: "Необходимо указать Фамилию",
            oname: "Необходимо указать Отчество",
            email: "Укажите cвой e-mail адрес",
            tel: "Укажите номер мобильного телефона",
            comment: "Ваш комментарий",
            message: false,
            login: "Введите логин",
            pass: "Введите пароль",
            firstpass: "Придумайте пароль",
            // repeatpass: "Подтвердите пароль",
            // changepass: "Введите новый пароль",
            town: "Укажите город",
            delivery_type: "Выберите способ получения заказа",
            street: "Укажите улицу",
            homenumber: "Укажите №",
            flat: "Укажите кв.",
            enter: "Укажите под.",
            floor: "Укажите этаж",
            company: "Укажите название адреса (например Дом или Офис)",
            paytype: "Выберите способ оплаты",
            payback: "Укажите сумму",
            theme: "Выберите тему обращения",
            //checkboxes
            // subscribe: false,
            captcha: false
        },
        //success: function(element) {
        //    $(element).closest('.validation').addClass('was-validated');
        //}
    });
    $('.callback form').validate({
        errorElement: "p",
//        errorClass: "error-send",
        errorClass: "login__popup-form__group-error",
            errorPlacement: function(error, element) {
                error.insertAfter(element);
                //return true;
            },
        highlight: function(element) {
            //$(element).closest('.validation').addClass('was-validated').removeClass('was-validated');
            $(element).closest('.form-group').removeClass('has-success');
            $(element).closest('.form-group').addClass('error');
        },
        unhighlight: function(element) {
            //$(element).closest('.validation').removeClass('was-validated').addClass('was-validated');
            if ($(element).closest('.form-group').hasClass('has-success')) {
                $(element).closest('.form-group').removeClass('error');
            }
        },
        success: function(valid, element) {
            $(element).closest('.form-group').addClass('has-success');
        },
        normalizer: function(value) {
            var $t = $(this);
            if($t.hasClass('placeholder') && ($t.val() === $t.attr('placeholder')))
                return '';
            return value;
        },
        rules: {
            fname: {
                required: true,
                minlength: 2
            },
            tel: {
                required: true,
                minlength: 10
            },
            email: {
                email: true
            },
			CALLBACK_PHONE: {
				phoneCallback: true
			},
            // subscribe: "required",
            captcha: "required"
        },
        messages: {
            fname: "Необходимо указать Имя",
            lname: "Необходимо указать Фамилию",
            oname: "Необходимо указать Отчество",
            email: "Укажите cвой e-mail адрес",
            tel: "Укажите номер мобильного телефона",
            comment: "Ваш комментарий",
            message: false,
            login: "Введите логин",
            pass: "Введите пароль",
            firstpass: "Придумайте пароль",
            // repeatpass: "Подтвердите пароль",
            // changepass: "Введите новый пароль",
            town: "Укажите город",
            delivery_type: "Выберите способ получения заказа",
            street: "Укажите улицу",
            homenumber: "Укажите №",
            flat: "Укажите кв.",
            enter: "Укажите под.",
            floor: "Укажите этаж",
            company: "Укажите название адреса (например Дом или Офис)",
            paytype: "Выберите способ оплаты",
            payback: "Укажите сумму",
            theme: "Выберите тему обращения",
            //checkboxes
            // subscribe: false,
            captcha: false
        },
        //success: function(element) {
        //    $(element).closest('.validation').addClass('was-validated');
        //}
    });
    $('#regform').validate({
        errorElement: "p",
        errorClass: "login__popup-form__group-error",
        errorPlacement: function(error, element) {
            error.insertAfter(element);
            //return true;
        },
        highlight: function(element) {
            //$(element).closest('.validation').addClass('was-validated').removeClass('was-validated');
            $(element).closest('.login__popup-form__group').removeClass('has-success');
            $(element).closest('.login__popup-form__group').addClass('error');
        },
        unhighlight: function(element) {
            //$(element).closest('.validation').removeClass('was-validated').addClass('was-validated');
            if ($(element).closest('.login__popup-form__group').hasClass('has-success')) {
                $(element).closest('.login__popup-form__group').removeClass('error');
            }
        },
        success: function(valid, element) {
            $(element).closest('.login__popup-form__group').addClass('has-success');
        },
        normalizer: function(value) {
            var $t = $(this);
            if($t.hasClass('placeholder') && ($t.val() === $t.attr('placeholder')))
                return '';
            return value;
        },
        rules: {
            fname: {
                required: true,
                minlength: 2
            },
            tel: {
                required: true,
                minlength: 10
            },
            email: {
                email: true
            },
            // subscribe: "required",
            captcha: "required",
            terms: {
                required: true
            }
        },
        messages: {
            fname: "Необходимо указать Имя",
            lname: "Необходимо указать Фамилию",
            oname: "Необходимо указать Отчество",
            email: "Укажите cвой e-mail адрес",
            tel: "Укажите номер мобильного телефона",
            comment: "Ваш комментарий",
            message: false,
            login: "Введите логин",
            pass: "Введите пароль",
            firstpass: "Придумайте пароль",
            // repeatpass: "Подтвердите пароль",
            // changepass: "Введите новый пароль",
            town: "Укажите город",
            delivery_type: "Выберите способ получения заказа",
            street: "Укажите улицу",
            homenumber: "Укажите №",
            flat: "Укажите кв.",
            enter: "Укажите под.",
            floor: "Укажите этаж",
            company: "Укажите название адреса (например Дом или Офис)",
            paytype: "Выберите способ оплаты",
            payback: "Укажите сумму",
            theme: "Выберите тему обращения",
            //checkboxes
            // subscribe: false,
            captcha: false
        },
        //success: function(element) {
        //    $(element).closest('.validation').addClass('was-validated');
        //}
    });
    $('.validation').each(function(){
        $(this).validate({
            errorElement: "p",
            errorClass: "login__popup-form__group-error",
            errorPlacement: function(error, element) {
                error.insertAfter(element);
                //return true;
            },
            highlight: function(element) {
                //$(element).closest('.validation').addClass('was-validated').removeClass('was-validated');
                $(element).closest('.login__popup-form__group').removeClass('has-success');
                $(element).closest('.login__popup-form__group').addClass('error');
            },
            unhighlight: function(element) {
                //$(element).closest('.validation').removeClass('was-validated').addClass('was-validated');
                if ($(element).closest('.login__popup-form__group').hasClass('has-success')) {
                    $(element).closest('.login__popup-form__group').removeClass('error');
                }
            },
            success: function(valid, element) {
                $(element).closest('.login__popup-form__group').addClass('has-success');
            },
            normalizer: function(value) {
                var $t = $(this);
                if($t.hasClass('placeholder') && ($t.val() === $t.attr('placeholder')))
                    return '';
                return value;
            },
            rules: {
                fname: {
                    required: true,
                    minlength: 2
                },
                tel: {
                    required: true,
                    minlength: 10
                },
                email: {
                    email: true
                },
                // subscribe: "required",
                captcha: "required"
            },
            messages: {
                fname: "Необходимо указать Имя",
                lname: "Необходимо указать Фамилию",
                oname: "Необходимо указать Отчество",
                email: "Укажите cвой e-mail адрес",
                tel: "Укажите номер мобильного телефона",
                comment: "Ваш комментарий",
                message: false,
                login: "Введите логин",
                pass: "Введите пароль",
                firstpass: "Придумайте пароль",
                // repeatpass: "Подтвердите пароль",
                // changepass: "Введите новый пароль",
                town: "Укажите город",
                delivery_type: "Выберите способ получения заказа",
                street: "Укажите улицу",
                homenumber: "Укажите №",
                flat: "Укажите кв.",
                enter: "Укажите под.",
                floor: "Укажите этаж",
                company: "Укажите название адреса (например Дом или Офис)",
                paytype: "Выберите способ оплаты",
                payback: "Укажите сумму",
                theme: "Выберите тему обращения",
                //checkboxes
                // subscribe: false,
                captcha: false
            },
            //success: function(element) {
            //    $(element).closest('.validation').addClass('was-validated');
            //}
        });
    })
    $('.validation_profile').each(function(){
        $(this).validate({
            errorElement: "p",
            errorClass: "login__popup-form__group-error",
            errorPlacement: function(error, element) {
                error.insertAfter(element);
                //return true;
            },
            highlight: function(element) {
                //$(element).closest('.validation').addClass('was-validated').removeClass('was-validated');
                $(element).closest('.input_group').removeClass('has-success');
                $(element).closest('.input_group').addClass('error');
            },
            unhighlight: function(element) {
                //$(element).closest('.validation').removeClass('was-validated').addClass('was-validated');
                if ($(element).closest('.input_group').hasClass('has-success')) {
                    $(element).closest('.input_group').removeClass('error');
                }
            },
            success: function(valid, element) {
                $(element).closest('.input_group').addClass('has-success');
            },
            normalizer: function(value) {
                var $t = $(this);
                if($t.hasClass('placeholder') && ($t.val() === $t.attr('placeholder')))
                    return '';
                return value;
            },
            rules: {
                fname: {
                    required: true,
                    minlength: 2
                },
                tel: {
                    required: true
                },
//				PERSONAL_PHONE: {
//					phone: true
//				},
                email: {
                    email: true
                },
//				UF_BIRTHDAY: {
//					datebirth: true
//				},
                // subscribe: "required",
                captcha: "required",
            },
            messages: {
                fname: "Необходимо указать Имя",
                lname: "Необходимо указать Фамилию",
                oname: "Необходимо указать Отчество",
                email: "Укажите cвой e-mail адрес",
                tel: "Укажите номер мобильного телефона",
                comment: "Ваш комментарий",
                message: false,
                login: "Введите логин",
                pass: "Введите пароль",
                firstpass: "Придумайте пароль",
                // repeatpass: "Подтвердите пароль",
                // changepass: "Введите новый пароль",
                town: "Укажите город",
                delivery_type: "Выберите способ получения заказа",
                street: "Укажите улицу",
                homenumber: "Укажите №",
                flat: "Укажите кв.",
                enter: "Укажите под.",
                floor: "Укажите этаж",
                company: "Укажите название адреса (например Дом или Офис)",
                paytype: "Выберите способ оплаты",
                payback: "Укажите сумму",
                theme: "Выберите тему обращения",
                //checkboxes
                // subscribe: false,
                captcha: false,
            },
            //success: function(element) {
            //    $(element).closest('.validation').addClass('was-validated');
            //}
        });
    })
    $('body').on('focus','[name="NEW_PASSWORD_CONFIRM"]',function(){
        $('[name="NEW_PASSWORD_CONFIRM"]').rules('add', {
            equalTo: "#loginnewpass"
        });
    })
    if(lang == 'ru'){
        $.extend($.validator.messages, {
            required: "Обязательное поле",
            email: "Пожалуйста введите корректный e-mail адрес",
            number: "Only numbers are allowed",
            minlength: "Minimum characters: {0}",
            min: "Minimum amount: {0}",
            maxlength: "Maximum number of characters: {0}",
            equalTo: 'Password mismatch',
            mask: 'Укажите все цифры номера телефона',
            terms: "Обязательное поле"
        });
        $.validator.methods.email = function (value, element) {
            return this.optional(element) || /[A-Za-z0-9]+@[A-Za-z0-9\-\_]+\.[A-Za-z0-9]+/.test(value);
        };
        $.validator.addMethod("nonumber", function (value, element, param) {
            if (value.length > 0) {
                return value.match(new RegExp("^[^0-9]+$"));
            } else {
                return true;
            }
        }, 'Недопустимые символы');
//        $.validator.addMethod("phone", function (value) {
//            if (value.length > 0) {
//                return /\d{3}-\d{3}-\d{4}/g.test(value);
//            } else {
//                return true
//            }
//        }, 'Некорректный номер телефона');
		$.validator.addMethod('phone', function (value, element) {
			if ($('[name="PERSONAL_PHONE"]').val().length > 0) {
				if($('[name="PERSONAL_PHONE"]').attr("validate") == "true") {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		}, "Некорректный номер телефона");
		$.validator.addMethod('phoneCallback', function (value, element) {
			if ($('#CALLBACK_PHONE').val().length > 0) {
				if($('#CALLBACK_PHONE').attr("validate") == "true") {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		}, "Некорректный номер телефона");
		$.validator.addMethod('datebirth', function (value, element) {
			if(validator.validateDate($('[name="UF_BIRTHDAY"]').val())) {
				return true;
			} else {
				return false;
			}
		}, "Некорректная дата рождения");
        $.validator.addMethod("password", function (value, element, param) {
            if (value.length < 8) {
                return false;
            } else {
                return true;
            }
        }, 'Минимальное количество 8 символов');
        $.validator.addClassRules("ajax-check-email", {
            remote: {
                url: "/ajax.php",
                type: "post",
                data: {
                    action: 'checkLogin'
                },
                dataFilter: function(response) {
                    if (response === 'true') {
                        return true;
                    }else {
                        message = 'Данный e-mail зарегистрирован';
                        return "\"" + message + "\"";
                    }
                }
            }
        });
        $.validator.addClassRules("ajax-check-login", {
            remote: {
                url: "/ajax.php",
                type: "post",
                data: {
                    action: 'checkLoginAuth'
                },
                dataFilter: function(response) {
                    if (response === 'true') {
                        return true;
                    }else {
                        message = 'Данный e-mail не найден';
                        return "\"" + message + "\"";
                    }
                }
            }
        });
        $.validator.addClassRules("ajax-check-password", {
            remote: {
                url: "/ajax.php",
                type: "post",
                data: {
                    action: 'checkPassword',
                    USER_LOGIN: function () {
                        return $('[name="USER_LOGIN"]').val();
                    }
                },
                dataFilter: function(response) {
                    if (response === 'true') {
                        return true;
                    }else {
                        message = 'Не верный пароль';
                        return "\"" + message + "\"";
                    }
                }
            }
        });
        $.validator.addClassRules("ajax-check-password-profile", {
            remote: {
                url: "/ajax.php",
                type: "post",
                data: {
                    action: 'checkPasswordProfile',
                    USER_LOGIN: function () {
                        return $('.profile_login').attr('data-login');
                    }
                },
                dataFilter: function(response) {
                    if (response === 'true') {
                        return true;
                    }else {
                        message = 'Не верный пароль';
                        return "\"" + message + "\"";
                    }
                }
            }
        });
    }else {
        $.extend($.validator.messages, {
            required: "Required field",
            email: "Please enter a valid e-mail address",
            number: "Only numbers are allowed",
            minlength: "Minimum characters: {0}",
            min: "Minimum amount: {0}",
            maxlength: "Maximum number of characters: {0}",
            equalTo: 'Password mismatch',
            mask: 'Enter all digits of the phone number',
            terms: "Required field"
        });
        $.validator.methods.email = function (value, element) {
            return this.optional(element) || /[A-Za-z0-9]+@[A-Za-z0-9\-\_]+\.[A-Za-z0-9]+/.test(value);
        };
        $.validator.addMethod("nonumber", function (value, element, param) {
            if (value.length > 0) {
                return value.match(new RegExp("^[^0-9]+$"));
            } else {
                return true;
            }
        }, 'Unacceptable symbols');
		$.validator.addMethod('phone', function (value, element) {
			if ($('[name="PERSONAL_PHONE"]').val().length > 0) {
				if($('[name="PERSONAL_PHONE"]').attr("validate") == "true") {
					return true;
				} else {
					return false;
				}
			} else return true;
		}, "Please enter a valid phone number");
		$.validator.addMethod('phoneCallback', function (value, element) {
			if ($('#CALLBACK_PHONE').val().length > 0) {
				if($('#CALLBACK_PHONE').attr("validate") == "true") {
					return true;
				} else {
					return false;
				}
			} else return true;
		}, "Please enter a valid phone number");
		$.validator.addMethod('datebirth', function (value, element) {
			if(validator.validateDate($('[name="UF_BIRTHDAY"]').attr("value"))) {
				return true;
			} else {
				return false;
			}
		}, "Incorrect date of birth");
        $.validator.addMethod("password", function (value, element, param) {
            if (value.length < 8) {
                return false;
            } else {
                return true;
            }
        }, 'Minimum 8 characters');
        $.validator.addClassRules("ajax-check-email", {
            remote: {
                url: "/ajax.php",
                type: "post",
                data: {
                    action: 'checkLogin'
                },
                dataFilter: function(response) {
                    if (response === 'true') {
                        return true;
                    }else {
                        message = 'This e-mail is registered';
                        return "\"" + message + "\"";
                    }
                }
            }
        });
        $.validator.addClassRules("ajax-check-login", {
            remote: {
                url: "/ajax.php",
                type: "post",
                data: {
                    action: 'checkLoginAuth'
                },
                dataFilter: function(response) {
                    if (response === 'true') {
                        return true;
                    }else {
                        message = 'This e-mail not found';
                        return "\"" + message + "\"";
                    }
                }
            }
        });
        $.validator.addClassRules("ajax-check-password", {
            remote: {
                url: "/ajax.php",
                type: "post",
                data: {
                    action: 'checkPassword',
                    USER_LOGIN: function () {
                        return $('[name="USER_LOGIN"]').val();
                    }
                },
                dataFilter: function(response) {
                    if (response === 'true') {
                        return true;
                    }else {
                        message = 'Incorrect password';
                        return "\"" + message + "\"";
                    }
                }
            }
        });
        $.validator.addClassRules("ajax-check-password-profile", {
            remote: {
                url: "/ajax.php",
                type: "post",
                data: {
                    action: 'checkPasswordProfile',
                    USER_LOGIN: function () {
                        return $('.profile_login').attr('data-login');
                    }
                },
                dataFilter: function(response) {
                    if (response === 'true') {
                        return true;
                    }else {
                        message = 'Incorrect password';
                        return "\"" + message + "\"";
                    }
                }
            }
        });
    }
    $('[name="REGISTER[LOGIN]"]').on('keyup',function(){
        $('[name="REGISTER[EMAIL]"]').val($(this).val());
    })
    $('[name="REGISTER[PASSWORD]"]').on('keyup',function(){
        $('[name="REGISTER[CONFIRM_PASSWORD]"]').val($(this).val());
    })
    $('[name="REGISTER[PASSWORD]"]').on('change',function(){
        $('[name="REGISTER[CONFIRM_PASSWORD]"]').val($(this).val());
    })
    $('body').on('click','.pageAjax',function(e){
        e.preventDefault();
        var url = $(this).attr('data-link');
        var page = $(this).attr('data-page');
        var section = getUrlParameter('section');
        $.ajax({
            url: url,
            type: 'post',
            data: {ajax: 'Y',PAGEN_15:page,section:section},
            success: function (result) {
                $('.load_ajax').html(result);
                $('.diveinblog__tabs').html($('.load_ajax').find('.diveinblog__tabs').html());
                $('html, body').animate({
                    scrollTop: $(".diveinblog__tabs").offset().top // класс объекта к которому приезжаем
                }, 1000);
                filtering();
            }
        });
    })
    $('body').on('click','.searchPageAjax .pageAjaxSearch',function(e){
        e.preventDefault();
        var page = $(this).attr('data-page');
        var id = $('.searchPageAjax .search__results-tabs__head .current').attr('data-id');
        var num = $('.searchPageAjax .pageBlock').attr('data-num');
        var data = {};
        data['ajax'] = 'Y';
        data['PAGEN_'+num] = page;
        data['id'] = id;
        $.ajax({
            url: location.href,
            type: 'post',
            data: data,
            success: function (result) {
                $('.searchPageAjax .search__results-tabs__body').html(result);
            }
        });
    })
    $('body').on('click','.searchPageAjax .search__results-tabs__head a',function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: location.href,
            type: 'post',
            data: {ajax: 'Y',id:id},
            success: function (result) {
                $('.searchPageAjax .search__results-tabs__body').html(result);
            }
        });
    })
    $('body').on('click','header .search__results-tabs__head a',function(){
        var val = $('.header__search-form__input input').val();
        var id = $(this).attr('data-id');
        $("header .search__results-tabs__head a.current").removeClass("current");
        $(this).addClass("current");
        $.ajax({
            url: '/search/?q='+val,
            type: 'post',
            data: {ajaxHeader: 'Y',id:id},
            success: function (result) {
				if ($('.searchPageAjax').length > 0)
					$('.searchPageAjax .search__results-tabs__body').html(result);
				else
					$('header .search__results-tabs__body').html($(result).find('.search__results-tabs__body').html());
            }
        });
    })
    $('.header__search-form__input input').on('keyup',function(){
        var findText = $(this).val();
        if(findText != '' && findText.length > 2) {
            $.ajax({
                url: '/search/?q=' + findText,
                method: 'post',
                data: {ajaxHeader: 'Y'},
                success: function (data) {
					if ($('.searchPageAjax').length > 0)
						$('.searchPageAjax .search__results-tabs').html(data);
					else {
                    	$('header .search__results-wrap').html(data);
                    	$("header .search__results-inner").removeClass("hidden");
                    	$("body").addClass("fixed");
					}
                }
            });
        }
    })
    $('body').on('click','.pageAjaxMedia',function(e){
        e.preventDefault();
        var url = $(this).attr('data-link');
        var page = $(this).attr('data-page');
        var num = $('.pageBlock').attr('data-num');
        var data = {};
        data['ajax'] = 'Y';
        data['PAGEN_'+num] = page;
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function (result) {
                $('.load_ajax').html(result);
                $('.pv__section').html($('.load_ajax').find('.pv__section').html());
                $('html, body').animate({
                    scrollTop: $(".pv__section").offset().top // класс объекта к которому приезжаем
                }, 1000);
            }
        });
    })
    $('body').on('click','.tabAjaxBlog',function(e){
        e.preventDefault();
        var url = location.href;
        var id = $(this).attr('data-id');
        $.ajax({
            url: url,
            type: 'post',
            data: {ajax: 'Y',section:id},
            success: function (result) {
                $('.tabAjaxBlog').each(function(){
                    $(this).removeClass('active');
                })
                $('.load_ajax').html(result);
                $('.diveinblog__tabs').html($('.load_ajax').find('.diveinblog__tabs').html());
                if(id == 0) {
                    url = removeParam('section',url);
                    history.pushState(null, null, url);
                }else {
                    if (url.indexOf('?') + 1) {
                        if (url.indexOf('section') + 1) {
                            window.history.replaceState('', '', UpdateQueryString('section', id, window.location.href));
                        } else {
                            newUrl = url + '&' + 'section' + '=' + id;
                            history.pushState(null, null, newUrl);
                        }
                    } else {
                        newUrl = url + '?' + 'section' + '=' + id;
                        history.pushState(null, null, newUrl);
                    }
                }
                filtering();
            }
        });
    })
    $('body').on('click','.tabAjaxEvents',function(e){
        e.preventDefault();
        var url = location.href;
        var id = $(this).attr('data-id');
        var type = getUrlParameter('type');
        if(type == 'calendar'){
            var nowYear = parseInt($('.year-name').attr('data-year'));
            var nowMonth = parseInt($('.month-name').attr('data-month'));
            $.ajax({
                type: "POST",
                url: location.href,
                data: {'calendarItems':'Y',type:type,section:id,month:nowMonth,year:nowYear},
                dataType: "json",
                success: function (result) {
					console.log(result);
                    var calItems = result;
                    setMonthCalendar(nowYear, nowMonth - 1,calItems);
                    $('.tabAjaxEvents').each(function () {
                        $(this).removeClass('active');
                    })
                    $('.tabAjaxEvents[data-id="'+id+'"]').addClass('active');
                    if (id == 0) {
                        url = removeParam('section', url);
                        history.pushState(null, null, url);
                    } else {
                        if (url.indexOf('?') + 1) {
                            if (url.indexOf('section') + 1) {
                                window.history.replaceState('', '', UpdateQueryString('section', id, window.location.href));
                            } else {
                                newUrl = url + '&' + 'section' + '=' + id;
                                history.pushState(null, null, newUrl);
                            }
                        } else {
                            newUrl = url + '?' + 'section' + '=' + id;
                            history.pushState(null, null, newUrl);
                        }
                    }
                    filtering();
                }
            });
        }else {
            $.ajax({
                url: url,
                type: 'post',
                data: {ajax: 'Y', section: id},
                success: function (result) {
                    $('.tabAjaxEvents').each(function () {
                        $(this).removeClass('active');
                    })
                    $('.load_ajax').html(result);
                    $('.diveinblog__tabs').html($('.load_ajax').find('.diveinblog__tabs').html());
                    if (id == 0) {
                        url = removeParam('section', url);
                        history.pushState(null, null, url);
                    } else {
                        if (url.indexOf('?') + 1) {
                            if (url.indexOf('section') + 1) {
                                window.history.replaceState('', '', UpdateQueryString('section', id, window.location.href));
                            } else {
                                newUrl = url + '&' + 'section' + '=' + id;
                                history.pushState(null, null, newUrl);
                            }
                        } else {
                            newUrl = url + '?' + 'section' + '=' + id;
                            history.pushState(null, null, newUrl);
                        }
                    }
                    filtering();
                }
            });
        }
    })
    $('body').on('click','.tabAjaxEventsType',function(e){
        e.preventDefault();
        var url = location.href;
        var type = $(this).attr('data-type');
        $.ajax({
            url: url,
            type: 'post',
            data: {ajax: 'Y',type:type},
            success: function (result) {
                $('.tabAjaxEvents').each(function(){
                    $(this).removeClass('active');
                })
                $('.load_ajax').html(result);
                $('.diveinblog__tabs').html($('.load_ajax').find('.diveinblog__tabs').html());
                if(type == 'calendar'){
                    $.ajax({
                        type: "POST",
                        url: location.href,
                        data: {'calendarItems':'Y',type:type},
                        dataType: "json",
                        success: function (result) {
                            var calItems = result;
                            var date = new Date();
                            var nowYear = date.getFullYear();
                            var nowMonth = date.getMonth();
                            setMonthCalendar(nowYear, nowMonth,calItems);
                        }
                    });
                }
                if(type == 0) {
                    url = removeParam('type',url);
                    history.pushState(null, null, url);
                }else {
                    if (url.indexOf('?') + 1) {
                        if (url.indexOf('type') + 1) {
                            window.history.replaceState('', '', UpdateQueryString('type', type, window.location.href));
                        } else {
                            newUrl = url + '&' + 'type' + '=' + type;
                            history.pushState(null, null, newUrl);
                        }
                    } else {
                        newUrl = url + '?' + 'type' + '=' + type;
                        history.pushState(null, null, newUrl);
                    }
                }
                filtering();
            }
        });
    });
	if ($(window).width() < 1024 && location.href.indexOf("events") > 0) {
        var url = location.href;
        var type = "calendar";
        $.ajax({
            url: url,
            type: 'post',
            data: {ajax: 'Y',type:type},
            success: function (result) {
                $('.load_ajax').html(result);
                $('.diveinblog__tabs').html($('.load_ajax').find('.diveinblog__tabs').html());
                if(type == 'calendar'){
                    $.ajax({
                        type: "POST",
                        url: location.href,
                        data: {'calendarItems':'Y',type:type},
                        dataType: "json",
                        success: function (result) {
                            var calItems = result;
                            var date = new Date();
                            var nowYear = date.getFullYear();
                            var nowMonth = date.getMonth();
                            setMonthCalendar(nowYear, nowMonth,calItems);
                        }
                    });
                }
                if(type == 0) {
                    url = removeParam('type',url);
                    history.pushState(null, null, url);
                }else {
                    if (url.indexOf('?') + 1) {
                        if (url.indexOf('type') + 1) {
                            window.history.replaceState('', '', UpdateQueryString('type', type, window.location.href));
                        } else {
                            newUrl = url + '&' + 'type' + '=' + type;
                            history.pushState(null, null, newUrl);
                        }
                    } else {
                        newUrl = url + '?' + 'type' + '=' + type;
                        history.pushState(null, null, newUrl);
                    }
                }
                filtering();
            }
        });

		$("body").on("click",".existEvents",function(){
			$(".mobileEvents").html("");
			let mobileContent = $(this).find(".calDayEvents").html();
			$(".mobileEvents").html(mobileContent);
		});
	}
    $("body").on("click",'.header__lang-current',function() {
		let mi_lang = getCookie("mi_lang");
		
		switch (mi_lang) {
		  case undefined:
			setCookie("mi_lang","s2");
			break;
		  case "s1":
			setCookie("mi_lang","s2");
			break;
		  case "s2":
			setCookie("mi_lang","s1");
			break;
		  default:
			setCookie("mi_lang","s2");
		}
		
		location.reload();
//        $.ajax({
//            type: "POST",
//            url: "/ajax.php",
//            data: {'action':'lang'},
//            success: function (result) {
//				console.log(result);
//                if($('.duplicate').length > 0){
//                    var href = $('.duplicate').attr('data-href');
//                    if(href != ''){
//                        location.href = href;
//                    }else{
//                        location.reload();
//                    }
//                } else {
//                    location.reload();
//                }
//            }
//        });
    })
    $("body").on("click",'.footer_menu_lang',function() {
        $.ajax({
            type: "POST",
            url: "/ajax.php",
            data: {'action':'lang'},
            success: function (result) {
                if($('.duplicate').length > 0){
                    var href = $('.duplicate').attr('data-href');
                    if(href != ''){
                        location.href = href;
                    }else{
                        location.reload();
                    }
                }else {
                    location.reload();
                }
            }
        });
    })
    if($('.divein__events-wrap[data-type="calendar"]').length > 0){
        $.ajax({
            type: "POST",
            url: location.href,
            data: {'calendarItems':'Y'},
            dataType: "json",
            success: function (result) {
                var calItems = result;
                var date = new Date();
                var nowYear = date.getFullYear();
                var nowMonth = date.getMonth();
                setMonthCalendar(nowYear, nowMonth,calItems);
            }
        });
    }
    $('body').on('click','.monthAjaxPrev',function(e){
        e.preventDefault();
		if ($(window).width() < 1024) {
			$(".mobileEvents").html("");
		}
        var month = parseInt($(this).attr('data-month'));
        var year = parseInt($(this).attr('data-year'));
        $.ajax({
            type: "POST",
            url: location.href,
            data: {'calendarItems':'Y','month':month,'year':year},
            dataType: "json",
            success: function (result) {
                var calItems = result;
                setMonthCalendar(year, month - 1,calItems);
                if(month == 1){
                    $('.monthAjaxPrev').attr('data-month',12);
                    $('.monthAjaxPrev').attr('data-year',year - 1);
                    $('.monthAjaxNext').attr('data-month',month + 1);
                    $('.monthAjaxNext').attr('data-year',year);
                    $('.month-name').attr('data-month',month);
                }
                if(month == 12){
                    $('.monthAjaxPrev').attr('data-month',month - 1);
                    $('.monthAjaxPrev').attr('data-year',year);
                    $('.monthAjaxNext').attr('data-month',1);
                    $('.monthAjaxNext').attr('data-year',year + 1);
                    $('.year-name').attr('data-year',year - 1);
                    $('.month-name').attr('data-month',month);
                }
                if(month != 1 && month != 12){
                    $('.monthAjaxPrev').attr('data-month',month - 1);
                    $('.monthAjaxPrev').attr('data-year',year);
                    $('.monthAjaxNext').attr('data-month',month + 1);
                    $('.monthAjaxNext').attr('data-year',year);
                    $('.month-name').attr('data-month',month);
                }

            }
        });
    })
    $('body').on('click','.monthAjaxNext',function(e){
        e.preventDefault();
		if ($(window).width() < 1024) {
			$(".mobileEvents").html("");
		}
        var month = parseInt($(this).attr('data-month'));
        var year = parseInt($(this).attr('data-year'));
        $.ajax({
            type: "POST",
            url: location.href,
            data: {'calendarItems':'Y','month':month,'year':year},
            dataType: "json",
            success: function (result) {
                var calItems = result;
                setMonthCalendar(year, month - 1,calItems);
                if(month == 12){
                    $('.monthAjaxPrev').attr('data-month',month - 1);
                    $('.monthAjaxPrev').attr('data-year',year);
                    $('.monthAjaxNext').attr('data-month',1);
                    $('.monthAjaxNext').attr('data-year',year + 1);
                    $('.month-name').attr('data-month',month);
                }if(month == 1){
                    $('.monthAjaxPrev').attr('data-month',12);
                    $('.monthAjaxPrev').attr('data-year',year - 1);
                    $('.monthAjaxNext').attr('data-month',2);
                    $('.monthAjaxNext').attr('data-year',year);
                    $('.year-name').attr('data-year',year + 1);
                    $('.month-name').attr('data-month',month);
                }
                if(month != 12 && month != 1){
                    $('.monthAjaxPrev').attr('data-month',month - 1);
                    $('.monthAjaxPrev').attr('data-year',year);
                    $('.monthAjaxNext').attr('data-month',month + 1);
                    $('.monthAjaxNext').attr('data-year',year);
                    $('.month-name').attr('data-month',month);
                }

            }
        });
    })

    $('body').on('click','[data-action="get_course"]',function(e){
        e.preventDefault();
        if ($('[href="#sign"]').length > 0){
            $('[href="#sign"]').click();
        } else {
            let course = parseInt($(this).attr('data-course'));
            let moduleUrl = $(this).attr('data-url');

            $.ajax({
                type: "GET",
                url: '/ajax.php',
                data: {'action':'get_course','course':course},
                dataType: "json",
                success: function (result) {
                    if (result === true){
                        window.location.href = moduleUrl;
                    }
                }
            });
        }
        return false;
    });
	
    $('.profile__popup-courses__start').click(function(e){
        e.preventDefault();
        if ($('[href="#sign"]').length > 0){
            $('[href="#sign"]').click();
        } else {
            let course = parseInt($(this).attr('data-course'));
            let moduleUrl = $(this).attr('data-url');

            $.ajax({
                type: "GET",
                url: '/ajax.php',
                data: {'action':'get_course','course':course},
                dataType: "json",
                success: function (result) {
                    if (result === true){
                        window.location.href = moduleUrl;
                    }
                }
            });
        }
        return false;
    });

    $(".downloadCertNew").click(function(){
        let cert_color = $(this).attr("data-type"),
            pdfContent = document.querySelector("#"+cert_color),
            optionArray = {
                margin:       [0,0,0,0],
                filename:     'cert.pdf',
                image:        { type: 'jpg', quality: 1 },
                html2canvas:  { scale: 4.01, x:0, y:0,scrollX:0,scrollY:0,windowWidth:500},
                jsPDF:        { orientation: 'landscape', compress: true }
            };

		console.log(pdfContent);
		
        // html to pdf generation with the reference of PDF worker object
        html2pdf().set(optionArray).from(pdfContent).save();
    });

    $('body').on('click','.indexSection5__tabs_head-item.cat-all',function(){
        $('.indexSection5__tabs-body .news__list-item').slice('4').removeClass('active');
    })
    $('body').on('click','.indexSection5__tabs_head-item.cat-all-not',function(){
        $('.indexSection5__tabs-body .news__list-item').removeClass('item-empty');
    })
    // TERMS AND CONDITION открываем
    $('.open_modal_terms').on("click", function (e) {
        e.preventDefault();
        let parent = $(".terms__open[id='terms"+$(this).attr('data-code')+"']");
        parent.toggleClass("_active");
        parent.find(".terms__overlay").toggleClass("_active");
        parent.find(".terms__wrap").toggleClass("_active");
        $("body").addClass("fixed");
    });
// TERMS AND CONDITION закрываем
    $(".terms__close,.terms__overlay").on("click", function (e) {
        let parent = $(this).closest(".terms__open");
        parent.removeClass("_active");
        parent.find(".terms__overlay").removeClass("_active");
        parent.find(".terms__wrap").removeClass("_active");
        $("body").removeClass("fixed");
    });
    $('.check_base').on('click',function(){
        var code = $(this).attr('data-code');
        $('.edit_base_profile').click();
        $("html,body").animate({scrollTop: $('.form_base_profile [name="'+code+'"]').offset().top - 110}, 500);
    });
    $('.check_work').on('click',function(){
        var code = $(this).attr('data-code');
        $('.edit_work_profile').click();
        $("html,body").animate({scrollTop: $('.form_work_profile [name="'+code+'"]').offset().top - 110}, 500);
    });
    $('.check_photo').on('click',function(){
        var code = $(this).attr('data-code');
        $('.edit_base_profile').click();
        $("html,body").animate({scrollTop: $('.form_base_profile .profile__acc-box__photo').offset().top - 110}, 500);
    });
    $('.popup__notify-item-read').on('click',function(e){
        e.preventDefault();
        var notifications = '';
        var url = $(this).attr('href');
        notifications = $(this).attr('data-id');
        if(notifications != '') {
            $.ajax({
                type: "POST",
                url: '/ajax.php',
                data: {'action': 'notify_read_user', 'notification': notifications},
                success: function (result) {
                    location.href = url;
                }
            });
        }
    });
	
    $('body').on('click','[data-action="auth_unlink"]',function(e){
        e.preventDefault();

        let item = $(this);
        let provider = $(this).attr('data-provider');

        $.ajax({
            type: "GET",
            url: '/ajax.php',
            data: {'action':'auth_unlink','provider': provider},
            dataType: "json",
            success: function (result) {
                if (result === true){
                    item.prev().remove();
                    item.remove();
                }
            }
        });
        return false;
    });

    if ($('#player-module').length > 0) {
        //add youtube player
        let tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";

        let firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
});

$(window).on("load", function () {
    if ($('.header__profile .openLoginPopup').length > 0) {
        let auth = getUrlParameter('auth');
        let $loginPopupSection = $(".login__popup-section");
        let url = removeParam('auth', location.href);

        if (auth === 'failed') {
            $('.header__profile .openLoginPopup').trigger('click');
            $('.login__popup .login__popup-user__error').show();
            history.pushState(null, null, url);
        }
    }
});

function generateEvents(events, count, popup = false, datePopup) {
    let eventsHtml = '',
		calDayCount = count,
        eventsTypeObject = $(".divein__events-tabs__item.active");
	if (count > 3) calDayCount = 3;
	if (popup) {
        eventsHtml = '<div class="popupEvents"><div class="popupEvents__overlay"></div><div class="popupEvents__wrap"><div class="popupEvents__list"><button class="popupEvents__close">x</button>';
	} else {
		let calDayEventsClass = "calDayEvents";
		if (count > 1) calDayEventsClass = "calDayEvents openPopup";
        eventsHtml = '<div class="'+calDayEventsClass+'" data-count="'+calDayCount+'">';
	}
    for (const element of events) {
        let eventLink = element.link,
            eventTitle = element.title,
            eventDesc = element.desc,
            eventTags = element.tags,
            eventImage = element.photo;
        if (count > 1 && !popup) eventsHtml += '<div class="calDayEvents__item">';
        else eventsHtml += '<a href="' + eventLink + '" class="calDayEvents__item">';
		eventsHtml += generateCalItem(eventTitle, eventLink, eventDesc, eventImage, eventTags, popup, datePopup);
        if (count > 1 && !popup) eventsHtml += '</div>';
        else eventsHtml += '</a>';
    }
    if (popup) eventsHtml += '</div></div></div>';
    else eventsHtml += '</div>';
    return eventsHtml;
}

// карточка события
function generateCalItem(title, link, desc, photo, tags, popup, datePopup) {
    let eventsHtml = '<div class="calDayEvents__item-photo">';
    eventsHtml += '<img src="' + photo + '" alt="' + title + '">';
	let tagsFindCount = tags.length;
    if (tagsFindCount > 0) {
        eventsHtml += '<div class="calDayEvents__item-tags">';
        for (const tag of tags) {
            let tagTitle = tag.title;
            eventsHtml += '<span class="calDayEvents__item-tags__item">' + tagTitle + '</span>';
        }
        eventsHtml += '</div>';
    }
    eventsHtml += '</div>';
    eventsHtml += '<div class="calDayEvents__item-content">';
	if (datePopup)
		eventsHtml += '<div class="calDayEvents__item-date">' + datePopup + '</div>';
    eventsHtml += '<div class="calDayEvents__item-title">' + title + '</div>';
    if (desc != "undefined") eventsHtml += '<div class="calDayEvents__item-desc">' + desc + '</div>';
    eventsHtml += '</div>';
    return eventsHtml;
}

function setMonthCalendar(year, month,calItems) {
    let monthDays = new Date(year, month + 1, 0).getDate(),
        monthPrefix = new Date(year, month, 0).getDay(),
        monthDaysText = '',
        eventsHtml = '';
    let nowDate = new Date(),
        nowDateNumber = nowDate.getDate(),
        nowMonth = nowDate.getMonth(),
        nowYear = nowDate.getFullYear(),
        container = document.getElementById('month-calendar'),
        monthContainer = container.getElementsByClassName('month-name')[0],
        yearContainer = container.getElementsByClassName('year-name')[0],
        daysContainer = container.getElementsByClassName('days')[0],
		mobileContainer = container.getElementsByClassName('mobileEvents')[0],
        prev = container.getElementsByClassName('prev')[0],
        next = container.getElementsByClassName('next')[0];
    var lang = $('body').attr('data-lang');
    let monthName = [];
    let monthNameShort = [];
    if(lang == 'ru'){
        monthName = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Остябрь', 'Ноябрь', 'Декабрь'];
        monthNameShort = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
    }else {
        monthName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        monthNameShort = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    }
    let curDate = nowDate.setMonth(nowDate.getMonth() - 1);
    monthContainer.textContent = monthName[month];
    yearContainer.textContent = year;
    daysContainer.innerHTML = '';

    if (monthPrefix > 0) {
        for (let i = 1; i <= monthPrefix; i++) {
            monthDaysText += '<li></li>';
        }
    }

    for (let i = 1; i <= monthDays; i++) {
        let dayFind = "";
        if (i < 10) dayFind = "0" + i;
        else dayFind = i;

		// составляем дату для модалки
		let datePopup = dayFind.toString() + " " + monthNameShort[(month + 1)] + " " + year.toString();

        // составляем дату для поиска	
		let monthText = month + 1;
		if (month < 10) monthText = "0"+(month+1);
        dayFind = dayFind.toString() + "." + monthText.toString() + "." + year.toString();

        // определяем тип события
        let eventsFindIndex = calItems.findIndex(item => item.date === dayFind);

        let dayClass = '';
        if (eventsFindIndex > -1) dayClass = ' class="existEvents"';
        monthDaysText += '<li' + dayClass+'><div class="calDayTop"><span class="calDayText">' + i;

        if (i == 1 || i == monthDays) monthDaysText += " <span>" + monthNameShort[month] + '</span></span>';
        else monthDaysText += '</span>';

        // ищем хотя бы одно событие
        if (eventsFindIndex > -1) {

            let events = calItems[eventsFindIndex].events;

			let eventsTitle = "Events";
			if (lang == "ru")
				eventsTitle = "Событий";

            let eventsFindCount = events.length;
            if (eventsFindCount > 1)
                monthDaysText += '<span class="calDayEventsCount">' + eventsFindCount + " "+eventsTitle+"</span>";
            monthDaysText += "</div>" + generateEvents(events, eventsFindCount, false, datePopup);
            if (eventsFindCount > 1)
                monthDaysText += generateEvents(events, eventsFindCount, true, datePopup);
        }
    }

    daysContainer.innerHTML = monthDaysText;

}
function UpdateQueryString(key, value, url) {
    if (!url) url = window.location.href;
    var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
        hash;

    if (re.test(url)) {
        if (typeof value !== 'undefined' && value !== null)
            return url.replace(re, '$1' + key + "=" + value + '$2$3');
        else {
            hash = url.split('#');
            url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            return url;
        }
    } else {
        if (typeof value !== 'undefined' && value !== null) {
            var separator = url.indexOf('?') !== -1 ? '&' : '?';
            hash = url.split('#');
            url = hash[0] + separator + key + '=' + value;
            if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                url += '#' + hash[1];
            return url;
        } else
            return url;
    }

}
function setUrlPage(page){
    var url = location.href,
        arUrl = url.split('?');
    if(arUrl[1]) {
        url = '/?' + arUrl[1];
    }else{
        url = '';
    }
    history.pushState(null, null, url);
}
function filtering(){
    $(".filtering").each(function(){
        var filterActive,
            filteringParent = $(this);

        function filterCategory(category) {
            if (filterActive != category) {

                // reset results list
                filteringParent.find('.filter-cat-results .f-cat').removeClass('active');

                // elements to be filtered
                filteringParent.find('.filter-cat-results .f-cat')
                    .filter('[data-cat="' + category + '"]')
                    .addClass('active');

                // reset active filter
                filterActive = category;
                filteringParent.find('.filtering__button').removeClass('active');
            }
        }

        filteringParent.find('.f-cat:not(.item-empty)').addClass('active');

        filteringParent.find('.filtering__button').click(function() {
            if ($(this).hasClass('cat-all')) {
                $('.filter-cat-results .f-cat').addClass('active');
                filterActive = 'cat-all';
                $('.filtering .filtering__button').removeClass('active');
            } else {
                filterCategory($(this).attr('data-cat'));
            }
            $(this).addClass('active');
        });
    });
}
//Получение get параметра
function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
//Удаление get параметра
function removeParam(key, sourceURL) {
    var splitUrl = sourceURL.split('?'),
        rtn = splitUrl[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? splitUrl[1] : '';
    if (queryString !== '') {
        params_arr = queryString.split('&');
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split('=')[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        if(params_arr.length != 0){
            rtn = rtn + '?' + params_arr.join('&');
        }
    }
    return rtn;
}

window.onYouTubeIframeAPIReady = function() {
    let playerModule = $('#player-module');
    if (playerModule.length > 0) {
        let lastTime = 0;
        let player = new YT.Player('player-module', {
            height: '315',
            width: '560',
            videoId: playerModule.data('video'),
            playerVars: {controls: 1, disablekb: 1, rel: 0},
            events: {
                'onReady': function (event) {
                    setInterval(function () {
                        let module = playerModule.data('module');
                        let curTime = player.getCurrentTime();
                        let duration = player.getDuration();
                        if ((curTime - lastTime) > 9) {
                            lastTime = curTime;
                            let progress = curTime / duration;
                            $.ajax({
                                type: "GET",
                                url: '/ajax.php',
                                data: {'action': 'module_progress', 'progress': progress, 'module': module},
                                dataType: "json",
                                success: function (result) {

                                }
                            });
                        }
                    }, 1000);
                },
            }
        });
    }
}

$(".onlyDigit").keydown(function(event) {
	
	// Разрешаем: backspace, delete, tab и escape
	if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
		// Разрешаем: Ctrl+A
		(event.keyCode == 65 && event.ctrlKey === true) ||
		// Разрешаем: home, end, влево, вправо
		(event.keyCode >= 35 && event.keyCode <= 39)) {

	  	// Ничего не делаем
		return;
	} else {
		// Запрещаем все, кроме цифр на основной клавиатуре, а так же Num-клавиатуре
	  	if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
			event.preventDefault();
	  	}
	}
});