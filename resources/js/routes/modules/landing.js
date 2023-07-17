export default [
    {
        path: '/',
        name: 'landing',
        component: () => import('../../pages/Landing.vue'),
        meta: {
            requiresAuth: false,
            isGuest: true,
        }
    }
]
