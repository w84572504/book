(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-63ea8eae"],{"6bec":function(a,s,t){},"8c80":function(a,s,t){"use strict";var e=t("6bec"),n=t.n(e);n.a},9486:function(a,s,t){"use strict";t.r(s);var e=function(){var a=this,s=a.$createElement,t=a._self._c||s;return t("div",[t("nav-bar",[t("span",{staticClass:"iconfont bc-back",attrs:{slot:"left"},slot:"left"}),t("p",{attrs:{slot:"mid"},slot:"mid"},[a._v("修改密码")])]),t("van-row",{attrs:{type:"flex",justify:"center"}},[t("van-col",{attrs:{span:"22"}},[t("van-cell-group",[t("van-field",{attrs:{type:"password",label:"旧密码",placeholder:"请输入旧密码",required:""},model:{value:a.data.oldpass,callback:function(s){a.$set(a.data,"oldpass",s)},expression:"data.oldpass"}})],1),t("van-field",{attrs:{type:"password",label:"新密码",placeholder:"请输入新密码",required:""},model:{value:a.data.newpass,callback:function(s){a.$set(a.data,"newpass",s)},expression:"data.newpass"}}),t("van-field",{attrs:{type:"password",label:"重复密码",placeholder:"请输入重复密码",required:""},model:{value:a.data.suepass,callback:function(s){a.$set(a.data,"suepass",s)},expression:"data.suepass"}}),t("van-button",{staticClass:"sure",attrs:{type:"primary"},on:{click:a.submit}},[a._v("确认修改")])],1)],1)],1)},n=[],l=(t("ac1f"),t("5319"),t("268c")),o=t("8d85"),c={name:"EditPass",components:{navBar:l["a"]},data:function(){return{data:{oldpass:"",newpass:"",suepass:""}}},methods:{submit:function(){var a=this;Object(o["b"])(this.data).then((function(s){1==s.status?(a.$toast.show("密码修改成功！"),a.$router.replace("/user/home")):a.$toast.show(s.data),console.log(s)}))}}},r=c,d=(t("8c80"),t("2877")),p=Object(d["a"])(r,e,n,!1,null,"2bf1a2ca",null);s["default"]=p.exports}}]);
//# sourceMappingURL=chunk-63ea8eae.9e8513d4.js.map