<template>
	<b-card title="IP data charts" style="margin: 20px">
		<b-tabs v-model="activeName">
			<b-tab title="Economy">
				<ve-bar :data="economyChartData" :settings="economyChartSettings" ref="0"></ve-bar>
			</b-tab>
			<b-tab title="Type">
				<ve-pie :data="typeChartData" :settings="typeChartSettings" ref="1"></ve-pie>
			</b-tab>
			<b-tab title="Economy and Type">
				<ve-histogram :data="economyTypeChartData" :settings="economyTypeChartSettings" ref="2"></ve-histogram>
			</b-tab>
			<b-tab title="Years">
				<ve-line :data="yearChartData" :settings="yearChartSettings" ref="3"></ve-line>
			</b-tab>
		</b-tabs>
	</b-card>
</template>

<script>
	import EconomyType from '../components/EconomyType'
	import Year from '../components/Year'

	export default {
		components: {
			EconomyType,
			Year
		},

		data() {
			return {
				activeName: null,
				economyChartData: null,
				economyChartSettings: {},
				typeChartData: null,
				typeChartSettings: {
					roseType: 'radius'
				},
				economyTypeChartData: null,
				economyTypeChartSettings: {},
				yearChartData: null,
				yearChartSettings: {}
			}
		},

		methods: {
			loadEconomyChartData() {
				axios.get('/api/v1/ips/cc')
					.then(response => {
						this.economyChartData = {
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

			loadTypeChartData() {
				axios.get('/api/v1/ips/type')
					.then(response => {
						this.typeChartData = {
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

			loadEconomyTypeChartData() {
				axios.get('/api/v1/ips/cc_type')
					.then(response => {
						this.economyTypeChartData = {
							columns: ['cc', 'ipv4', 'ipv6', 'asn'],
							rows: Object.keys(response.data).map(i => response.data[i])
						}

						this.economyTypeChartSettings = {
							metrics: ['ipv4', 'ipv6', 'asn'],
							stack: {'all': ['ipv4', 'ipv6', 'asn']}
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

			loadYearChartData() {
				axios.get('/api/v1/ips/year')
					.then(response => {
						console.log(Object.keys(response.data).map(i => response.data[i]))
						this.yearChartData = {
							columns: ['year', 'ipv4', 'ipv6', 'asn'],
							rows: Object.keys(response.data).map(i => response.data[i])
						}

						this.yearChartSettings = {
							metrics: ['ipv4', 'ipv6', 'asn'],
							dimension: ['year']
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
			this.loadEconomyChartData()
			this.loadTypeChartData()
			this.loadEconomyTypeChartData()
			this.loadYearChartData()
		},

		watch: {
			activeName(newVal, oldVal) {
				this.$nextTick(_ => {
					this.$refs[`${newVal}`].echarts.resize()
				})
			}
		}
	}
</script>
