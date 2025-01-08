import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/Index.vue";
import adminMiddleware from '@/Middleware/AdminMiddleware.js';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            name: "Home",
            component: () => import("@/views/Index.vue"),
        },
        {
            path: "/login",
            name: "login",
            component: () => import("@/views/Auth/Login.vue"),
        },
        {
            path: "/register",
            name: "register",
            component: () => import("@/views/Auth/Register.vue"),
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: () => import("@/views/Client/Dashboard.vue"),
        },
        {
            path: "/price",
            name: "Package",
            component: () => import("@/views/Package/Index.vue"),
        },
        {
            path: "/service",
            name: "Service",
            component: () => import("@/views/Service/Index.vue"),
        },
        {
            path: "/order-success",
            name: "success",
            component: () => import("@/views/CheckOut/Success.vue"),
        },
        {
            path: "/CheckOut/:slug",
            name: "CheckOut",
            component: () => import("@/views/CheckOut/CheckOut.vue"),
        },
        {
            path: "/about",
            name: "About",
            component: () => import("@/views/About/Index.vue"),
        },
        {
            path: "/contact",
            name: "Contact",
            component: () => import("@/views/Contact/Index.vue"),
        },
        // Auth
        {
            path: "/admin/login",
            name: "adminLogin",
            component: () => import("@/views/Dashboard/Auth/Login.vue"),
        },

        //dashboard
        {
            path: "/admin/dashboard",
            name: "Dashboard",
            component: () => import("@/views/Dashboard/Index.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/service-category",
            name: "AdminServiceCategory",
            component: () =>
                import("@/views/Dashboard/ServiceCategory/Index.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/Customer-mail",
            name: "Cutomermail",
            component: () => import("@/views/Dashboard/ClientsMail/Index.vue"),
            beforeEnter: adminMiddleware,
        },

        {
            path: "/admin/mail-details/:id",
            name: "MailDetails",
            component: () => import("@/views/Dashboard/ClientsMail/Show.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/clients",
            name: "clientsList",
            component: () => import("@/views/Dashboard/Clients/Index.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/orders",
            name: "ordersList",
            component: () => import("@/views/Dashboard/Orders/Index.vue"),
            beforeEnter: adminMiddleware,
        },

        {
            path: "/admin/order-details/:id",
            name: "OrderDetails",
            component: () => import("@/views/Dashboard/Orders/Show.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/create-category",
            name: "AdminCreateCategory",
            component: () =>
                import("@/views/Dashboard/ServiceCategory/Create.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/edit-category/:id",
            name: "AdminEditCategory",
            component: () =>
                import("@/views/Dashboard/ServiceCategory/Edit.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/service",
            name: "AdminService",
            component: () => import("@/views/Dashboard/Services/Index.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/create-service",
            name: "AdminCreateService",
            component: () => import("@/views/Dashboard/Services/Create.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/edit-service/:id",
            name: "AdminEditService",
            component: () => import("@/views/Dashboard/Services/Edit.vue"),
            beforeEnter: adminMiddleware,
        },

        //Package Route
        {
            path: "/admin/package",
            name: "AdminPackage",
            component: () => import("@/views/Dashboard/Package/Index.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/create-package",
            name: "AdminCreatePackage",
            component: () => import("@/views/Dashboard/Package/Create.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/edit-package/:id",
            name: "AdminEditPackage",
            component: () => import("@/views/Dashboard/Package/Edit.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/setting",
            name: "AdminSetting",
            component: () => import("@/views/Dashboard/Setting/Index.vue"),
            beforeEnter: adminMiddleware,
        },

        //Pages Route
        {
            path: "/admin/pages",
            name: "AdminPages",
            component: () => import("@/views/Dashboard/CutomPages/Index.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/create-page",
            name: "CreatePage",
            component: () => import("@/views/Dashboard/CutomPages/Create.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/admin/edit-page/:id",
            name: "EditPage",
            component: () => import("@/views/Dashboard/CutomPages/Edit.vue"),
            beforeEnter: adminMiddleware,
        },
        {
            path: "/:slug",
            name: "custom-page",
            component: () => import("@/views/CutomPage/Index.vue"),
        },
    ],
});

export default router;
