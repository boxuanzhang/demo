<template>
	<div id="main">
		<ve-bar :data="chartData" :settings="chartSettings" ref="chart"></ve-bar>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				chartData: null,
				chartSettings: {
					roseType: 'radius'
				}
			}
		},

		methods: {
			loadData() {
				axios.get('/api/v1/ips/cc')
					.then(response => {
						this.chartData = {
							columns: ['Economy', 'Total'],
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

		created() {
			this.loadData()
		},

		// watch: {
		// 	activeName (v) {
		// 		this.$nextTick(_ => {
		// 			this.$refs[`chart${v}`].echarts.resize()
		// 		})
		// 	}
		// }
	}
</script>