<template>
    <span id="singleblog">
        <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article>
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><a href="#">{{singlePost.title}}</a></h3>
                    </div>
                    <img :src="`uploadImage/${singlePost.photo}`" alt=""/>
                  </div>
                  <p>
                    {{singlePost.description}}
                  </p>

                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li v-if="singlePost.user"><i class="icon-user"></i><a href="#">{{ singlePost.user.name }}</a></li>
                      <li v-if="singlePost.category"><i class="icon-tags"></i><a href="#">{{ singlePost.category.category_name }}</a></li>
                      <li><i class="icon-calendar"></i>{{ singlePost.created_at | timeformat}}</li>
                    </ul>
                  </div>
                </div>
              </div>
            </article>
          </div>
          <BlogSidebar/>
        </div>
      </div>
    </section>
    </span>
</template>

<script>
    import BlogSidebar from "./BlogSidebar.vue"
    export default {
        name: "SingleBlog",
        components:{
            BlogSidebar
        },
        mounted(){
            this.$store.dispatch('getPostById',this.$route.params.id);
        },
        computed:{
            singlePost(){
              return  this.$store.getters.getPostById
            }
        },
        methods:{

        },
        watch:{
            $route(to,from){
                this.$store.dispatch('getPostById',this.$route.params.id);
            }
        }
    }
</script>