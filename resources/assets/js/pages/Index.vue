<template>
    <div class="blog el-scrollbar__wrap">
        <el-backtop target=".page-component__scroll .el-scrollbar__wrap"></el-backtop>
        <el-row type="flex" class="row-bg" justify="center">
            <el-col :xs="24" :sm="24" :md="16" :lg="16">
                <el-row type="flex" class="row-bg lv-row-bg" justify="space-between">
                    <el-col :span="16"  class="lv-blog-side lv-page-component__scroll" id="art-side" v-loading="loading">
                        <div class="lv-scrollbar__wrap" :style="infinite_box">
                            <ul class="list">
                                <li v-for="(i , index) in articles.data"  :key="index" class="infinite-list-item">
                                    <el-row class="art-item">
                                        <div class="lv-card-shadow" :style="showModel.body">
                                            <div class="lv-blog-popover">
                                                <div style="max-width: 150px">
                                                    <el-popover
                                                            placement="top"
                                                            width="200"
                                                            trigger="hover">
                                                        <el-row  type="flex" class="row-bg" justify="space-between">
                                                            <div :span="6">
                                                                <el-avatar :size="45" :src="i.user.avatar"></el-avatar>
                                                            </div>
                                                            <div :span="14" style="margin-left:5px"><span style="margin: 5px 0;font-size: 16px;color:#F56C6C;font-weight: bold">{{i.user.username}}</span><br>
                                                                <span style="margin: 5px 0">{{i.user.introduction}}</span></div>
                                                        </el-row>
                                                        <el-divider></el-divider>
                                                        <router-link :to="{ name:'主页' ,params:{'user':i.user_id},query:{user:i.user_id}}"  >
                                                            <a href="#"><span style="color: cornflowerblue;">访问主页</span></a>
                                                        </router-link>
                                                        <router-link :to="{ name:'用户文章' ,params:{'user':i.user_id},query:{user:i.user_id}}" style="float: right"  >
                                                            <a href="#">他的博客</a>
                                                        </router-link>
                                                        <div slot="reference">
                                                            <img class="lv-avatar" :src="i.user.avatar">
                                                            <router-link class="lv-break" :to="{ name:'用户文章' ,params:{'user':i.user_id}}">
                                                                <a href="#">{{i.user.username}}</a>
                                                            </router-link>
                                                        </div>
                                                    </el-popover>
                                                </div>
                                            </div>
                                            <h5 :style="showModel.title" class="clear-title lv-border-left">
                                                <router-link :to="{name:'查看文章',params: {art_id:i.id}}"   class="art-title">{{i.title}}</router-link>
                                            </h5>
                                            <el-row class="art-info d-flex align-items-center justify-content-start">
                                                <div class="art-time" :style="showModel.time"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                                <div class="lv-clear-both"></div>
                                                <div class="d-flex align-items-center lv-float-left">
                                                    <i class="el-icon-collection-tag"></i>：
                                                    <span v-for="(t,index) in i.tags"  :key="index">
                                                            <router-link :to="{name:'标签文章',params: {tag:t.id},query:{user:i.user_id}}">
                                                                <el-tag size="mini" class="tag">{{t.name}}</el-tag>
                                                            </router-link>
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-center art-category">
                                                    <i class="el-icon-folder-opened"></i>：
                                                    <span>
                                                        <span>
                                                            <router-link :to="{name:'分类文章',params: {category:i.category.id},query:{user:i.user_id}}" >
                                                                <el-tag size="mini">{{i.category.name}}</el-tag>
                                                            </router-link>
                                                        </span>
                                                    </span>
                                                </div>
                                                <div class="lv-clear-both"></div>
                                            </el-row>
                                            <el-row class="art-body" :style="showModel.abstract">
                                                <div class="side-img hidden-sm-and-down" :style="showModel.image">
<!--                                                    <el-image class="art-banner" :src="configs.IMG_API+i.id">-->
<!--                                                        <div slot="placeholder" class="image-slot">-->
<!--                                                            <img class="art-banner" src="https://mozilan.geekadpt.cn/img/other/orange.progress-bar-stripe-loader.svg">-->
<!--                                                        </div>-->
<!--                                                    </el-image>-->
                                                    <el-image class="art-banner" :src="i.thumb">
                                                        <div slot="placeholder" class="image-slot">
                                                            <img class="art-banner" src="https://file.bobcoder.cc/blog-images/loader.svg">
                                                        </div>
                                                    </el-image>
                                                </div>
                                                <div class="side-abstract">
                                                    <router-link :to="{name:'查看文章',params: {art_id:i.id}}">
                                                        <div class="art-abstract" :style="showModel.abstract">
                                                            {{i.content}}
                                                        </div>
                                                    </router-link>
                                                </div>
                                            </el-row>
                                            <div style="display: block;width: 100%">
                                                <div class="art-more">
                                                    <router-link :to="{name:'查看文章',params: {art_id:i.id}}"   >
                                                        <el-button plain  class="art-more-button" :style="showModel.read">阅读全文</el-button>
                                                        <span class="art-more-button-sm">阅读全文</span>
                                                        <span class="art-more-simple" :style="showModel.simple_read">阅读全文</span>
                                                    </router-link>
                                                    <div class="art-time-small"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                                    <div class="art-time-simple" :style="showModel.simple_time"><i class="el-icon-time"></i>：{{i.created_at}}</div>
                                                    <div class="view"><i class="el-icon-view"></i>&#8194;{{i.click}}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <img v-show="index <= 3" class="star" src="images/star.png" />
                                    </el-row>
                                </li>
                            </ul>
                            <p v-if="loading">加载中...</p>
                            <p v-if="noMore" class="no-more">很高兴你翻到这里，但是真的没有了...</p>
                        </div>
                    </el-col>
                    <el-col :span="7" class="hidden-sm-and-down lv-tag-side" id="side" :style="infinite_side" >
                        <div class="item">
                            <Notice></Notice>
                        </div>
                        <div class="lv-clear-both"></div>
                        <div class="item lv-margin-top">
                            <HotComment></HotComment>
                        </div>
                        <div class="lv-clear-both"></div>
                        <div class="item lv-margin-top">
                            <Recommend></Recommend>
                        </div>
                        <div class="lv-clear-both"></div>
                        <div class="item lv-margin-top">
                            <Friend></Friend>
                        </div>
                        <div class="lv-clear-both"></div>
                        <div class="item lv-margin-top">
                            <Adsense></Adsense>
                        </div>
                        <div class="lv-clear-both"></div>
                        <div class="item lv-margin-top">
                            <VFooter></VFooter>
                        </div>
                    </el-col>
                    <Oauth></Oauth>
                </el-row>
            </el-col>
        </el-row>
        <whell-menu></whell-menu>
    </div>
</template>
<script>
    import Friend from '../components/Friend'
    import Oauth from '../components/Oauth'
    import Recommend from '../components/Recommend'
    import HotComment from '../components/HotComment'
    import LFooter from '../components/L-footer'
    import Adsense from '../components/Adsense'
    import Notice from '../components/Notice'
    import VFooter from '../components/global/V-Footer'
    import WhellMenu from '../components/Wheel-menu'
    import _judge_bottom from '../utils/judge_bottom'
    import BScroll from '@better-scroll/core'
    import PullUp from '@better-scroll/pull-up'
    export default {
        data () {
            return {
                scroll:{},
                loading: false,
                infinite_box:{
                    maxHeight:'',
                    overflow: 'auto',
                },
                infinite_side:{
                    maxHeight:'',
                    overflow: 'auto',
                },
            }
        },
        name: 'blog',
        components: {
            Friend,
            Oauth,
            Recommend,
            HotComment,
            LFooter,
            Adsense,
            Notice,
            VFooter,
            WhellMenu
        },
        computed:{
            noMore () {
                if(this.$store.getters.getArticles.total === undefined || this.$store.getters.getArticles.total === 0 ){
                    return true;
                }else{
                    return this.$store.getters.getArticles.current_page >= this.$store.getters.getArticles.last_page;
                }
            },
            disabled () {
                return this.loading || this.noMore
            },
            articles(){
                var data = this.$store.getters.getArticles;
                return data;
            },
            showModel(){
                return this.$store.getters.getArticleShowModel;
            },
            configs(){
                return this.$store.getters.getConfigs;
            }
        },
        watch: {
            // 如果路由有变化，会再次执行该方法
            "$route": "getArticles",
        },
        mounted(){
            document.getElementsByClassName("blog")[0].addEventListener('scroll', this.handleScroll);
        },
        created(){
            this.getArticles();
        },
        methods: {
            handleScroll() {
                if(((document.getElementById('art-side').getBoundingClientRect().bottom-115) <= _judge_bottom.getWindowHeight()) && !this.disabled){
                    this.load();
                }
            },
            getArticles(){
                if(this.$route.params.user !== undefined && this.$route.params.tag ===undefined && this.$route.params.category === undefined)
                {
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadArticles',{
                        user:this.$route.params.user ? this.$route.params.user : '',
                    });
                }else if(this.$route.params.user === undefined && this.$route.params.tag !==undefined && this.$route.params.category ===undefined){
                    //console.log("检测到tag属性");
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadUserTagArticles',{
                        user:this.$route.params.user,
                        tag:this.$route.params.tag,
                        page:'',
                    });
                }else if(this.$route.params.user === undefined&& this.$route.params.tag ===undefined && this.$route.params.category !==undefined){
                    //console.log("检测到cat属性");
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadUserCategoryArticles',{
                        user:this.$route.params.user,
                        category:this.$route.params.category,
                        page:'',
                    });
                }else{
                    this.$store.dispatch('clearArticles');
                    this.$store.dispatch('loadArticles',{
                        user:this.$route.params.user ? this.$route.params.user : '',
                    });
                }
            },
            load () {
                this.loading = true;
                setTimeout(() => {
                    if(this.$route.params.user !== undefined && this.$route.params.tag === undefined&& this.$route.params.category ===undefined)
                    {
                        this.$store.dispatch('loadArticles',{
                            user:this.$route.params.user ? this.$route.params.user :'',
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,

                        });
                    }else if(this.$route.params.user === undefined&& this.$route.params.tag !== undefined && this.$route.params.category ===undefined){
                        this.$store.dispatch('loadUserTagArticles',{
                            tag:this.$route.params.tag,
                            user:this.$route.params.user ? this.$route.params.user :'',
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                        });
                    }else if(this.$route.params.user === undefined&& this.$route.params.tag ===undefined && this.$route.params.category !==undefined){
                        this.$store.dispatch('loadUserCategoryArticles',{
                            category:this.$route.params.category,
                            user:this.$route.params.user ? this.$route.params.user :'',
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                        });
                    }else{
                        this.$store.dispatch('loadArticles',{
                            user:this.$route.params.user ? this.$route.params.user :'',
                            page: this.$store.getters.getArticles.meta === undefined ? 1 : ++this.$store.getters.getArticles.meta.pagination.current_page,
                        });
                    }
                    this.$watch(this.$store.getters.getArticlesLoadStatus, function () {
                        if(this.$store.getters.getArticlesLoadStatus() === 2) {
                            this.loading = false
                        }
                        if(this.$store.getters.getArticlesLoadStatus() === 3) {
                            this.$message.error('错了哦，加载文章失败了');
                        }
                    });
                }, 800);
            }
        },
        destroyed() {
            this.$store.dispatch('clearArticles');
            document.getElementsByClassName("blog")[0].removeEventListener('scroll', this.handleScroll);
        }
    }
</script>