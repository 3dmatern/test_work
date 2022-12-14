$(document).ready(function(){
    //Вывод имени пользователя
    let chekname = $(".title_name").html();
    $.ajax({ 
        type: 'POST', 
        url: 'vendor/username.php',
        dataType: 'json',
        data: {
            chekname:chekname
        },
        success (data) {
            $('.title_name').html(data.message);
        }
    });
    //Авторизация
    $('.login_btn').click(function(e){
        e.preventDefault();
        $(`input`).removeClass('error');
        $('.msg').addClass('block_off');
        $(`label`).text('');
        let login = $('input[name="login"]').val(),
            password = $('input[name="password"]').val();
        $.ajax({
            url: 'vendor/singin.php',
            type: 'POST',
            dataType: 'json',
            data: {
                login: login,
                password: password
            },
            success (data) {
                if(data.type === 1){
                    document.location.href = 'profile.php';
                } else {
                    if(data.type === 0){
                        data.fields.forEach(function(field){
                            $(`input[name="${field}"]`).addClass('error');
                            $(`label[for="${field}"]`).text(data.message);
                        });
                    }
                }
            }
        });
    });
    
    //Регистрация
    $('.reg_btn').click(function(e){
        e.preventDefault();
        $(`input`).removeClass('error');
        $('.msg').addClass('block_off');
        $(`label`).text('');
        let login = $('input[name="login"]').val(),
            password = $('input[name="password"]').val(),
            password_confirm = $('input[name="password_confirm"]').val(),
            email = $('input[name="email"]').val(),
            name = $('input[name="name"]').val();
        $.ajax({
            url: 'vendor/singup.php',
            type: 'POST',
            dataType: 'json',
            data: {
                login: login,
                password: password,
                password_confirm: password_confirm,
                email: email,
                name: name
            },
            success (data) {
                if(data.type === 1){
                    $('.msg').removeClass('block_off').text(data.message);
                    $(`label`).text('');
                    $(`input`).val('');
                    $('.prof_title_name').text('Hello, '.name);
                } else {
                    if(data.type === 0){
                        data.fields.forEach(function(field){
                            $(`input[name="${field}"]`).addClass('error');
                            $(`label[for="${field}"]`).text(data.message);
                        });
                    }
                }
            }
        });
    });
    //Изменение имени
    $('.name_btn').click(function(e){
        e.preventDefault();
        $(`input`).removeClass('error');
        $(`label`).removeClass('done');
        $(`label`).text('');
        let login = $('input[name="login"]').val(),
            name = $('input[name="name"]').val();
        $.ajax({
            url: 'vendor/reName.php',
            type: 'POST',
            dataType: 'json',
            data: {
                login: login,
                name: name
            },
            success (data) {
                if(data.type === 1){
                    data.fields.forEach(function(field){
                        $(`label[for="${field}"]`).text(data.message).addClass('done');
                    });
                } else {
                    if(data.type === 0){
                        data.fields.forEach(function(field){
                            $(`input[name="${field}"]`).addClass('error');
                            $(`label[for="${field}"]`).text(data.message);
                        });
                    }
                }
            }
        });
    });
    //Изменение пароля
    $('.password_btn').click(function(e){
        e.preventDefault();
        $(`input`).removeClass('error');
        $(`label`).removeClass('done');
        $(`label`).text('');
        let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();
        $.ajax({
            url: 'vendor/rePassword.php',
            type: 'POST',
            dataType: 'json',
            data: {
                login: login,
                password: password
            },
            success (data) {
                if(data.type === 1){
                    data.fields.forEach(function(field){
                        $(`label[for="${field}"]`).text(data.message).addClass('done');
                    });
                } else {
                    if(data.type === 0){
                        data.fields.forEach(function(field){
                            $(`input[name="${field}"]`).addClass('error');
                            $(`label[for="${field}"]`).text(data.message);
                        });
                    }
                }
            }
        });
    });

    //Удалить профиль
    $('.deleted_btn').click(function(e){
        e.preventDefault();
        $('.msg').addClass('block_off');
        let login = $('input[name="login"]').val();
        $.ajax({
            url: 'vendor/deleted.php',
            type: 'POST',
            dataType: 'json',
            data: {
                login: login
            },
            success (data) {
                if(data.type === 1){
                    document.location.href = 'index.php';
                } else {
                    if(data.type === 0){
                        $('.msg').removeClass('block_off').text(data.message);
                    }
                }
            }
        });
    });
});