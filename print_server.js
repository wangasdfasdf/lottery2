// 拼接content数据 --- start ----
const dayjs=function(params){
 const date = typeof params == 'string'? new Date(params): (params || new Date())
  var y = date.getFullYear();
  var m = date.getMonth() + 1;
  var d = date.getDate();
  var h = date.getHours();
  var mm = date.getMinutes();
  var ss = date.getSeconds();
  const REGEX_FORMAT = /\[([^\]]+)]|Y{1,4}|M{1,4}|D{1,2}|d{1,4}|H{1,2}|h{1,2}|a|A|m{1,2}|s{1,2}|Z{1,2}|SSS/g
  return {
    format(formatStr) {
      const zeroAdd = (p)=> p < 10 ? ('0' + p) : p;
      const str = formatStr 
      const matches = (match) => {
        switch (match) {
          case 'YYYY':
            return y
          case 'YY':
              return y.toString().slice(2)
          case 'MM':
            return zeroAdd(m)
          case 'DD':
            return zeroAdd(d)
          case 'H':
            return h
          case 'HH':
            return zeroAdd(h)
          case 'm':
            return mm
          case 'mm':
            return zeroAdd(mm)
          case 's':
            return ss
          case 'ss':
            return zeroAdd(ss)
          default:
            break
        }
        return null
      }
  
      return str.replace(REGEX_FORMAT, (match, $1) => $1 || matches(match))
    }
  }
}
const plsConfig = {
  /*----------- 直选-----------------*/
  409: {
    name: "直选",
    type: "1",
    category: "6",
    grf: 'zx',
    cate: '直选',
  },
  414: {
    name: "直选",
    type: "1",
    category: "1",
    grf: 'zx_fs',
    cate: '直选'
  },
  415: {
    name: "直选复式",
    type: "1",
    category: "1",
    grf: 'zx_fs',
    cate: '直选'
  },

  416: {
    name: "直选和值",
    type: "1",
    category: "2",
    grf: 'zx_hz',
    cate: '直选'
  },

  417: {
    name: "直选跨度",
    type: "1",
    category: "3",
    grf: 'zx_kd',
    cate: '直选'
  },

  418: {
    name: "直选组合复式",
    type: "1",
    category: "4",
    grf: 'zx_zhfs',
    cate: '直选'
  },
  429: {
    name: "直选组合胆拖",
    type: "1",
    category: "5",
    grf: 'zx_zhdt',
    cate: '直选'
  },
  /*----------- 组选-----------------*/
  410: {
    name: "组选",
    type: "2",
    category: "6",
    grf: 'zux',
    cate: '组选'
  },
  // 419 420 一样
  419: {
    name: "组选3复式",
    type: "2",
    category: "1",
    grf: 'zux_fs_3',
    cate: '组选'
  },
  420: {
    name: "组选3复式",
    type: "2",
    category: "1",
    grf: 'zux_fs_3',
    cate: '组选'
  },

  // 424 425 一样
  424: {
    name: "组选6复式",
    type: "3",
    category: "1",
    grf: 'zux_fs_6',
    cate: '组选'
  },

  425: {
    name: "组选6复式",
    type: "3",
    category: "1",
    grf: 'zux_fs_6',
    cate: '组选'
  },

  421: {
    name: "组选和值",
    type: "2,3",
    category: "2",
    grf: "zux_hz",
    cate: '组选'
  },

  422: {
    name: "组选3跨度",
    type: "2",
    category: "3",
    grf: "zux_kd_3",
    cate: '组选'
  },
  426: {
    name: "组选6跨度",
    type: "3",
    category: "3",
    grf: "zux_kd_6",
    cate: '组选'
  },

  423: {
    name: "组选3胆拖",
    type: "2",
    category: "5",
    grf: "zux_dt_3",
    cate: '组选'
  },
  427: {
    name: "组选6胆拖",
    type: "3",
    category: "5",
    grf: "zux_dt_6",
    cate: '组选'
  }
}
const bdConfig={
  dict_dcbf:[[{
    name:'胜其它',
    key:'sp10',
    value:'胜其它'
  },{
    name:'1:0',
    key:'sp1',
    value:'1:0'
  },{
    name:'2:0',
    key:'sp2',
    value:'2:0',
  },{
    name:'2:1',
    key:'sp3',
    value:'2:1',
  },{
    name:'3:0',
    key:'sp4',
    value:'3:0',
  },{
    name:'3:1',
    key:'sp5',
    value:'3:1',
  },{
    name:'3:2',
    key:'sp6',
    value:'3:2',
  },{
    name:'4:0',
    key:'sp7',
    value:'4:0',
  },{
    name:'4:1',
    key:'sp8',
    value:'4:1',
  },{
    name:'4:2',
    key:'sp9',
    value:'4:2',
  }],[{
    name:'平其它',
    key:'sp15',
    value:'平其它',
  },{
    name:'0:0',
    key:'sp11',
    value:'0:0',
  },{
    name:'1:1',
    key:'sp12',
    value:'1:1',
  },{
    name:'2:2',
    key:'sp13',
    value:'2:2',
  },{
    name:'3:3',
    key:'sp14',
    value:'3:3',
  }],[{
    name:'负其它',
    key:'sp25',
    value:'负其它',
  },{
    name:'0:1',
    key:'sp16',
    value:'0:1',
  },{
    name:'0:2',
    key:'sp17',
    value:'0:2',
  },{
    name:'1:2',
    key:'sp18',
    value:'1:2',
  },{
    name:'0:3',
    key:'sp19',
    value:'0:3',
  },{
    name:'1:3',
    key:'sp20',
    value:'1:3',
  },{
    name:'2:3',
    key:'sp21',
    value:'2:3',
  },{
    name:'0:4',
    key:'sp22',
    value:'0:4',
  },{
    name:'1:4',
    key:'sp23',
    value:'1:4',
  },{
    name:'2:4',
    key:'sp24',
    value:'2:4',
  }]]
  ,dict_bqc:[{
    name:'3-3',
    key:'sp1',
    value:'3-3'
  },{
    name:'3-1',
    key:'sp2',
    value:'3-1'
  },{
    name:'3-0',
    key:'sp3',
    value:'3-0'
  },{
    name:'1-3',
    key:'sp4',
    value:'1-3'
  },{
    name:'1-1',
    key:'sp5',
    value:'1-1'
  },{
    name:'1-0',
    key:'sp6',
    value:'1-0'
  },{
    name:'0-3',
    key:'sp7',
    value:'0-3'
  },{
    name:'0-1',
    key:'sp8',
    value:'0-1'
  },{
    name:'0-0',
    key:'sp9',
    value:'0-0'
  }]
  ,dict_sf:[{
    name:'胜',
    key:'sp1',
    value:'胜'
  },{
    name:'负',
    key:'sp2',
    value:'负'
  }]
 ,dict_spf:[{
    name:'胜',
    key:'sp1',
    value:'3'
  },{
    name:'平',
    key:'sp2',
    value:'1'
  },{
    name:'负',
    key:'sp3',
    value:'0'
  }]
 ,dict_sxp:[{
    name:'上单',
    key:'sp1',
    value:'上单'
  },{
    name:'上双',
    key:'sp2',
    value:'上双'
  },{
    name:'下单',
    key:'sp3',
    value:'下单'
  },{
    name:'下双',
    key:'sp4',
    value:'下双'
  }]
  ,dict_zjq:[{
    name:'0',
    key:'sp1',
    value:'0'
  },{
    name:'1',
    key:'sp2',
    value:'1'
  },{
    name:'2',
    key:'sp3',
    value:'2'
  },{
    name:'3',
    key:'sp4',
    value:'3'
  },{
    name:'4',
    key:'sp5',
    value:'4'
  },{
    name:'5',
    key:'sp6',
    value:'5'
  },{
    name:'6',
    key:'sp7',
    value:'6'
  },{
    name:'7+',
    key:'sp8',
    value:'7+'
  }]
}
/**
 * 票面信息相关功能重新组装
 */
 const fixOddsNumber = (num) => {
   //数字总共四位 + 小数点共五位
  const numStr = (num + '').split('.')
  numStr[1] = numStr[1] || '0'
  const precision= 4 - numStr[0].length //小数点后需要补的位置
  if (numStr[1].length < precision) {
    numStr[1] = numStr[1] + (new Array(precision - numStr[1].length).fill(0)).join("")
  }
  return numStr.join(".")
}
const factorial=(n)=>{
  return n<=1?1:n*factorial(n-1)
}
const combination=(n,m)=>{
  return factorial(n)/(factorial(m)*factorial(n-m))
}
function getMatchHtml(item) {
  const isBasketBall=item.pass_type.indexOf("篮球")==0
  const isHhgg=item.pass_type.indexOf("混合过关")>-1;
  const result = []
  const resultArr = [];
  const list = item.bet_info || []
  list.forEach((item, i) => {
    let arr = []
    // 混合模式下场次与日期中间没有空格，其他情况都有空格
    // 非混合模式下 场次与日期间两个空格 20230404
    // 混合模式下 print_label 两个空格拼接 20230404
    if(item.print_label.length){
      arr.push(`<p>第${i+1}场${isHhgg?item.num:'<i>'+item.num+'</i>'}${(item.print_label.map(v=>"<i>"+v+"</i>")).join("")}</p>`)
      resultArr.push(`第${i+1}场${isHhgg?item.num:'  '+item.num} ${item.print_label.join(isHhgg?"  ":" ")}`)
    }else{
      arr.push(`<p>第${i+1}场<i>${item.num}</i></p>`)
      resultArr.push(`第${i+1}场  ${item.num}`)
    }
    // 篮球票面客队在前，主队在后
    arr.push(isBasketBall?`<p>客队:${item.vsb} Vs 主队:${item.vsa}</p>`:`<p>主队:${item.vsa} Vs 客队:${item.vsb}</p>`)
    resultArr.push(isBasketBall?`客队:${item.vsb} Vs 主队:${item.vsa}`:`主队:${item.vsa} Vs 客队:${item.vsb}`)
    arr.push(`<p>${item.odds_name}</p>`)
    resultArr.push(item.odds_name)
    result.push(arr.join(''))
  });
  return {
    resultHtml:result.join(''),
    resultArr
  }
}

function fixMoney(str) {
  let arr = (str + '').split('.');
  let decimal=(arr[1]||'00').split("")
  return [(arr[0] || '0').replace(/(\d)(?=(?:\d{3})+$)/g, '$1,'), (new Array(2).fill(0)).map((v,i)=>decimal[i]||v).join('')].join(".")
}

function getRandomNum(min, max) {
  return min + Math.round(Math.random() * (max - min));
}

function getRandomStr(lens) {
  const num = Math.random().toString().slice(2, 2 + lens)
  const res = (num.split('')).map(v => {
    if (Math.random() < 0.2) {
      return String.fromCharCode(getRandomNum(65, 90))
    } else {
      return v
    }
  })
  return res.join('')
}
const getCompetionHtml=(item,is_redeem)=>{
  const { resultHtml }= getMatchHtml(item)
  return `<h3><b>${item.pass_method}</b><b>${item.bet_multiplier}倍</b><b>合计 ${item.bet_amount}元</b></h3>${resultHtml}<p>(选项固定奖金额为每1元投注对应的奖金额)</p>
  <p>本票最高可能固定奖金:${fixMoney(item.highest_reward)}元</p>
  <p>单倍注数:${item.bet_number}</p>`+(is_redeem?`<div class="exchange-box"><div class="exchange"><h5>已兑奖</h5><h6>${item.winning_status=='winning'?fixNum(item.wining_amount):'<i>0</i>元'}</h6></div></div>`:'')
}
// function generateRandomString(lens,letters,numbers,letterCount){
//   let randomString = '';
//   // 生成随机的数字数量
//   // const numberCount = lens - letterCount;

//   // 生成位置索引数组
//   const positions = Array.from({ length: lens }, (_, index) => index);
//   positions.sort(() => Math.random() - 0.5); // 随机打乱位置索引数组顺序
//   // 插入英文字母
//   for (let i = 0; i < letterCount; i++) {
//     const position = positions[i];
//     randomString = randomString.substring(0, position) + letters[Math.floor(Math.random()*letters.length)] + randomString.substring(position);
//   }

//   // 插入数字
//   for (let i = letterCount; i < lens; i++) {
//     const position = positions[i];
//     randomString = randomString.substring(0, position) + numbers[Math.floor(Math.random()*numbers.length)] + randomString.substring(position);
//   }
//   return randomString;
// }
// // 竞彩
// function getRandomSuffix_jc() {
//   // 页头串号后8位编码中穿插的英文字母至少要随机出现3个，不得超过5个（包含5个），字母为大写随机，英文字母范围：A  B  C  D  E  F其它英文字母不得出现
//   const lens=8;
//   const letters = ['A', 'B', 'C', 'D', 'E', 'F']; // 可用的英文字母
//   const numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']; // 可用的数字
//   // 生成随机的英文字母数量
//   const letterCount = Math.floor(Math.random() * 3) + 3;
//   return generateRandomString(lens,letters,numbers,letterCount)
// }
// // 北单
// function getRandomSuffix_bd() {
//   // 页头串号后13位编码中穿插的英文字母至少要随机出现6个，不得超过10个（包含10个），字母为大写随机，英文字母范围：A 至 Z，但不得出现O 
//   const lens=13;
//   const letters = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z"] ; // 可用的英文字母
//   const numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']; // 可用的数字
//   // 生成随机的英文字母数量
//   const letterCount = Math.floor(Math.random() * 5) + 6;
//   return generateRandomString(lens,letters,numbers,letterCount)
// }
// // 排列3
// function getRandomSuffix_pls() {
//   // 页头串号后6位编码中穿插的英文字母至少要随机出现三个，不得超过5个（包含5个），字母为大小写随机，英文字母范围：A 至 Z 含+号。
//   const lens=6;
//   const letters = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","p","q","r","s","t","u","v","w","x","y","z","+"] ; // 可用的英文字母
//   const numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']; // 可用的数字
//   // 生成随机的英文字母数量
//   const letterCount = Math.floor(Math.random() * 3) + 3;
//   let randomString = '';
//   // 生成随机的数字数量
//   // const numberCount = lens - letterCount;

//   // 生成位置索引数组
//   const positions = Array.from({ length: lens }, (_, index) => index);
//   positions.sort(() => Math.random() - 0.5); // 随机打乱位置索引数组顺序
//   // 插入英文字母
//   for (let i = 0; i < letterCount; i++) {
//     const position = positions[i];
//     const letterIndex=randomString.indexOf('+')>-1?Math.floor(Math.random()*(letters.length-1)):Math.floor(Math.random()*letters.length) //+号只出现一次
//     randomString = randomString.substring(0, position) + letters[letterIndex] + randomString.substring(position);
//   }

//   // 插入数字
//   for (let i = letterCount; i < lens; i++) {
//     const position = positions[i];
//     randomString = randomString.substring(0, position) + numbers[Math.floor(Math.random()*numbers.length)] + randomString.substring(position);
//   }
//   return randomString;

// }
function fixTax(amount,percent){
  const count = amount*percent*100
  //数字截断，保留两位小数
  const numStr = (count/100).toString().split('.')
  const dotArr = (numStr[1]||"00").split('')
  return [numStr[0],(new Array(2).fill('0')).map((v,i)=>dotArr[i]||v).join("")].join(".")
}
const fixNum=(_num)=>{
 const num=_num.toString()
 const numArr=num.split('.')
 const result=[numArr[0]||0]
 result.push("元")
 if(numArr[1] && parseInt(numArr[1])>0){
   result.push(parseInt(numArr[1]))
   result.push("分")
 }
 return result.join('')
}
const fixBbNums=(id)=>{
  const str = id+''
  if(str.length==1){
    return [' ',' ',str].join("")
  }if(str.length==2){
    return [' ',str].join("")
  }else{
    return str
  }
}
// 获取指定前缀指定位数的随机数
const getRandomOrderNum=(end,prefix='')=>{
  const full=(parseInt(Math.random()*10e16).toString() + parseInt(Math.random()*10e16).toString())
  return (prefix+full).substring(0,end)
}
const printContent = (item,print_conf) => {
  item.bet_info = item.bet_info||[];
  // const zsMatch=item.bet_number.match(/;共(\d+)注/)
  // const zsNum=Number(zsMatch&&zsMatch[1]?zsMatch[1]:10) //获取总共多少注
  const { resultArr}= getMatchHtml(item)
  return {
    title: "竞彩"+item.pass_type,
    time: dayjs(item.print_time||new Date()).format('YY/MM/DD HH:mm:ss') ,
    number: item.print_order_no?item.print_order_no.split(",").join(" "):'',
    content:"",
    content_arr:resultArr.concat(['(选项固定奖金额为每1元投注对应的奖金额)',`本票最高可能固定奖金:${fixMoney(item.highest_reward)}元`,
    `单倍注数:${item.bet_number}`]),
    code:print_conf.bottom_code,//底部编号
    printType:print_conf.print_type,//打印类型 1 广告版 2 地址版
    ads:print_conf.ad_content||[],
    tax:fixTax(item.bet_amount,0.21),
    address:print_conf.address,//店铺地址
    // isShort:item.pass_method.indexOf("单场固定")>-1&&item.bet_info.length<2 &&zsNum<=3 //是否是短票
  }
}
// 排列三内容

const printPlsContent=(item,print_conf)=>{
  let grf_suffix=''; //用于其他特殊情况追加grf文件后缀
  const print_order_no = item.print_order_no.split(",")
  const last_no = print_order_no.pop()
  let contentXml=''
  if(['409','410'].includes(item.pass_method)){
    // 单式
      let offset={1:2,2:1,3:1,4:1,5:0,6:2,7:2,8:1,9:1,10:0}[item.bet_info.length];
      item.bet_info.forEach((v,i)=>{
        contentXml+=`<content_${i+1+offset}>${item.bet_info.length>1?(String.fromCharCode(65 + i)+' '):''}${v.content.join("  ")}</content_${i+1+offset}>`
      })
      //超过5张用加长版
      grf_suffix=item.bet_info.length>5?'_l':''
  }else if(['414','415'].includes(item.pass_method)){
    // 直选复式
      let maxLens=0
      item.bet_info.forEach(v=>{
        v.content_arr=v.content.split(",")
        maxLens=Math.max(maxLens,v.content_arr.length)
      })
      item.bet_info.forEach((v,i)=>{
        let offset = new Array(maxLens-v.content_arr.length).fill("!")
        contentXml+=`<content_${i+1}>第${String.fromCharCode(65 + i)}位: ${v.content_arr.concat(offset).join(" ")}</content_${i+1}>`
      })
  }else if(['416','417','421','422','426'].includes(item.pass_method)){
    // 和值 与 跨度
    item.bet_info.forEach((v)=>{
      contentXml+=`<content_txt>${v.content.split(",").join("  ")}</content_txt>`
    })
  }else if(['418'].includes(item.pass_method)){
    // 组合复式
    item.bet_info.forEach((v)=>{
      contentXml+=`<content_txt>${v.content.split(",").join("  ")}</content_txt>`
    })
  }else if(['424','425','419','420'].includes(item.pass_method)){
    // 组合复式 超过8个换行
    item.bet_info.forEach((v)=>{
      const arr=v.content.split(",")
      if(arr.length>8 && plsConfig[item.pass_method] && plsConfig[item.pass_method].grf){
        const xmlarr=[arr.splice(0,8),v.content.split(",").splice(8)].map(a=>a.join("  "))
        contentXml+=`<content_txt>${xmlarr.join("\n")}</content_txt>`
        grf_suffix='_l'
      }else{
        grf_suffix=''
        contentXml+=`<content_txt>${arr.join("  ")}</content_txt>`
      }
    })
  }else if(['429','423','427'].includes(item.pass_method)){
    // 胆拖
     let maxLens=0;
    item.bet_info.forEach(v=>{
      v.xml_key=v.name=='胆码'?'dan_ma':'tuo_ma'
      v.content_arr = v.content.split(",")
      maxLens=Math.max(maxLens,v.content_arr.length)
    })
    item.bet_info.forEach((v)=>{
      let offset = new Array(maxLens-v.content_arr.length).fill("!")
      contentXml+=`<${v.xml_key}>${v.content_arr.concat(offset).join("  ")}</${v.xml_key}>`
    })
  }
  return {
    contentXml,
    grf_suffix, //grf后缀
    grf:plsConfig[item.pass_method]?plsConfig[item.pass_method].grf:'',
    pass_method_name:`${(plsConfig[item.pass_method]?plsConfig[item.pass_method].name:'')}票`,
    number: print_order_no.join(" ")+'  '+last_no,
    time: dayjs(item.print_time||new Date()).format('YY/MM/DD HH:mm:ss') ,
    open_time:dayjs(item.plan_end_time).format('YYYY年MM月DD日')+'开奖',
    code:print_conf.bottom_code,//底部编号
    code_num:'0007',
    printType:print_conf.print_type,//打印类型 1 广告版 2 地址版
    ads:print_conf.ad_content||[],
    tax:fixTax(item.bet_amount,0.34),
    address:print_conf.address,//店铺地址
  }
}
// 北单内容
const printBdContent=(item,print_conf)=>{
  const print_order_no = item.print_order_no.split(",")
  const last_no = print_order_no.pop()
  let content=[]
  let contentRight=[]
  if(item.detail.pass_type=='spf'){
    item.bet_info.forEach(v=>{
      content.push(`${fixBbNums(v.num)}.${v.vsa}`)
      const chooseKey = v.values.map(j=>j.k)
      let odds=[]
      bdConfig[`dict_${item.detail.pass_type}`].forEach(d=>{
         odds.push(chooseKey.includes(d.key)?d.value:"-")
      })
      contentRight.push(`${odds.join(" ")}${(v.handicap>0 || v.handicap<0)?` [${v.handicap<0?'-':'+'}${Math.abs(v.handicap)}]`:''}`)
    })
  } else if(item.detail.pass_type=='sf'){
    item.bet_info.forEach(v=>{
      content.push(`${fixBbNums(v.num)}.${v.vsa}`)
      const chooseKey = v.values.map(j=>j.k)
      let odds=[]
      bdConfig[`dict_${item.detail.pass_type}`].forEach(d=>{
         odds.push(chooseKey.includes(d.key)?d.value:"--")
      })
      contentRight.push(`${odds.join(" ")}${(v.handicap>0 || v.handicap<0)?` [${v.handicap<0?'-':'+'} ${Math.abs(v.handicap)}球]`:''}`)
    })
  }else if(item.detail.pass_type=='sxp'){
    item.bet_info.forEach(v=>{
      content.push(`${fixBbNums(v.num)}.${v.vsa}`)
      const chooseKey = v.values.map(j=>j.k)
      let odds=[]
      bdConfig[`dict_${item.detail.pass_type}`].forEach(d=>{
         odds.push(chooseKey.includes(d.key)?d.value:"？？")
      })
      contentRight.push(odds.join(" "))
    })
  }else if(item.detail.pass_type=='zjq'){
    item.bet_info.forEach(v=>{
      content.push(`${fixBbNums(v.num)}.${v.vsa}`)
      const chooseKey = v.values.map(j=>j.k)
      let odds=[]
      bdConfig[`dict_${item.detail.pass_type}`].forEach(d=>{
         odds.push(chooseKey.includes(d.key)?d.value:"-")
      })
      contentRight.push(odds.join(" "))
    })
  }else if(item.detail.pass_type=='bqc'){
    item.bet_info.forEach(v=>{
      content.push(`(${fixBbNums(v.num)}.${v.vsa})`)
      const chooseKey = v.values.map(j=>j.k)
      let odds=[]
      bdConfig[`dict_${item.detail.pass_type}`].forEach(d=>{
         odds.push(chooseKey.includes(d.key)?d.value:"---")
      })
      content.push(odds.join(" "))
    })
  }else if(item.detail.pass_type=='dcbf'){
    item.bet_info.forEach(v=>{
      content.push(`(${fixBbNums(v.num)}.${v.vsa})`)
      const chooseKey = v.values.map(j=>j.k)
      let odds=[]
      bdConfig[`dict_${item.detail.pass_type}`].forEach((d,i)=>{
        let child = []
        d.forEach((m,j)=>{
          child.push(chooseKey.includes(m.key)?m.value:j==0?"------":"---")
        })
        const first = child.shift()
        odds.push((child.concat([first])).join(" "))
      })
      content.push(odds.join("\n"))
    })
  }
  return {
    contentXml:`<content_txt>${content.join("\n")}</content_txt><content_right>${contentRight.join("\n")}</content_right>`,
    number: print_order_no.join(" ")+'  '+last_no,
    time: dayjs(item.print_time||new Date()).format('YY/MM/DD HH:mm:ss') ,
    code:print_conf.bottom_code,//底部编号
    code_num:'00088',
    printType:print_conf.print_type,//打印类型 1 广告版 2 地址版
    ads:print_conf.ad_content||[],
    tax:fixTax(item.bet_amount,0.22),
    address:print_conf.address,//店铺地址
  }
}
// 拼接content数据 --- end ----

function fillPassType (pass_method, bet_multiplier, bet_amount, fixBlank = 0) {
  // 汉字 20 数字,逗号，空格34 fixBlank:修正左侧偏移
  const spaceNum = 340 - getLens(pass_method) - getLens(bet_multiplier) - getLens(bet_amount)
  return `${pass_method}${new Array(fixBlank).fill(" ").join('')}${new Array(Math.ceil(spaceNum / 20) + 2).fill(" ").join('')}${bet_multiplier}`
}
function getLens (str) {
  // 一个汉字=1.7个数字
  let lens = 0;
  str.split("").forEach(v => lens += (/[\u4e00-\u9fa5]/).test(v) ? 17 : 10)
  return lens
}
const printWidth=79.0
// 排列3
function printPls ({ form, params, data }) {
 const report = urlAddRandomNo("./grwebapp/pls/" + form.grf + (form.grf_suffix||'')+".grf")
 const height = 101.0
  let pass_method = fillPassType(form.pass_method_name, `${params.bet_multiplier}倍`, `合计 ${params.bet_amount}元`, 2)
  return  renderGrfData(
      `<report>
      <_grparam>
      <order_no>${form.number}</order_no>
      <draw_no>${params.betting_info}</draw_no>
      <open_time>${form.open_time}</open_time>
      <multiple></multiple>
      <pass_type>${pass_method}</pass_type>
      <amount>${params.bet_amount}</amount>
      <time>${form.time}</time>
      <tax>${form.tax}</tax>
      ${form.contentXml}
      <code>${form.code}</code>
      <code_num>${params.serial_number}</code_num>
      <address>${form.address}</address>
      ${data.exchange_money ? `<exchange_title>已兑奖</exchange_title><exchange_money>${data.exchange_money}</exchange_money>` : ''}
      </_grparam>
      </report>`, `${data.exchange_money ? '' : 'Report.ControlByName("kuang").Visible = false;'}Report.Utility.TextWrapByWord = false;`, {report,height,width:printWidth})
}
// 北京单场
function printBjdc ({ form, params, data }) {
  let height = 203.0
  let grfName = 'bd' + params.detail.pass_type
  const pass_method_arr=params.pass_method.split(",");
  if (params.detail.pass_type == "spf" || params.detail.pass_type == "sf" || params.detail.pass_type == "sxp" || params.detail.pass_type == "zjq") {
    if (pass_method_arr.length > 3) {
      //特殊 <=5场为短票
      grfName += (params.bet_info.length <= 5) ? '_d' : '_c' //长短
      grfName += '_s'
      // 胜负 与 胜平负 大于5关的过关方式要分成两行
      if (pass_method_arr.length > 5 && (params.detail.pass_type == "spf" || params.detail.pass_type == "sf")) {
        grfName += '_2'
      }
    } else {
      // 非特殊 <=6场为短票
      grfName += (params.bet_info.length <= 6) ? '_d' : '_c' //长短
    }
    if (grfName.indexOf("_d") > -1) height = 101.0 //短票设置高度
  } else if (params.detail.pass_type == "bqc") {
    grfName += (params.bet_info.length <= 3 && pass_method_arr.length <= 2) ? '_d' : '_c' //长短
    if (pass_method_arr.length > 3) grfName += '_s' // 特殊
    if (grfName.indexOf("_d") > -1) height = 101.0 //短票设置高度
  } else if (params.detail.pass_type == "dcbf") {
    grfName += (params.bet_info.length <= 1) ? '_d' : '_c' //长短
    if (pass_method_arr.length > 3) grfName += '_s' // 特殊
    if ((params.bet_info.length > 7) && grfName.indexOf("_s") > -1) { //超长特殊
      grfName += '_l'
    } else if (params.bet_info.length > 8) { //超长
      grfName += '_l'
    }
    if (grfName.indexOf("_d") > -1) height = 101.0 //短票设置高度
  }
  const isSpecial = grfName.indexOf('_s') > -1
  let multiplier = ''
  let pass_method = '过关方式 '
  let pass_method_2 = ''
  if (grfName.indexOf('_2') > -1) { // 过关方式两行的
    let pass_arr = params.pass_method.split(",")
    pass_method += pass_arr.splice(0, 5).join("  ")
    pass_method_2 = `<pass_type_2>${pass_arr.join("  ")}</pass_type_2>`
  } else {
    pass_method += pass_method_arr.join("  ")
  }
  if (isSpecial) {
    multiplier = params.bet_multiplier
  } else if(pass_method_arr.length==3){
    // 只有三关特殊处理
    // pass_method = `${pass_method}`
    multiplier = `${new Array(13).fill(" ").join("")}${params.bet_multiplier}倍`
  } else {
    pass_method = fillPassType(pass_method, `${params.bet_multiplier}倍`, `合计 ${params.bet_amount}元`)
  }
  const report = urlAddRandomNo("./grwebapp/bd/" + grfName + ".grf")
  return  renderGrfData(
      `<report>
      <_grparam>
      <order_no>${form.number}</order_no>
      <draw_no>${params.betting_info}</draw_no>
      <open_time>${form.open_time}</open_time>
      <multiple>${multiplier}</multiple>
      <pass_type>${pass_method}</pass_type>
      ${pass_method_2}
      <amount>${params.bet_amount}</amount>
      <time>${form.time}</time>
      <tax>${form.tax}</tax>
      ${form.contentXml}
      <code>${form.code}</code>
      <code_num>${params.serial_number}</code_num>
      <address>${form.address}</address>
      ${data.exchange_money ? `<exchange_title>已兑奖</exchange_title><exchange_money>${data.exchange_money}</exchange_money>` : ''}
      </_grparam>
      </report>`, `${data.exchange_money ? '' : 'Report.ControlByName("kuang").Visible = false;'}Report.Utility.TextWrapByWord = false;`,{width:printWidth,height,report})
  // printType:userInfo.print_type,//打印类型 1 广告版 2 地址版
}
// 竞猜逻辑
function printCompetion ({ form, params, data, dom_height }) {
  let report = ''
  let height = 0
  if (dom_height > 95) {
    report = urlAddRandomNo("./grwebapp/c_e.grf")
    height= 203.0
  } else {
    report = urlAddRandomNo("./grwebapp/d_e.grf")
    height = 101.0
  }
  let bet_amount = `合计 ${params.bet_amount}元`
  let bet_multiplier = `${params.bet_multiplier}倍`
  let pass_method = fillPassType(params.pass_method, bet_multiplier, bet_amount)
  return  renderGrfData(
      `<report>
      <_grparam>
      <title>${form.title}</title>
      <order_no>${form.number}</order_no>
      <pass_type>${pass_method}</pass_type>
      <multiple></multiple>
      <amount>${bet_amount}</amount>
      <time>${form.time}</time>
      <tax>${form.tax}</tax>
      <content_txt>${form.content_arr.join("\n")}</content_txt>
      <code>${form.code}</code>
      <address>${form.address}</address>
      ${data.exchange_money ? `<exchange_title>已兑奖</exchange_title><exchange_money>${data.exchange_money}</exchange_money>` : ''}
      </_grparam>
      </report>`,`${data.exchange_money ? '' : 'Report.ControlByName("kuang").Visible = false;'}Report.Utility.TextWrapByWord = false;`, {report,height,width:printWidth})
}
function printExchange({ data }) {
  const report = urlAddRandomNo("./grwebapp/ypdy.grf")
  const height = 50.0
  return renderGrfData(
      `<report>
      <_grparam>
      <exchange_title>已兑奖</exchange_title>
      <exchange_money>${data.exchange_money}</exchange_money>
      </_grparam>
      </report>`, null, {report,height,width:printWidth})
}
function urlAddRandomNo(str){
  return str.replace('./grwebapp/','')
}
function renderGrfData(data, code, config){
  return str2base64(JSON.stringify({
    xml:data,
    code:code,
    conf:config
  }))
}
const base642str=(base64)=>{
  return Buffer.from(base64, "base64").toString();
}
const str2base64=(str)=>{
  return Buffer.from(str).toString('base64')
}
function combineOrderNo(print_order_no,order_prefix){
  const list_prefix=order_prefix.split(",")
  const list_order=print_order_no.split(",")
  const separator='-' //分隔符
  const list_combine=list_order.map((v,i)=>{
    const p = list_prefix[i]
     if(v.indexOf('-')>-1){
        const child = v.split(separator)
        const pre_child = p.split(separator)
        const _child = child.map((m,j)=>{
          return pre_child[j]?pre_child[j]+m.substring(pre_child[j].length):m
        })
        return _child.join(separator)
     }else{
      return p?p+v.substring(p.length):v
     }
  })
  return list_combine.join(',')
}
 /**
 * 主函数
 * @param {String} params 订单详情数据
 * @param {String} print_conf 用户打印配置 {print_type,order_prefix,address,bottom_code,ad_content}
 */
function renderData({params,print_conf,dom_height,is_redeem}){
  const data=is_redeem>0?{exchange_money:params.winning_status=='winning'?fixNum(params.wining_amount):'0元'}:{}
  const _print_conf={
    print_type:1,order_prefix:'',address:'',bottom_code:'11-056988-101',ad_content:['传统足彩2.6亿大派奖火热进行中！'],
    ...print_conf?print_conf:{}
  }
  if(is_redeem=='2'){
    return printExchange({data})
  }
  if(params.print_order_no && _print_conf.order_prefix){
    // 组合用户的编号与系统编号
    params.print_order_no=combineOrderNo(params.print_order_no,_print_conf.order_prefix)
  }
  let form = {}
  if(params.type=="bjdc"){
    form = printBdContent(params,_print_conf)
  }else if(params.type=="pls"){
    form = printPlsContent(params,_print_conf)
  }else {
    form = printContent(params,_print_conf)
  }
  if (params.type == 'pls') return printPls({ form, params, data })
  if (params.type == 'bjdc') return printBjdc({ form, params, data })
  return printCompetion({ form, params, data,dom_height })
}
const argReg=/^--args=/;
const argvIndex=process.argv.findIndex(v=>argReg.test(v))
if(argvIndex>-1){
  try{
    const arg=process.argv[argvIndex].replace(argReg,'')
    console.log(renderData(JSON.parse(base642str(arg))))
  }catch(err){
    console.log(err)
  }
}
module.exports={getCompetionHtml}
