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
		}

		initState() {
			this.state = {
				current: { id: null, phase: null },
				listSong: [],
			}
		}

		handleEvent() {
			// SELECT PHASE
			this.$selectPhase.on('changed.bs.select', this.handleEventSelectPhase.bind(this));

			// ADD SONE
			this.$element
				.off('click.showPopupSelect')
				.on('click.showPopupSelect', '[data-popup-select]', this.handleEventShowPopupSelect.bind(this));
		}

		handleEventSelectPhase() {
			const id = +this.$selectPhase.selectpicker('val');
			const $phase = this.getPhaseTemplate(id);

			this.$contentPhase.append($phase);
			this.$selectPhase.val(0).selectpicker('render');
		}

		handleEventShowPopupSelect(e) {
			const $target = $(e.target);
			const $phase = $target.closest('[data-phase]');
			const id = $phase.find('[name="phaseName"]').val();
			const phase = $phase.find('[data-list-songs]');
			const htmlTemplateSelect = `
				<div class="form-group bmd-form-group">
					<input type="text" class="form-control">
				</div>
			`;

			this.state = { ...this.state, current: { id, phase } };

			swal({
				title: `Chọn bài hát`,
				html: htmlTemplateSelect,
				showCancelButton: true,
			});
		}

		getPhaseTemplate(id) {
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
				<div class='row mb-2' data-phase>
					<div class='col-12 col-md-3'>
						<div class='h-100 min-h-75 p-2 ${bgColor(phaseSlug)} rounded text-light position-relative'>
							<h5 class='font-weight-bold'>${phaseName}</h5>
							<input name='phaseName' value='${id}' type='hidden'/>
							<div class='d-flex flex-column position-absolute top-2 right-2'>
								<button class='p-0 border-0 text-light bg-transparent cursor-pointer' type='button'>
									<i class="d-block text-sm material-icons">close</i>
								</button>
								<button class='p-0 border-0 text-light bg-transparent cursor-pointer' type='button'>
									<i class="d-block text-sm material-icons">arrow_drop_up</i>
								</button>
								<button class='p-0 border-0 text-light bg-transparent cursor-pointer' type='button'>
									<i class="d-block text-sm material-icons">arrow_drop_down</i>
								</button>
							</div>
						</div>
					</div>
					<div class='col-12 col-md-9'>
						<div class='pr-5' data-list-songs></div>
						<div class='d-flex align-items-center'>
							<div class='w-100 border-bottom mr-3'></div>
							<button class='p-0 border text-black-50 rounded-circle bg-transparent' type='button' data-popup-select>
								<i class="d-block material-icons">add</i>
							</button>
						</div>
					</div>
				</div>
			`;
		}

		async fetchListSong() {
			const { host, origin, pathname } = window.location;
			const apiUrl = `${origin}${host === 'localhost' ? /\/hopamthanhca_admin\//.exec(pathname)[0] : ''}/song/listAllSongs`;
			const $card = this.$element.find('[data-card-phase]');
			const listSong = await new Promise((reslove, reject) => {
				$card.addClass('loading');
				fetch(apiUrl)
					.then(res => res.json())
					.then(ret => {
						reslove(ret);
						$card.removeClass('loading');
					});
			});

			this.state = { ...this.state, listSong }
		}
	}

	$("[data-weekly-add]").length && new WeeklyAdd($("[data-weekly-add]"));
});
