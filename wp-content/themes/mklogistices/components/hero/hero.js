import on from 'dom-event'
import { select, setAttribute, getAttribute, set, unset, selectAll, trigger, contains } from '../../src/js/lib/util'

const selectors = {
  BTN_DROPDOWN : '.js-btn-dropdown-hero',
  CONTENT_DROPDOWN : '.js-content-dropdown-hero',
  DROPDOWN_WRAP : '.js-dropdown-wrap',
  DROPDOWN_ITEM : '.js-dropdown-item',
  FORM_HERO : '.js-form-hero',
  KEYWORD : '.js-keyword',
}

const classes = {
  SHOW : 'is-show'
}

export default el => {
  const formEl = select(selectors.FORM_HERO, el)
  const inputEl = select(selectors.KEYWORD, formEl)
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

  const submitForm = () => {
    if (inputEl && formEl) {
      on(formEl, 'submit', (event) => {
        event.preventDefault()

        const query = encodeURIComponent(inputEl.value.trim())
        const status = getAttribute('data-icon', btnDropdown)

        // Define the URLs for each platform
        let searchUrl = ''
        if (status === '1688') {
          searchUrl = `https://s.1688.com/selloffer/offer_search.htm?keywords=${query}`
        } else if (status === 'taobao') {
          searchUrl = `https://s.taobao.com/search?q=${query}`
        } else if (status === 'tmall') {
          searchUrl = `https://list.tmall.com/search_product.htm?q=${query}`
        }

        // Open the search URL in a new tab
        window.open(searchUrl, '_blank')
      })
    }
  }

  submitForm()

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
