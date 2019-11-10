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
                                <h3 class="card-title">Add New Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" @click.prevent="addCategory()">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="categoryId">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="categoryId"
                                               placeholder="Enter Category Name" v-model="form.category_name" :class="{ 'is-invalid': form.errors.has('category_name') }">
                                        <has-error :form="form" field="category_name"></has-error>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
        name: "New",
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
            addCategory(){
                this.form.post('/save-category')
                    .then((response)=>{
                       this.$router.push('/category-list')
                        Toast.fire({
                            type: 'success',
                            title: 'Category Added successfully'
                        })
                    })
                    .catch(()=>{

                    })
            }
        }
    }
</script>