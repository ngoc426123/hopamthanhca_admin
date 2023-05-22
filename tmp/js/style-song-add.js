$(document).ready(() => {
	class SongAdd {
		constructor(element) {
			this.$element = element;
			this.initDOM();
			this.initEvent();
		}

		initDOM() {
			this.$songTitle = this.$element.find('[data-song-title]');
			this.$songExist = this.$element.find('[data-song-exist]');
			this.$listSongExist = this.$element.find('[data-list-song-exist]');
			this.$inputFind = this.$element.find('[data-input-find]');
			this.$catFind = this.$element.find('[data-cat-find]');
		}

		async initEvent() {
			console.log(window.location);
			const url = window.location.origin;
			const path = window.location.pathname;
			const data = await new Promise((reslove, reject) => {
				fetch(`${url}${path}/listAllSongs`)
					.then(res => res.json())
					.then(ret => reslove(ret));
			});

			this.$songTitle.on("blur", (event) => {
				const value = $(event.target).val().toLowerCase();
				const filted = data.filter(song => {
					const { title } = song;
					const regex = new RegExp(`(${value})`);

					if (regex.test(title.toLowerCase())) {
						return song;
					}
				}).slice(0, 10);

				if (filted.length > 0) {
					this.$songExist.removeClass('d-none');
					this.renderListSongExist(filted);
				} else {
					this.$songExist.addClass('d-none');
				}
			});

			this.$inputFind.on('keyup', (event) => {
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
			})
		}

		renderListSongExist(data) {
			const url = window.location.origin;
			const path = window.location.pathname;

			this.$listSongExist.html('');
			data.forEach(song => {
				const author = song.cat['tac-gia'].reduce((prev, curr) => prev += `${curr.cat_name}, `, '');
				const authorSlice = author.substr(0, author.length - 2);

				this.$listSongExist.append(`<li><a href="${url}${path}?action=edit&id=${song.id}">${song.title}</a> - ${authorSlice}</li>`);
			})
		}
	}

	$("[data-song-add]").length && new SongAdd($("[data-song-add]"));
});
