(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-4e75e24a"],{"0cab":function(t,n,c){"use strict";c.r(n);var a=function(){var t=this,n=t.$createElement,c=t._self._c||n;return c("div",[c("nav-bar",[c("span",{staticClass:"iconfont bc-back",attrs:{slot:"left"},slot:"left"}),c("p",{attrs:{slot:"mid"},slot:"mid"},[t._v("扫描二维码")])]),t._m(0),c("div",{staticClass:"=footer"},[c("button",{on:{click:t.startRecognize}},[t._v("1.创建控件")]),c("button",{on:{click:t.startScan}},[t._v("2.开始扫描")]),c("button",{on:{click:t.cancelScan}},[t._v("3.结束扫描")]),c("button",{on:{click:t.closeScan}},[t._v("4.关闭控件")])])],1)},e=[function(){var t=this,n=t.$createElement,c=t._self._c||n;return c("div",{staticClass:"scan"},[c("div",{attrs:{id:"bcid"}},[c("p",{staticClass:"tip"},[t._v("...载入中...")])])])}],o=(c("b0c0"),c("ac1f"),c("5319"),c("268c")),s=c("8d85"),r=null,i={name:"Login",components:{navBar:o["a"]},data:function(){return{codeUrl:""}},created:function(){},mounted:function(){this.startRecognize()},methods:{startRecognize:function(){var t=this;function n(n,c,a){switch(n){case plus.barcode.QR:n="QR";break;case plus.barcode.EAN13:n="EAN13";break;case plus.barcode.EAN8:n="EAN8";break;default:n="其它"+n;break}c=c.replace(/\n/g,""),t.codeUrl=c,t.closeScan(),Object(s["d"])({bh:t.codeUrl}).then((function(n){1==n.status?t.$router.replace({path:"/user/dopage",query:{code:t.codeUrl,name:n.data.name}}):t.$toast.show("暂无数据")}))}window.plus&&(r=new plus.barcode.Barcode("bcid"),r.onmarked=n)},startScan:function(){window.plus&&r.start()},cancelScan:function(){window.plus&&r.cancel()},closeScan:function(){window.plus&&r.close()}}},l=i,u=(c("586e"),c("2877")),d=Object(u["a"])(l,a,e,!1,null,"2b5ca264",null);n["default"]=d.exports},4068:function(t,n,c){},"586e":function(t,n,c){"use strict";var a=c("4068"),e=c.n(a);e.a},b0c0:function(t,n,c){var a=c("83ab"),e=c("9bf2").f,o=Function.prototype,s=o.toString,r=/^\s*function ([^ (]*)/,i="name";!a||i in o||e(o,i,{configurable:!0,get:function(){try{return s.call(this).match(r)[1]}catch(t){return""}}})}}]);
//# sourceMappingURL=chunk-4e75e24a.ebbb7448.js.map