<template>
  <div id="app">
    <!-- 公共头部组件 -->

    <head />
    <!-- 主页大图 -->
    <div class="banner"></div>
    <navBar />
    <!-- 主要部分 -->
    <div class="main">
      <div class="main-contant">
        <!-- 广告位置 -->
        <!-- <div class="main-contant-guanggao">
          <guanggao />
        </div> -->
        <!-- 文章 -->
        <div class="main-contant-contant">
          <contant />
        </div>
        <!-- 个人信息 -->
        <div class="main-contant-personal">
          <personal />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import head from './components/head'
import navBar from './components/navBar'
import contant from './components/contant'
import personal from './components/personal'
export default {
  data () {
    return {
      msg: 's'
    }
  },
  components: {
    head,
    navBar,
    personal,
    contant
  }
}
</script>

<style lang="scss">
html,
body {
  font-family: "PingFang SC";
  width: 100%;
  height: 100%;
}
body,
div,
dl,
dt,
dd,
ul,
ol,
li,
h1,
h2,
h3,
h4,
h5,
h6,
pre,
code,
form,
fieldset,
legend,
input,
texarea,
p,
blockquote,
th,
td {
  margin: 0px;
  padding: 0px;
}
a {
  text-decoration: none;
}
#app {
  width: 100%;
  height: 100%;
  .banner {
    width: 100%;
    height: 395px;
    background: url("https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1553739689&di=7e1ce9a30665bb9d4de7c4a268460b2d&imgtype=jpg&er=1&src=http%3A%2F%2Fattimg.dospy.com%2Fimg%2Fday_100221%2F20100221_3895f3db24c21f064c35Q7StqsweChDs.jpg")
      no-repeat center;
    background-size: cover;
  }
  .main {
    background: #eeeeee;
    &-contant {
      width: 60%;
      margin: 0 auto;
      min-height: 600px;
      display: flex;
      &-contant {
        flex: 3;
      }
      &-personal {
        flex: 1;
      }
    }
  }
}
/* width */
::-webkit-scrollbar {
  width: 8px;
}

/* Track */
::-webkit-scrollbar-track {
  background: rgb(255, 255, 255);
  border-radius: 8px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #09f;
  border-radius: 8px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #06f;
}
</style>