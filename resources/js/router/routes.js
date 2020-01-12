function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('index.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },

  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ] },

  { path: '*', component: page('errors/404.vue') },

  { path: '/admin/', name: 'dashboard', component: page('admin/dashboard.vue') },
  { path: '/admin/anggota', name: 'anggota', component: page('admin/anggota.vue') },
  { path: '/admin/buku', name: 'buku', component: page('admin/buku.vue') },
  { path: '/admin/peminjaman', name: 'peminjaman', component: page('admin/peminjaman.vue') },
  { path: '/admin/pengembalian', name: 'pengembalian', component: page('admin/pengembalian.vue') },
]
