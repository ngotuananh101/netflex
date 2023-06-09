export default [
    {
        path: '/auth',
        redirect: {name: 'login'},
        meta: {
            isGuest: true,
            requiresAuth: false,
        },
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
                meta: {
                    requiresAuth: true,
                    isGuest: false,
                },
            },
            {
                path: 'sent',
                name: 'sent',
                component: () => import('../../pages/auth/Sent.vue'),
                meta: {
                    requiresAuth: true,
                    isGuest: false,
                },
            },
            {
                path: 'logout',
                name: 'logout',
                component: () => import('../../pages/auth/Logout.vue'),
                meta: {
                    requiresAuth: true,
                    isGuest: false,
                }
            },
            {
                path: 'forgot-password',
                name: 'forgot-password',
                component: () => import('../../pages/auth/ForgotPassword.vue'),
            },
            {
                path: 'reset/:token',
                name: 'reset-password',
                component: () => import('../../pages/auth/ResetPassword.vue'),
            }
        ]
    }
]
