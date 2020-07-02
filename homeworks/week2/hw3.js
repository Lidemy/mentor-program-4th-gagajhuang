function reverse(str) {
	let result = '';
	for(let i=str.length -1;i>=0;i--){  //由最後一個索引值往前輸出
		result += str[i];
	}
	console.log(result);
  // console.log(str.split("").reverse().join(""));
  /*
	執行順序為：
	1. split 分割字串 -> [h,e,l,l,o]
	2. reverse 反轉顯示 ->[o,e,l,l,h]
	3. join 合併字元 -> oellh
  */
}

reverse('hello');
