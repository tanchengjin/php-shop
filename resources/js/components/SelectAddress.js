const address = require('china-area-data/v5/data');

Vue.component('select-address', {
    data() {
        return {
            provinces: address['86'],
            cities: {},
            districts: {},
            provinceId: '',
            cityId: '',
            districtId: '',
        };
    },
    created() {
    },
    watch: {
        provinceId(val) {
            if (!val) {
                this.cities = {};
                this.cityId = '';
                return;
            }
            this.cities = address[val];
            if(!this.cities[this.cityId]){
                this.cityId='';
            }
        },
        cityId(val) {
            if (!val){
                this.districts={};
                this.districtId='';
                return;
            }
            this.districts=address[val];
            if(!this.districts[this.districtId]){
                this.districtId ='';
            }
        },
        districtId(val) {
            this.$emit('change',[this.provinces[this.provinceId],this.cities[this.cityId],this.districts[this.districtId]])
        }
    }
});
