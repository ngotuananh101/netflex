export default [
    {
        path: '/home',
        name: 'home',
        component: () => import('../../pages/home/Home.vue'),
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
            }
        ]
    }
]
