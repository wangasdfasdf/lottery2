(function(e){function t(t){for(var r,a,s=t[0],l=t[1],c=t[2],u=0,p=[];u<s.length;u++)a=s[u],Object.prototype.hasOwnProperty.call(o,a)&&o[a]&&p.push(o[a][0]),o[a]=0;for(r in l)Object.prototype.hasOwnProperty.call(l,r)&&(e[r]=l[r]);d&&d(t);while(p.length)p.shift()();return i.push.apply(i,c||[]),n()}function n(){for(var e,t=0;t<i.length;t++){for(var n=i[t],r=!0,a=1;a<n.length;a++){var s=n[a];0!==o[s]&&(r=!1)}r&&(i.splice(t--,1),e=l(l.s=n[0]))}return e}var r={},a={agency:0},o={agency:0},i=[];function s(e){return l.p+"static/js/"+({}[e]||e)+"."+{"chunk-09cd9940":"72fead9a","chunk-50533e0b":"d633af87"}[e]+".js"}function l(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,l),n.l=!0,n.exports}l.e=function(e){var t=[],n={"chunk-09cd9940":1,"chunk-50533e0b":1};a[e]?t.push(a[e]):0!==a[e]&&n[e]&&t.push(a[e]=new Promise((function(t,n){for(var r="static/css/"+({}[e]||e)+"."+{"chunk-09cd9940":"ff680a0a","chunk-50533e0b":"b9f50ba2"}[e]+".css",o=l.p+r,i=document.getElementsByTagName("link"),s=0;s<i.length;s++){var c=i[s],u=c.getAttribute("data-href")||c.getAttribute("href");if("stylesheet"===c.rel&&(u===r||u===o))return t()}var p=document.getElementsByTagName("style");for(s=0;s<p.length;s++){c=p[s],u=c.getAttribute("data-href");if(u===r||u===o)return t()}var d=document.createElement("link");d.rel="stylesheet",d.type="text/css",d.onload=t,d.onerror=function(t){var r=t&&t.target&&t.target.src||o,i=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");i.code="CSS_CHUNK_LOAD_FAILED",i.request=r,delete a[e],d.parentNode.removeChild(d),n(i)},d.href=o;var f=document.getElementsByTagName("head")[0];f.appendChild(d)})).then((function(){a[e]=0})));var r=o[e];if(0!==r)if(r)t.push(r[2]);else{var i=new Promise((function(t,n){r=o[e]=[t,n]}));t.push(r[2]=i);var c,u=document.createElement("script");u.charset="utf-8",u.timeout=120,l.nc&&u.setAttribute("nonce",l.nc),u.src=s(e);var p=new Error;c=function(t){u.onerror=u.onload=null,clearTimeout(d);var n=o[e];if(0!==n){if(n){var r=t&&("load"===t.type?"missing":t.type),a=t&&t.target&&t.target.src;p.message="Loading chunk "+e+" failed.\n("+r+": "+a+")",p.name="ChunkLoadError",p.type=r,p.request=a,n[1](p)}o[e]=void 0}};var d=setTimeout((function(){c({type:"timeout",target:u})}),12e4);u.onerror=u.onload=c,document.head.appendChild(u)}return Promise.all(t)},l.m=e,l.c=r,l.d=function(e,t,n){l.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},l.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},l.t=function(e,t){if(1&t&&(e=l(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(l.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)l.d(n,r,function(t){return e[t]}.bind(null,r));return n},l.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return l.d(t,"a",t),t},l.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},l.p="/",l.oe=function(e){throw e};var c=window["webpackJsonp"]=window["webpackJsonp"]||[],u=c.push.bind(c);c.push=t,c=c.slice();for(var p=0;p<c.length;p++)t(c[p]);var d=u;i.push([1,"chunk-vendors","chunk-common"]),n()})({1:function(e,t,n){e.exports=n("1fc4")},"122f":function(e,t,n){"use strict";var r=n("d786"),a=n.n(r);a.a},"1fc4":function(e,t,n){"use strict";n.r(t);n("cadf"),n("551c"),n("f751"),n("097d");var r=n("2b0e"),a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"app"}},[n("router-view"),n("el-dialog",{attrs:{title:"修改信息",visible:e.dialogVisible,width:"480px","destroy-on-close":"",center:"","close-on-click-modal":!1,"append-to-body":!0},on:{"update:visible":function(t){e.dialogVisible=t},closed:function(t){return e.$store.commit("SET_VISIBLE",!1)}}},[e.dialogVisible?n("setInfo"):e._e()],1),n("el-dialog",{attrs:{title:"充值天数",visible:e.rechargeVisible,width:"580px","destroy-on-close":"",center:"","close-on-click-modal":!1,"append-to-body":!0},on:{"update:visible":function(t){e.rechargeVisible=t},closed:function(t){return e.$store.commit("SET_RECHARGE",!1)}}},[e.rechargeVisible?n("setRecharge"):e._e()],1)],1)},o=[],i=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-form",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}],ref:"ruleForm",attrs:{inline:!0,model:e.ruleForm,rules:e.rules,"label-width":"100px"}},[n("el-form-item",{attrs:{label:"头像：",prop:"avatar"}},[n("v-upload",{ref:"upload_sets",attrs:{"auto-upload":!1,maxLens:1,UploadFile:e.UploadFile},on:{change:e.onFileChange},model:{value:e.ruleForm.avatar,callback:function(t){e.$set(e.ruleForm,"avatar",t)},expression:"ruleForm.avatar"}})],1),n("el-form-item",{attrs:{label:"名称：",prop:"name"}},[n("el-input",{attrs:{placeholder:"请输入名称",clearable:""},model:{value:e.ruleForm.name,callback:function(t){e.$set(e.ruleForm,"name",t)},expression:"ruleForm.name"}})],1),n("el-form-item",{attrs:{label:"登陆密码：",prop:"password"}},[n("el-input",{attrs:{placeholder:"请输入登陆密码",clearable:""},model:{value:e.ruleForm.password,callback:function(t){e.$set(e.ruleForm,"password",t)},expression:"ruleForm.password"}})],1),n("el-form-item",{attrs:{label:"确认密码：",prop:"password_confirmation"}},[n("el-input",{attrs:{placeholder:"请再次输入登陆密码",clearable:""},model:{value:e.ruleForm.password_confirmation,callback:function(t){e.$set(e.ruleForm,"password_confirmation",t)},expression:"ruleForm.password_confirmation"}})],1),n("el-form-item",{attrs:{label:" "}},[n("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.submitForm("ruleForm")}}},[e._v("确定")]),n("el-button",{staticStyle:{"margin-left":"40px"},on:{click:e.onClose}},[e._v("取消")])],1)],1)},s=[],l=(n("8e6e"),n("ac6a"),n("456d"),n("7f7f"),n("bd86")),c=(n("96cf"),n("3b8d")),u=(n("a481"),n("6b54"),n("bc3a")),p=n.n(u),d=n("2f62"),f=n("c1f7"),m=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-shop",{attrs:{api:e.api}})},h=[],g=n("0371"),b={components:{vShop:g["a"]},data:function(){return{api:{shopList:it,shopAdd:st,shopEdit:lt,shopInfo:ct,shopExpiry:ut}}}},v=b,y=n("2877"),_=Object(y["a"])(v,m,h,!1,null,null,null),w=_.exports,O=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-feedback",{attrs:{api:e.api}})},j=[],k=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-card",{staticClass:"box-card"},[n("div",{staticClass:"card-header no-margin",attrs:{slot:"header"},slot:"header"},[n("span",{staticClass:"card-title"},[e._v(e._s(e.$route.meta.title))])]),n("el-table",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}],staticStyle:{width:"100%"},attrs:{data:e.tableData,stripe:"",border:""}},[n("el-table-column",{attrs:{prop:"id",label:"ID",width:"60"}}),n("el-table-column",{attrs:{prop:"shop",label:"店铺名称"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n       "+e._s(t.row.shop.name)+"\n      ")]}}])}),n("el-table-column",{attrs:{prop:"shop",label:"店铺联系方式"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n       "+e._s(t.row.shop.phone)+"\n      ")]}}])}),n("el-table-column",{attrs:{prop:"problem",label:"反馈内容"}}),n("el-table-column",{attrs:{prop:"created_at",label:"反馈时间"},scopedSlots:e._u([{key:"default",fn:function(t){return[e._v("\n       "+e._s(e.formatDateTime(t.row.created_at))+"\n      ")]}}])}),n("el-table-column",{attrs:{prop:"reply",label:"回复内容"},scopedSlots:e._u([{key:"default",fn:function(t){return[n("span",{staticStyle:{color:"#67c23a"}},[e._v(e._s(t.row.reply))])]}}])}),n("el-table-column",{attrs:{prop:"reply_time",label:"回复时间"},scopedSlots:e._u([{key:"default",fn:function(t){return[t.row.reply_time?n("span",{staticStyle:{color:"#E6A23C"}},[e._v(e._s(e.formatDateTime(t.row.reply_time)))]):e._e()]}}])}),n("el-table-column",{attrs:{label:"操作"},scopedSlots:e._u([{key:"default",fn:function(t){return[n("el-button",{attrs:{type:"text"},on:{click:function(n){return e.handleReply(t.row)}}},[e._v("回复")])]}}])})],1),n("el-pagination",{attrs:{"current-page":e.currentPage,"page-sizes":[10,20,30],"page-size":e.pageSize,layout:"total, sizes, prev, pager, next, jumper",total:e.pageTotal},on:{"size-change":e.handleSizeChange,"current-change":e.handleCurrentChange}}),n("el-dialog",{attrs:{title:"意见回复",visible:e.dialogVisible,width:"480px","destroy-on-close":"",center:"","close-on-click-modal":!1},on:{"update:visible":function(t){e.dialogVisible=t}}},[n("el-form",{ref:"ruleForm",attrs:{model:e.ruleForm,rules:e.rules,"label-width":"10px"}},[n("el-form-item",{attrs:{label:"",prop:"reply"}},[n("el-input",{staticClass:"u-textarea",attrs:{type:"textarea",rows:8,placeholder:"请输入",clearable:""},model:{value:e.ruleForm.reply,callback:function(t){e.$set(e.ruleForm,"reply",t)},expression:"ruleForm.reply"}})],1)],1),n("span",{staticClass:"dialog-footer",attrs:{slot:"footer"},slot:"footer"},[n("el-button",{attrs:{type:"primary"},on:{click:function(t){return e.submitForm("ruleForm")}}},[e._v("提 交")])],1)],1)],1)},E=[],x=n("5a0c"),S=n.n(x);function P(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function F(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?P(Object(n),!0).forEach((function(t){Object(l["a"])(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):P(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var $={props:{api:{type:Object,default:function(){}}},data:function(){return{loading:!1,currentPage:1,pageSize:10,pageTotal:0,tableData:[],statusList:[],formInline:{},visible:!1,searhParams:{},dialogVisible:!1,ruleForm:{reply:""},rules:{reply:[{required:!0,message:"请输入",trigger:"blur"}]}}},methods:{formatDateTime:function(e){return S()(e).format("YYYY-MM-DD HH:mm:ss")},handleSizeChange:function(e){this.currentPage=1,this.pageSize=e,this.getData()},handleCurrentChange:function(e){this.currentPage=e,this.getData()},handleReply:function(e){this.ruleForm={id:e.id,reply:""},this.dialogVisible=!0},submitForm:function(e){var t=this;this.$refs[e].validate(function(){var e=Object(c["a"])(regeneratorRuntime.mark((function e(n){var r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(!n){e.next=7;break}return e.next=3,t.api.feedBackReply(t.ruleForm.id,{reply:t.ruleForm.reply});case 3:r=e.sent,200==r.code&&(t.dialogVisible=!1,t.$message.success("操作成功"),t.getData()),e.next=9;break;case 7:return e.abrupt("return",!1);case 9:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}())},getData:function(){var e=Object(c["a"])(regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(!this.loading){e.next=2;break}return e.abrupt("return");case 2:return this.loading=!0,e.next=5,this.api.feedBackList(F({num:this.pageSize,page:this.currentPage},this.searhParams));case 5:t=e.sent,this.loading=!1,200==t.code&&(this.pageTotal=t.data.total,this.currentPage=parseInt(t.data.current_page||1),this.tableData=t.data&&t.data.list?t.data.list:[]);case 8:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),onSearch:function(){this.currentPage=1;var e=this.formInline.range&&this.formInline.range[0]?this.formInline.range[0]:void 0,t=this.formInline.range&&this.formInline.range[1]?this.formInline.range[1]:void 0;this.searhParams=F({},this.formInline,{range:void 0,start_time:e,end_time:t}),this.getData()}},created:function(){this.getData()}},T=$,C=Object(y["a"])(T,k,E,!1,null,null,null),R=C.exports,D={components:{vFeedback:R},data:function(){return{api:{feedBackList:pt,feedBackReply:dt}}}},I=D,L=Object(y["a"])(I,O,j,!1,null,null,null),A=L.exports,N=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-order",{attrs:{api:e.api,aid:e.aid,sid:e.sid}})},U=[],V=n("e488"),M={components:{vOrder:V["a"]},data:function(){return{api:{orderList:ft,orderStat:mt},aid:this.$route.params.aid,sid:this.$route.params.sid}}},z=M,H=Object(y["a"])(z,N,U,!1,null,null,null),B=H.exports,G=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-trade",{attrs:{api:e.api,is_agent:e.is_agent}})},W=[],q=n("422f"),K={components:{vTrade:q["a"]},data:function(){return{api:{getWalletLogList:ht},is_agent:!0}}},Y=K,J=Object(y["a"])(Y,G,W,!1,null,null,null),Q=J.exports,X=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-account",{attrs:{api:e.api}})},Z=[],ee=n("889f"),te={components:{vAccount:ee["a"]},data:function(){return{api:{getAccountLogList:gt}}}},ne=te,re=Object(y["a"])(ne,X,Z,!1,null,null,null),ae=re.exports,oe=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-card",{staticClass:"box-card"},[n("div",{attrs:{slot:"header"},slot:"header"},[n("div",{staticClass:"card-header no-margin"},[n("span",{staticClass:"card-title"},[e._v(e._s(e.$route.meta.title))])])]),n("div",{directives:[{name:"loading",rawName:"v-loading",value:e.loading,expression:"loading"}]},[n("v-editor",{model:{value:e.content,callback:function(t){e.content=t},expression:"content"}}),n("el-button",{staticStyle:{"margin-top":"20px"},attrs:{type:"primary"},on:{click:e.submitForm}},[e._v("立即保存")])],1)])},ie=[],se=n("ceb0"),le={components:{vEditor:se["a"]},data:function(){return{loading:!1,content:"",editId:null}},methods:{submitForm:function(){var e=Object(c["a"])(regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(this.loading=!0,!this.editId){e.next=7;break}return e.next=4,yt(this.editId,this.content);case 4:e.t0=e.sent,e.next=10;break;case 7:return e.next=9,vt(this.content);case 9:e.t0=e.sent;case 10:t=e.t0,200==t.code&&this.$message.success("操作成功"),this.loading=!1;case 13:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}(),getData:function(){var e=Object(c["a"])(regeneratorRuntime.mark((function e(){var t;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return this.loading=!0,e.next=3,bt();case 3:t=e.sent,this.loading=!1,200==t.code&&t.data&&(this.editId=t.data.id,this.content=t.data.value);case 6:case"end":return e.stop()}}),e,this)})));function t(){return e.apply(this,arguments)}return t}()},created:function(){this.getData()}},ce=le,ue=Object(y["a"])(ce,oe,ie,!1,null,null,null),pe=ue.exports,de=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-wallet",{attrs:{api:e.api}})},fe=[],me=n("48a4"),he={components:{vWallet:me["a"]},data:function(){return{api:{uploadFile:tt,getWalletConf:_t,addWalletConf:wt,editWalletConf:Ot}}}},ge=he,be=Object(y["a"])(ge,de,fe,!1,null,null,null),ve=be.exports,ye=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-walletips",{attrs:{api:e.api}})},_e=[],we=n("5069"),Oe={components:{vWalletips:we["a"]},data:function(){return{api:{getWalletInfo:jt,addWalletInfo:kt,editWalletInfo:Et}}}},je=Oe,ke=Object(y["a"])(je,ye,_e,!1,null,null,null),Ee=ke.exports,xe=[{path:"/index",name:"index",component:f["a"],redirect:"/shop",meta:{title:"首页"},children:[{path:"/shop",name:"shop",component:w,meta:{title:"店铺管理",icon:"el-icon-s-shop"}},{path:"/order",name:"order",component:B,meta:{title:"订单管理",icon:"el-icon-s-order"}},{path:"/account",name:"account",component:ae,meta:{title:"余额记录",icon:"el-icon-s-finance"}},{path:"/trade",name:"trade",component:Q,meta:{title:"钱包记录",icon:"el-icon-s-ticket"}},{path:"/wallet",name:"wallet",component:ve,meta:{title:"钱包设置",icon:"el-icon-wallet"}},{path:"/walletip",name:"walletip",component:Ee,meta:{title:"钱包说明",icon:"el-icon-bell"}},{path:"/guide",name:"guide",component:pe,meta:{title:"续费教程",icon:"el-icon-reading"}},{path:"/feedback",name:"feedback",component:A,meta:{title:"意见反馈",icon:"el-icon-s-comment"}}]}];function Se(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function Pe(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?Se(Object(n),!0).forEach((function(t){Object(l["a"])(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):Se(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function Fe(e){var t=e.meta||{};return e.meta.hideInMenu?null:{path:e.path,name:e.name,meta:Pe({icon:"BarsOutlined"},t)}}function $e(e){var t=[];return e.map((function(e){var n=Fe(e);if(n&&e.children){var r=$e(e.children);if(1==r.length){var a=r[0],o=a.path,i=a.name;n={path:o,name:i,meta:n.meta}}else n.children=r}n&&t.push(n)})),t}var Te={state:{menus:[]},mutations:{SET_AUTH:function(e,t){e.auth=t},SET_MENU:function(e,t){e.menus=t}},actions:{GenerateMenus:function(e,t){var n=e.commit,r=t.allRoutes;return new Promise((function(e){var t=$e(r[0].children);n("SET_MENU",t),e(t)}))},GenerateRoutes:function(e,t){var n=e.commit;return new Promise((function(e){if(!t)return n("SET_MENU",[]),e(null);var r=xe;e(r)}))}}},Ce=Te;function Re(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function De(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?Re(Object(n),!0).forEach((function(t){Object(l["a"])(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):Re(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var Ie=function(e,t){var n="__agent_token__";if("set"!=e)return localStorage.getItem(n);t?localStorage.setItem(n,t):localStorage.removeItem(n)},Le=function(e,t){var n="__agent_name__";return n?"set"!=e?localStorage.getItem(n):void(t?localStorage.setItem(n,t):localStorage.removeItem(n)):null},Ae=Le("get"),Ne={state:{type:"agency",token:Ie("get"),username:Ae,hello:"",auth:[],roles:[],visible:!1,recharge:!1,userInfo:null},mutations:{SET_TOKEN:function(e,t){e.token=t,Ie("set",t)},SET_AUTH:function(e,t){e.auth=t},SET_WELCOME:function(e,t){e.welcome=t},SET_HELLO:function(e,t){e.hello=t},SET_USERINFO:function(e,t){e.userInfo=t},SET_VISIBLE:function(e,t){e.visible=t},SET_RECHARGE:function(e,t){e.recharge=t},SET_USERNAME:function(e,t){e.username=t,e.isSuper="admin"===t,Le("set",t)}},actions:{GetInfo:function(e){var t=e.commit;e.state;return new Promise((function(e){nt().then((function(n){if(200===n.code){var r=De({},n.data);t("SET_AUTH",[]),t("SET_USERINFO",r),e(r)}else e(null)})).catch((function(t){e(null)}))}))},Logout:function(e){var t=e.commit;return new Promise((function(e){t("SET_TOKEN",null),t("SET_USERINFO",null),t("SET_AUTH",[]),e()}))}}},Ue=new r["default"],Ve={state:{title:"宠物商家管理平台",menutitle:"宠物商家",collapsed:document.body.clientWidth<1500,reload:!1,bgColor:"#001529",actColor:"#ffffff"},mutations:{SET_COLLAPSED:function(e,t){e.collapsed=!e.collapsed},SET_RELOAD:function(e){e.reload=!0,Ue.$nextTick((function(){e.reload=!1}))}}};r["default"].use(d["a"]);var Me=new d["a"].Store({modules:{permission:Ce,user:Ne,layout:Ve},state:{},mutations:{},actions:{}}),ze=n("8c4f"),He=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"login-wrap"},[n("div",{staticClass:"ms-login"},[n("div",{staticClass:"ms-title"},[e._v(e._s(e.$store.state.layout.title)+"登录")]),n("el-form",{ref:"login",staticClass:"ms-content",attrs:{model:e.param,rules:e.rules,"label-width":"0px",size:"medium"}},[n("el-form-item",{attrs:{prop:"m_account"}},[n("el-input",{attrs:{maxlength:"11",placeholder:"请输入用户名"},model:{value:e.param.m_account,callback:function(t){e.$set(e.param,"m_account",t)},expression:"param.m_account"}},[n("el-button",{attrs:{slot:"prepend",icon:"el-icon-user"},slot:"prepend"})],1)],1),n("el-form-item",{attrs:{prop:"m_password"}},[n("el-input",{attrs:{type:"password",placeholder:"请输入密码","show-password":""},nativeOn:{keyup:function(t){return!t.type.indexOf("key")&&e._k(t.keyCode,"enter",13,t.key,"Enter")?null:e.submitForm()}},model:{value:e.param.m_password,callback:function(t){e.$set(e.param,"m_password",t)},expression:"param.m_password"}},[n("el-button",{attrs:{slot:"prepend",icon:"el-icon-lock"},slot:"prepend"})],1)],1),n("div",{staticClass:"login-btn"},[n("el-button",{attrs:{type:"primary",loading:e.loading},on:{click:e.submitForm}},[e._v("登 录")])],1)],1)],1)])},Be=[],Ge={data:function(){return{loading:!1,param:{m_account:this.$store.state.user.username,m_password:""},rules:{m_account:[{required:!0,message:"请输入账号",trigger:"blur"}],m_password:[{required:!0,message:"请输入密码",trigger:"blur"}]}}},methods:{submitForm:function(){var e=this;this.$refs.login.validate(function(){var t=Object(c["a"])(regeneratorRuntime.mark((function t(n){var r;return regeneratorRuntime.wrap((function(t){while(1)switch(t.prev=t.next){case 0:if(!n){t.next=9;break}return e.loading=!0,t.next=4,at({login_name:e.param.m_account,password:e.param.m_password});case 4:r=t.sent,e.loading=!1,200==r.code&&(e.$message.success("登录成功"),e.$store.commit("SET_TOKEN",r.data.token),e.$store.commit("SET_USERNAME",e.param.m_account),e.$store.commit("SET_AUTH",[]),e.$store.commit("SET_USERINFO",null),e.$router.replace("/index")),t.next=11;break;case 9:return e.$message.error("请输入账号和密码"),t.abrupt("return",!1);case 11:case"end":return t.stop()}}),t)})));return function(e){return t.apply(this,arguments)}}())}}},We=Ge,qe=(n("122f"),Object(y["a"])(We,He,Be,!1,null,"450a43d8",null)),Ke=qe.exports,Ye=[{path:"/",redirect:"/index"},{path:"/login",name:"login",component:Ke,meta:{title:"登录"}},{path:"/403",name:"403",component:function(){return n.e("chunk-09cd9940").then(n.bind(null,"4311"))},meta:{title:"403",hidden:!1}},{path:"/404",name:"404",component:function(){return n.e("chunk-50533e0b").then(n.bind(null,"ee5d"))},meta:{title:"404",hidden:!1}}],Je=ze["a"].prototype.push;ze["a"].prototype.push=function(e,t,n){return t||n?Je.call(this,e,t,n):Je.call(this,e).catch((function(e){return e}))},r["default"].use(ze["a"]);var Qe=new ze["a"]({routes:Ye}),Xe=new r["default"],Ze=p.a.create({baseURL:"/",timeout:2e4});Ze.interceptors.request.use(function(){var e=Object(c["a"])(regeneratorRuntime.mark((function e(t){return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:return t.headers.token=Me.state.user.token||"","post"===t.method&&("[object FormData]"==Object.prototype.toString.call(t.data)?t.headers["Content-Type"]="multipart/form-data":t.headers["Content-Type"]="application/json"),e.abrupt("return",t);case 3:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}(),(function(e){return Xe.$message.error(e),Promise.reject()})),Ze.interceptors.response.use((function(e){if(200===e.status)return 200!==e.data.code&&Xe.$message.error(e.data.msg),e.data;Xe.$message.error("接口请求异常，请稍后再试，错误代码："+e.status),Promise.reject(e)}),(function(e){var t=e&&e.response&&e.response.data&&401==e.response.data.code?"登录已过期":e;return Xe.$message.error(t),"登录已过期"==t&&Qe.replace("/login"),Promise.reject(t)}));var et=Ze,tt=function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return et.post("/agent/v1/upload",e,t)},nt=function(e){return et.get("/agent/v1/info",{params:e})},rt=function(e){return et.put("/agent/v1/info",e)},at=function(e){return et.post("/agent/v1/login",e)},ot=function(e){return et.get("/agent/v1/address",{params:e})},it=function(e){return et.get("/agent/v1/shop",{params:e})},st=function(e){return et.post("/agent/v1/shop",e)},lt=function(e,t){return et.put("/agent/v1/shop/".concat(e),t)},ct=function(e,t){return et.get("/agent/v1/shop/".concat(e),{params:t})},ut=function(e){return et.post("/agent/v1/shop/expiry-time",e)},pt=function(e){return et.get("/agent/v1/feedback",{params:e})},dt=function(e,t){return et.put("/agent/v1/feedback/".concat(e),t)},ft=function(e){return et.get("/agent/v1/order",{params:e})},mt=function(e){return et.get("/agent/v1/order/statistical",{params:e})},ht=function(e){return et.get("/agent/v1/shop/wallet-payment-log",{params:e})},gt=function(e){return et.get("/agent/v1/account-day/log",{params:e})},bt=function(){return et.get("/agent/v1/agent-config/guide",{})},vt=function(e){return et.post("/agent/v1/agent-config",{name:"续费教程",key:"guide",value:e})},yt=function(e,t){return et.put("/agent/v1/agent-config/".concat(e),{name:"续费教程",key:"guide",value:t})},_t=function(){return et.get("/agent/v1/agent-config/wallet_address",{})},wt=function(e){return et.post("/agent/v1/agent-config",{name:"钱包设置",key:"wallet_address",value:e})},Ot=function(e,t){return et.put("/agent/v1/agent-config/".concat(e),{name:"钱包设置",key:"wallet_address",value:t})},jt=function(){return et.get("/agent/v1/agent-config/wallet_info",{})},kt=function(e){return et.post("/agent/v1/agent-config",{name:"钱包说明",key:"wallet_info",value:e})},Et=function(e,t){return et.put("/agent/v1/agent-config/".concat(e),{name:"钱包说明",key:"wallet_info",value:t})},xt=n("d443");function St(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function Pt(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?St(Object(n),!0).forEach((function(t){Object(l["a"])(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):St(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var Ft={components:{vUpload:xt["a"]},data:function(){return{UploadFile:tt,ruleForm:{},loading:!1}},computed:{rules:function(){var e=this,t=function(t,n,r){if(!e.ruleForm.password)return r();""===n?r(new Error("请再次输入密码")):n!==e.ruleForm.password?r(new Error("两次输入密码不一致!")):r()};return{password_confirmation:[{required:!0,validator:t,trigger:"blur"}]}}},methods:{onFileChange:function(e){this.$refs.ruleForm.validateField("avatar")},onClose:function(){this.$store.commit("SET_VISIBLE",!1)},submitForm:function(e){var t=this;this.$refs[e].validate(function(){var e=Object(c["a"])(regeneratorRuntime.mark((function e(n){var r,a,o,i;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(!n){e.next=19;break}if(t.loading=!0,r=t.ruleForm.avatar&&t.ruleForm.avatar[0]?t.ruleForm.avatar[0].raw:null,a="",!r){e.next=11;break}return e.next=7,t.$refs.upload_sets.submit(r);case 7:o=e.sent,a=200==o.code&&o.data?o.data.url:"",e.next=12;break;case 11:a=t.ruleForm.avatar.map((function(e){return e.url})).join(",");case 12:return e.next=14,rt(Pt({},t.ruleForm.name?{name:t.ruleForm.name}:{},{},t.ruleForm.password_confirmation?{password:t.ruleForm.password_confirmation}:{},{},t.ruleForm.avatar?{avatar:a}:{}));case 14:i=e.sent,t.loading=!1,200==i.code&&(t.$message.success("操作成功"),t.$store.dispatch("GetInfo"),t.onClose()),e.next=21;break;case 19:return e.abrupt("return",!1);case 21:case"end":return e.stop()}}),e)})));return function(t){return e.apply(this,arguments)}}())}},created:function(){var e=this.$store.state.user.userInfo,t=e.name,n=e.avatar;this.ruleForm={name:t,avatar:n?[{url:t,avatar:n}]:[]}}},$t=Ft,Tt=Object(y["a"])($t,i,s,!1,null,null,null),Ct=Tt.exports,Rt=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"wall-info"},[n("div",{staticClass:"flex-center"},[n("el-image",{staticStyle:{width:"200px","min-height":"50px"},attrs:{src:e.wallet.wallet_address_img}})],1),e._m(0),n("div",{staticClass:"wall-ads"},[n("span",[e._v("收款钱包地址："+e._s(e.wallet.wallet_address)+" ")]),e.wallet.wallet_address?n("el-button",{staticClass:"copy-btn",attrs:{size:"small",round:"",type:"primary"},on:{click:function(t){return e.handleCopy(e.wallet.wallet_address)}}},[e._v("复 制")]):e._e()],1),n("div",{staticClass:"flex-center",staticStyle:{"padding-top":"40px"}},[n("el-button",{on:{click:e.onClose}},[e._v("关 闭")])],1)])},Dt=[function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"wall-desc"},[n("p",[e._v("仅支持"),n("i",[e._v("TRC-20")]),e._v("网络接收"),n("i",[e._v("USDT")])]),n("p",[n("i",[e._v("请仔细核对金额和货币类型")]),e._v("，错误的支付将导致资金无法到账")]),n("p",[e._v("超过15分钟未支付，请重新下单")])])}],It=n("ed08"),Lt={data:function(){return{wallet:{},ruleForm:{}}},computed:{rules:function(){return{}}},methods:{onClose:function(){this.$store.commit("SET_RECHARGE",!1)},handleCopy:function(e){var t=this;Object(It["b"])(e).then((function(){t.$message.success("复制成功!")})).catch((function(e){t.$message.error("复制失败!")}))},getData:function(){var e=this;ot().then((function(t){200==t.code&&(e.wallet=t.data)}))}},created:function(){this.getData()}},At=Lt,Nt=(n("89d0"),Object(y["a"])(At,Rt,Dt,!1,null,"6e8cfa7c",null)),Ut=Nt.exports,Vt={components:{setInfo:Ct,setRecharge:Ut},data:function(){return{dialogVisible:!1,rechargeVisible:!1}},computed:{isVisible:function(){return this.$store.state.user.visible},isRecharge:function(){return this.$store.state.user.recharge}},watch:{isVisible:function(e){this.dialogVisible=e},isRecharge:function(e){this.rechargeVisible=e}}},Mt=Vt,zt=(n("64c8"),n("8a5f"),Object(y["a"])(Mt,a,o,!1,null,null,null)),Ht=zt.exports;n("db4d"),n("6762");function Bt(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function Gt(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?Bt(Object(n),!0).forEach((function(t){Object(l["a"])(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):Bt(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var Wt=["login"];Qe.beforeEach(function(){var e=Object(c["a"])(regeneratorRuntime.mark((function e(t,n,r){var a,o,i;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(a=Me.state.user.userInfo,!a&&!Wt.includes(t.name)){e.next=6;break}r(),e.next=26;break;case 6:return e.next=8,Me.dispatch("GetInfo");case 8:if(o=e.sent,o){e.next=13;break}r({path:"/login",replace:!0}),e.next=26;break;case 13:if("enable"==o.status){e.next=17;break}return Qe.addRoute({path:"*",name:"pathMatch",redirect:"/404"}),e.abrupt("return",r({path:"/403",replace:!0}));case 17:return e.next=19,Me.dispatch("GenerateRoutes",Me.state.user);case 19:return i=e.sent,i.forEach((function(e){Qe.addRoute(e)})),Qe.addRoute({path:"*",name:"pathMatch",redirect:"/404"}),e.next=25,Me.dispatch("GenerateMenus",{allRoutes:i});case 25:r(Gt({},t));case 26:case"end":return e.stop()}}),e)})));return function(t,n,r){return e.apply(this,arguments)}}()),Qe.afterEach(function(){var e=Object(c["a"])(regeneratorRuntime.mark((function e(t,n){var r;return regeneratorRuntime.wrap((function(e){while(1)switch(e.prev=e.next){case 0:if(document.title="".concat(t.meta.title," | ").concat(Me.state.layout.title),"login"!=t.name||"login"===n.name){e.next=8;break}return Me.commit("SET_TOKEN",null),e.next=5,Me.dispatch("GenerateRoutes",null);case 5:r=new ze["a"]({routes:Ye}),Qe.matcher=r.matcher;case 8:case"end":return e.stop()}}),e)})));return function(t,n){return e.apply(this,arguments)}}());n("52be");r["default"].config.productionTip=!1,r["default"].prototype.$store=Me,new r["default"]({router:Qe,store:Me,render:function(e){return e(Ht)}}).$mount("#app")},"64c8":function(e,t,n){"use strict";var r=n("b874"),a=n.n(r);a.a},7665:function(e,t,n){},"89d0":function(e,t,n){"use strict";var r=n("7665"),a=n.n(r);a.a},"8a5f":function(e,t,n){"use strict";var r=n("ad3f"),a=n.n(r);a.a},ad3f:function(e,t,n){},b874:function(e,t,n){},d786:function(e,t,n){}});