$(document).ready(() => {
	class WeeklyAdd {
		constructor(element) {
			this.$element = element;
			this.initDOM();
			this.initState();
			this.handleEvent();
			this.fetchListSong();
		}

		initDOM() {
			this.$selectPhase = this.$element.find('[data-select-phase]');
			this.$contentPhase = this.$element.find('[data-content-phase]');
			this.$listSong = this.$element.find('[data-list-song]');
			this.$popupListSong = this.$element.find('[data-popup-list-song]');
			this.$popupInner = this.$element.find('[data-popup-inner]');
			this.$popupClose = this.$element.find('[data-popup-close]');
			this.$btnMetaSeo = this.$element.find('#update_meta_seo');

			this.$listSong.length > 0 && this.$listSong.perfectScrollbar();
			this.$contentPhase.sortable();
		}

		initState() {
			this.state = {
				current: { id: null, phase: null, phaseName: null, phaseSlug: null },
				listSong: [],
			}
		}

		handleEvent() {
			// ADD PHASE
			this.$selectPhase.on('changed.bs.select', this.handleEventAddPhase.bind(this));

			// DEL PHASE
			this.$element
				.off('click.DelPhase')
				.on('click.DelPhase', '[data-del-phase]', this.handleEventDelPhase.bind(this));

			// ADD SONG
			this.$popupClose
				.off('click.ClosePopup')
				.on('click.ClosePopup', this.handleEventClosePopup.bind(this));

			// ADD SHOW POPUP SONG
			this.$element
				.off('click.showPopupSelect')
				.on('click.showPopupSelect', '[data-popup-select]', this.handleEventShowPopupSelect.bind(this));
			
			// EXPO SONG
			this.$element
				.off('click.showExpoSong')
				.on('click.showExpoSong', '[data-expo-song]', this.handleEventExpoSong.bind(this));

			// DEPO SONG
			this.$element
				.off('click.showDepoSong')
				.on('click.showDepoSong', '[data-depo-song]', this.handleEventDepoSong.bind(this));

			// META SEO
			this.$btnMetaSeo
				.off('click.MetaSeo')
				.on('click.MetaSeo', this.handleEventMetaSeo.bind(this));
		}

		handleEventAddPhase() {
			const id = +this.$selectPhase.selectpicker('val');
			const $phase = this.get$PhaseTemplate(id);

			this.$contentPhase.append($phase);
			this.$selectPhase.val(0).selectpicker('render');
		}

		handleEventDelPhase(e) {
			const $target = $(e.currentTarget);
			const $parent = $target.closest('[data-phase]');

			$parent.remove();
		}

		handleEventShowPopupSelect(e) {
			const $target = $(e.target);
			const $phase = $target.closest('[data-phase]');
			const id = $phase.attr('data-phase-id');
			const phaseName = $phase.attr('data-phase-name');
			const phaseSlug = $phase.attr('data-phase-slug');
			const phase = $phase.find('[data-list-songs]');

			this.state = { ...this.state, current: { id, phase, phaseName, phaseSlug } };
			this.$popupListSong.removeClass('opacity-0 invisible');
			this.$popupInner.removeClass('transform-x-100');
		}

		handleEventClosePopup() {
			this.$popupListSong.addClass('opacity-0 invisible');
			this.$popupInner.addClass('transform-x-100');
		}

		handleEventExpoSong(e) {
			const { listSong, current: { phase } } = this.state;
			const $target = $(e.currentTarget);
			const id = $target.attr('data-expo-song');
			const data = listSong.filter(item => item.id === id)[0];
			const $song = this.get$Song(data);
	
			phase.find('tbody').append($song);
		}

		handleEventDepoSong(e) {
			const $target = $(e.currentTarget);
			const $parent = $target.closest('tr');

			$parent.remove();
		}

		handleEventMetaSeo() {
			const $selectedYear = $('[name="chuyenmuc[]"]').filter(':checked');
			const textYear = $selectedYear.parent().text().trim();
			const title = $('[name="title"]').val();
			const slug = toSlug($('[name="title"]').val());
			const excerpt = $('[name="excerpt"]').val();
			const defaultExcerpt = `Thánh ca hàng tuần ${title} - ${textYear} biên soạn theo lịch phụng vụ, chuẩn bài hát được cho phép hát trong thánh lễ`;
			const keywork = `${title} - ${textYear}, bài hát ${title} - ${textYear}, soạn bài hát ${title} - ${textYear}`;

			$('[name="seotitle"]').val(title).parent(".bmd-form-group").addClass('is-filled');
			$('[name="seourl"]').val(slug).parent(".bmd-form-group").addClass('is-filled');
			$('[name="seodes"]').val(excerpt || defaultExcerpt).parent(".bmd-form-group").addClass('is-filled');
			$('[name="seokeywork"]').val(keywork).parent(".bmd-form-group").addClass('is-filled');

			$('.seo-title').text(title);
			$('.seo-url').text(`http://hopamthanhca.com/weekly/${slug}`);
			$('.seo-desc').text(excerpt);
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
			const $listSong = this.get$ListSong(listSong);
						
			this.$listSong.append($listSong);
			$body.removeClass('loading');
			this.state = { ...this.state, listSong }
		}

		get$PhaseTemplate(id) {
			const phaseName = this.$selectPhase.find(`option[value="${id}"]`).text();
			const phaseSlug = this.$selectPhase.find(`option[value="${id}"]`).data('slug');
			const bgColor = (phaseSlug) => {
				switch (phaseSlug) {
					case 'nhap-le': return 'bg-info';
					case 'dap-ca': return 'bg-success';
					case 'ca-tiep-lien': return 'bg-danger';
					case 'dang-le': return 'bg-info';
					case 'hiep-le': return 'bg-warning';
					case 'ket-le': return 'bg-primary';
				}
			}

			return `
				<div class='row mb-2' data-phase data-phase-id='${id}' data-phase-slug='${phaseSlug}' data-phase-name='${phaseName}'>
					<div class='col-12 col-md-3'>
						<div class='h-100 min-h-75 p-2 ${bgColor(phaseSlug)} rounded text-light position-relative'>
							<h5 class='font-weight-bold'>${phaseName}</h5>
							<div class='d-flex flex-column position-absolute top-2 right-2'>
								<button class='p-0 border-0 text-light bg-transparent cursor-pointer' type='button' data-del-phase>
									<i class="d-block text-sm material-icons">close</i>
								</button>
							</div>
						</div>
					</div>
					<div class='col-12 col-md-9 d-flex flex-column justify-content-end'>
						<div class='w-100 pr-5' data-list-songs>
							<table class='table table-no-border mb-0'>
								<tbody></tbody>
							</table>
						</div>
						<div class='w-100 d-flex align-items-center'>
							<div class='w-100 mr-3 border-bottom'></div>
							<button class='p-0 border text-black-50 rounded-circle bg-transparent' type='button' data-popup-select>
								<i class="d-block material-icons">play_for_work</i>
							</button>
						</div>
					</div>
				</div>
			`;
		}

		get$ListSong(data) {
			return `
				<table class="table">
					<tbody>
						${data.map(({ id, title, cat, excerpt }) => {
							return `
								<tr>
									<td>
										<span class="text-primary">${title}</span>
										<small>- ${cat['tac-gia'][0].cat_name}</small>
										<small class="d-block text-muted">${excerpt.substr(0, 40)}...</small>
									</td>
									<td class="td-actions text-right">
										<button class="btn btn-info" data-expo-song=${id}>
											<i class="material-icons">system_update_alt</i>
										</button>
									</td>
								</tr>
							`
						}).join('')}
					</tbody>
				</table>
			`;
		}

		get$Song({
			id,
			title,
			cat,
			excerpt,
		}) {
			const { current: { phaseSlug } } = this.state;
			const textColor = () => {
				switch (phaseSlug) {
					case 'nhap-le': return 'text-info';
					case 'dap-ca': return 'text-success';
					case 'ca-tiep-lien': return 'text-danger';
					case 'dang-le': return 'text-info';
					case 'hiep-le': return 'text-warning';
					case 'ket-le': return 'text-primary';
				}
			}

			return `
				<tr data-song-id=${id}>
					<td>
						<div class='text-muted ${textColor()}'>${title} - ${cat['tac-gia'][0].cat_name}</div>
						<input type='hidden' name='${phaseSlug}[]' value='${id}' />
					</td>
					<td>
						<small class='text-muted'>${excerpt.substr(0, 60)}...</small>
					</td>
					<td class='td-actions text-right'>
						<button class="btn btn-link btn-danger" data-depo-song type='button'>
							<i class="material-icons">close</i>
						</button>
					</td>
				</tr>
			`;
		}
	}

	$("[data-weekly-add]").length && new WeeklyAdd($("[data-weekly-add]"));
});
