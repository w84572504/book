(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-a451c61a"],{"0cab":function(c,n,t){"use strict";t.r(n);var a=function(){var c=this,n=c.$createElement,t=c._self._c||n;return t("div",{staticClass:"scan"},[c._m(0),t("div",{staticClass:"fotter"},[t("button",{on:{click:c.startRecognize}},[c._v("1.创建控件")]),t("button",{on:{click:c.startScan}},[c._v("2.开始扫描")]),t("button",{on:{click:c.cancelScan}},[c._v("3.结束扫描")]),t("button",{on:{click:c.closeScan}},[c._v("4.关闭控件")])])])},e=[function(){var c=this,n=c.$createElement,t=c._self._c||n;return t("div",{attrs:{id:"bcid"}},[t("div",{staticStyle:{height:"40%"}}),t("p",{staticClass:"tip"},[c._v("...载入中...")])])}],s=(t("ac1f"),t("5319"),null),o={name:"Login",data:function(){return{codeUrl:""}},methods:{startRecognize:function(){var c=this;function n(n,t,a){switch(n){case plus.barcode.QR:n="QR";break;case plus.barcode.EAN13:n="EAN13";break;case plus.barcode.EAN8:n="EAN8";break;default:n="其它"+n;break}t=t.replace(/\n/g,""),c.codeUrl=t,alert(t),c.closeScan()}window.plus&&(s=new plus.barcode.Barcode("bcid"),s.onmarked=n)},startScan:function(){window.plus&&s.start()},cancelScan:function(){window.plus&&s.cancel()},closeScan:function(){window.plus&&s.close()}}},i=o,l=(t("2587"),t("2877")),r=Object(l["a"])(i,a,e,!1,null,"31d8ef81",null);n["default"]=r.exports},2587:function(c,n,t){"use strict";var a=t("3c2b"),e=t.n(a);e.a},"3c2b":function(c,n,t){}}]);
//# sourceMappingURL=chunk-a451c61a.07433f34.js.map