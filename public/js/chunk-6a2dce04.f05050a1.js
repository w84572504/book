(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-6a2dce04"],{"071f":function(t,e,a){},"0d03":function(t,e,a){var n=a("6eeb"),r=Date.prototype,s="Invalid Date",i="toString",o=r[i],c=r.getTime;new Date(NaN)+""!=s&&n(r,i,(function(){var t=c.call(this);return t===t?o.call(this):s}))},"4c38":function(t,e,a){"use strict";var n=a("071f"),r=a.n(n);r.a},6371:function(t,e,a){"use strict";var n=a("ea9f"),r=a.n(n);r.a},ad8c:function(t,e,a){"use strict";var n=a("cc9b"),r=a.n(n);r.a},b0c0:function(t,e,a){var n=a("83ab"),r=a("9bf2").f,s=Function.prototype,i=s.toString,o=/^\s*function ([^ (]*)/,c="name";!n||c in s||r(s,c,{configurable:!0,get:function(){try{return i.call(this).match(o)[1]}catch(t){return""}}})},bd7f:function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("nav-bar",[a("span",{staticClass:"iconfont bc-back",attrs:{slot:"left"},slot:"left"}),a("p",{attrs:{slot:"mid"},slot:"mid"},[t._v(t._s(t.name))]),a("p",{attrs:{slot:"right"},slot:"right"})]),a("div",[1==t.id?a("from-in",{attrs:{name:t.name,uid:t.getUid,ids:t.getPid}}):2==t.id?a("from-test",{attrs:{name:t.name,uid:t.getUid,ids:t.getPid}}):a("from-bad",{attrs:{name:t.name,uid:t.getUid,ids:t.getPid}})],1)],1)},r=[],s=(a("a4d3"),a("4de4"),a("4160"),a("b0c0"),a("e439"),a("dbb4"),a("b64b"),a("159b"),a("2fa7")),i=a("268c"),o=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"con"},[a("van-row",{attrs:{type:"flex",justify:"center"}},[a("van-col",{attrs:{span:"22"}},[a("h4",{staticClass:"tit"},[t._v(t._s(t.name))]),a("van-field",{attrs:{readonly:"",clickable:"",label:"报废原因",value:t.data.bfyy,placeholder:"选择原因",required:""},on:{click:function(e){t.showPicker=!0}}}),a("van-cell-group",[a("van-field",{attrs:{rows:"1",autosize:"",label:"报废说明",type:"textarea",placeholder:"请输入说明",required:""},model:{value:t.data.bfsm,callback:function(e){t.$set(t.data,"bfsm",e)},expression:"data.bfsm"}})],1),a("van-cell-group",[a("van-field",{attrs:{rows:"1",autosize:"",label:"备注",type:"textarea",placeholder:"请输入备注"},model:{value:t.data.bz,callback:function(e){t.$set(t.data,"bz",e)},expression:"data.bz"}})],1),a("div",[a("van-button",{staticClass:"sure",attrs:{type:"primary"},on:{click:t.submit}},[t._v("确认保存")])],1)],1)],1),a("van-popup",{attrs:{position:"bottom"},model:{value:t.showPicker,callback:function(e){t.showPicker=e},expression:"showPicker"}},[a("van-picker",{attrs:{"show-toolbar":"",columns:t.columns},on:{cancel:function(e){t.showPicker=!1},confirm:t.onConfirm}})],1)],1)},c=[],l=(a("ac1f"),a("5319"),a("8d85")),u={name:"FromTBad",props:{name:String,uid:String,ids:String},data:function(){return{data:{bh:"",bfyy:"",bfsm:"",bz:""},showPicker:!1,columns:[]}},created:function(){this._getBadInfo()},methods:{onConfirm:function(t){this.data.bfyy=t,this.showPicker=!1},_getBadInfo:function(){var t=this;Object(l["c"])().then((function(e){if(1==e.status){var a=[];for(var n in e.data)a.push(e.data[n]["mc"]);t.columns=a}}))},submit:function(){var t=this;this.data.bh=this.ids,Object(l["a"])(this.data).then((function(e){console.log(e),1==e.status?(t.$toast.show("报废操作成功！"),t.$router.replace("/user/tool")):t.$toast.show(e.msg)}))}}},d=u,f=(a("6371"),a("2877")),h=Object(f["a"])(d,o,c,!1,null,"86bdc5d6",null),m=h.exports,p=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"con"},[a("van-row",{attrs:{type:"flex",justify:"center"}},[a("van-col",{attrs:{span:"22"}},[a("h4",{staticClass:"tit"},[t._v(t._s(t.name))]),a("van-field",{attrs:{type:"text",label:"使用地点",placeholder:"请输入地点",required:""},model:{value:t.data.sydd,callback:function(e){t.$set(t.data,"sydd",e)},expression:"data.sydd"}}),a("van-field",{attrs:{type:"text",label:"生产日期",placeholder:"请输入生产日期",required:"",readonly:"readonly"},on:{focus:function(e){return t.makerTime("scrq")}},model:{value:t.data.scrq,callback:function(e){t.$set(t.data,"scrq",e)},expression:"data.scrq"}}),a("van-field",{attrs:{type:"text",label:"有效日期",placeholder:"请输入有效日期",required:"",readonly:"readonly"},on:{focus:function(e){return t.makerTime("yxrq")}},model:{value:t.data.yxrq,callback:function(e){t.$set(t.data,"yxrq",e)},expression:"data.yxrq"}}),a("van-field",{attrs:{type:"text",label:"下次检测日期",placeholder:"请输入检测日期",required:"",readonly:"readonly"},on:{focus:function(e){return t.makerTime("xcjxrq")}},model:{value:t.data.xcjxrq,callback:function(e){t.$set(t.data,"xcjxrq",e)},expression:"data.xcjxrq"}}),a("van-cell-group",[a("van-field",{attrs:{rows:"1",autosize:"",label:"备注",type:"textarea",placeholder:"请输入备注"},model:{value:t.data.bz,callback:function(e){t.$set(t.data,"bz",e)},expression:"data.bz"}})],1),a("van-uploader",{staticClass:"imgs",attrs:{"before-read":t.beforeRead,multiple:"","max-count":1},model:{value:t.data.fileList,callback:function(e){t.$set(t.data,"fileList",e)},expression:"data.fileList"}}),a("div",[a("van-button",{staticClass:"sure",attrs:{type:"primary"},on:{click:t.submit}},[t._v("确认保存")])],1)],1)],1),a("van-popup",{style:{height:"40%"},attrs:{position:"bottom"},model:{value:t.show,callback:function(e){t.show=e},expression:"show"}},[a("van-datetime-picker",{attrs:{type:"date","min-date":t.minDate},on:{confirm:function(e){return t.chose()}},model:{value:t.currentDate,callback:function(e){t.currentDate=e},expression:"currentDate"}})],1)],1)},b=[],v=(a("c975"),a("0d03"),{name:"FromIn",props:{name:String,uid:String,ids:String},data:function(){return{currentDate:new Date,minDate:new Date,show:!1,data:{bh:"",sydd:"",scrq:"",yxrq:"",xcjxrq:"",bz:"",rkzp:"",rkr:"",fileList:[]},which:"",imgArr:["image/jpeg","image/jpg","image/png","image/gif"]}},methods:{makerTime:function(t){this.show=!0,this.which=t},p:function(t){return t<10?"0"+t:t},chose:function(){var t=new Date(this.currentDate),e=t.getFullYear()+"-"+this.p(t.getMonth()+1)+"-"+this.p(t.getDate());this.data[this.which]=e,this.show=!1},beforeRead:function(t){return"-1"!=this.imgArr.indexOf(t.type)||(this.$toast.show("上传图片格式不正确!"),!1)},submit:function(){var t=this;this.data.bh=this.ids,this.data.rkr=this.uid,Object(l["i"])(this.data).then((function(e){1==e.status?(t.$toast.show("入库成功"),t.$router.replace("/user/tool")):t.$toast.show(e.msg)}))}}}),y=v,g=(a("ad8c"),Object(f["a"])(y,p,b,!1,null,"2acfe80e",null)),w=g.exports,x=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"con"},[a("van-row",{attrs:{type:"flex",justify:"center"}},[a("van-col",{attrs:{span:"22"}},[a("h4",{staticClass:"tit"},[t._v(t._s(t.name)+" 实验")]),a("van-field",{attrs:{readonly:"",clickable:"",label:"实验项目",value:t.data.syxm,placeholder:"选择原因",required:""},on:{click:function(e){t.showPicker=!0}}}),a("van-cell-group",[a("van-field",{attrs:{rows:"1",autosize:"",label:"实验描述",type:"textarea",placeholder:"请输入说明",required:""},model:{value:t.data.syms,callback:function(e){t.$set(t.data,"syms",e)},expression:"data.syms"}})],1),a("van-cell-group",[a("van-field",{attrs:{rows:"1",autosize:"",label:"备注",type:"textarea",placeholder:"请输入备注"},model:{value:t.data.bz,callback:function(e){t.$set(t.data,"bz",e)},expression:"data.bz"}})],1),a("div",[a("van-button",{staticClass:"sure",attrs:{type:"primary"},on:{click:t.submit}},[t._v("确认保存")])],1)],1)],1),a("van-popup",{attrs:{position:"bottom"},model:{value:t.showPicker,callback:function(e){t.showPicker=e},expression:"showPicker"}},[a("van-picker",{attrs:{"show-toolbar":"",columns:t.columns},on:{cancel:function(e){t.showPicker=!1},confirm:t.onConfirm}})],1)],1)},k=[],O={name:"FromTBad",props:{name:String,uid:String,ids:String},data:function(){return{data:{bh:"",syxm:"",syms:"",bz:""},showPicker:!1,columns:[]}},created:function(){this._getTestInfo()},methods:{onConfirm:function(t){this.data.syxm=t,this.showPicker=!1},_getTestInfo:function(){var t=this;Object(l["g"])().then((function(e){if(1==e.status){var a=[];for(var n in e.data)a.push(e.data[n]["mc"]);t.columns=a}}))},submit:function(){var t=this;this.data.bh=this.ids,Object(l["j"])(this.data).then((function(e){console.log(e),1==e.status?(t.$toast.show("操作成功！"),t.$router.replace("/user/tool")):t.$toast.show(e.msg)}))}}},j=O,$=(a("4c38"),Object(f["a"])(j,x,k,!1,null,"c51427b4",null)),q=$.exports,P=a("2f62");function _(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(t);e&&(n=n.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,n)}return a}function z(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?_(a,!0).forEach((function(e){Object(s["a"])(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):_(a).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}var D={name:"FromSub",components:{navBar:i["a"],FromBad:m,FromIn:w,FromTest:q},data:function(){return{id:0,code:"",name:name,ids:0}},created:function(){this.id=this.$route.params.id,this.code=this.$route.query.code,this._getEqu()},methods:z({},Object(P["c"])(["getUserInfo"]),{_getEqu:function(){var t=this;Object(l["d"])({bh:this.code}).then((function(e){1==e.status?t.name=e.data.name:t.$toast.show("获取信息失败")}))}}),computed:{getUser:function(){var t=JSON.parse(this.getUserInfo());return t.username},getUid:function(){var t=JSON.parse(this.getUserInfo());return t.userid},getPid:function(){return this.$route.query.ids}}},S=D,C=Object(f["a"])(S,n,r,!1,null,"c20b8af6",null);e["default"]=C.exports},c975:function(t,e,a){"use strict";var n=a("23e7"),r=a("4d64").indexOf,s=a("b301"),i=[].indexOf,o=!!i&&1/[1].indexOf(1,-0)<0,c=s("indexOf");n({target:"Array",proto:!0,forced:o||c},{indexOf:function(t){return o?i.apply(this,arguments)||0:r(this,t,arguments.length>1?arguments[1]:void 0)}})},cc9b:function(t,e,a){},ea9f:function(t,e,a){}}]);
//# sourceMappingURL=chunk-6a2dce04.f05050a1.js.map