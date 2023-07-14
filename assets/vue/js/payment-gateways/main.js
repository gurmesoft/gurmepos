import{o as a,a as c,r as G,s as x,u as p,g as _,q as z,h as f,j as b,d as E,x as C,f as g,t as s,y as F,b as e,z as I,A as N,w as T,i as L,F as S,B as V,n as U,e as v,C as q,D as O,E as R,c as H,G as Q,H as J,I as K,l as W,m as X}from"../vendor/main.js";import{u as A,a as M,_ as Y,p as Z}from"../tailwind/main.js";import{_ as P}from"../_plugin-vue_export-helper/main.js";import{_ as B}from"../PrimaryButton/main.js";import{_ as ee,a as te,b as se}from"../Info/main.js";const ae={},oe={type:"button",class:"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center mr-2"};function ne(d,l){return a(),c("button",oe,[G(d.$slots,"default")])}const re=P(ae,[["render",ne]]),le={key:0,class:"bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"},de={__name:"ProBadge",setup(d){const l=A(),{isProActive:m}=x(l);return(h,i)=>p(m)?b("",!0):(a(),c("span",le,[_(p(z),{class:"w-3 h-3"}),f("Pro")]))}},k=E("GatewayAccounts",{state:()=>({gatewayAccounts:window.gpos.gateway_accounts||[]}),actions:{async addGatewayAccount(d){return await M.post("add_gateway_account",{gateway:d})},async getGatewayAccounts(){const d=await M.get("get_gateway_accounts");this.gatewayAccounts=d},updateActiveStatus(d,l){M.post("update_active_status",{id:d,status:l})},async updateDefaultStatus(d,l){return await M.post("update_default_status",{id:d,default:l})}}}),ce={id:"add-payment-gateway",tabindex:"-1","aria-hidden":"true",class:"fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full"},ie={class:"relative w-full h-full max-w-md md:h-auto"},ue={class:"relative bg-white rounded-lg shadow"},pe={class:"flex items-start justify-between p-1"},_e={id:"add-payment-gateway-close",type:"button",class:"text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center","data-modal-hide":"add-payment-gateway"},me={class:"py-6 pl-6 pr-3 space-y-3"},fe={class:"text-xl font-semibold flex items-center"},ge={class:"ml-2 bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded border border-purple-400"},he={class:"relative w-full"},ye={class:"absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"},we={class:"pr-4"},be=["placeholder"],xe={class:"payment-gateway-modal mt-2 space-y-5 overflow-y-auto h-60 max-h-min"},$e=["onMouseover"],ve={class:"flex gap-2 items-center py-2"},ke=["src"],Ae={class:"text-sm font-normal text-gray-500"},Me={key:1},Ce={class:"px-6 pt-3 pb-6 text-sm font-medium text-gray-500"},Se={href:"https://posentegrator.com/bize-ulasin/",target:"_blank",class:"text-blue-600"},Ve={__name:"AddPaymentGatewayModal",setup(d){const{paymentGateways:l}=A(),{addGatewayAccount:m}=k(),{gatewayAccounts:h}=x(k()),i=C(!1),o=C(""),r=()=>l.filter(t=>t.title.toLowerCase().includes(o.value.toLowerCase())&&!h.value.find(u=>t.id===u.gateway_id)),$=async t=>{document.getElementById("add-payment-gateway-close").click();const u=await m(t);window.location.href=u.settings_url};return(t,u)=>(a(),c("div",null,[_(B,{"data-modal-target":"add-payment-gateway","data-modal-toggle":"add-payment-gateway"},{default:g(()=>[f(s(t.$t("add_payment_comp"))+" ",1),_(p(F),{class:"w-4 h-4 ml-2"})]),_:1}),e("div",ce,[e("div",ie,[e("div",ue,[e("div",pe,[e("button",_e,[_(p(I),{class:"w-5 h-5"})])]),e("div",me,[e("p",fe,[f(s(t.$t("add_payment_comp"))+" ",1),e("span",ge,s(p(l).length)+" "+s(t.$t("establishment")),1)]),e("div",he,[e("div",ye,[_(p(N),{class:"w-4 h-4 text-blue-600"})]),e("div",we,[T(e("input",{"onUpdate:modelValue":u[0]||(u[0]=n=>o.value=n),type:"text",class:"!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !w-full !pl-10 !p-3 mb-6",placeholder:t.$t("search_payment_gateway"),required:""},null,8,be),[[L,o.value]])])]),e("div",xe,[(a(!0),c(S,null,V(r(),(n,y)=>(a(),c("div",{key:y,class:U(`border rounded-lg flex justify-between items-center ${n.is_need_pro?"bg-gray-100 p-4":"p-3"}`),onMouseleave:u[1]||(u[1]=w=>i.value=!1),onMouseover:w=>i.value=y},[e("div",ve,[e("img",{class:"w-[50px] object-contain",src:n.logo},null,8,ke),e("span",Ae,s(n.title),1)]),n.is_need_pro?(a(),v(de,{key:0})):(a(),c("div",Me,[i.value===y?(a(),v(re,{key:0,onClick:w=>$(n.id)},{default:g(()=>[_(p(q),{class:"w-5 h-5 font-bold"})]),_:2},1032,["onClick"])):b("",!0)]))],42,$e))),128))])]),e("p",Ce,[f(s(t.$t("find_comp"))+" ",1),e("a",Se,s(t.$t("contact_us")),1)])])])])]))}},Be={},Ge={class:"inline-flex items-center bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full"},je=e("span",{class:"w-2 h-2 mr-1 bg-green-500 rounded-full"},null,-1);function Te(d,l){return a(),c("span",Ge,[je,G(d.$slots,"default")])}const Pe=P(Be,[["render",Te]]),De={class:"w-full text-sm text-left bg-white shadow-md"},ze={class:"text-xs text-gray-500 uppercase bg-[#F9FAFB]"},Ee={scope:"col",class:"px-6 py-3"},Fe={scope:"col",class:"px-6 py-3"},Ie={scope:"col",class:""},Ne={scope:"col",class:"px-6 py-3 sr-only"},Le={key:0},Ue={colspan:"4",class:"px-6 py-4 text-sm text-gray-400"},qe=["onMouseover"],Oe={scope:"row",class:"px-3 py-4 font-medium text-gray-900 rounded-lg whitespace-nowrap flex gap-5 items-center !min-w-[300px]"},Re=["src"],He={key:1},Qe={class:"px-6 py-4"},Je={class:"flex gap-2 flex-wrap"},Ke=["href"],We=["data-tooltip-target"],Xe=["id"],Ye={class:"max-w-xs flex flex-wrap break-words"},Ze=e("div",{class:"tooltip-arrow","data-popper-arrow":""},null,-1),et={class:"px-6 py-4 flex justify-end"},tt={__name:"PaymentGatewayTable",setup(d){const{paymentGateways:l}=x(A()),{updateDefaultStatus:m,getGatewayAccounts:h}=k(),{gatewayAccounts:i}=x(k()),o=C(!1),r=(t,u)=>l.value.find(y=>y.id==t.gateway_id)[u],$=async(t,u)=>{await m(t,u),h()};return(t,u)=>(a(),c("table",De,[e("thead",ze,[e("tr",null,[e("th",Ee,s(t.$t("payment_method")),1),e("th",Fe,s(t.$t("features")),1),e("th",Ie,s(t.$t("currency")),1),e("th",Ne,s(t.$t("actions")),1)])]),e("tbody",null,[p(i).length===0?(a(),c("tr",Le,[e("td",Ue,s(t.$t("not_active_comp")),1)])):(a(!0),c(S,{key:1},V(p(i),(n,y)=>(a(),c("tr",{key:y,class:"bg-white border border-gray-100",onMouseleave:u[0]||(u[0]=w=>o.value=!1),onMouseover:w=>o.value=y},[e("th",Oe,[e("img",{class:"w-[50px] max-h-[30px]",src:r(n,"logo")},null,8,Re),f(" "+s(r(n,"title"))+" ",1),n.is_default?(a(),v(Pe,{key:0},{default:g(()=>[f(s(t.$t("default_payment")),1)]),_:1})):b("",!0),o.value===y&&!n.is_default?(a(),c("div",He,[_(B,{class:"!inline-flex !items-center !bg-blue-700 !text-white !text-xs !font-medium !mr-2 !px-2.5 !py-0.5 !rounded-full",onClick:w=>$(n.id,!0)},{default:g(()=>[f(s(t.$t("make_default_payment")),1)]),_:2},1032,["onClick"])])):b("",!0)]),e("td",Qe,[e("div",Je,[(a(!0),c(S,null,V(r(n,"supports").slice(0,5),(w,D)=>(a(),c("span",{key:D,class:"bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded"},s(t.$t(w)),1))),128)),r(n,"supports").length>5?(a(),c("a",{key:0,href:n.settings_url,class:"bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded underline"},s(t.$t("all_features")),9,Ke)):b("",!0)])]),e("td",null,[e("button",{"data-tooltip-target":`currency-${n.id}`,"data-tooltip-placement":"bottom",type:"button"},[_(p(O),{class:"w-5 h-5 text-green-600"})],8,We),e("div",{id:`currency-${n.id}`,role:"tooltip",class:"absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip"},[e("div",Ye,s(r(n,"currencies").join(", ")),1),Ze],8,Xe)]),e("td",et,[_(B,{href:n.settings_url},{default:g(()=>[_(p(R),{class:"w-4 h-4"})]),_:2},1032,["href"])])],40,qe))),128))])]))}},st={class:"flex gap-2 items-center"},at={class:"relative inline-flex items-center cursor-pointer"},ot=e("div",{class:"w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"},null,-1),nt={class:"ml-3 text-sm font-medium text-gray-900"},rt={__name:"Toggle",props:["modelValue"],emits:["update:modelValue"],setup(d,{emit:l}){const m=d,h=H({get(){return m.modelValue},set(i){l("update:modelValue",i)}});return(i,o)=>(a(),c("div",st,[e("label",at,[T(e("input",{"onUpdate:modelValue":o[0]||(o[0]=r=>h.value=r),type:"checkbox",class:"sr-only peer"},null,512),[[Q,h.value]]),ot,e("span",nt,[G(i.$slots,"default")])])]))}},lt={class:"flex gap-2 items-center"},dt={__name:"TestMode",setup(d){const l=A(),{isTestMode:m}=x(l),{t:h}=J(),i=async o=>{await l.updateTestMode(o);const r=jQuery("#wp-admin-bar-gurmepos");o?(r.addClass("gpos-test-mode-active"),r.children("a").children("span.ab-label").html(`POS Entegratör ${h("test_mode")}`)):(r.removeClass("gpos-test-mode-active"),r.children("a").children("span.ab-label").html("POS Entegratör"))};return(o,r)=>(a(),c("div",lt,[_(rt,{modelValue:p(m),"onUpdate:modelValue":r[0]||(r[0]=$=>K(m)?m.value=$:null),onChange:r[1]||(r[1]=$=>i(p(m)))},{default:g(()=>[f(s(o.$t("test_mode")),1)]),_:1},8,["modelValue"]),_(ee,{class:"mt-1"},{default:g(()=>[f(s(o.$t("test_mode_content")),1)]),_:1})]))}},ct={class:"w-full flex justify-between items-center border mb-4 border-gray-100 rounded-lg p-5 bg-white shadow-md"},it=e("div",{id:"sticky-banner",tabindex:"-1",class:"fixed bottom-10 right-10"},null,-1),ut={__name:"App",setup(d){const l=A(),{isTestMode:m}=x(l),h=k(),{gatewayAccounts:i}=x(h);return(o,r)=>(a(),v(Y,{text:o.$t("payment_methods"),href:"https://yardim.gurmehub.com/docs/pos-entegrator/odeme-yontemleri/?utm_source=wp_plugin&utm_medium=organic&utm_campaign=footer"},{default:g(()=>[p(m)?(a(),v(te,{key:0},{content:g(()=>[f(s(o.$t("test_mode_content")),1)]),default:g(()=>[f(s(o.$t("test_mode_title")),1)]),_:1})):b("",!0),p(i).length===0?(a(),v(se,{key:1},{content:g(()=>[f(s(o.$t("empty_gateway_content")),1)]),default:g(()=>[f(s(o.$t("empty_gateway_title")),1)]),_:1})):b("",!0),e("div",ct,[_(dt),_(Ve)]),_(tt),it]),_:1},8,["text"]))}},pt=W({locale:"default",messages:window.gpos.strings,legacy:!1}),j=X(ut);j.use(Z);j.use(pt);j.mount("#app");
