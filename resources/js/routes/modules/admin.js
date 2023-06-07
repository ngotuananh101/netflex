export default [
    {
        path: '/admin',
        name: 'admin',
        component: () => import('../../pages/admin/Admin.vue'),
        redirect: {name: 'admin dashboard'},
        meta: {
            requiresAuth: true,
            requiresAdmin: true,
            isGuest: false,
        },
        children: [
            {
                path: '/',
                name: 'admin dashboard',
                component: () => import('../../pages/admin/Dashboard.vue'),
            }
        ]
    }
]
