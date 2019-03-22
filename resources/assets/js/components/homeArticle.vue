<template>
  <div class="homeArticle">
    <div class="imgs">
      <img src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=2378606792,1096904360&fm=27&gp=0.jpg"
           alt="">
    </div>
    <div class="homeArticle-detatil">
      vConsole 让你在手机上也能轻63464松调试网页vConsole 让你在sasadasd
    </div>
    <div class="homeArticle-bottom">
      55
    </div>
  </div>
</template>

<script>
export default {
  name: "homeArticle"
}
</script>

<style lang='scss'>
.homeArticle {
  float: left;
  position: relative;
  margin: 2%;
  width: 29%;
  height: 260px;
  border-radius: 4px;
  overflow: hidden;
  .imgs {
    width: 100%;
    height: 160px;
    img {
      width: 100%;
      height: 100%;
    }
  }
  &-detatil {
    font-size: 1rem;
    color: #4a4c4e;
    line-height: 28px;
    padding: 8px 2px;
    height: 50px;
    overflow: hidden;
    -webkit-line-clamp: 2;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    margin: 4px 0;
  }
  &-bottom {
    height: 20px;
    position: absolute;
    bottom: 0;
  }
}
</style>
