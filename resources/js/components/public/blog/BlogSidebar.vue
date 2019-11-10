<template>
    <span id="sidebar">
        <div class="span4">
            <aside class="right-sidebar">
              <div class="widget">
                <form class="form-search">
                  <input @keyup="realSearch" placeholder="Type something" type="text" v-model="keyword" class="input-medium search-query">
                  <button type="submit" @click.prevent="realSearch" class="btn btn-square btn-theme">Search</button>
                </form>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Categories</h5>
                <ul class="cat">
                  <li v-for="category in allCategories">
                    <i class="icon-angle-right"></i><router-link :to="`/categories/${category.id}`">{{category.category_name}}</router-link><span>(10)</span>
                  </li>
                </ul>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Latest posts</h5>
                <ul class="recent">
                  <li v-for="(post,index) in blogpost" v-if="index<5">
                    <img :src="`uploadImage/${post.photo}`" class="pull-left" alt="" height="150" width="120" />
                    <h6><router-link :to="`/blog-post/${post.id}`">{{post.title | shortlength(50,"....")}}</router-link></h6>
                    <p>
                      {{post.description | shortlength(100,"....")}}
                    </p>
                  </li>
                </ul>
              </div>
            </aside>
          </div>
    </span>
</template>

<script>
  import _ from 'lodash'
    export default {
        name: "BlogSidebar",
        data(){
          return {
              keyword: ''
          }
        },
        computed:{
            allCategories(){
               return this.$store.getters.allCategories
           },
            blogpost(){
                return this.$store.getters.getBlogPost
            }

        },
        mounted(){
            this.$store.dispatch('getBlogPost')
            this.$store.dispatch('allCategories')
        },
        methods:{
            realSearch(){
                this.$store.dispatch('SearchPost',this.keyword);
            },
            realSearch:_.debounce (function () {
                this.$store.dispatch('SearchPost',this.keyword);
            },1000)
        }
    }
</script>