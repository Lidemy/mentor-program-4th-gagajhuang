const request = require('request');

const urlAPI = 'https://api.twitch.tv/kraken';
const clientID = 'zn4lnselm0scry6lag1327agbh2e3u';

// api 設置
const options = {
  url: `${urlAPI}/games/top`,
  headers: {
    Accept: 'application/vnd.twitchtv.v5+json',
    'Client-ID': clientID,
  },
};
// eslint-disable-next-line
function callback(err, response, body) {
  let topData;
  try {
    topData = JSON.parse(body);
  } catch (error) {
    return console.log(error);
  }
  // console.log(topData.top);
  // console.log(topData.top.length);//10
  const tapList = topData.top;

  // eslint-disable-next-line
  for (let i = 0; i < tapList.length; i++) {
    // console.log('觀看人數為：' + tapList[i].viewers + '，遊戲名稱：' + tapList[i].game.name);
    console.log(`觀看人數為：${tapList[i].viewers}，遊戲名稱：${tapList[i].game.name}`);
  }
}

request(options, callback);
