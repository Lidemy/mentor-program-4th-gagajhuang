/*eslint-disable*/
const form = document.querySelector('form');

// 記得此處不是使用 click，而是 submit，否則點擊其他位置也會出現 error 文字
form.addEventListener('submit', submitAct);

function submitAct(e) {
  e.preventDefault();// 預防跳頁
  let hasError = false;// 預設輸入內容無誤
  const values = {};// 將值取出為物件

  const elements = document.querySelectorAll('.redsup');
  for (element of elements) {
    const inputs = element.querySelector('input');
    const radios = element.querySelectorAll('input[type=radio]');
    // let isVaild = true;// input 裡有東西為 true

    if (inputs) {
      values[inputs.name] = inputs.value;// values 是物件
      if (!inputs.value) {
        element.classList.remove('hide-error');
        hasError = true;
      } else {
        element.classList.add('hide-error');
      }
    }
    if (radios.length) {
      const hasValue = [...radios].some(radio => radio.checked);
      if (!hasValue) {
        element.classList.remove('hide-error');
        hasError = true;
      } else {
        element.classList.add('hide-error');
        const checkedRadio = element.querySelector('input[type=radio]:checked');
        values[checkedRadio.name] = checkedRadio.value;
        // console.log(values)
      }
    }
  }
  if (!hasError) {
    alert(JSON.stringify(values));
  }
}
/*
  const inputs = document.querySelectorAll('.redsup input');
  for (let input of inputs) {
    // 方法一
    if(!input.value){
      const span = document.createElement('span');// 這段不能寫外面，否則永遠只有最後一個呈現
      span.innerText = '不能為空！';
      input.parentNode.appendChild(span);
    }
    // 方法二
    // 將原本隱藏的 class 拿掉，此方法可避免 click 重複顯示文字
    if (!input.value) {
      input.parentNode.classList.remove('hide-error');
      hasError = true;
    }else{
      input.parentNode.classList.add('hide-error');
    }
  }
*/
