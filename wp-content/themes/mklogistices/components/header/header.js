import on from 'dom-event'
import throttle from 'lodash.throttle'
import { select, setAttribute, set, unset, selectAll, trigger, contains } from '../../src/js/lib/util'

const DESKTOP_BREAKPOINT = 1200
const selectors = {
  TOGGLE_NAV_SELECTOR: '.js-toggle-mobile-nav',
  HEADER_NAV_SELECTOR: '.js-header-nav',
  NAV_PARENT_ITEM_SELECTOR: '.js-nav-parent-item',
  NAV_ITEM_SELECTOR: '.js-nav-item',
  NAV_ITEM_LINK_SELECTOR: '.js-nav-item-link',
  CONTACT_SELECTOR: '.js-header-contact',
  SUB_NAV_SELECTOR: '.js-nav-item-content',
  OPEN_MENU_CLASS: 'is-open-menu',
  ACTIVE_SUB_MENU_CLASS: 'is-active-sub-menu',
  ACTIVE_SLIDEOUT_CLASS: 'is-active-slideout',
  SHOW_CLASS: 'is-show',
  HIDE_CLASS: 'is-hide',
  SCROLLING_DOWN_CLASS: 'is-scrolling-down',
}
export default el => {
  const toggleNavEl = select(selectors.TOGGLE_NAV_SELECTOR, el)
  const headerNavEl = select(selectors.HEADER_NAV_SELECTOR, el)
  const navParentItemEls = selectAll(selectors.NAV_PARENT_ITEM_SELECTOR, el)
  const navItemLinkEls = selectAll(selectors.NAV_ITEM_LINK_SELECTOR, el)
  const subNavEls = selectAll(selectors.SUB_NAV_SELECTOR, el)
  let lastScrollTop = 0

  const setProperties = () => {
    const vh = window.innerHeight * 0.01
    document.documentElement.style.setProperty('--vh', `${vh}px`)
  }
  setProperties()
  on(window, 'resize', throttle(setProperties, 100))

  // handle menu navigation
  const openMenu = () => {
    setAttribute('aria-expanded', true, toggleNavEl)
    set(document.body, selectors.OPEN_MENU_CLASS)
  }

  const closeMenu = () => {
    setAttribute('aria-expanded', false, toggleNavEl)
    unset(headerNavEl, selectors.ACTIVE_SUB_MENU_CLASS)
    unset(document.body, selectors.OPEN_MENU_CLASS)

    navItemLinkEls.length > 0 && navItemLinkEls.forEach((itemEl) => {
      setAttribute('aria-expanded', false, itemEl)
    })
  }

  toggleNavEl && on(toggleNavEl, 'click', () => {
    if (document.body.classList.contains(selectors.OPEN_MENU_CLASS)) {
      closeMenu()
    } else {
      openMenu()
    }
  })

  navItemLinkEls.length > 0 && navItemLinkEls.forEach((itemEl) => {
    on(itemEl, 'click', (e) => {
      const parentEl = itemEl.closest(selectors.NAV_PARENT_ITEM_SELECTOR)
      const contentEl = select(selectors.SUB_NAV_SELECTOR, parentEl)

      parentEl.classList.toggle(selectors.ACTIVE_SUB_MENU_CLASS)
      contentEl.style.maxHeight = contentEl.style.maxHeight ? null : `${contentEl.scrollHeight}px`
      if (contains(parentEl, selectors.ACTIVE_SUB_MENU_CLASS)) {
        setAttribute('aria-expanded', true, itemEl)
      } else {
        setAttribute('aria-expanded', false, itemEl)
      }
    })
  })

  const openSubNavOnEnter = (nav) => {
    if (window.innerWidth < DESKTOP_BREAKPOINT) {
      return
    }
    closeAllSubNav()
    set(document.body, selectors.ACTIVE_SLIDEOUT_CLASS)

    const btnSubmenu = select(selectors.NAV_ITEM_LINK_SELECTOR, nav)
    btnSubmenu?.setAttribute('aria-expanded', true)
  }

  const closeAllSubNav = () => {
    if (window.innerWidth < DESKTOP_BREAKPOINT) {
      return
    }
    unset(document.body, selectors.ACTIVE_SLIDEOUT_CLASS)

    navParentItemEls?.forEach(nav => {
      const btnSubmenu = select(selectors.NAV_ITEM_LINK_SELECTOR, nav)
      btnSubmenu?.setAttribute('aria-expanded', false)
    })
  }

  navParentItemEls.length > 0 && navParentItemEls.forEach((itemEl) => {
    on(itemEl, 'mouseenter', () => openSubNavOnEnter(itemEl))
    on(itemEl, 'mouseleave', closeAllSubNav)
    itemEl.addEventListener('keydown', event => {
      if (event.keyCode === 13) {
        openSubNavOnEnter(itemEl)
      }
    })
  })

  const closeSubNavByFocusOut = (subNav) => {
    const groupItems = subNav.querySelectorAll('a')
    const firstItem = groupItems[0]
    const lastItem = groupItems[groupItems.length - 1]

    firstItem.addEventListener('keydown', event => {
      if (event.keyCode === 9 && event.shiftKey) {
        closeAllSubNav()
      }
    })

    lastItem.addEventListener('keydown', event => {
      if (event.keyCode === 9 && !event.shiftKey) {
        closeAllSubNav()
      }
    })
  }

  if (subNavEls && subNavEls.length) {
    subNavEls.forEach(subNav => {
      window.addEventListener('load', closeSubNavByFocusOut(subNav))
    })
  }

  // handle scrolling navigation
  const hideHeaderOnScrollDown = () => {
    const st = window.pageYOffset || document.documentElement.scrollTop
    const headerOffset = el ? el.offsetHeight : 100

    if (st <= headerOffset) {
      el.classList.remove(selectors.HIDE_CLASS, selectors.SHOW_CLASS)
    } else if (st > lastScrollTop && st > headerOffset && !contains(document.body, selectors.ACTIVE_SLIDEOUT_CLASS)){
      set(el, selectors.HIDE_CLASS)
      unset(el, selectors.SHOW_CLASS)
    } else {
      set(el, selectors.SHOW_CLASS)
      unset(el, selectors.HIDE_CLASS)
    }

    lastScrollTop = st <= 0 ? 0 : st
  }

  hideHeaderOnScrollDown()
  window.addEventListener('scroll', () => {
    hideHeaderOnScrollDown()
  }, { passive: true })
}
