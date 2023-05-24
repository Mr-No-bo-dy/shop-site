// for some Entities' Update
let updatesbtn = document.querySelectorAll('.update')
updatesbtn.forEach(update => {
   update.onclick = ()  => {
      update.nextElementSibling.style.display = 'inline-block'
      update.style.display = 'none'
      update.closest('.inputs').querySelectorAll('input').forEach(input => {
         input.removeAttribute('readonly')
      })
      update.closest('.inputs').querySelectorAll('select').forEach(input => {
         input.removeAttribute('disabled')
      })
   }
})
