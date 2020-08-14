/*eslint-disable*/
const quesClick = document.querySelectorAll('.question__list');

for (let i = 0; i < quesClick.length; i++) {
  quesClick[i].addEventListener('click', isHidden);
}


function isHidden(e) {
  // 取得 CSS 樣式，window.getComputedStyle
  const styleStatus = window.getComputedStyle(this.children[1]).getPropertyValue("display");
  const arrowIcon = this.children[0].children[0];

  if (styleStatus == 'none') {
    this.children[1].style = 'opacity:1;display:block'
    arrowIcon.setAttribute('class', 'far fa-caret-square-down');
  } else {
    this.children[1].style = 'opacity:0;display:none'
    arrowIcon.setAttribute('class', 'far fa-caret-square-up');
  }
}
