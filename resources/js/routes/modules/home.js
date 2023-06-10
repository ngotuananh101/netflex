export default [
    {
        path: '/home',
        name: 'home',
        component: () => import('../../pages/home/Layout.vue'),
        redirect: {name: 'home dashboard'},
        meta: {
            requiresAuth: true,
            isGuest: false,
        },
        children: [
            {
                path: '/',
                name: 'home dashboard',
                component: () => import('../../pages/home/Dashboard.vue'),
            },
            {
                path: '/profile',
                name: 'home profile',
                redirect: {name: 'select profile'},
                children: [
                    {
                        path: '',
                        name: 'select profile',
                        component: () => import('../../pages/home/profile/Select.vue'),
                    },
                    {
                        path: 'manage',
                        name: 'manage profile',
                        component: () => import('../../pages/home/profile/Manage.vue'),
                    },
                ]
            }
        ]
    }
]
