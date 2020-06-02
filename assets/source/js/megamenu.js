export default () => {

    const mainMenuElement = document.querySelector('#main-menu'); 
    const dropdownMenus = document.querySelectorAll(".js-dropdown");


    const showAll = (event) => {
        dropdownMenus.forEach( el => { el.classList.add('is-active'); })
    }
    const hideAll = (event) => {
        dropdownMenus.forEach( el => { el.classList.remove('is-active'); })
    }

    mainMenuElement.onmouseover = showAll;
    mainMenuElement.onmouseout = hideAll; 

    for(let el of dropdownMenus){
        el.onmouseover = (ev) => { el.classList.add("hovered"); console.log("hovered triggered") }
        el.onmouseout = (ev) => { el.classList.remove("hovered"); }
    }

  }