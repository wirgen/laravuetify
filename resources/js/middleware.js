import router from './routes'
import { getToken, removeToken } from '@/utils/auth'
import { getInfo, refresh } from '@/api/auth'

const whiteList = ['/login', '/404']

router.beforeEach(async (to, from, next) => {
  let logged = false
  const hasToken = getToken()

  if (hasToken) {
    const info = await getInfo()

    if (info.error === undefined) {
      logged = true
    } else {
      try {
        const data = await refresh()
        if (data.error === undefined) {
          logged = true
        }
      } catch (e) {
        removeToken()
      }
    }

    if (logged) {
      if (to.path === '/login') {
        next({ path: '/' })
      } else {
        next()
      }
    }
  }

  if (!logged) {
    if (whiteList.indexOf(to.matched[0] ? to.matched[0].path : '') !== -1) {
      next()
    } else {
      next(`/login?redirect=${to.path}`)
    }
  }
})
