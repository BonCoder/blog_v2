<template>
  <!-- 个人页面：个人信息 推荐 -->
  <div class="personalvue">
    <!-- 个人信息 -->
    <OurSelf />
    <!-- 热门推荐 -->
    <tuijian />
    <!-- 标签 -->
    <biaoqian />
    <!-- 有情链接 -->
    <lianjie />

  </div>
</template>

<script>
import OurSelf from './personalvueOne'
import lianjie from './lianjie'
import biaoqian from './biaoqian'
import tuijian from './tuijian'

export default {
  name: "personal",
  components: {
    OurSelf,
    lianjie,
    biaoqian,
    tuijian
  }
}
</script>

<style>
.personalvue {
}
</style>
