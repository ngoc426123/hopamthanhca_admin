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

    $("#changePass").change((element) => {
        if ($(element.target).prop('checked')) {
            $("#divChangePass").stop().slideDown(300);
        } else {
            $("#divChangePass").stop().slideUp(300);
        }
    });

    $(".card-form-check").each((index, element) => {
        let __self = $(element);
        let itemCheck = null;

        $(element).find(".form-check").each((idx, ele) => {
            let isChecked = $(ele).find('.form-check-input').prop('checked');
            if (isChecked) {
                $(ele).prependTo(__self);
            }
        });
    });

    function toSlug(text){
    
        //Lấy text từ thẻ input title 
    
        //Đổi chữ hoa thành chữ thường
        slug = text.toLowerCase();
    
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        return slug;
    }

    $("#update_meta_seo").on("click", () => {
        const title = $('[name="title"]').val();
        const slug = toSlug($('[name="title"]').val());
        const excerpt = $('[name="excerpt"]').val();
        const keywork = `${title}, bài hát ${title}, hợp âm ${title}, hợp âm guitar ${title}, ${title} hợp âm`;

        $('[name="seotitle"]').val(title).parent(".bmd-form-group").addClass('is-filled');
        $('[name="seourl"]').val(slug).parent(".bmd-form-group").addClass('is-filled');
        $('[name="seodes"]').val(excerpt).parent(".bmd-form-group").addClass('is-filled');
        $('[name="seokeywork"]').val(keywork).parent(".bmd-form-group").addClass('is-filled');

        $('.seo-title').text(title);
        $('.seo-url').text(`http://hopamthanhca.com/${slug}`);
        $('.seo-desc').text(excerpt);
    });

    $(".quickEdit").on('click', (event) => {
        const trElement = $(event.target).parents("tr");
        const id        = trElement.find("td:first").text();
        fetch(`${base_url}song/get_quick_song?id=${id}`)
        .then(res => res.json())
        .then(data => {
            let current_url = window.location.href;
            current_url = current_url.replace(/#/g,"");
            current_url = current_url+`&quickedit=${data.id}`;

            const chuyenmuc = renderCheckCat(data.chuyenmuc, data.cat.chuyen_muc);
            const tacgia = renderCheckCat(data.tacgia, data.cat.tac_gia);
            const bangchucai = renderCheckCat(data.bangchucai, data.cat.bang_chu_cai);
            const dieubaihat = renderCheckCat(data.dieubaihat, data.cat.dieu_bai_hat);  
            const layout = `<tr class="table-default">
                                <td colspan=6>
                                    <form method="post" action="${current_url}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="${data.title}" placeholder="Tiêu đề" name="title">
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-over card-form-check">` +
                                                        chuyenmuc +
                                                    `</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-over card-form-check">` +
                                                        tacgia +
                                                    `</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-over card-form-check">` +
                                                        bangchucai +
                                                    `</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-over card-form-check">` +
                                                        dieubaihat +
                                                    `</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <div class="togglebutton">
                                                    <label><input type="checkbox" name="status" ${data.status=='publish'?'checked':''}>Publish <span class="toggle"></span></label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="File nhạc" value="${data.meta.pdffile}" name="pdffile">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Lời đầu" value="${data.excerpt}" name="excerpt">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Hợp âm chính" value="${data.meta.hopamchinh}" name="hopamchinh">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="SEO Title" value="${data.meta.seotitle}" name="seotitle">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="SEO Url" value="${data.meta.seourl}" name="seourl">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="SEO Meta decription" value="${data.meta.seodes}" name="seodes">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="SEO Keyworks" value="${data.meta.seokeywork}" name="seokeywork">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-success" name="update">Đồng ý</button>
                                    </div>
                                    </form>
                                </td>
                            </tr>`;
            $(layout).insertAfter(trElement);
        });
        event.preventDefault();
    });

    function renderCheckCat (danhmuc, danhmuc_song) {
        let ret = ``;
        danhmuc.forEach(element => {
            const checked = (danhmuc_song.includes(element.id))?`checked`:``;
            ret += `<div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="danhmuc[]" type="checkbox" value="${element.id}" ${checked}> ${element.cat_name} <span
                                    class="form-check-sign"><span class="check"></span></span>
                            </label>
                        </div>`;
        });
        return ret; 
    }
});