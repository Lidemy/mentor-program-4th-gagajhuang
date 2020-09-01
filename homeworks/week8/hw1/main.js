/*eslint-disable*/
const btnResult = document.querySelector('.button__award');
const awardBlock = document.querySelector('.award__block');
const buttonRestart = document.querySelector('.button__restart');

btnResult.addEventListener('click',() => {
	const request = new XMLHttpRequest();
	const errorMesg = '系統不穩定，請再試一次！';

	request.onload = function(){
		if (this.status >= 200 && this.status < 400) {
			let data;
			// 判斷格式是不是 JSON
			try {
				data = JSON.parse(this.response);
			} catch (err) {
				alert(errorMesg);
				return
			}
			// 判斷取出的 data 沒有 prize 
			if(!data.prize){
				alert(errorMesg);
				return
			}
			// FIRST、SECOND、THIRD 以及 NONE
			const resultText = document.querySelector('.result__text');
			const awardContent = document.querySelector('.award__content').classList.add('hide__content');
			const resultBlock = document.querySelector('.result__block').classList.remove('hide__content');
			if (data.prize === 'FIRST') {
				resultText.innerText = '恭喜你中頭獎了！日本東京來回雙人遊！';
				awardBlock.classList.add('bg__first');
			} else if (data.prize === 'SECOND'){
				resultText.innerText = '二獎！90 吋電視一台！';
				awardBlock.classList.add('bg__second');
			} else if (data.prize === 'THIRD'){
				resultText.innerText = '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，bang！';
				awardBlock.classList.add('bg__third');
			} else if (data.prize === 'NONE'){
				resultText.innerText = '銘謝惠顧';
				awardBlock.classList.add('bg__none');
			}
		}else {
			alert(errorMesg)
		}
	}

	request.onerror = function(){
		alert(errorMesg)
	}
	request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery', true);
	request.send();
});

// 重新抽獎
buttonRestart.addEventListener('click', ()=>{
	location.reload()
});