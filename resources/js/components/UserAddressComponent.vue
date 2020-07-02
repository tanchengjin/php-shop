<template>
    <div>
        <div class="card">
            <div class="card-header">
                我的地址
            </div>
            <div class="card-body" id="app">
                <form action="#">
                    <div class="form-group row">
                        <label for="/" class="col-2 col-form-label text-right">省市区</label>
                        <div class="col-3">
                            <select name="province" id="province" class="form-control" v-model="provinceId">
                                <option value="">请选择省</option>
                                <option v-for="(name,id) in provinces" :value="id">{{ name }}</option>
                            </select>
                        </div>

                        <div class="col-3">
                            <select name="city" id="city" class="form-control" v-model="cityId">
                                <option value="">请选择市</option>
                                <option v-for="(name,id) in cities" :value="id">{{ name }}</option>
                            </select>
                        </div>

                        <div class="col-3">
                            <select name="district" id="district" class="form-control" v-model="districtId">
                                <option value="">请选择区</option>
                                <option v-for="(name,id) in districts" :value="id">{{ name }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-2 col-form-label text-right">详细地址</label>
                        <div class="col-9">
                            <input type="text" name="district" class="form-control" id="address">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact_name" class="col-2 col-form-label text-right">联系人</label>
                        <div class="col-9">
                            <input type="text" name="contact_name" class="form-control" id="contact_name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact_phone" class="col-2 col-form-label text-right">联系电话</label>
                        <div class="col-9">
                            <input type="text" name="contact_phone" class="form-control" id="contact_phone">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="code" class="col-2 col-form-label text-right">邮编</label>
                        <div class="col-9">
                            <input type="text" name="contact_phone" class="form-control" id="code">
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary" type="submit">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    const addressData = require('china-area-data/v5/data');
    export default {
        mounted() {
            console.log(32123)
        },
        data() {
            return {
                provinces: addressData['86'],
                cities: {},
                districts: {},
                provinceId: '',
                cityId: '',
                districtId: '',
            };
        },
        watch: {
            provinceId(val) {
                if (!val) {
                    this.cities = {};
                    this.cityId = '';
                    return;
                }

                this.cities = addressData[val];

                if (!this.cities[this.cityId]) {
                    this.cityId = '';
                }
            },
            cityId(val) {
                if (!val) {
                    this.districts = {};
                    this.districtId = '';
                }
                this.districts = addressData[val];
                if (!this.districts[this.districtId]) {
                    this.districtId = '';
                }

            },
            districtId(val) {
                this.$mount('change', this.provinces[this.provinceId], this.cities[this.cityId], this.districts[this.districtId]);
            }
        }
    }
</script>

<style scoped>

</style>
