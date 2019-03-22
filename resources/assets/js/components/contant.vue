<template>
  <div class="navcontant">
    <homeArticle />
    <homeArticle />
    <homeArticle />
  </div>
</template>

<script>
import homeArticle from './homeArticle.vue'
export default {
  name: "contant",
  components: {
    homeArticle
  }
}
</script>

<style>
.navcontant {
  height: 100%;
  padding: 20px;
  background: #eeeeee;
}
</style>
