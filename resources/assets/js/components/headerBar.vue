<template>
  <!-- 头部组件 -->
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
        <el-button type="success"
                   @click.stop="toLogin(true,0)"
                   plain>登录</el-button>
        <el-button type="danger"
                   @click.stop="toLogin(true,1)"
                   plain>注册</el-button>
      </div>
      <!-- <router-view name="login"></router-view> -->
      <login v-if="islogin"
             @toLogin="toLogin"
             :istype="istype" />
    </div>
  </div>
</template>

<script>
import hover from './hover'
import login from './login'
export default {
  name: "headerBar",
  data () {
    return {
      seach: "",
      islogin: false,
      istype: ""
    }
  },
  components: {
    hover,
    login
  },
  methods: {
    //去搜索
    toSeach () {
      console.log(0)
    },
    //去登录
    toLogin (b, c) {
      this.islogin = b
      this.istype = c
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