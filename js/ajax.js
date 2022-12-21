$(document).ready(function(){
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
});
