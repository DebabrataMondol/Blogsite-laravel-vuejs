<template>
    <div>
        <section class="content">
            <div class="row justify-content-around">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post List</h3>
                            <div class="card-tools">
                                <button class="btn btn-primary">
                                    <router-link to="/add-post" style="color: #fff;">Add New Post</router-link>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Category</th>
                                    <th>User</th>
                                    <th>Post Title</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(post,index) in allPost">
                                    <td>{{index+1}}</td>
                                    <td v-if="post.category">{{post.category.category_name}}</td>
                                    <td v-if="post.user">{{post.user.name}}</td>
                                    <td>{{post.title}}</td>
                                    <td>{{post.description | shortlength(100,"....")}}</td>
                                    <td>
                                        <img :src="ourImage(post.photo)" width="40" height="50"/>
                                    </td>
                                    <td>
                                        <router-link :to="`edit-post/${post.id}`"  class="btn btn-info">Edit</router-link>
                                        <a href="" @click.prevent="deletepost(post.id)" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
</template>

<script>
    export default {
        name: "List",

        mounted(){
            this.$store.dispatch('getAllPost')
        },
        computed:{
            allPost(){
                return this.$store.getters.getAllPost
            }
        },
        methods:{
            ourImage(image){
                return "uploadImage/"+image;
            },
            deletepost(id){
                axios.get('/delete-post/'+id)
                    .then(()=>{
                        this.$store.dispatch("getAllPost")
                        Toast.fire({
                            type: 'success',
                            title: 'Post Deleted successfully'
                        })
                    })
            }
        }
    }
</script>