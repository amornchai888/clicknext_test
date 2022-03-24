import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

import Home from "./views/Home";
import Login from "./views/auth/Login";

const router = new VueRouter({
    mode: "history",
    linkActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "index",
            component: () => import("./views/Home.vue"),
        },

        {
            path: "/withdraw",
            name: "withdraw",
            component: () => import("./views/Withdraw.vue"),
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: "/home",
            name: "home",
            component: () => import("./views/Home.vue"),
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: "/login",
            name: "login",
            component: () => import("./views/auth/Login.vue"),
        },
    ],
});

router.beforeEach((to, from, next) => {
    //  Redirect if not authenticated on secured routes
    if (to.matched.some((m) => m.meta.requiresAuth)) {
        if (!localStorage.getItem('auth.token')) {
            return next("/login");
        }
    }

    return next();
});

export default router;
