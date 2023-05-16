export default [
    {
        path: '/auth',
        redirect: {name: 'login'},
        children: [
            {
                path: 'login',
                name: 'login',
                component: () => import('../../pages/auth/SignIn.vue'),
            },
            {
                path: 'signup',
                name: 'signup',
                component: () => import('../../pages/auth/SignUp.vue'),
            },
            {
                path: 'verify/:id/:hash',
                name: 'verify',
                component: () => import('../../pages/auth/Verify.vue'),
            }
        ]
    }
]
