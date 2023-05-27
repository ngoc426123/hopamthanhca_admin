$(document).ready(() => {
	$('.sidebar .sidebar-wrapper, .main-panel').each((_, e) => {
		$(e).perfectScrollbar();
	});

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
		const element_head = $('.card-header');
		const element_input = $('.form-control');
		const username = $('#username').val();
		const password = $('#password').val();

		new Promise((reslove, reject) => {
			$.ajax({
				url: base_url + 'login/check',
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

	$("#changePassword").change((element) => {
		if ($(element.target).prop('checked')) {
			$("#divChangePass").stop().slideDown(300);
		} else {
			$("#divChangePass").stop().slideUp(300);
		}
	});

	$(".btnCreatePassword").on(`click`, () => {
		const maxChar = 10;
		const stepChar = 4;
		const arrChar = `abcdefghijklmnopqrstuvwxyzABCDEFGHIJKMLOPQRSTWXYZ0123456789`;
		const arrCharSpc = `!@#$%^&*`;
		const arrCharLength = arrChar.length;
		const arrCharSpcLength = arrCharSpc.length;
		const randomChar = return_char();

		function random_char() {
			return arrChar[Math.floor(Math.random() * (arrCharLength - 1)) + 1];
		}

		function random_char_spc() {
			return arrCharSpc[Math.floor(Math.random() * (arrCharSpcLength - 1)) + 1];
		}

		function replaceAt(string, index, replace) {
			return string.substring(0, index) + replace + string.substring(index + 1);
		}

		function return_char() {
			let output = ``;
			for (let i = 0; i < maxChar; i++) {
				output += random_char();
			}
			for (let i = 0; i < output.length; i += stepChar) {
				output = replaceAt(output, i, random_char_spc())
			}
			return output;
		}

		$(`[name="password"], [name="passwordAgain"]`).val(randomChar).parent(".bmd-form-group").addClass('is-filled');

		const eleInputPassword = $(`[name="password"]`);
		const eleInputPasswordAgain = $(`[name="passwordAgain"]`);

		eleInputPassword.attr("type", "text");
		eleInputPasswordAgain.attr("type", "text")
	});

	$(`[name="password"], [name="passwordAgain"]`).on(`focus`, (event) => {
		$(event.target).attr("type", "password");
	})

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

	window.toSlug = (text) => {
		slug = text.toLowerCase();
		slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
		slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
		slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
		slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
		slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
		slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
		slug = slug.replace(/đ/gi, 'd');
		slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
		slug = slug.replace(/ /gi, "-");
		slug = slug.replace(/\-\-\-\-\-/gi, '-');
		slug = slug.replace(/\-\-\-\-/gi, '-');
		slug = slug.replace(/\-\-\-/gi, '-');
		slug = slug.replace(/\-\-/gi, '-');
		slug = '@' + slug + '@';
		slug = slug.replace(/\@\-|\-\@|\@/gi, '');
		return slug;
	}

	$("#update_meta_seo_cat").on("click", () => {
		const title = $('[name="name"]').val();
		const slug = toSlug($('[name="name"]').val());
		const keywork = `danh mục hợp âm thánh ca, ${title}, danh mục ${title}, ${title} danh mục`;

		$('[name="seotitle"]').val(title).parent(".bmd-form-group").addClass('is-filled');
		$('[name="seourl"]').val(slug).parent(".bmd-form-group").addClass('is-filled');
		$('[name="seokeywork"]').val(keywork).parent(".bmd-form-group").addClass('is-filled');

		$('.seo-title').text(title);
		$('.seo-url').text(`http://hopamthanhca.com/danh-muc/${slug}`);
		$('.seo-desc').text(keywork);
	});

	$(".quickEdit").on('click', (event) => {
		const trElement = $(event.target).parents("tr");
		const id = trElement.find("td:first").text();
		if (trElement.next("tr").hasClass("table-default")) {
			return false;
		}
		fetch(`${base_url}song/get_quick_song?id=${id}`)
			.then(res => res.json())
			.then(data => {
				let current_url = window.location.href;
				current_url = current_url.replace(/#/g, "");
				current_url = current_url + `&quickedit=${data.id}`;

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
																		<div class="card-over card-form-check">${chuyenmuc}</div>
																	</div>
																</div>
															</div>
															<div class="col-12 col-lg-3">
																<div class="card">
																	<div class="card-body">
																		<div class="card-over card-form-check">${tacgia}</div>
																	</div>
																</div>
															</div>
															<div class="col-12 col-lg-3">
																<div class="card">
																	<div class="card-body">
																		<div class="card-over card-form-check">${bangchucai}</div>
																	</div>
																</div>
															</div>
															<div class="col-12 col-lg-3">
																<div class="card">
																	<div class="card-body">
																		<div class="card-over card-form-check">${dieubaihat}</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-12 col-lg-6">
																<div class="form-group">
																	<div class="togglebutton">
																		<label><input type="checkbox" name="status" ${data.status == 'publish' ? 'checked' : ''}>Publish <span class="toggle"></span></label>
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

	function renderCheckCat(danhmuc, danhmuc_song) {
		let ret = ``;
		danhmuc.forEach(element => {
			const checked = (danhmuc_song.includes(element.id)) ? `checked` : ``;
			ret += `<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" name="danhmuc[]" type="checkbox" value="${element.id}" ${checked}>
										${element.cat_name}
										<span class="form-check-sign"><span class="check"></span></span>
								</label>
							</div>`;
		});
		return ret;
	}

	$(".changePermission").on("change", (event) => {
		const permission = ($(event.target).prop('checked')) ? 1 : 0;
		const id = $(event.target).val();
		new Promise((reslove, reject) => {
			$.ajax({
				url: `${base_url}user/changepermission`,
				async: true,
				type: `POST`,
				data: {
					id: id,
					permission: permission,
				}
			});
		});
	});

	$(".btnChangePass").on("click", (event) => {
		const id = $(event.target).val();
		swal({
			title: `Đổi mật khẩu`,
			html: `
						<div class="form-group">
								<input type="password" class="form-control passNew" placeholder="Mật khẩu mới">
						</div>
						<div class="form-group">
								<input type="password" class="form-control passNewAgain" placeholder="Nhập lại mật khẩu">
						</div>
				`,
			showCloseButton: true,
			showCancelButton: true,
		}).then((event) => {
			if (event.value) {
				const passNew = $(".passNew").val();
				const passNewAgain = $(".passNewAgain").val();

				if (passNew != passNewAgain) {
					swal({
						icon: `error`,
						title: `Lỗi`,
						text: `Mật khẩu nhập lại không đúng`,
					});
				} else if (passNew == '' || passNewAgain == '') {
					swal({
						icon: `error`,
						title: `Lỗi`,
						text: `Chưa nhập một trong hai mật khẩu`,
					});
				} else {
					new Promise((reslove, reject) => {
						$.ajax({
							url: `${base_url}user/changepassword`,
							async: true,
							type: `POST`,
							data: {
								id: id,
								passNew: passNew
							},
							success: () => {
								swal({
									title: `Thành công`,
									text: `Đổi mật khẩu thành công`,
								});
							}
						});
					});
				}
			} else if (event.dismiss) {
				console.log("bạn nhấn cancel");
			}
		});
	});

	$(".btn-remove-song").on("click", (event) => {
		const ele = $(event.target).parent("button");
		const id = ele.attr("data-id");

		swal({
			title: `Xóa bài hát`,
			showCloseButton: true,
			showCancelButton: true,
		}).then((event) => {
			if (event.value) {
				new Promise((reslove, reject) => {
					$.ajax({
						url: `${base_url}song/del`,
						async: true,
						type: `POST`,
						data: {
							id: id,
						},
						success: (e) => {
							ele.parents("tr").remove();
							swal({
								title: `Thành công`,
								text: `Bạn đã xóa bài hát vừa rồi`,
							});
						}
					});
				});
			} else if (event.dismiss) {
				console.log("bạn nhấn cancel");
			}
		});
	});

	$(".btn-remove-weekly").on("click", (event) => {
		const ele = $(event.target).parent("button");
		const id = ele.attr("data-id");

		swal({
			title: `Xóa soạn thánh lễ`,
			showCloseButton: true,
			showCancelButton: true,
		}).then((event) => {
			if (event.value) {
				new Promise((reslove, reject) => {
					$.ajax({
						url: `${base_url}weekly/del`,
						async: true,
						type: `POST`,
						data: {
							id: id,
						},
						success: (e) => {
							ele.parents("tr").remove();
							swal({
								title: `Thành công`,
								text: `Bạn đã xóa phần soạn vừa rồi`,
							});
						}
					});
				});
			} else if (event.dismiss) {
				console.log("bạn nhấn cancel");
			}
		});
	});
});