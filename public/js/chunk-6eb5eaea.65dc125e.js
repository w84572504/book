(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-6eb5eaea"],{"5a43":function(t,e,n){},"6b68":function(t,e,n){"use strict";var r=n("5a43"),a=n.n(r);a.a},"88d7":function(t,e,n){"use strict";n.r(e);var r=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("nav-bar",[n("span",{staticClass:"iconfont bc-back",attrs:{slot:"left"},slot:"left"}),n("p",{attrs:{slot:"mid"},slot:"mid"},[t._v(t._s(t.getUser))]),n("p",{attrs:{slot:"right"},on:{click:t.goPage},slot:"right"},[t._v("用户中心")])]),n("div",[n("div",{staticClass:"headerbg"},[n("h2",{staticClass:"tit"},[t._v(t._s(t.getName))])])]),n("van-row",{staticClass:"con",attrs:{type:"flex",justify:"center"}},[n("van-col",{attrs:{span:"22"}},[n("van-row",{staticClass:"middle",attrs:{gutter:"20",type:"flex",justify:"center"}},[n("van-col",{attrs:{span:"18"}},[1==t.status?n("div",{staticClass:"gobtn"},[n("div",[n("van-button",{staticClass:"max",attrs:{type:"primary"},on:{click:function(e){return t.nextPage(1)}}},[t._v("立即入库")])],1),n("div",[n("van-button",{staticClass:"max",attrs:{type:"primary"},on:{click:function(e){return t.nextPage(4)}}},[t._v("查看信息")])],1)]):2==t.status?n("div",{staticClass:"gobtn"},[n("div",[n("van-button",{staticClass:"max",attrs:{type:"primary"},on:{click:function(e){return t.nextPage(2)}}},[t._v("实验操作")])],1),n("div",[n("van-button",{staticClass:"max",attrs:{type:"primary"},on:{click:function(e){return t.nextPage(3)}}},[t._v("报废操作")])],1),n("div",[n("van-button",{staticClass:"max",attrs:{type:"primary"},on:{click:function(e){return t.nextPage(4)}}},[t._v("查看信息")])],1)]):n("div",{staticClass:"gobtn"},[n("div",[n("van-button",{staticClass:"max",attrs:{type:"primary"},on:{click:function(e){return t.nextPage(4)}}},[t._v("查看信息")])],1)])])],1)],1)],1)],1)},a=[],s=(n("a4d3"),n("4de4"),n("4160"),n("b0c0"),n("e439"),n("dbb4"),n("b64b"),n("ac1f"),n("5319"),n("159b"),n("2fa7")),i=n("268c"),c=n("2f62"),o=n("8d85");function u(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function f(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?u(n,!0).forEach((function(e){Object(s["a"])(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):u(n).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var l={name:"DoPage",components:{navBar:i["a"]},data:function(){return{code:"",name:name,status:0,ids:0}},created:function(){this.code=this.$route.query.code,this._getEqu()},methods:f({},Object(c["c"])(["getUserInfo"]),{_getEqu:function(){var t=this;Object(o["d"])({bh:this.code}).then((function(e){t.status=e.data.status,t.ids=e.data.bh}))},nextPage:function(t){4==t?this.$router.push({path:"/user/info",query:{code:this.code,ids:this.ids}}):this.$router.push({path:"/user/fromsub/"+t,query:{code:this.code,ids:this.ids}})},goPage:function(){this.$router.replace("/user/home")}}),computed:{getUser:function(){var t=JSON.parse(this.getUserInfo());return t.username},getUid:function(){var t=JSON.parse(this.getUserInfo());return t.userid},getName:function(){return this.$route.query.name}}},p=l,d=(n("6b68"),n("2877")),b=Object(d["a"])(p,r,a,!1,null,"41ff5c18",null);e["default"]=b.exports},b0c0:function(t,e,n){var r=n("83ab"),a=n("9bf2").f,s=Function.prototype,i=s.toString,c=/^\s*function ([^ (]*)/,o="name";!r||o in s||a(s,o,{configurable:!0,get:function(){try{return i.call(this).match(c)[1]}catch(t){return""}}})}}]);
//# sourceMappingURL=chunk-6eb5eaea.65dc125e.js.map