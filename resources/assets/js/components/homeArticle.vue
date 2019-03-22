<template>
  <div class="homeArticle">
    <div class="imgs">
      <img src="https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=2378606792,1096904360&fm=27&gp=0.jpg"
           alt="">
      <div class="imgs-conat">
        vConsole 让你在手机上也能轻63464松调试网页vConsole 让你在sasadasd
      </div>
    </div>
    <div class="homeArticle-detatil">
      vConsole 让你在手机上也能轻63464松调试网页vConsole 让你在sasadasd
    </div>
    <div class="homeArticle-bottom">
      <span>2018-05-15</span> <span>684</span> <span>5545</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "homeArticle"
}
</script>

<style lang='scss'>
@keyframes fadeIn {
  0% {
    opacity: 0; /*初始状态 透明度为0*/
  }
  25% {
    opacity: 0.25; /*中间状态 透明度为0*/
  }
  50% {
    opacity: 0.5; /*中间状态 透明度为0*/
  }
  75% {
    opacity: 0.75; /*中间状态 透明度为0*/
  }
  100% {
    opacity: 1; /*结尾状态 透明度为1*/
  }
}
.homeArticle {
  float: left;
  position: relative;
  margin: 2%;
  width: 29%;
  height: 260px;
  border-radius: 4px;
  overflow: hidden;
  border: 1px solid #e6ebf5;
  box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.05);
  .imgs {
    position: relative;
    width: 100%;
    height: 150px;
    overflow: hidden;
    img {
      width: 100%;
      height: 100%;
      transition: 0.5s all;
    }
    &-conat {
      padding: 10%;
      position: absolute;
      top: 40px;
      width: 80%;
      height: 80%;
      font-size: 0.8rem;
      line-height: 1.4rem;
      background: rgba(0, 0, 0, 0.3);
      opacity: 0;
      transition: 0.2s all;
      color: #ffffff;
    }
  }
  .imgs:hover img {
    transform: scale(1.1);
  }
  .imgs:hover .imgs-conat {
    -webkit-animation-name: fadeIn; /*动画名称*/
    -webkit-animation-duration: 0.75s; /*动画持续时间*/
    -webkit-animation-iteration-count: 1; /*动画次数*/
    -webkit-animation-delay: 0s; /*延迟时间*/
    top: 0px;
    opacity: 1;
  }
  &-detatil {
    font-size: 1rem;
    color: #4a4c4e;
    line-height: 28px;
    padding: 8px 10px;
    height: 50px;
    overflow: hidden;
    -webkit-line-clamp: 2;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    margin: 4px 0;
  }
  &-bottom {
    padding: 0 10px;
    height: 26px;
    position: absolute;
    bottom: 0;
    font-size: 0.8rem;
    text-decoration: none;
    color: #999;
  }
}
</style>
