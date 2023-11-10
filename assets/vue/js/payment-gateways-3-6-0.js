import{o as n,c as l,r as C,s as k,y as x,h as d,f as _,g as p,t as o,u as c,_ as D,a as e,$ as F,a0 as T,w as V,p as N,F as S,x as j,n as I,e as b,I as L,b as y,a1 as P,a2 as q,a3 as E}from"./vendor-3-6-0.js";import{u as G,_ as R}from"./Page-3-6-0.js";import{_ as U}from"./_plugin-vue_export-helper-3-6-0.js";import{u as M,_ as H}from"./GatewayAccountsStore-3-6-0.js";import{_ as B}from"./PrimaryButton-3-6-0.js";import{S as J}from"./SetDefaultBadge-3-6-0.js";import{_ as K,a as O}from"./Warning-3-6-0.js";import{i as Q}from"./admin-app-3-6-0.js";import"./ajax-3-6-0.js";import"./store-3-6-0.js";const W={},X={type:"button",class:"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center mr-2"};function Y($,u){return n(),l("button",X,[C($.$slots,"default")])}const Z=U(W,[["render",Y]]),ee={key:0,class:"fixed top-0 left-0 z-50 flex align-center items-center h-screen justify-center w-full",style:{"background-color":"rgba(0,0,0,0.5)"}},te={class:"p-4 overflow-x-hidden overflow-y-auto"},se={class:"relative w-full h-full max-w-md"},oe={class:"relative bg-white rounded-lg shadow"},ne={class:"flex items-start justify-between p-1"},ae={class:"py-6 pl-6 pr-3 space-y-3"},le={class:"text-xl font-semibold flex items-center"},re={class:"ml-2 bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded border border-purple-400"},ie={class:"relative w-full"},de={class:"absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"},ce={class:"pr-4"},ue=["placeholder"],_e={class:"payment-gateway-modal mt-2 space-y-5 overflow-y-auto h-60 max-h-min"},pe=["onMouseover"],me={class:"flex gap-2 items-center py-2"},fe=["src"],he={class:"text-sm font-normal text-gray-500"},ye={key:1},ge={class:"px-6 pt-3 pb-6 text-sm font-medium text-gray-500"},be={href:"https://posentegrator.com/bize-ulasin/",target:"_blank",class:"text-blue-600"},$e={__name:"AddPaymentGatewayModal",setup($){const{paymentGateways:u}=G(),{addGatewayAccount:g}=M(),{gatewayAccounts:v}=k(M()),h=x(!1),r=x(""),i=x(!1),A=()=>u.filter(t=>t.title.toLowerCase().includes(r.value.toLowerCase())&&!v.value.find(a=>t.id===a.gateway_id)),w=async t=>{i.value=!1;const a=await g(t);window.location.href=a.settings_url};return(t,a)=>(n(),l("div",null,[d(B,{onClick:a[0]||(a[0]=s=>i.value=!i.value)},{default:_(()=>[p(o(t.$t("add_payment_comp"))+" ",1),d(c(D),{class:"w-4 h-4 ml-2"})]),_:1}),i.value?(n(),l("div",ee,[e("div",te,[e("div",se,[e("div",oe,[e("div",ne,[e("button",{type:"button",class:"text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center",onClick:a[1]||(a[1]=s=>i.value=!i.value)},[d(c(F),{class:"w-5 h-5"})])]),e("div",ae,[e("p",le,[p(o(t.$t("add_payment_comp"))+" ",1),e("span",re,o(c(u).length)+" "+o(t.$t("establishment")),1)]),e("div",ie,[e("div",de,[d(c(T),{class:"w-4 h-4 text-blue-600"})]),e("div",ce,[V(e("input",{"onUpdate:modelValue":a[2]||(a[2]=s=>r.value=s),type:"text",class:"!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !w-full !pl-10 !p-3 mb-6",placeholder:t.$t("search_payment_gateway"),required:""},null,8,ue),[[N,r.value]])])]),e("div",_e,[(n(!0),l(S,null,j(A(),(s,m)=>(n(),l("div",{key:m,class:I(`border rounded-lg flex justify-between items-center ${s.is_need_pro?"bg-gray-100 p-4":"p-3"}`),onMouseleave:a[3]||(a[3]=f=>h.value=!1),onMouseover:f=>h.value=m},[e("div",me,[e("img",{class:"w-[50px] object-contain",src:s.logo},null,8,fe),e("span",he,o(s.title),1)]),s.is_need_pro?(n(),b(H,{key:0})):(n(),l("div",ye,[h.value===m?(n(),b(Z,{key:0,onClick:f=>w(s.id)},{default:_(()=>[d(c(L),{class:"w-5 h-5 font-bold"})]),_:2},1032,["onClick"])):y("",!0)]))],42,pe))),128))])]),e("p",ge,[p(o(t.$t("find_comp"))+" ",1),e("a",be,o(t.$t("contact_us")),1)])])])])])):y("",!0)]))}},ve={class:"w-full text-sm text-left bg-white shadow-md"},we={class:"text-xs text-gray-500 uppercase bg-[#F9FAFB]"},xe={scope:"col",class:"px-6 py-3 w-4/12"},ke={scope:"col",class:"px-6 py-3 w-6/12"},Me={scope:"col",class:"w-1/12"},Ce={scope:"col",class:"px-6 py-3 sr-only w-1/12"},Ae={key:0},Se={colspan:"4",class:"px-6 py-4 text-sm text-gray-400"},je=["onMouseover"],Be={scope:"row",class:"px-3 py-4 font-medium text-gray-900 rounded-lg whitespace-nowrap flex gap-5 items-center !min-w-[300px]"},Ge=["src"],ze={key:1},De={class:"px-6 py-4"},Fe={class:"flex gap-2 flex-wrap"},Te=["href"],Ve=["onMouseenter","onMouseleave"],Ne=["id"],Ie={class:"max-w-xs flex flex-wrap break-words"},Le={class:"px-6 py-4 flex justify-end"},Pe={__name:"PaymentGatewayTable",setup($){const{paymentGateways:u}=k(G()),{updateDefaultStatus:g,getGatewayAccounts:v}=M(),{gatewayAccounts:h}=k(M()),r=x(!1),i=(t,a)=>u.value.find(m=>m.id==t.gateway_id)[a],A=async(t,a)=>{await g(t,a),v()},w=x([]);return(t,a)=>(n(),l("table",ve,[e("thead",we,[e("tr",null,[e("th",xe,o(t.$t("payment_method")),1),e("th",ke,o(t.$t("features")),1),e("th",Me,o(t.$t("currency")),1),e("th",Ce,o(t.$t("actions")),1)])]),e("tbody",null,[c(h).length===0?(n(),l("tr",Ae,[e("td",Se,o(t.$t("not_active_comp")),1)])):(n(!0),l(S,{key:1},j(c(h),(s,m)=>(n(),l("tr",{key:m,class:"bg-white border border-gray-100",onMouseleave:a[0]||(a[0]=f=>r.value=!1),onMouseover:f=>r.value=m},[e("th",Be,[e("img",{class:"w-[50px] max-h-[30px]",src:i(s,"logo")},null,8,Ge),p(" "+o(i(s,"title"))+" ",1),s.is_default?(n(),b(J,{key:0},{default:_(()=>[p(o(t.$t("default")),1)]),_:1})):y("",!0),r.value===m&&!s.is_default?(n(),l("div",ze,[d(B,{class:"!inline-flex !items-center !bg-blue-700 !text-white !text-xs !font-medium !mr-2 !px-2.5 !py-0.5 !rounded-full",onClick:f=>A(s.id,!0)},{default:_(()=>[p(o(t.$t("make_default")),1)]),_:2},1032,["onClick"])])):y("",!0)]),e("td",De,[e("div",Fe,[(n(!0),l(S,null,j(i(s,"supports").slice(0,5),(f,z)=>(n(),l("span",{key:z,class:"bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded"},o(t.$t(f)),1))),128)),i(s,"supports").length>5?(n(),l("a",{key:0,href:s.settings_url,class:"bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded underline"},o(t.$t("all_features")),9,Te)):y("",!0)])]),e("td",null,[e("span",{class:"z-10 cursor-pointer",onMouseenter:f=>w.value[s.id]=!0,onMouseleave:f=>w.value[s.id]=!1},[d(c(P),{class:"w-5 h-5 text-green-600"})],40,Ve),w.value[s.id]?(n(),l("div",{key:0,id:`currency-${s.id}`,class:"absolute z-10 inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm tooltip"},[e("div",Ie,o(i(s,"currencies").join(", ")),1)],8,Ne)):y("",!0)]),e("td",Le,[d(B,{href:s.settings_url},{default:_(()=>[d(c(q),{class:"w-4 h-4"})]),_:2},1032,["href"])])],40,je))),128))])]))}},qe={class:"p-4 mb-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full",role:"alert"},Ee={class:"flex items-center"},Re={class:"text-blue-600 text-md font-medium"},Ue={class:"text-blue-600 mt-2 mb-4 text-sm"},He={__name:"Info",setup($){return(u,g)=>(n(),l("div",qe,[e("div",Ee,[d(c(E),{class:"w-4 h-4 mr-2"}),e("span",Re,[C(u.$slots,"default")])]),e("div",Ue,[C(u.$slots,"content")]),C(u.$slots,"button")]))}},Je={class:"w-full flex justify-between items-center border mb-4 border-gray-100 rounded-lg p-5 bg-white shadow-md"},Ke=e("div",{id:"sticky-banner",tabindex:"-1",class:"fixed bottom-10 right-10"},null,-1),Oe={__name:"App",setup($){const u=G(),{isTestMode:g}=k(u),v=M(),{gatewayAccounts:h}=k(v);return(r,i)=>(n(),b(R,{text:r.$t("payment_methods"),href:"https://yardim.gurmehub.com/docs/pos-entegrator/odeme-yontemleri/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"},{default:_(()=>[c(g)?(n(),b(K,{key:0,class:"p-4 mb-4"},{content:_(()=>[p(o(r.$t("test_mode_content")),1)]),default:_(()=>[p(o(r.$t("test_mode_title")),1)]),_:1})):y("",!0),c(h).length===0?(n(),b(He,{key:1},{content:_(()=>[p(o(r.$t("empty_gateway_content")),1)]),default:_(()=>[p(o(r.$t("empty_gateway_title")),1)]),_:1})):y("",!0),e("div",Je,[d(O),d($e)]),d(Pe),Ke]),_:1},8,["text"]))}};Q(Oe);
