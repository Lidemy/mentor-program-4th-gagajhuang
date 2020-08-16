/*eslint-disable*/
// 將高度設為 35(height 的高度) ，則可隱藏
const quesBlock = document.querySelector('.section__question');
quesBlock.addEventListener('click', clickAct);

function clickAct(e) {
  // tagName 是大寫，須保持固定小寫 .toLowerCase()
  if (e.target.tagName.toLowerCase() === 'h3') {
    e.target.parentNode.classList.toggle('hide-content');
    const arrowIcon = e.target.children[0];
    if (arrowIcon.classList.contains('fa-caret-square-up')) {
      arrowIcon.setAttribute('class', 'far fa-caret-square-down');
    } else {
      arrowIcon.setAttribute('class', 'far fa-caret-square-up');
    }
  }
}
