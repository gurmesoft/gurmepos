import{h as I,S as x,o as l,c as i,r as h,a as e,d as o,u as t,z as j,s as $,b as k,w as d,k as f,t as s,n as m,F as y,A as v,e as r,C as A,T as V,m as D,D as N,B as q,f as F,g as G}from"../vendor/main.js";import{p as z}from"../tailwind/main.js";import{b as w,u as M,_ as O,a as C}from"../PrimaryButton/main.js";import{_ as R}from"../Warning/main.js";const E=I("GatewayAccount",{state:()=>({gatewayAccount:window.gpos.gateway_account||{}}),actions:{async updateAccountSettings(){await w.post("update_account_settings",{id:this.gatewayAccount.id,settings:this.gatewayAccount.gateway_settings}),x.fire({text:"Ayarlar kayıt edildi.",icon:"success",confirmButtonText:"Tamam",confirmButtonColor:"#1A56DB"})},async testConnection(){const u=await w.post("check_connection",{id:this.gatewayAccount.id,settings:this.gatewayAccount.gateway_settings});x.fire({text:u.message,icon:u.result,confirmButtonText:"Tamam",confirmButtonColor:"#1A56DB"})},async deleteAccount(){return await w.post("remove_gateway_account",{id:this.gatewayAccount.id})}}}),L=["href"],H={key:1,type:"button",class:"!text-blue-700 border border-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"},B={__name:"OutlineButton",props:["href"],setup(u){return(c,n)=>u.href?(l(),i("a",{key:0,href:u.href,class:"!text-blue-700 border border-blue-700 !focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"},[h(c.$slots,"default")],8,L)):(l(),i("button",H,[h(c.$slots,"default")]))}},J={class:"w-72 flex justify-between py-4 px-3 bg-gray-50 rounded-lg items-center"},K={class:"text-base"},P={__name:"FeatureBadge",setup(u){return(c,n)=>(l(),i("div",J,[e("span",K,[h(c.$slots,"default")]),o(t(j),{class:"w-6 h-6 text-green-300"})]))}},Q={class:"w-full flex gap-5"},U={class:"w-3/5"},W={class:"w-full flex flex-wrap"},X={class:"w-full"},Y={class:"block mb-2 text-sm font-medium text-gray-900"},Z=["placeholder","disabled"],ee={class:"w-full flex justify-between items-center p-2 mt-4"},te={class:"mt-6 text-xs text-red-600 flex gap-1 items-center font-medium"},se={key:0,class:"bg-yellow-50 rounded-lg border-2 border-yellow-600 border-dashed py-10 px-3 mt-5"},ae={class:"w-full flex flex-wrap"},oe={class:"w-full"},ne={class:"block mb-2 text-sm font-medium text-gray-900"},le=["placeholder"],ce={class:"w-full flex justify-between items-center p-2 mt-4"},re={class:"w-2/5"},ie={class:"w-full flex flex-col gap-2"},de=["src"],ue={class:"text-lg text-gray-500"},_e=["href"],pe={class:"mt-10"},ge={class:"text-2xl font-bold text-[#111928]"},fe={class:"w-full flex flex-wrap gap-5 mt-4"},me={class:"mt-5"},ye={class:"text-2xl font-bold text-[#111928]"},we={class:"w-1/2 flex items-center flex-wrap break-words bg-gray-50 rounded-lg py-4 px-3"},he={class:"flex gap-2 items-center"},be={class:"text-xs text-gray-900 font-medium"},xe={__name:"App",setup(u){const c=E(),{gatewayAccount:n}=$(c),S=M(),{isTestMode:_,paymentGateways:T}=$(S);return n.value.gateway_property=T.value.find(a=>a.id===n.value.gateway_id),(a,ke)=>(l(),k(O,null,{default:d(()=>[e("div",Q,[e("div",U,[e("div",W,[(l(!0),i(y,null,f(t(n).gateway_property.fields,(p,g)=>(l(),i("div",{key:g,class:"w-1/2 p-2"},[e("div",X,[e("label",Y,s(p.label),1),e("input",{type:"text",class:m(`!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3 ${t(_)?"placeholder:text-gray-300":"placeholder:text-gray-600"}`),placeholder:p.label,required:"",disabled:t(_)},null,10,Z)])]))),128)),e("div",ee,[e("div",null,[o(B,{class:m(`${t(_)?"!border-gray-100 !text-gray-200":"bg-white"}`),disabled:t(_),onClick:t(c).testConnection},{default:d(()=>[o(t(v),{class:"w-4 h-4 mr-2"}),r(" "+s(a.$t("connect_test")),1)]),_:1},8,["class","disabled","onClick"]),o(C,{class:m(`${t(_)?"!bg-gray-100":"!bg-blue-700"}`),disabled:t(_)},{default:d(()=>[o(t(A),{class:"w-4 h-4 mr-2"}),r(" "+s(a.$t("save_settings")),1)]),_:1},8,["class","disabled"])]),e("button",te,[o(t(V),{class:"w-3 h-3"}),r(s(a.$t("delete_gateway")),1)])])]),t(_)?(l(),i("div",se,[o(R,{class:"!border-0"},{content:d(()=>[r(s(a.$t("test_mode_content")),1)]),default:d(()=>[r(s(a.$t("test_mode_title"))+" ",1)]),_:1}),e("div",ae,[(l(!0),i(y,null,f(t(n).gateway_property.fields,(p,g)=>(l(),i("div",{key:g,class:"w-1/2 p-2"},[e("div",oe,[e("label",ne,s(p.label),1),e("input",{type:"text",class:"!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3",placeholder:p.label,required:""},null,8,le)])]))),128))]),e("div",ce,[e("div",null,[o(B,{onClick:t(c).testConnection},{default:d(()=>[o(t(v),{class:"w-4 h-4 mr-2"}),r(s(a.$t("connect_test")),1)]),_:1},8,["onClick"]),o(C,{onClick:t(c).updateAccountSettings},{default:d(()=>[o(t(A),{class:"w-4 h-4 mr-2"}),r(s(a.$t("save_settings")),1)]),_:1},8,["onClick"])])])])):D("",!0)]),e("div",re,[e("div",ie,[e("img",{class:"w-1/4",src:t(n).gateway_property.logo},null,8,de),e("p",ue,s(a.$t(`${t(n).gateway_id}.description`)),1),e("a",{href:t(n).gateway_property.merchant_panel,target:"_blank",class:"mt-2 text-blue-700 text-sm flex gap-1 items-center"},[r(s(a.$t("gateway_screen")),1),o(t(N),{class:"w-3 h-3 text-blue-700"})],8,_e)])])]),e("div",pe,[e("span",ge,s(a.$t("supports_features")),1),e("div",fe,[(l(!0),i(y,null,f(t(n).gateway_property.supports,(p,g)=>(l(),k(P,{key:g},{default:d(()=>[r(s(a.$t(p)),1)]),_:2},1024))),128))])]),e("div",me,[e("span",ye,s(a.$t("supports_currency")),1),e("div",we,[e("div",he,[o(t(q),{class:"w-5 h-5 text-gray-900"}),e("span",be,s(t(n).gateway_property.currencies.join(", ")),1)])])])]),_:1}))}},$e=F({locale:"default",messages:window.gpos.strings}),b=G(xe);b.use(z);b.use($e);b.mount("#app");
