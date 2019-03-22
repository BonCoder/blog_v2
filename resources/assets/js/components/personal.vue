<template>
  <!-- 个人页面：个人信息 推荐 -->
  <div class="personalvue">
    <OurSelf />
  </div>
</template>

<script>
import OurSelf from './personalvueOne'
export default {
  name: "personal",
  components: {
    OurSelf
  }
}
</script>

<style>
.personalvue {
  margin: 8px 0;
  height: 100%;
  padding: 20px;
  border-radius: 2px;
  border: 0;
  background: #ffffff;
  box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.12), 0 1px 6px 0 rgba(0, 0, 0, 0.12);
}
</style>
