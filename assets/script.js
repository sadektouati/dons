window.onload = function() {
    const selects = document.querySelectorAll('._reload');
    [...selects].forEach((element) => {
        element.addEventListener('change', () =>{
            element.closest('form').submit()
        })
    })
}