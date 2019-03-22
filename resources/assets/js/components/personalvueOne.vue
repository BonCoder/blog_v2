<template>
  <div class="personalvueone">
    <div class="personalvueone-avatar">
      <img src="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=2547219944,305786735&fm=27&gp=0.jpg"
           alt="">
    </div>
    <div class="personalvueone-jianjie">
      简介：
    </div>
    <div class="personalvueone-name">
      网名 : 易之晓晓
    </div>
    <div class="personalvueone-jiesao">
      个人介绍 ：现从事互联网工作，目前就职于 ~~~ 不告诉你 。本人擅长的是PHP和Linux服务器方面，不过也偶尔也做做Java游戏开发，比较喜欢的就是研究新技术，得跟上时代的脚步，不停的学习
    </div>
    <div class="personalvueone-email">
      email ：xcqweb.@163.com
    </div>
    <div class="personalvueone-created_at">
      创建时间 ：2018-05-25
    </div>
    <div class="personalvueone-updated_at">
      更新时间 ：2018-05-25
    </div>
  </div>
</template>

<script>
export default {
  name: "personalvueOne",
  data () {
    return {
      form: {
        name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '',
        desc: ''
      }
    }
  },
  methods: {
    onSubmit () {
      console.log('submit!');
    }
  }
}
</script>

<style lang="scss">
.personalvueone {
  color: #666666;
  margin: 8px 0;
  padding: 20px;
  border-radius: 2px;
  border: 0;
  background: #ffffff;
  box-shadow: 0 1px 6px 0 rgba(0, 0, 0, 0.12), 0 1px 6px 0 rgba(0, 0, 0, 0.12);
  &-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;

    float: right;
    img {
      width: 100%;
      height: 100%;
    }
  }
  &-jianjie {
    font-size: 1.25rem;
    font-weight: 800;
    color: #000000;
  }
  &-name {
    padding: 20px 6px 20px;
  }
  &-jiesao {
    padding: 10px 6px;
    line-height: 26px;
  }
  &-email {
    padding: 10px 6px;
  }
  &-created_at {
    padding: 10px 6px;
  }
  &-updated_at {
    padding: 0px 6px;
  }
}
</style>
