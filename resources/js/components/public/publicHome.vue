<template>
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="row">
                    <h3 class="text-center">We work with</h3>
                    <div class="span3" v-for="category in allCategories" style="padding: 5px">
                        <div class="box aligncenter">
                            <div class="aligncenter icon">
                                <i class="icon-briefcase icon-circled icon-64 active"></i>
                            </div>
                            <div class="text">
                                <router-link :to="`/categories/${category.id}`">{{category.category_name}}</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        name: "publicHome",
        computed:{
            allCategories(){
                return this.$store.getters.allCategories
            }
        },
        mounted(){
            this.$store.dispatch('getBlogPost')
            this.$store.dispatch('allCategories')
        }
    }
</script>