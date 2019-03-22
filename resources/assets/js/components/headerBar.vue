<template>
  <div class="header">
    <div class="contant">
      <a href="http://www.baidu.com">
        <hover contant="We are all in the gutter, but some of us are looking at the stars." /></a>
      <div class="right">
        <el-input v-model="seach"
                  placeholder="搜索">
          <i slot="prefix"
             @click="toSeach"
             class="el-input__icon el-icon-search"></i>
        </el-input>
        <el-button type="danger">登录</el-button>
        <el-button type="danger">注册</el-button>
      </div>
    </div>
  </div>
</template>

<script>
import hover from './hover'
export default {
  name: "headerBar",
  data () {
    return {
      seach: ""
    }
  },
  components: {
    hover
  },
  methods: {
    toSeach () {
      console.log(0)
    }
  }
}
</script>

<style lang="scss">
.header {
  height: 52px;
  color: #66757f;
  .contant {
    height: 100%;
    width: 60%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    .right {
      display: flex;
      justify-content: space-between;
      align-items: center;
      .el-input {
        margin: 10px;
        width: 220px;
        margin-left: 200px;
      }
    }
  }
}
</style>