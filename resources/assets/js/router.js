import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


let all_router = {
    routes: [
        {
            path: '/signin',
            component: resolve => void(require(['./components/signIn'], resolve))
        },
        {
            path: '/debate',
            component: resolve => void(require(['./components/debate'], resolve))
        }
    ]
}

all_router.routes.push(
    {
        path: '*',
        component: resolve => void(require(['./components/404'], resolve))
    }
)

export default new VueRouter(all_router);
