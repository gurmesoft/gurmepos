import{o as a,a as i,r as $,e as E,s as w,m as z,h as c,g as m,j as f,t as n,u,P as F,b as e,X as U,M as L,w as G,p as N,F as C,q as I,n as D,f as x,x as q,y as T,S as H,c as K,d as R,i as S,B as X,z as O,I as J,E as Q,k as W,l as Y}from"../vendor/main.js";import{a as V,u as k,_ as Z,p as ee}from"../tailwind/main.js";import{_ as te}from"../ProBadge/main.js";import{_ as j}from"../PrimaryButton/main.js";import{_ as se}from"../Warning/main.js";const oe=(l,s)=>{const r=l.__vccOpts||l;for(const[d,t]of s)r[d]=t;return r},ae={},ne={type:"button",class:"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center mr-2"};function le(l,s){return a(),i("button",ne,[$(l.$slots,"default")])}const re=oe(ae,[["render",le]]),v=E("GatewayAccounts",{state:()=>({gatewayAccounts:window.gpos.gateway_accounts||[]}),actions:{async addGatewayAccount(l){return await V.post("add_gateway_account",{gateway:l})},async getGatewayAccounts(){const l=await V.get("get_gateway_accounts");this.gatewayAccounts=l},updateActiveStatus(l,s){V.post("update_active_status",{id:l,status:s})}}}),de={id:"add-payment-gateway",tabindex:"-1","aria-hidden":"true",class:"fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full"},ce={class:"relative w-full h-full max-w-md md:h-auto"},ie={class:"relative bg-white rounded-lg shadow"},ue={class:"flex items-start justify-between p-1"},pe={id:"add-payment-gateway-close",type:"button",class:"text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center","data-modal-hide":"add-payment-gateway"},_e={class:"py-6 pl-6 pr-3 space-y-3"},me={class:"text-xl font-semibold flex items-center"},fe={class:"ml-2 bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded border border-purple-400"},he={class:"relative w-full"},ge={class:"absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"},ye={class:"pr-4"},be={class:"payment-gateway-modal mt-2 space-y-5 overflow-y-auto h-60 max-h-min"},we=["onMouseover"],xe={class:"flex gap-2 items-center py-2"},$e=["src"],ve={class:"text-sm font-normal text-gray-500"},ke={key:1},Ae={class:"px-6 pt-3 pb-6 text-sm font-medium text-gray-500"},Ve={href:"https://posentegrator.com/",target:"_blank",class:"text-blue-600"},Ce={__name:"AddPaymentGatewayModal",setup(l){const{paymentGateways:s}=k(),{addGatewayAccount:r,getGatewayAccounts:d}=v(),{gatewayAccounts:t}=w(v()),p=z(!1),o=z(""),g=()=>s.filter(_=>_.title.toLowerCase().includes(o.value.toLowerCase())&&!t.value.find(b=>_.id===b.gateway_id)),y=async _=>{document.getElementById("add-payment-gateway-close").click(),await r(_),H.fire({text:"Ödeme Kuruluşu Eklendi.",icon:"success",confirmButtonText:"Tamam",confirmButtonColor:"#1A56DB"}),d()};return(_,b)=>(a(),i("div",null,[c(j,{"data-modal-target":"add-payment-gateway","data-modal-toggle":"add-payment-gateway"},{default:m(()=>[f(n(_.$t("add_payment_comp"))+" ",1),c(u(F),{class:"w-4 h-4 ml-2"})]),_:1}),e("div",de,[e("div",ce,[e("div",ie,[e("div",ue,[e("button",pe,[c(u(U),{class:"w-5 h-5"})])]),e("div",_e,[e("p",me,[f(n(_.$t("add_payment_comp"))+" ",1),e("span",fe,n(g.length)+" "+n(_.$t("establishment")),1)]),e("div",he,[e("div",ge,[c(u(L),{class:"w-4 h-4 text-blue-600"})]),e("div",ye,[G(e("input",{"onUpdate:modelValue":b[0]||(b[0]=h=>o.value=h),type:"text",class:"!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !w-full !pl-10 !p-3 mb-6",placeholder:"Ödeme Kuruluşu Ara",required:""},null,512),[[N,o.value]])])]),e("div",be,[(a(!0),i(C,null,I(g(),(h,A)=>(a(),i("div",{key:A,class:D(`border rounded-lg flex justify-between items-center ${h.is_need_pro?"bg-gray-100 p-4":"p-3"}`),onMouseleave:b[1]||(b[1]=B=>p.value=!1),onMouseover:B=>p.value=A},[e("div",xe,[e("img",{class:"w-[50px] object-contain",src:h.logo},null,8,$e),e("span",ve,n(h.title),1)]),h.is_need_pro?(a(),x(te,{key:0})):(a(),i("div",ke,[p.value===A?(a(),x(re,{key:0,onClick:B=>y(h.id)},{default:m(()=>[c(u(q),{class:"w-5 h-5 font-bold"})]),_:2},1032,["onClick"])):T("",!0)]))],42,we))),128))])]),e("p",Ae,[f(n(_.$t("find_comp"))+" ",1),e("a",Ve,n(_.$t("contact_us")),1)])])])])]))}},Ie={class:"flex gap-2 items-center"},Te={class:"relative inline-flex items-center cursor-pointer"},Me=e("div",{class:"w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"},null,-1),Be={class:"ml-3 text-sm font-medium text-gray-900"},P={__name:"Toggle",props:["modelValue"],emits:["update:modelValue"],setup(l,{emit:s}){const r=l,d=K({get(){return r.modelValue},set(t){s("update:modelValue",t)}});return(t,p)=>(a(),i("div",Ie,[e("label",Te,[G(e("input",{"onUpdate:modelValue":p[0]||(p[0]=o=>S(d)?d.value=o:null),type:"checkbox",class:"sr-only peer"},null,512),[[R,u(d)]]),Me,e("span",Be,[$(t.$slots,"default")])])]))}},ze={class:"w-full text-sm text-left"},Ge={class:"text-xs text-gray-500 uppercase bg-[#F9FAFB]"},Se=e("th",{scope:"col",class:"px-6 py-3 sr-only"}," Logo ",-1),je={scope:"col",class:"px-6 py-3"},Pe={scope:"col",class:"px-6 py-3"},Ee={scope:"col",class:""},Fe={scope:"col",class:"px-6 py-3"},Ue={scope:"col",class:"px-6 py-3 sr-only"},Le={key:0},Ne={colspan:"6",class:"px-6 py-4 text-sm text-gray-400"},De={scope:"row",class:"px-4 py-4 font-medium text-gray-900 rounded-lg whitespace-nowrap"},qe=["src"],He={scope:"row",class:"px-6 py-4 font-medium text-gray-900 rounded-lg whitespace-nowrap"},Ke={class:"px-6 py-4"},Re={class:"flex gap-2 flex-wrap"},Xe=["data-tooltip-target"],Oe=["id"],Je={class:"max-w-xs flex flex-wrap break-words"},Qe=e("div",{class:"tooltip-arrow","data-popper-arrow":""},null,-1),We={class:"px-6 py-4"},Ye={class:"px-6 py-4 flex justify-end"},Ze={__name:"PaymentGatewayTable",setup(l){const{paymentGateways:s}=w(k()),{gatewayAccounts:r}=w(v()),d=(t,p)=>s.value.find(g=>g.id==t.gateway_id)[p];return(t,p)=>(a(),i("table",ze,[e("thead",Ge,[e("tr",null,[Se,e("th",je,n(t.$t("payment_method")),1),e("th",Pe,n(t.$t("features")),1),e("th",Ee,n(t.$t("currency")),1),e("th",Fe,n(t.$t("status")),1),e("th",Ue,n(t.$t("actions")),1)])]),e("tbody",null,[u(r).length===0?(a(),i("tr",Le,[e("td",Ne,n(t.$t("not_active_comp")),1)])):(a(!0),i(C,{key:1},I(u(r),(o,g)=>(a(),i("tr",{key:g,class:"bg-white border border-gray-100"},[e("th",De,[e("img",{class:"w-[50px]",src:d(o,"logo")},null,8,qe)]),e("th",He,n(d(o,"title"))+" "+n(o.is_default),1),e("td",Ke,[e("div",Re,[(a(!0),i(C,null,I(d(o,"supports"),(y,_)=>(a(),i("span",{key:_,class:"bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded"},n(t.$t(y)),1))),128))])]),e("td",null,[e("button",{"data-tooltip-target":`currency-${o.id}`,"data-tooltip-placement":"bottom",type:"button"},[c(u(X),{class:"w-5 h-5 text-green-600"})],8,Xe),e("div",{id:`currency-${o.id}`,role:"tooltip",class:"absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip"},[e("div",Je,n(d(o,"currencies").join(", ")),1),Qe],8,Oe)]),e("td",We,[c(P,{modelValue:o.status,"onUpdate:modelValue":y=>o.status=y,onChange:y=>t.store.updateActiveStatus(o.id,o.status)},null,8,["modelValue","onUpdate:modelValue","onChange"])]),e("td",Ye,[c(j,{href:o.settings_url},{default:m(()=>[c(u(O),{class:"w-4 h-4"})]),_:2},1032,["href"])])]))),128))])]))}},et={"data-tooltip-target":"tooltip-bottom","data-tooltip-placement":"bottom"},tt={id:"tooltip-bottom",role:"tooltip",class:"absolute z-10 invisible inline-block px-3 py-2 text-sm text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip"},st=e("div",{class:"tooltip-arrow","data-popper-arrow":""},null,-1),ot={__name:"Tooltip",setup(l){return(s,r)=>(a(),i("div",null,[e("button",et,[c(u(J),{class:"w-4 h-4"})]),e("div",tt,[$(s.$slots,"default"),st])]))}},at={class:"flex gap-2 items-center"},nt={__name:"TestMode",setup(l){const s=k(),{isTestMode:r}=w(s);return(d,t)=>(a(),i("div",at,[c(P,{modelValue:u(r),"onUpdate:modelValue":t[0]||(t[0]=p=>S(r)?r.value=p:null),onChange:u(s).updateTestMode},{default:m(()=>[f(n(d.$t("test_mode")),1)]),_:1},8,["modelValue","onChange"]),c(ot,null,{default:m(()=>[f(n(d.$t("test_mode_content")),1)]),_:1})]))}},lt={id:"alert-additional-content-4",class:"p-4 mb-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50",role:"alert"},rt={class:"flex items-center"},dt={class:"text-blue-600 text-lg font-medium"},ct={class:"text-blue-600 mt-2 mb-4 text-sm"},it={__name:"Info",setup(l){return(s,r)=>(a(),i("div",lt,[e("div",rt,[c(u(Q),{class:"w-4 h-4 mr-2"}),e("h3",dt,[$(s.$slots,"default")])]),e("div",ct,[$(s.$slots,"content")])]))}},ut={class:"w-full flex justify-between items-center border mb-2 border-gray-100 rounded-lg p-5"},pt=e("div",{id:"sticky-banner",tabindex:"-1",class:"fixed bottom-10 right-10"},null,-1),_t={__name:"App",setup(l){const s=k(),{isTestMode:r}=w(s),d=v(),{gatewayAccounts:t}=w(d);return(p,o)=>(a(),x(Z,null,{default:m(()=>[u(r)?(a(),x(se,{key:0},{content:m(()=>[f(" Test modu aktif iken test API'leri ile çalışmanız gerekmektedir, lütfen kullanmış olduğunuz sanal pos ayarlarından test API'lerini giriniz. ")]),default:m(()=>[f(" Test Modu Aktif")]),_:1})):T("",!0),u(t).length===0?(a(),x(it,{key:1},{content:m(()=>[f(" Hemen ödeme almaya başlamak için anlaşmalı olduğunuz ödeme kuruluşunun bağlantısını gerçekleştirin. ")]),default:m(()=>[f(" Henüz bir pos aktif etmediniz.")]),_:1})):T("",!0),e("div",ut,[c(nt),c(Ce)]),c(Ze),pt]),_:1}))}},mt=W({locale:"default",messages:window.gpos.strings}),M=Y(_t);M.use(ee);M.use(mt);M.mount("#app");
