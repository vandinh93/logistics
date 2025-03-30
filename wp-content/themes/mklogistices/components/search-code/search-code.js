import { select, getAttribute } from '../../src/js/lib/util'

const selectors = {
  FETCH_BUTTON: '.js-fetch-button',
  LOADING: '.js-loading',
  RESULT: '.js-result',
  INPUT_TRACKING: '.js-input-tracking',
  TABLE: '.js-table',
  TABLE_BODY: '.js-table-body',
  NO_RESULT: '.js-no-result',
  FORM_TRACKING: '.js-form-tracking',
}

export default el => {
  const apiUrl = getAttribute('data-api-url', el)
  const fetchButtonEl = select(selectors.FETCH_BUTTON, el)
  const loadingEl = select(selectors.LOADING, el)
  const inputEl = select(selectors.INPUT_TRACKING, el)
  const resultEl = select(selectors.RESULT, el)
  const noResultEl = select(selectors.NO_RESULT, el)
  const tableEl = select(selectors.TABLE, el)
  const formEl = select(selectors.FORM_TRACKING, el)
  const tableBodyEl = select(selectors.TABLE_BODY, el)

  async function fetchData(e) {
    e.preventDefault()

    loadingEl.style.display = 'flex'
    noResultEl.style.display = 'none'
    tableEl.style.display = 'none'
    tableBodyEl.innerHTML = ''

    let trackingNumber = inputEl.value
    if (!trackingNumber || !apiUrl) {
      return
    }

    try {
      const response = await fetch(apiUrl + '?tracking=' + trackingNumber, {
        method: 'GET',
        redirect: 'follow'
      })
      const data = await response.json()
      resultEl.style.display = 'block'

      if (data.length > 0) {
        tableEl.style.display = 'block'

        data.forEach(item => {
          let row = tableBodyEl.insertRow()

          row.insertCell(0).textContent = new Date(item.date).toLocaleDateString("vi-VN")
          row.insertCell(1).textContent = item.stt
          row.insertCell(2).textContent = item.code
          row.insertCell(3).textContent = item.name
          row.insertCell(4).textContent = item.line
        })
      } else {
        tableEl.style.display = 'none'
        noResultEl.style.display = 'block'
      }
    } catch (error) {
      resultEl.style.display = 'block'
      tableEl.style.display = 'none'
      noResultEl.style.display = 'block'

      console.error('Lỗi khi lấy dữ liệu:', error)
    } finally {
      loadingEl.style.display = 'none'
    }
  }

  if (fetchButtonEl || formEl) {
    fetchButtonEl.addEventListener('click', fetchData)
    formEl.addEventListener('submit', fetchData)
  }
}