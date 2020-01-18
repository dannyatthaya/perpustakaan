import store from '~/store'

export default async (to, from, next) => {
  if (store.getters['auth/user'].role == 1) {
    next()
  } else {
    next({ name: 'index' })
  }
}
