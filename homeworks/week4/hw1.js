// 列出前十本書籍的 id 以及書名
const request = require('request');

request(
  'https://lidemy-book-store.herokuapp.com/books?_limit=10',

  // function (error, response, body){}
  (error, response, body) => {
    let bookData;
    try {
      bookData = JSON.parse(body);
    } catch (err) {
      console.log(err);
    }
    // console.log(bookData);
    for (let i = 0; i < bookData.length; i += 1) { // i++ 需改成 i+=1
      console.log(`${bookData[i].id} ${bookData[i].name}`);
    }
  },
);
