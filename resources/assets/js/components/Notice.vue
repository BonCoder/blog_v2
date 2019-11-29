<template>
    <el-col class="tag">
        <el-card class="box-card">
            <div slot="header" class="d-flex align-items-center">
                <i class="el-icon-data-board"></i>
                <span>小白板</span>
            </div>
            <div class="text">
                {{configs.notice}}
            </div>
            <div class="clear"></div>
        </el-card>
    </el-col>
</template>

<script>
    export default {
        name: 'tag',
        computed:{
            configs(){
                let configs = this.$store.getters.getConfigs;
                let hasMessage =  localStorage.getItem('Message');
                let hasUrgentMessage = localStorage.getItem('UrgentMessage');
                if(configs.message && configs.message != hasMessage){
                    localStorage.setItem('Message', configs.message);
                    this.$notify({
                        title: '你好,',
                        message: configs.message,
                        type: 'info',
                        duration:6000
                    });
                }
                if(configs.urgent_message && configs.urgent_message != hasUrgentMessage) {
                    localStorage.setItem('UrgentMessage', configs.urgent_message);
                    this.$notify({
                        title: '紧急通知',
                        message: configs.urgent_message,
                        type: 'warning',
                        offset: 100,
                        dangerouslyUseHTMLString: true,
                        duration:0
                    });
                }
                return this.$store.getters.getConfigs;
            }
        }
    }
</script>

<style scoped lang="scss">
    .box-card .item:hover {
        color: #409EFF;
        cursor: pointer;
    }
    .text{
        font-size: 14px;
    }
    .clear{
        clear: both;
    }
</style>