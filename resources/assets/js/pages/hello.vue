<template>
    <div>
        <h1>Hello, Larvuent!!!</h1>
        <el-button @click="visible = true">按钮</el-button>
        <el-dialog title="欢迎"
                   :visible.snc="visible"
                   :before-close="handleClose"
        >
            <p>欢迎使用 Element</p>
        </el-dialog>
        <div v-for="(item,index) in list" :key="index">{{ item.title }}</div>
    </div>
</template>

<script>
import request from '../utils/request'

export default {
    name: 'index',
    data() {
        return {
            visible: false,
            list: []
        }
    },
    created() {
        this.getList()
    },
    methods: {
        handleClose(done) {
            done();
        },
        getList() {
            request.get('api/v1/article', this.form)
                .then(({data}) => {
                    this.list = data
                }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>

<style>
    .hello {
        font-size: 2em;
        color: green;
    }
</style>