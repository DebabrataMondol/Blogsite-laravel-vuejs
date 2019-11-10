<template>
    <div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-around">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Post</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" enctype="multipart/form-data" @submit.prevent="updatePost">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="postId">Title</label>
                                        <input type="text" name="title" class="form-control" id="postId"
                                               placeholder="Enter Title" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" name="description" class="form-control" id="description"
                                                  placeholder="Enter description" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                        <!--<markdown-editor v-model="form.description"></markdown-editor>-->
                                        <has-error :form="form" field="description"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Select Category</label>
                                        <select class="form-control" id="category" name="category_id" v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }">
                                            <option disabled value="">Select One</option>
                                            <option :value="category.id" v-for="category in getAllCategory">{{category.category_name}}</option>
                                        </select>
                                        <has-error :form="form" field="category_id"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input @change = "changePhoto($event)" type="file"  name="photo" class="form-control" id="photo" :class="{ 'is-invalid': form.errors.has('photo') }">
                                        <img :src="updateImage()" alt="" height="100" width="100">
                                        <has-error :form="form" field="photo"></has-error>
                                    </div>
                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

    </div>
</template>

<script>
    export default {
        name: "Edit",
        data(){
            return {
                // Create a new form instance
                form: new Form({
                    title: '',
                    description: '',
                    category_id: '',
                    photo: '',
                    remember: false
                })
            }
        },
        mounted(){
            this.$store.dispatch("allCategory")
        },
        created(){
            axios.get(`/edit-post/${this.$route.params.postid}`)
                .then((response)=>{
                this.form.fill(response.data.post)
            })
        },
        computed:{
            getAllCategory(){
                return this.$store.getters.getCategory
            }
        },
        methods:{
            changePhoto(event){
                let file = event.target.files[0];
                console.log(file)
                if(file.size>1048576){
                    Swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    } )
                }else{
                    let reader = new FileReader();

                    reader.onload = event=> {
                        this.form.photo = event.target.result
                        console.log(event.target.result)
                    };

                    reader.readAsDataURL(file);
                }

            },
            updatePost(){
                this.form.post(`/update-post/${this.$route.params.postid}`)
                    .then((response)=>{
                        this.$router.push('/post-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Post updated successfully'
                        })
                    })
                    .catch(()=>{

                    })
            },
            updateImage(){
                let img = this.form.photo;
                if(img.length>100){
                   return this.form.photo
                }else{
                    return `uploadimage/${this.form.photo}`
                }
            }
        }
    }
</script>