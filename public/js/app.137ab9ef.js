(function(e){function t(t){for(var r,o,u=t[0],c=t[1],l=t[2],s=0,f=[];s<u.length;s++)o=u[s],Object.prototype.hasOwnProperty.call(a,o)&&a[o]&&f.push(a[o][0]),a[o]=0;for(r in c)Object.prototype.hasOwnProperty.call(c,r)&&(e[r]=c[r]);d&&d(t);while(f.length)f.shift()();return i.push.apply(i,l||[]),n()}function n(){for(var e,t=0;t<i.length;t++){for(var n=i[t],r=!0,o=1;o<n.length;o++){var u=n[o];0!==a[u]&&(r=!1)}r&&(i.splice(t--,1),e=c(c.s=n[0]))}return e}var r={},o={app:0},a={app:0},i=[];function u(e){return c.p+"js/"+({}[e]||e)+"."+{"chunk-2d21a403":"c5b593c3","chunk-56ba0aed":"a40914ee","chunk-79180b48":"ad5840c4"}[e]+".js"}function c(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,c),n.l=!0,n.exports}c.e=function(e){var t=[],n={"chunk-56ba0aed":1};o[e]?t.push(o[e]):0!==o[e]&&n[e]&&t.push(o[e]=new Promise((function(t,n){for(var r="css/"+({}[e]||e)+"."+{"chunk-2d21a403":"31d6cfe0","chunk-56ba0aed":"d1ad90da","chunk-79180b48":"31d6cfe0"}[e]+".css",a=c.p+r,i=document.getElementsByTagName("link"),u=0;u<i.length;u++){var l=i[u],s=l.getAttribute("data-href")||l.getAttribute("href");if("stylesheet"===l.rel&&(s===r||s===a))return t()}var f=document.getElementsByTagName("style");for(u=0;u<f.length;u++){l=f[u],s=l.getAttribute("data-href");if(s===r||s===a)return t()}var d=document.createElement("link");d.rel="stylesheet",d.type="text/css",d.onload=t,d.onerror=function(t){var r=t&&t.target&&t.target.src||a,i=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");i.code="CSS_CHUNK_LOAD_FAILED",i.request=r,delete o[e],d.parentNode.removeChild(d),n(i)},d.href=a;var h=document.getElementsByTagName("head")[0];h.appendChild(d)})).then((function(){o[e]=0})));var r=a[e];if(0!==r)if(r)t.push(r[2]);else{var i=new Promise((function(t,n){r=a[e]=[t,n]}));t.push(r[2]=i);var l,s=document.createElement("script");s.charset="utf-8",s.timeout=120,c.nc&&s.setAttribute("nonce",c.nc),s.src=u(e);var f=new Error;l=function(t){s.onerror=s.onload=null,clearTimeout(d);var n=a[e];if(0!==n){if(n){var r=t&&("load"===t.type?"missing":t.type),o=t&&t.target&&t.target.src;f.message="Loading chunk "+e+" failed.\n("+r+": "+o+")",f.name="ChunkLoadError",f.type=r,f.request=o,n[1](f)}a[e]=void 0}};var d=setTimeout((function(){l({type:"timeout",target:s})}),12e4);s.onerror=s.onload=l,document.head.appendChild(s)}return Promise.all(t)},c.m=e,c.c=r,c.d=function(e,t,n){c.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},c.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},c.t=function(e,t){if(1&t&&(e=c(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(c.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)c.d(n,r,function(t){return e[t]}.bind(null,r));return n},c.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return c.d(t,"a",t),t},c.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},c.p="/",c.oe=function(e){throw console.error(e),e};var l=window["webpackJsonp"]=window["webpackJsonp"]||[],s=l.push.bind(l);l.push=t,l=l.slice();for(var f=0;f<l.length;f++)t(l[f]);var d=s;i.push([0,"chunk-vendors"]),n()})({0:function(e,t,n){e.exports=n("56d7")},"034f":function(e,t,n){"use strict";var r=n("85ec"),o=n.n(r);o.a},"0a0d":function(e,t,n){"use strict";n.r(t);var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[e._v(" 首页 ")])},o=[],a={name:"Index"},i=a,u=n("2877"),c=Object(u["a"])(i,r,o,!1,null,"ce904dac",null);t["default"]=c.exports},4360:function(e,t,n){"use strict";var r=n("2b0e"),o=n("2f62"),a={Authorization:function(e,t){localStorage.setItem("Authorization",t),e.Authorization=t},uinfo:function(e,t){localStorage.setItem("data",JSON.stringify(t)),e.user=JSON.stringify(t)},logout:function(e){localStorage.removeItem("Authorization"),localStorage.removeItem("data"),e.Authorization=null,e.user={}},showLoading:function(e){e.LOADING=!0},hideLoading:function(e){e.LOADING=!1}},i={alogin:function(e,t){var n=e.commit;n("Authorization",t)},uinfo:function(e,t){var n=e.commit;n("uinfo",t)},alogout:function(e){var t=e.commit;t("logout")}},u={getLoding:function(e){return e.LOADING},getUserInfo:function(e){return e.user}},c={};r["a"].use(o["a"]);var l={user:{},Authorization:null,LOADING:!1};t["a"]=new o["a"].Store({state:l,mutations:a,getters:u,actions:i,modules:c})},"56d7":function(e,t,n){"use strict";n.r(t);n("e260"),n("e6cf"),n("cca6"),n("a79d");var r=n("2b0e"),o=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{attrs:{id:"app"}},[n("router-view"),n("loading")],1)},a=[],i=n("0a0d"),u=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("van-popup",{attrs:{value:e.LOADING}},[n("van-loading",{attrs:{size:"24px",vertical:""}},[e._v("加载中...")])],1)],1)},c=[],l=n("2f62"),s={name:"Loding",data:function(){return{}},computed:Object(l["c"])(["LOADING"])},f=s,d=n("2877"),h=Object(d["a"])(f,u,c,!1,null,"e55bbe6e",null),p=h.exports,m={name:"home",components:{Index:i["default"],Loading:p}},g=m,v=(n("034f"),Object(d["a"])(g,o,a,!1,null,null,null)),b=v.exports,y=(n("d3b7"),n("8c4f")),w=n("4360");n("ac1f"),n("466d");function A(e){return!!/^1\d{10}$/.test(e)}var O=function(e,t){var n="";return function(r){n&&clearTimeout(n),n=setTimeout((function(){e(r)}),t)}};function x(){var e=window.navigator.userAgent.toLowerCase();return"micromessenger"==e.match(/MicroMessenger/i)}var k={checkPhone:A,debounce:O,isWeiXin:x};r["a"].use(y["a"]);var S=function(){return n.e("chunk-2d21a403").then(n.bind(null,"bb5b"))},L=function(){return Promise.resolve().then(n.bind(null,"0a0d"))},_=function(){return n.e("chunk-56ba0aed").then(n.bind(null,"f191"))},j=function(){return n.e("chunk-79180b48").then(n.bind(null,"3738"))},I=[{path:"/",redirect:"/index/index"},{path:"/index",component:S,meta:{islogin:!0},children:[{path:"index",name:"index",component:L,meta:{islogin:!0}}]},{path:"/weixin",component:_,meta:{islogin:!1}},{path:"/author",component:j,meta:{islogin:!1}}];localStorage.getItem("Authorization")&&w["a"].commit("Authorization",localStorage.Authorization);var E=new y["a"]({mode:"history",base:"/",routes:I});E.beforeEach((function(e,t,n){var r=k.isWeiXin(),o=e.path;r?e.matched.some((function(e){return e.meta.islogin}))?w["a"].state.Authorization?(console.log(w["a"].state),n()):n({path:"/author",query:{redirect:e.fullPath}}):n():"/weixin"==o?n():n({path:"/weixin"})}));var N=E,P=n("b970");n("157a");r["a"].use(P["a"]),r["a"].config.productionTip=!1,new r["a"]({router:N,store:w["a"],render:function(e){return e(b)}}).$mount("#app")},"85ec":function(e,t,n){}});
//# sourceMappingURL=app.137ab9ef.js.map