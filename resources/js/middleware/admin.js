import store from '~/store'

export default (to, from, next) => {
  if (store.getters['auth/user'].role == 2) {
    next()
  } else {
    next({ name: 'login' })
  }
}
