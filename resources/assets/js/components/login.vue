<template>
  <div class="login"
       @mousewheel.preven>
    <div class="login-contant">
      <div class="login-contant-title">
        {{istype== 0 ?"登录":"注册"}}
      </div>
      <el-form :model="user"
               label-width="80px">
        <el-form-item label="用户名">
          <el-input v-model="user.name"
                    placeholder="请输入用户名"
                    type="text"></el-input>
        </el-form-item>
        <el-form-item prop="email"
                      label="邮箱">
          <el-input v-model="user.email"
                    placeholder="请输入邮箱"></el-input>
        </el-form-item>
        <el-form-item label="密码">
          <el-input v-model="user.password"
                    placeholder="请输入密码"
                    type="password"></el-input>
        </el-form-item>
        <el-form-item v-if="istype =='1'"
                      label="确认密码">
          <el-input v-model="user.surePass"
                    placeholder="请再次输入密码"
                    type="password"></el-input>
        </el-form-item>
        <el-form-item v-if="istype =='1'"
                      label="验证码">
          <el-input v-model="user.code"
                    placeholder="请输入验证码"
                    type="text">
            <el-button :type="timer>0?'info':'danger'"
                       slot="suffix"
                       plain
                       @click="getCode">{{timer>0?`${timer}s后重试`:"获取验证码"}}</el-button>
          </el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="success"
                     v-if="istype =='0'"
                     plain
                     @click="login">登录</el-button>
          <el-button type="success"
                     v-if="istype =='1'"
                     plain
                     @click="register">注册</el-button>
          <el-button type="danger"
                     plain
                     @click="$emit('toLogin',false)">取消</el-button>
        </el-form-item>
      </el-form>
    </div>
  </div>
</template>

<script>
import * as apis from '../requests/apis'
export default {
  name: 'login',
  props: ['istype'],
  data () {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        surePass: "",
        code: ""
      },
      timer: 0
    }
  },
  created () {
    // var mo = function (e) { e.preventDefault(); };
    // document.body.style.overflow = 'hidden';
    // document.addEventListener("touchmove", mo, false);//禁止页面滑动
  },
  methods: {
    //获取验证码
    getCode () {
      this.timer = 10
      let a = setInterval(() => {
        if (this.timer > 0) {
          this.timer--
        } else {
          clearInterval(a)
        }
      }, 1000)
    },
    //登录
    login () {
      // this.$http.post(apis.LOGIN, {
      //   username,
      //   password
      // })
      //   .then((resp) => {
      //     if (resp.data.code === 200 && resp.data.errorMsg === 'OK') {
      //       this.loginSuccess(resp.data.data)
      //     }
      //   })
      console.log("登录")
    },
    //注册
    register () {
      //邮箱校验
      let re = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/;
      if (!re.test(this.user.email)) {
        this.$message({
          message: '请正确输入邮箱',
          type: 'warning'
        });
        return
      }
      console.log(this.user.code)
      if (this.user.name == "") {
        this.$message({
          message: '请输入邮箱',
          type: 'warning'
        });
        return
      }
      if (this.user.password == "") {
        this.$message({
          message: '请输入密码',
          type: 'warning'
        });
        return
      }
      if (this.user.password !== this.user.surePass) {
        this.$message({
          message: '密码输入不一致',
          type: 'warning'
        });
        return
      }
      if (this.user.code == "") {
        this.$message({
          message: '验证码不能为空',
          type: 'warning'
        });
        return
      }
    }
  }
}
</script>

<style lang='scss'>
.login {
  position: fixed;
  background: rgba($color: #000000, $alpha: 0.4);
  top: 0;
  left: 0;
  z-index: 99;
  width: 100%;
  height: 100%;
  &-contant {
    width: 400px;
    min-height: 260px;
    margin: 122px auto;
    background: #ffffff;
    border-radius: 4px;
    overflow: hidden;
    padding: 20px 20px;
    .el-input {
      width: 90%;
      .el-input__suffix {
        right: 0;
      }
    }
    .el-form {
      width: 100%;
    }
    &-title {
      padding: 10px 0 15px 0;
      text-align: center;
      font-size: 1.6rem;
      color: #000000;
      font-weight: 500;
    }
  }
}
</style>
