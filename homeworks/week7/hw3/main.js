/*eslint-disable*/
const checkboxEnter = document.querySelector('input[type=text]');
const todoBlock = document.querySelector('.todo-block');
const listContent = document.querySelectorAll('.list__content');

checkboxEnter.addEventListener('keydown', addList);
todoBlock.addEventListener('click', deleteList);
todoBlock.addEventListener('click', checkedList);

// 跳脫 html 標籤符號
function escapeHtml(unsafe) {
  return unsafe
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

// 新增
function addList(e) {
  if (e.keyCode == 13 && this.value !== '') {
    const addDiv = document.createElement('div');
    addDiv.classList.add('list-block');
    addDiv.innerHTML = `
			<div class="list__content">
				<input type="checkbox" name="enter">
				<p>${escapeHtml(this.value)}</p>
			</div>
			<button class="btn-delete">刪除</button>`;
    todoBlock.appendChild(addDiv);
    this.value = '';
  }
}

// 刪除
function deleteList(e) {
  if (e.target.className == 'btn-delete') {
    e.target.parentNode.remove();
  }
}

// 已完成/未完成
function checkedList(e) {
  const listContent = e.target.parentNode;
  const thisInput = listContent.querySelector('input');
  const thisP = listContent.querySelector('p');
  // console.log(e.target.tagName);
  
  if(e.target.tagName == "P" || e.target.tagName == "DIV"){
    thisInput.checked = !thisInput.checked;
  }
  thisP.classList.toggle('completed');
  // if (thisInput.checked == true) {
  //   thisP.classList.add('completed');
  // } else {
  //   thisP.classList.remove('completed');
  // }
}

// Huli 範例修改
// 合併刪除及未完成/未完成
/* document.querySelector('.todo-block').addEventListener('click',(event) => {
  const { target } = event; // 解構

  // 刪除
  if(target.classList.contains('btn-delete')){
    target.parentNode.remove();
  }

  // 已完成/未完成
  const listContent = target.parentNode;
  const thisInput = listContent.querySelector('input');
  const thisP = listContent.querySelector('p');
  if(thisInput.checked == true){
    thisP.classList.add('completed');
  }else{
    thisP.classList.remove('completed');
  }
}) */
