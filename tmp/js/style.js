$(document).ready(() => {
    $('#btn-login').off('click').on('click', () => {
        check_login();
    });

    $(window).off('keypress').on('keypress', (event) => {
        if (event.key === "Enter") {
            check_login();
        }
    });

    function check_login() {
        const element = $('.card-login');
        const element_head  = $('.card-header');
        const element_input = $('.form-control');
        const username = $('#username').val();
        const password = $('#password').val();


        new Promise((reslove, reject) => {
            $.ajax({
                url: base_url+'login/check',
                async: true,
                data: {
                    username: username,
                    password: password,
                },
                type: 'post',
                success: (result) => {
                    if (parseInt(result) === 1) {
                        element
                            .addClass('tada')
                            .on('animationend webkitAnimationEnd oAnimationEnd', (ele) => {
                                element.removeClass('tada');
                                setTimeout(() => { window.location.href = base_url }, 300);
                                
                            });
                        element_head
                            .removeClass('card-header-info')
                            .removeClass('card-header-danger')
                            .addClass('card-header-success');
                        element_input.blur();
                    } else if (parseInt(result) === 0) {
                        element
                            .addClass('headshake')
                            .on('animationend webkitAnimationEnd oAnimationEnd', (ele) => {
                                element.removeClass('headshake');
                            });
                        element_head
                            .removeClass('card-header-info')
                            .removeClass('card-header-success')
                            .addClass('card-header-danger');
                        element_input.focus();
                    }
                }
            });
        });
    }
}).bind($);