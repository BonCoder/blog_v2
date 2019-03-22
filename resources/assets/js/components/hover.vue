<template>
  <div class="hover">
    <div class="contain"
         :class="isActive?'isClick':''">{{contant}}</div>
    <div :class="isActive?'isClick1':''"
         class="bottom"></div>
  </div>
</template>

<script>
export default {
  name: "hover",
  props: ["contant", "isActive"]
}
</script>

<style lang='scss'>
.hover {
  min-width: 0px;
  height: 100%;
  position: relative;
  overflow: hidden;
  color: #66757f;
  .contain {
    padding: 0 10px;
    font-size: 1rem;
    justify-content: center;
    height: 100%;
    display: flex;
    align-items: center;
  }
  .bottom {
    position: absolute;
    width: 100%;
    height: 4px;
    background: #09f;
    bottom: -4px;
    transition: all 0.3s;
  }
}
.isClick {
  color: #09f;
}
.isClick1 {
  bottom: 0px !important;
}
.hover:hover {
  color: #09f;
}
.hover:hover .bottom {
  bottom: 0px;
}
</style>
