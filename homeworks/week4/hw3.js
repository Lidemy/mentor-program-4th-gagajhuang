const request = require('request');
const process = require('process');

const urlAPI = 'https://restcountries.eu/rest/v2';
const arge = process.argv;
const countryName = arge[2];


request(
  `${urlAPI}/name/${countryName}`,

  (error, response, body) => {
    if (response.statusCode >= 400 && response.statusCode < 500) {
      console.log('找不到國家資訊');
    }

    let countryData;
    try {
      countryData = JSON.parse(body);
    } catch (err) {
      console.log(err);
    }
    // console.log(countryData);
    for (let i = 0; i < countryData.length; i += 1) {
      console.log('============');
      console.log(`國家：${countryData[i].name}`);
      console.log(`首都：${countryData[i].capital}`);
      console.log(`貨幣：${countryData[i].currencies[0].code}`);
      console.log(`國碼：${countryData[i].callingCodes[0]}`);
    }
  },
);
