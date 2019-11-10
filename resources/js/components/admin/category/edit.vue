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
                                <h3 class="card-title">Edit Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @submit.prevent="updateCategory()">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="categoryId">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="categoryId"
                                               placeholder="Update Category Name" v-model="form.category_name" :class="{ 'is-invalid': form.errors.has('category_name') }">
                                        <has-error :form="form" field="category_name"></has-error>
                                    </div>
                                </div>
                                <!-- /.card-body -->

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
        mounted(){
          axios.get(`/edit-category/${this.$route.params.categoryid}`)
              .then((response)=>{
              this.form.fill(response.data.category)
              })
        },
        data(){
            return {
                // Create a new form instance
                form: new Form({
                    category_name: '',
                    remember: false
                })
            }
        },
        methods:{
            updateCategory(){
                this.form.post(`/update-category/${this.$route.params.categoryid}`)
                    .then((response)=>{
                        this.$router.push('/category-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Category Updated successfully'
                        })
                    })
                    .catch(()=>{

                    })
            }


        }
    }
</script>