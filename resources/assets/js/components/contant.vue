<template>
  <!-- 主页文章内容 -->
  <div class="navcontant">
    <homeArticle />
    <homeArticle />
    <homeArticle />
    <div class="pages">
      <el-pagination @size-change="handleSizeChange"
                     @current-change="handleCurrentChange"
                     :current-page.sync="currentPage3"
                     :page-size="100"
                     layout="prev, pager, next, jumper"
                     :total="1000">
      </el-pagination>
    </div>
  </div>
</template>

<script>
import homeArticle from './homeArticle.vue'
export default {
  name: "contant",
  components: {
    homeArticle
  },
  methods: {
    handleSizeChange (val) {
      console.log(`每页 ${val} 条`);
    },
    handleCurrentChange (val) {
      console.log(`当前页: ${val}`);
    }
  },
  data () {
    return {
      currentPage1: 5,
      currentPage2: 5,
      currentPage3: 5,
      currentPage4: 4
    };
  }
}
</script>

<style lang='scss'>
.navcontant {
  margin: 8px 4px;
  height: 93%;
  padding: 20px;
  border: 1px solid #e1e8ed;
  background-color: #ffffff;
  border-radius: 4px;
  position: relative;
  .pages {
    bottom: 0;
    right: 0;
    position: absolute;
    width: 100%;
    padding: 20px 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }
}
</style>
