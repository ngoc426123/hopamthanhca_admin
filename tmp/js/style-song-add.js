$(document).ready(() => {
	class SongAdd {
		constructor(element) {
			this.$element = element;
			this.initDOM();
			this.initState();
			this.handleEvent();
			this.fetchListSong();
		}

		initDOM() {
			this.$songTitle = this.$element.find('[data-song-title]');
			this.$songExist = this.$element.find('[data-song-exist]');
			this.$listSongExist = this.$element.find('[data-list-song-exist]');
			this.$inputFind = this.$element.find('[data-input-find]');
			this.$catFind = this.$element.find('[data-cat-find]');
			this.$btnMetaSeo = this.$element.find('#update_meta_seo');
		}

		initState() {
			this.state = { listSong: [] };
		}

		handleEvent() {
			// SONG TITLE BLUR
			this.$songTitle
				.off("blur.SongAdd")
				.on("blur.SongAdd", this.handleEventBlurTitle.bind(this));

			// INPUT KEYUP
			this.$inputFind
				.off("keyup.SongAdd")
				.on("keyup.SongAdd", this.handleEventKeyupInput.bind(this));

			// META SEO
			this.$btnMetaSeo
				.off('click.MetaSeo')
				.on('click.MetaSeo', this.handleEventMetaSeo.bind(this));
		}

		async fetchListSong() {
			const apiUrl = `${base_url}/song/listAllSongs`;
			const $body = $('body');
			const listSong = await new Promise((reslove, reject) => {
				$body.addClass('loading');
				fetch(apiUrl)
					.then(res => res.json())
					.then(reslove);
			});

			$body.removeClass('loading');
			this.state = { ...this.state, listSong }
		}

		handleEventBlurTitle() {
			const { listSong } = this.state;
			const value = this.$songTitle.val().toLowerCase();
			const filted = listSong.filter((song) => {
				const { title } = song;
				const regex = new RegExp(`(${value})`);

				return regex.test(title.toLowerCase()) ? song : [];
			}).slice(0, 10);

			if (filted.length > 0) {
				this.$songExist.removeClass('d-none');
				this.renderListSongExist(filted);
			} else {
				this.$songExist.addClass('d-none');
			}
		}

		handleEventKeyupInput() {
			const target = $(event.target)
			const domCatFind = target.prev(this.$catFind);
			const domItemFind = domCatFind.find('.form-check');
			const value = target.val();

			domItemFind.addClass('d-none');

			if (!value) {
				domItemFind.removeClass('d-none');
			} else {
				domItemFind.each((index, item) => {
					const textFind = $(item).find('.form-check-label').text().toUpperCase();
					const valueUpper = value.toUpperCase();
					const regex = new RegExp(`(${valueUpper})`, 'g');

					regex.exec(textFind) !== null && $(item).removeClass('d-none');
				});
			}
		}

		handleEventMetaSeo() {
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
		}

		renderListSongExist(data) {
			const path = window.location.pathname;
			
			this.$listSongExist.html('');
			data.forEach(song => {
				const urlLink = `${base_url}${path}?action=edit&id=${song.id}`;
				const author = song.cat['tac-gia'].reduce((prev, curr) => prev += `${curr.cat_name}, `, '');
				const authorSlice = author.substr(0, author.length - 2);

				this.$listSongExist.append(`<li><a href="${urlLink}">${song.title}</a> - ${authorSlice}</li>`);
			})
		}
	}

	$("[data-song-add]").length && new SongAdd($("[data-song-add]"));
});
