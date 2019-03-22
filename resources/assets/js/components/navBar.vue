<template>
  <div class="nav"
       id="nav"
       :class="isFixed== true?'isFixed':''">
    <div class="nav-contant">
      <div class="nav-contant-logo">

      </div>
      <div style="flex:1;">
        <div style="float:left;height:100%;"
             v-for="i in nav"
             :key="i.item">
          <el-dropdown>
            <div class="contantNav-one">
              <hover :contant="i.item"
                     :isActive="i.isActive" />
            </div>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>黄金糕</el-dropdown-item>
              <el-dropdown-item>狮子头</el-dropdown-item>
              <el-dropdown-item>螺蛳粉</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>
      </div>
      <div class="right">
        <span>当前在 : &nbsp;网站首页</span>
      </div>
    </div>
  </div>
</template>

<script>
import hover from './hover'
export default {
  name: "navBar",
  data () {
    return {
      isFixed: false,
      nav: [
        { item: "网站首页", isActive: true },
        { item: "编程语言", isActive: false },
        { item: "服务器技术", isActive: false },
        { item: "前端技术", isActive: false }
      ]
    }
  },
  components: {
    hover
  },
  computed: {
    offsetTop () {
      return document.querySelector('#nav').offsetTop
    }
  },
  methods: {
    //在methods监控滚动时间
    handleScroll () {
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop
      console.log(scrollTop > this.offsetTop)
      scrollTop > this.offsetTop ? this.isFixed = true : this.isFixed = false
    },

  },
  mounted () {
    window.addEventListener('scroll', this.handleScroll);
  },
  destroyed () {
    window.removeEventListener('scroll', this.handleScroll);
  }

}
</script>

<style lang="scss">
.nav {
  background: #ffffff;
  width: 100%;
  height: 60px;
  &-contant {
    width: 80%;
    height: 100%;
    margin: 0 auto;
    display: flex;
    &-logo {
      width: 14.5%;
      height: 100%;
    }
    .contantNav {
      height: 100%;
      &-one {
        float: left;
        min-width: 50px;
        height: 100%;
      }
    }
    .right {
      width: 31.5%;
      font-size: 0.8rem;
      color: #66757f;
      display: flex;
      align-items: center;
    }
  }
  .el-dropdown {
    height: 100%;
    margin-right: 10px;
  }
}

.isFixed {
  position: fixed;
  top: 0px;
  z-index: 1004;
  box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.43);
}
</style>
