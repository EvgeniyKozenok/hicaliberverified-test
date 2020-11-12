<template>
    <el-input style="width: 0;" class="customize-select">
        <el-select slot="append" v-model="curValue" placeholder="Select" @change="propsChangeHandler">
            <el-option
                v-for="item in selectOptions"
                :key="item.value"
                :label="item.label"
                :value="item.value">
            </el-option>
        </el-select>
        <template slot="prepend">{{ prepend }}</template>
    </el-input>
</template>

<script>
export default {
    name: "SelectComponent",
    props: ['value', 'prepend', 'max'],
    methods: {
        propsChangeHandler() {
            this.$emit('updateQueryParam', this.curValue);
        }
    },
    computed: {
        selectOptions() {
            let opt = [];
            opt.push({value: 0, label: 'Select'})
            for (let i = 1; i < this.max + 1; i++) {
                opt.push({value: i, label: i})
            }
            return opt;
        }
    },
    data() {
        return {
            curValue: this.value
        }
    }
}

</script>

<style>
.customize-select > .el-input__inner {
    width: 0;
    margin: 0;
    padding: 0;
    border-left: none;
}
.customize-select .el-select {
    min-width: 150px;
}
.customize-select .el-input-group__append {
    background-color: #fff;
}
</style>
