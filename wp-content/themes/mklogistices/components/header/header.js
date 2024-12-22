import gsap from 'gsap'
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
  NAV_ITEM_BACK_SELECTOR: '.js-nav-item-back',
  CONTACT_SELECTOR: '.js-header-contact',
  SUB_NAV_SELECTOR: '.js-nav-item-content',
  OPEN_MENU_CLASS: 'is-open-menu',
  OPEN_SUB_MENU_CLASS: 'is-open-sub-menu',
  ACTIVE_SUB_MENU_CLASS: 'is-active-sub-menu',
  ACTIVE_SLIDEOUT_CLASS: 'is-active-slideout',
  SHOW_CLASS: 'is-show',
  HIDE_CLASS: 'is-hide',
  SCROLLING_DOWN_CLASS: 'is-scrolling-down',
}
export default el => {
  const toggleNavEl = select(selectors.TOGGLE_NAV_SELECTOR, el)
  const headerNavEl = select(selectors.HEADER_NAV_SELECTOR, el)
  const menuItemEls = selectAll(selectors.NAV_ITEM_SELECTOR, el)
  const navParentItemEls = selectAll(selectors.NAV_PARENT_ITEM_SELECTOR, el)
  const navItemLinkEls = selectAll(selectors.NAV_ITEM_LINK_SELECTOR, el)
  const navItemBackEls = selectAll(selectors.NAV_ITEM_BACK_SELECTOR, el)
  const subNavEls = selectAll(selectors.SUB_NAV_SELECTOR, el)
  let lastScrollTop = 0

  const setProperties = () => {
    const vh = window.innerHeight * 0.01
    document.documentElement.style.setProperty('--vh', `${vh}px`)
  }
  setProperties()
  on(window, 'resize', throttle(setProperties, 100))

  let tl = gsap.timeline({paused:true, reversed:true})
    .to(headerNavEl, {duration: 0.5, y: 0, visibility: 'visible', ease: 'Power2.easeOut'})
  menuItemEls.length && tl.from(menuItemEls , {duration: 0.5, opacity: 0, y: 100, ease: 'Power2.easeOut', stagger: 0.1})
  tl.from('.js-header-contact', {duration: 0.5, opacity: 0, y: 100, ease: 'Power2.easeOut'}, '-=0.4')

  const animate = () => {
    tl.reversed() ? tl.timeScale(1).play() : tl.timeScale(3).reverse()
  }

  // handle menu navigation
  const openMenu = () => {
    setAttribute('aria-expanded', true, toggleNavEl)
    set(document.body, selectors.OPEN_MENU_CLASS)
    trigger('lenis-stop', document.body)
  }

  const closeMenu = () => {
    setAttribute('aria-expanded', false, toggleNavEl)
    unset(headerNavEl, selectors.ACTIVE_SUB_MENU_CLASS)
    unset(document.body, selectors.OPEN_MENU_CLASS)
    trigger('lenis-start', document.body)

    navParentItemEls.length > 0 && navParentItemEls.forEach((itemEl) => {
      unset(itemEl, selectors.OPEN_SUB_MENU_CLASS)
    })

    navItemLinkEls.length > 0 && navItemLinkEls.forEach((itemEl) => {
      setAttribute('aria-expanded', false, itemEl)
    })
  }

  const openSubMenu = (btn) => {
    const buttonEl = btn.closest(selectors.NAV_ITEM_LINK_SELECTOR)

    buttonEl && setAttribute('aria-expanded', true, buttonEl)
    set(headerNavEl, selectors.ACTIVE_SUB_MENU_CLASS)
    set(btn.closest(selectors.NAV_PARENT_ITEM_SELECTOR), selectors.OPEN_SUB_MENU_CLASS)
  }

  const closeSubMenu = (btn) => {
    const buttonEl = select(selectors.NAV_ITEM_LINK_SELECTOR, btn.closest(selectors.NAV_PARENT_ITEM_SELECTOR))

    buttonEl && setAttribute('aria-expanded', false, buttonEl)
    unset(headerNavEl, selectors.ACTIVE_SUB_MENU_CLASS)
    unset(btn.closest(selectors.NAV_PARENT_ITEM_SELECTOR), selectors.OPEN_SUB_MENU_CLASS)
  }

  toggleNavEl && on(toggleNavEl, 'click', () => {
    if (document.body.classList.contains(selectors.OPEN_MENU_CLASS)) {
      closeMenu()
    } else {
      openMenu()
    }
    animate()
  })

  navItemLinkEls.length > 0 && navItemLinkEls.forEach((itemEl) => {
    on(itemEl, 'click', (e) => {
      openSubMenu(e.target)
    })
  })

  const openSubNavOnEnter = (nav) => {
    if (window.innerWidth < DESKTOP_BREAKPOINT) {
      return
    }
    closeAllSubNav()
    set(nav, selectors.OPEN_SUB_MENU_CLASS)
    set(document.body, selectors.ACTIVE_SLIDEOUT_CLASS)
    trigger('lenis-stop', document.body)

    const btnSubmenu = select(selectors.NAV_ITEM_LINK_SELECTOR, nav)
    btnSubmenu?.setAttribute('aria-expanded', true)
  }

  const closeAllSubNav = () => {
    if (window.innerWidth < DESKTOP_BREAKPOINT) {
      return
    }
    unset(document.body, selectors.ACTIVE_SLIDEOUT_CLASS)
    trigger('lenis-start', document.body)

    navParentItemEls?.forEach(nav => {
      unset(nav, selectors.OPEN_SUB_MENU_CLASS)
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

  navItemBackEls.length > 0 && navItemBackEls.forEach((itemEl) => {
    on(itemEl, 'click', (e) => {
      closeSubMenu(e.target)
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
