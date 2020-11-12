<template>
    <el-container style="height: 700px; border: 1px solid #eee">
        <el-aside>
            <el-menu style="height: 500px;">
                <el-header style="text-align: center; font-size: 12px">
                    Search
                </el-header>
                <el-menu-item>
                    <el-input placeholder="By partial name" v-model="name">
                        <template slot="prepend">Name</template>
                    </el-input>
                </el-menu-item>
                <el-menu-item>
                    <select-component :max="10" :prepend="'bedrooms'" v-model="bedrooms" @updateQueryParam="updateBedrooms"/>
                </el-menu-item>

                <el-menu-item>
                    <select-component :max="5" :prepend="'bathrooms'" v-model="bathrooms" @updateQueryParam="updateBathrooms"/>
                </el-menu-item>

                <el-menu-item>
                    <select-component :max="8" :prepend="'storeys'" v-model="storeys" @updateQueryParam="updateStoreys"/>
                </el-menu-item>

                <el-menu-item>
                    <select-component :max="8" :prepend="'garages'" v-model="garages" @updateQueryParam="updateGarages"/>
                </el-menu-item>

                <el-menu-item>
                    <el-input v-model.number="prices[0]" @input="onInputMin">
                        <template slot="prepend">Min Price</template>
                    </el-input>
                    <br/>
                    <el-input v-model.number="prices[1]" @input="onInputMax">
                        <template slot="prepend">Max Price</template>
                    </el-input>
                    <br/>
                    <el-slider v-model="prices" range :min="min" :max="max"></el-slider>
                </el-menu-item>

            </el-menu>
            <el-button type="primary" icon="el-icon-search" @click="serverRequest">Search</el-button>
        </el-aside>

        <el-container>
            <el-header style="text-align: right; font-size: 12px">
                <i class="el-icon-setting" style="margin-right: 15px"></i>
            </el-header>

            <el-main>
                <el-table :data="tableData">
                    <el-table-column prop="name" label="Name"/>
                    <el-table-column prop="price" label="Price" width="140"/>
                    <el-table-column prop="bedrooms" label="Bedrooms" width="120"/>
                    <el-table-column prop="bathrooms" label="Bathrooms" width="120"/>
                    <el-table-column prop="storeys" label="Storeys" width="120"/>
                    <el-table-column prop="garages" label="Garages" width="120"/>
                </el-table>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
import 'element-ui/lib/theme-chalk/index.css';
import SelectComponent from "./SelectComponent";

export default {
    name: "DeveloperTest",
    components: {SelectComponent},
    data() {
        return {
            tableData: [],
            name: '',
            min: 0,
            max: 999999,
            prices: [0, 999999],
            bedrooms: 0,
            bathrooms: 0,
            storeys: 0,
            garages: 0,
            page: 1
        }
    },
    methods: {
        onInputMin(val) {
            this.prices = [ val, this.prices[1] ]
        },
        onInputMax(val) {
            this.prices = [ this.prices[0], val ]
        },
        updateBedrooms(bedrooms) {
            this.bedrooms = bedrooms
        },
        updateBathrooms(bathrooms) {
            this.bathrooms = bathrooms
        },
        updateStoreys(storeys) {
            this.storeys = storeys
        },
        updateGarages(garages) {
            this.garages = garages
        },
        addParam(params, paramName, paramValue) {
            if (paramValue) {
                params.append(paramName, paramValue);
            }
        },
        serverRequest () {
            const params = new URLSearchParams();
            this.addParam(params, 'name', this.name);
            this.addParam(params, 'bathrooms', this.bathrooms);
            this.addParam(params, 'bedrooms', this.bedrooms);
            this.addParam(params, 'storeys', this.storeys);
            this.addParam(params, 'garages', this.garages);

            axios.get('/api/search', {params: params})
                .then(response => {
                    if (response.data.success) {
                        this.tableData = response.data.data
                    }
                })
                .catch(error => (console.log(error)));
        }
    },
    mounted() {
        this.serverRequest();
    }
}
</script>

<style>
.el-header {
    background-color: #B3C0D1;
    color: #333;
    line-height: 60px;
}

.el-aside {
    color: #333;
}
.el-input-group__append {
    width: 300px;
}
.el-input-group__prepend {
    padding: 0 15px !important;
}

.el-input-group {
    width: 260px !important;
}

.el-select .el-input {
    width: 160px;
}
</style>
