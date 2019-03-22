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
  margin: 8px 4px;
  height: 100%;
  padding: 20px;
  border: 1px solid #e1e8ed;
  background-color: #ffffff;
  border-radius: 4px;
}
</style>
