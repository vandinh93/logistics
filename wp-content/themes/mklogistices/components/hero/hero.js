import on from 'dom-event'
import { select, setAttribute, getAttribute, set, unset, selectAll, trigger, contains } from '../../src/js/lib/util'

const selectors = {
  BTN_DROPDOWN : '.js-btn-dropdown-hero',
  CONTENT_DROPDOWN : '.js-content-dropdown-hero',
  DROPDOWN_WRAP : '.js-dropdown-wrap',
  DROPDOWN_ITEM : '.js-dropdown-item',
}

const classes = {
  SHOW : 'is-show'
}

export default el => {
  const btnDropdown = select(selectors.BTN_DROPDOWN, el)
  const contentDropdown = select(selectors.CONTENT_DROPDOWN, el)
  const dropdownWrap = select(selectors.DROPDOWN_WRAP, el)
  const dropdownItems = selectAll(selectors.DROPDOWN_ITEM, el)

  if ( !btnDropdown && !contentDropdown && !dropdownWrap ) return
  on(btnDropdown, 'click', () => {
    dropdownWrap.classList.toggle(classes.SHOW)

    if (contains(dropdownWrap, classes.SHOW)) {
      setAttribute('aria-expanded', true, btnDropdown)
    } else {
      setAttribute('aria-expanded', false, btnDropdown)
    }
  })

  if (dropdownItems.length > 0) {
    dropdownItems.forEach(item => {
      on(item, 'click', () => {
        const icon = getAttribute('title', item)

        dropdownWrap.classList.remove(classes.SHOW)
        setAttribute('aria-expanded', false, btnDropdown)
        setAttribute('data-icon', icon, btnDropdown)
      })
    })
  }
}
