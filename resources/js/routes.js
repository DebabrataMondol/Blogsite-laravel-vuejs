import AdminHome from './components/admin/AdminHome.vue'
import CategoryList from './components/admin/category/list.vue'
import AddCategory from './components/admin/category/new.vue'
import EditCategory from './components/admin/category/edit.vue'

//post component

import PostList from './components/admin/post/list.vue'
import AddPost from './components/admin/post/new.vue'
import EditPost from './components/admin/post/edit.vue'
import Ex from './components/ExampleComponent.vue'


//FrontEnd Component

import PublicHome from './components/public/publicHome.vue'
import BlogPost from './components/public/blog/BlogPost.vue'
import SinglePost from './components/public/blog/SingleBlog.vue'


export const routes = [

  { path: '/home',
      component: AdminHome
  },
    {
        path: '/category-list',
        component: CategoryList
    },
    {
        path: '/add-category',
        component: AddCategory
    },
    {
        path: '/edit-category/:categoryid',
        component: EditCategory
    },

    //POST

    {
        path: '/post-list',
        component: PostList
    },
    {
        path: '/add-post',
        component: AddPost
    },
    {
        path: '/edit-post/:postid',
        component: EditPost
    },



    // FrontEnd Route

    {
        path: '/',
        component: PublicHome
    },
    {
        path:'/blog-post',
        component: BlogPost
    },
    {
        path:'/blog-post/:id',
        component: SinglePost
    }
    ,
    {
        path:'/categories/:id',
        component: BlogPost
    }

]