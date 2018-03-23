<template>
	<div id="main">
		<ve-pie :data="chartData" :settings="chartSettings"></ve-pie>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				chartData: {},
				chartSettings: {
					roseType: 'radius'
				}
			}
		},

		methods: {
			resizeMainContainer() {
				let mainContainer          = document.getElementById('main')
				mainContainer.style.width  = window.innerWidth + 'px'
				mainContainer.style.height = window.innerHeight * 0.8 + 'px'
			},

			loadData() {
				axios.get('/api/v1/ips/type')
					.then(response => {
						this.chartData = {
							columns: ['Type', 'Total'],
							rows: response.data
						}
					})
					.catch(error => {
						if (error.response.data.errors) {
							alert(error.response.data.errors.join("\n"))
						} else {
							alert('Sorry, something went wrong. Please reload the page and try again.')
						}
					})
			},
		},

		mounted() {
			console.log('111')
			this.loadData()
			this.resizeMainContainer()
		},
	}
</script>