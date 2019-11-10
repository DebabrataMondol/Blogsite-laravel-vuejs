export default {
    state:{
       category:[],
        post:[],
        blogpost:[],
        singlePost:[],
        allCategories:[]
    },
    getters:{
       getCategory(state){
           return state.category
       },
        getAllPost(state){
           return state.post
        },
        getBlogPost(state){
            return state.blogpost
        },
        getPostById(state){
            return state.singlePost
        },
        allCategories(state){
            return state.allCategories
        }
    },
    actions:{
        allCategory(context){
            axios.get('/view-category')
                .then((response)=>{
                context.commit('categories',response.data.categories)
                })
        },
        getAllPost(context){
            axios.get('/view-post')
                .then((response)=>{
                context.commit('allPost',response.data.posts)
                })
        },
        getBlogPost(context){
            axios.get('/blog-post-view')
                .then((response)=>{
                    context.commit('getBlogPost',response.data.blogPost)
                })
        },
        getPostById(context,payload){
            axios.get('/single-post-view/'+payload)
                .then((response)=>{
                context.commit('getSinglePost',response.data.singlePost)
                })
        },
        allCategories(context){
            axios.get('/all-category')
                .then((response)=>{
                    context.commit('allCategories',response.data.allCategory)
                })
        },
        getPostByCatId(context,payload){
            axios.get('/categories/'+payload)
                .then((response)=>{
                    console.log(response.data.posts)
                    context.commit('getPostByCatId',response.data.posts)
                })
        },
        SearchPost(context,payload){
            axios.get('/search?s='+payload)
                .then((response)=>{
                    context.commit('getSearchPost',response.data.posts)
                })

        }
    },
    mutations:{
        categories(state,data){
            return state.category = data
        },
        allPost(state,payload){
            return state.post = payload
        },
        getBlogPost(state,payload){
            return state.blogpost = payload
        },
        getSinglePost(state,payload){
            return state.singlePost =payload
        },
        allCategories(state,payload){
            return state.allCategories =payload
        },
        getPostByCatId(state,payload){
            return state.blogpost = payload
        },
        getSearchPost(state,payload){
             state.blogpost =payload
        }

    }

}