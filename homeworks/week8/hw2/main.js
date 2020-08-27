/*eslint-disable*/
const urlApi = "https://api.twitch.tv/kraken";
const clientID = "zn4lnselm0scry6lag1327agbh2e3u";
const accept = "application/vnd.twitchtv.v5+json";
const request = new XMLHttpRequest();
const errorMesg = "系統不穩定，請再試一次！";

// 清單顯示 Top5 遊戲名稱
function getTopGame() {
  request.onload = function () {
    if (request.status >= 200 && request.status < 400) {
      let data;
      try {
        data = JSON.parse(request.responseText);
      } catch (err) {
        alert(errorMesg);
        return;
      }
      // navbar Top5 清單
      renderList(data)
    } else {
      alert(errorMesg);
    }
  };
  request.onerror = function () {
    alert(errorMesg);
  };
  request.open("GET", `${urlApi}/games/top?limit=5`, true);
  request.setRequestHeader("Client-ID", clientID);
  request.setRequestHeader("Accept", accept);
  request.send();
}
// navbar Top5 清單
function renderList(data){
  const navbarListUl = document.querySelector(".navbar__list ul");
  var topGames = data.top.map((gamefun) => gamefun.game.name);// 單取遊戲名稱轉為陣列
  for (let i = 0; i < topGames.length; i++) {
    const item = document.createElement("li");
    item.innerText = topGames[i];
    navbarListUl.appendChild(item);
    
    //帶入 game 名稱，初始畫面
    masterTop(topGames[0], (data) =>{
    	renderUser(data.streams);
    });
  }
  document.querySelector('.title h1').innerText = topGames[0];
}
// 內容顯示各遊戲的前 20 名直播
function masterTop(item) {
  request.onload = function () {
    if (request.status >= 200 && request.status < 400) {
      let data;
      try {
        data = JSON.parse(request.responseText);
        
      } catch (err) {
        alert(errorMesg);
        return;
      }
      renderUser(data.streams)
    } else {
      alert(errorMesg);
    }
  };
  request.onerror = function () {
    alert(errorMesg);
  };
  request.open("GET", `${urlApi}/streams/?game=${encodeURIComponent(item)}&limit=20`, true);
  request.setRequestHeader("Client-ID", clientID);
  request.setRequestHeader("Accept", accept);
  request.send();
}

//點擊切換頁面
document.querySelector('.menu__ul').addEventListener('click', e =>{
		// 移除已存在的畫面
		const userRemove = document.querySelectorAll('.master__block');
		Array.prototype.forEach.call( userRemove, function( node ) {
		    node.parentNode.removeChild( node );
		});

		if(e.target.tagName.toLowerCase() === 'li'){
			let listName = e.target.innerText;
			masterTop(listName, (data) => {
         appendStreams(data.streams)
      })
      document.querySelector('.title h1').innerText = listName;
		}
})
// 前 20 直播主
function renderUser(streams){
  for (let i = 0; i < streams.length; i++) {
    const element = document.createElement("div");
    element.classList.add('master__block');
    element.innerHTML = `
			<img src="${streams[i].preview.large}">
				<div class="master__infor">
					<div class="master__photo"><img src="${streams[i].channel.logo}"></div>
					<div class="master__text">
						<div class="master__title">${streams[i].channel.status}</div>
						<div class="master__name">${streams[i].channel.name}</div>
					</div>
				</div>`
		document.querySelector('.master__list').appendChild(element);
  }
}

getTopGame();

// menu 切換
const menuBlock = document.querySelector('.menu__block');
menuBlock.addEventListener('click', menuShow);

function menuShow(e){
  document.querySelector('.menu__ul').classList.toggle('menu__show')
}
document.querySelector('.menu__ul').addEventListener('click', e => {
  if(e.target.tagName.toLowerCase() === 'li'){
    e.target.parentNode.classList.remove('menu__show')
  }
})