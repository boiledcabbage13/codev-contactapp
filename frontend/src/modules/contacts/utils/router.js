const BASE_PATH = '/contacts';

export const ContactModuleRoutes = [
  {
    path: BASE_PATH,
    name: 'ContactModule',
    component: () => import(/* webpackChunkName: 'contactModule' */ '../ContactModule'),
    redirect: '/',
    children: [
      {
        path: '/',
        name: 'Contact',
        component: () => import(/* webpackChunkName: 'contactPage' */ '../pages/ContactPage'),
      }
    ]
  }
]
