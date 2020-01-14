function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'index', component: page('index.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },

  { path: '/admin/buku', name: 'bukuRead', component: page('admin/buku/read.vue') },
  { path: '/admin/buku/create', name: 'bukuCreate', component: page('admin/buku/create.vue') },
  { path: '/admin/buku/detail/:id', name: 'bukuUpdate', component: page('admin/update.vue') },

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

  { path: '/admin/', name: 'dashboard', component: page('admin/index.vue') },
  { path: '/admin/anggota', name: 'admin.anggota', component: page('admin/anggota.vue') },
  { path: '/admin/buku', name: 'admin.buku', component: page('admin/buku.vue') },
  { path: '/admin/peminjaman', name: 'admin.peminjaman', component: page('admin/peminjaman.vue') },
  { path: '/admin/pengembalian', name: 'admin.pengembalian', component: page('admin/pengembalian.vue') },

  { path: '*', component: page('errors/404.vue') },
]
