/* eslint-disable no-use-before-define */
const request = require('request');
const process = require('process');

const urlAPI = 'https://lidemy-book-store.herokuapp.com';
const arge = process.argv;
const act = arge[2];
const parameter3 = arge[3];
const parameter4 = arge[4];

switch (act) {
  case 'list':
    listFun();
    break;
  case 'read':
    readFun(parameter3);
    break;
  case 'delete':
    deleteFun(parameter3);
    break;
  case 'create':
    createFun(parameter3);
    break;
  case 'update':
    updateFun(parameter3, parameter4);
    break;
  default:
    console.log('commands 錯誤!');
}

// 印出前二十本書的 id 與書名
function listFun() {
  request(
    // urlAPI + '/books?_limit=20',
    `${urlAPI}/books?_limit=20`,

    // function (error, response, body){}
    (error, response, body) => {
      let bookData;
      try {
        bookData = JSON.parse(body);
      } catch (err) {
        console.log(err);
      }
      // console.log(bookData);
      for (let i = 0; i < bookData.length; i += 1) {
        console.log(`${bookData[i].id} ${bookData[i].name}`);
      }
    },
  );
}

// 輸出 id 為 1 的書籍
function readFun(id) {
  request(
    `${urlAPI}/books/${id}`,
    (error, response, body) => {
      let bookData;
      try {
        bookData = JSON.parse(body);
      } catch (err) {
        console.log(err);
      }
      // console.log(bookData);
      // console.log('id 為 '+ id + ' ，書名為：' + bookData.name);
      console.log(`id 為 ${id} ，書名為：${bookData.name}`);
    },
  );
}

// 刪除 id 為 1 的書籍
function deleteFun(id) {
  request.delete(
    `${urlAPI}/books/${id}`,
    (error, response, body) => {
      let bookData;
      try {
        bookData = JSON.parse(body);
      } catch (err) {
        console.log(err);
      }
      // console.log(bookData);
      console.log(`成功刪除 id 為 ${id}，書名為：${bookData.name}`);
    },
  );
}

// 新增一本名為 I love coding 的書
function createFun(name) {
  request.post(
    `${urlAPI}/books`,
    // { form: { name: name } },
    { form: { name } },
    (error, response, body) => {
      let bookData;
      try {
        bookData = JSON.parse(body);
      } catch (err) {
        console.log(err);
      }
      // console.log(bookData);
      console.log(`成功新增一本書為${name}，id 為：${bookData.id}`);
    },
  );
}

// 更新 id 為 1 的書名為 new name
function updateFun(id, name) {
  request.patch(
    `${urlAPI}/books/${id}`,
    { form: { name } },
    (error, response, body) => {
      let bookData;
      try {
        bookData = JSON.parse(body);
      } catch (err) {
        console.log(err);
      }
      console.log(bookData);
      console.log(`更新 id ${id} 的書名為：${name}`);
    },
  );
}
