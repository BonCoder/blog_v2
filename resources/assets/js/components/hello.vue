<template>
    <div>
        <h1>Hello, Larvuent!</h1>
        <el-button @click="visible = true">按钮</el-button>
        <el-dialog title="欢迎"
                   :visible.snc="visible"
                   :before-close="handleClose"
        >
            <p>欢迎使用 Element</p>
        </el-dialog>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                visible: false
            }
        },
        methods:{
            handleClose(done){
                done();
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