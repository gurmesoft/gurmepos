import{o as a,c as l,r as C,j as F,s as k,x,g as u,e as p,f as m,t as o,u as _,M as N,a as e,N as V,O as P,w as I,m as L,F as G,q as j,n as q,d as b,P as R,l as g,Q as E,R as J,T as K,J as O,K as Q}from"./vendor-staging.js";import{a as M,p as U}from"./ajax-staging.js";import{u as D,_ as H}from"./Page-staging.js";import{_ as W}from"./_plugin-vue_export-helper-staging.js";import{_ as X}from"./ProBadge-staging.js";import{_ as B}from"./PrimaryButton-staging.js";import{S as Y}from"./SetDefaultBadge-staging.js";import{_ as Z,a as ee}from"./Warning-staging.js";/* empty css             */const te={},se={type:"button",class:"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2 text-center inline-flex items-center mr-2"};function oe(i,r){return a(),l("button",se,[C(i.$slots,"default")])}const ae=W(te,[["render",oe]]),A=F("GatewayAccounts",{state:()=>({gatewayAccounts:window.gpos.gateway_accounts||[]}),actions:{async addGatewayAccount(i){return await M.post("add_gateway_account",{gateway:i})},async getGatewayAccounts(){const i=await M.get("get_gateway_accounts");this.gatewayAccounts=i},updateActiveStatus(i,r){M.post("update_active_status",{id:i,status:r})},async updateDefaultStatus(i,r){return await M.post("update_default_status",{id:i,default:r})}}}),ne={key:0,class:"fixed top-0 left-0 z-50 flex align-center items-center h-screen justify-center w-full",style:{"background-color":"rgba(0,0,0,0.5)"}},le={class:"p-4 overflow-x-hidden overflow-y-auto"},re={class:"relative w-full h-full max-w-md"},ie={class:"relative bg-white rounded-lg shadow"},de={class:"flex items-start justify-between p-1"},ce={class:"py-6 pl-6 pr-3 space-y-3"},ue={class:"text-xl font-semibold flex items-center"},_e={class:"ml-2 bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded border border-purple-400"},pe={class:"relative w-full"},me={class:"absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"},fe={class:"pr-4"},ye=["placeholder"],he={class:"payment-gateway-modal mt-2 space-y-5 overflow-y-auto h-60 max-h-min"},ge=["onMouseover"],we={class:"flex gap-2 items-center py-2"},be=["src"],ve={class:"text-sm font-normal text-gray-500"},$e={key:1},xe={class:"px-6 pt-3 pb-6 text-sm font-medium text-gray-500"},ke={href:"https://posentegrator.com/bize-ulasin/",target:"_blank",class:"text-blue-600"},Ae={__name:"AddPaymentGatewayModal",setup(i){const{paymentGateways:r}=D(),{addGatewayAccount:w}=A(),{gatewayAccounts:v}=k(A()),h=x(!1),d=x(""),c=x(!1),S=()=>r.filter(t=>t.title.toLowerCase().includes(d.value.toLowerCase())&&!v.value.find(n=>t.id===n.gateway_id)),$=async t=>{c.value=!1;const n=await w(t);window.location.href=n.settings_url};return(t,n)=>(a(),l("div",null,[u(B,{onClick:n[0]||(n[0]=s=>c.value=!c.value)},{default:p(()=>[m(o(t.$t("add_payment_comp"))+" ",1),u(_(N),{class:"w-4 h-4 ml-2"})]),_:1}),c.value?(a(),l("div",ne,[e("div",le,[e("div",re,[e("div",ie,[e("div",de,[e("button",{type:"button",class:"text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center",onClick:n[1]||(n[1]=s=>c.value=!c.value)},[u(_(V),{class:"w-5 h-5"})])]),e("div",ce,[e("p",ue,[m(o(t.$t("add_payment_comp"))+" ",1),e("span",_e,o(_(r).length)+" "+o(t.$t("establishment")),1)]),e("div",pe,[e("div",me,[u(_(P),{class:"w-4 h-4 text-blue-600"})]),e("div",fe,[I(e("input",{"onUpdate:modelValue":n[2]||(n[2]=s=>d.value=s),type:"text",class:"!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !w-full !pl-10 !p-3 mb-6",placeholder:t.$t("search_payment_gateway"),required:""},null,8,ye),[[L,d.value]])])]),e("div",he,[(a(!0),l(G,null,j(S(),(s,f)=>(a(),l("div",{key:f,class:q(`border rounded-lg flex justify-between items-center ${s.is_need_pro?"bg-gray-100 p-4":"p-3"}`),onMouseleave:n[3]||(n[3]=y=>h.value=!1),onMouseover:y=>h.value=f},[e("div",we,[e("img",{class:"w-[50px] object-contain",src:s.logo},null,8,be),e("span",ve,o(s.title),1)]),s.is_need_pro?(a(),b(X,{key:0})):(a(),l("div",$e,[h.value===f?(a(),b(ae,{key:0,onClick:y=>$(s.id)},{default:p(()=>[u(_(R),{class:"w-5 h-5 font-bold"})]),_:2},1032,["onClick"])):g("",!0)]))],42,ge))),128))])]),e("p",xe,[m(o(t.$t("find_comp"))+" ",1),e("a",ke,o(t.$t("contact_us")),1)])])])])])):g("",!0)]))}},Me={class:"w-full text-sm text-left bg-white shadow-md"},Ce={class:"text-xs text-gray-500 uppercase bg-[#F9FAFB]"},Se={scope:"col",class:"px-6 py-3 w-4/12"},Ge={scope:"col",class:"px-6 py-3 w-6/12"},je={scope:"col",class:"w-1/12"},Be={scope:"col",class:"px-6 py-3 sr-only w-1/12"},De={key:0},Te={colspan:"4",class:"px-6 py-4 text-sm text-gray-400"},ze=["onMouseover"],Fe={scope:"row",class:"px-3 py-4 font-medium text-gray-900 rounded-lg whitespace-nowrap flex gap-5 items-center !min-w-[300px]"},Ne=["src"],Ve={key:1},Pe={class:"px-6 py-4"},Ie={class:"flex gap-2 flex-wrap"},Le=["href"],qe=["onMouseenter","onMouseleave"],Re=["id"],Ee={class:"max-w-xs flex flex-wrap break-words"},Je={class:"px-6 py-4 flex justify-end"},Ke={__name:"PaymentGatewayTable",setup(i){const{paymentGateways:r}=k(D()),{updateDefaultStatus:w,getGatewayAccounts:v}=A(),{gatewayAccounts:h}=k(A()),d=x(!1),c=(t,n)=>r.value.find(f=>f.id==t.gateway_id)[n],S=async(t,n)=>{await w(t,n),v()},$=x([]);return(t,n)=>(a(),l("table",Me,[e("thead",Ce,[e("tr",null,[e("th",Se,o(t.$t("payment_method")),1),e("th",Ge,o(t.$t("features")),1),e("th",je,o(t.$t("currency")),1),e("th",Be,o(t.$t("actions")),1)])]),e("tbody",null,[_(h).length===0?(a(),l("tr",De,[e("td",Te,o(t.$t("not_active_comp")),1)])):(a(!0),l(G,{key:1},j(_(h),(s,f)=>(a(),l("tr",{key:f,class:"bg-white border border-gray-100",onMouseleave:n[0]||(n[0]=y=>d.value=!1),onMouseover:y=>d.value=f},[e("th",Fe,[e("img",{class:"w-[50px] max-h-[30px]",src:c(s,"logo")},null,8,Ne),m(" "+o(c(s,"title"))+" ",1),s.is_default?(a(),b(Y,{key:0},{default:p(()=>[m(o(t.$t("default")),1)]),_:1})):g("",!0),d.value===f&&!s.is_default?(a(),l("div",Ve,[u(B,{class:"!inline-flex !items-center !bg-blue-700 !text-white !text-xs !font-medium !mr-2 !px-2.5 !py-0.5 !rounded-full",onClick:y=>S(s.id,!0)},{default:p(()=>[m(o(t.$t("make_default")),1)]),_:2},1032,["onClick"])])):g("",!0)]),e("td",Pe,[e("div",Ie,[(a(!0),l(G,null,j(c(s,"supports").slice(0,5),(y,z)=>(a(),l("span",{key:z,class:"bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded"},o(t.$t(y)),1))),128)),c(s,"supports").length>5?(a(),l("a",{key:0,href:s.settings_url,class:"bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded underline"},o(t.$t("all_features")),9,Le)):g("",!0)])]),e("td",null,[e("span",{class:"z-10 cursor-pointer",onMouseenter:y=>$.value[s.id]=!0,onMouseleave:y=>$.value[s.id]=!1},[u(_(E),{class:"w-5 h-5 text-green-600"})],40,qe),$.value[s.id]?(a(),l("div",{key:0,id:`currency-${s.id}`,class:"absolute z-10 inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm tooltip"},[e("div",Ee,o(c(s,"currencies").join(", ")),1)],8,Re)):g("",!0)]),e("td",Je,[u(B,{href:s.settings_url},{default:p(()=>[u(_(J),{class:"w-4 h-4"})]),_:2},1032,["href"])])],40,ze))),128))])]))}},Oe={class:"p-4 mb-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full",role:"alert"},Qe={class:"flex items-center"},Ue={class:"text-blue-600 text-md font-medium"},He={class:"text-blue-600 mt-2 mb-4 text-sm"},We={__name:"Info",setup(i){return(r,w)=>(a(),l("div",Oe,[e("div",Qe,[u(_(K),{class:"w-4 h-4 mr-2"}),e("span",Ue,[C(r.$slots,"default")])]),e("div",He,[C(r.$slots,"content")]),C(r.$slots,"button")]))}},Xe={class:"w-full flex justify-between items-center border mb-4 border-gray-100 rounded-lg p-5 bg-white shadow-md"},Ye=e("div",{id:"sticky-banner",tabindex:"-1",class:"fixed bottom-10 right-10"},null,-1),Ze={__name:"App",setup(i){const r=D(),{isTestMode:w}=k(r),v=A(),{gatewayAccounts:h}=k(v);return(d,c)=>(a(),b(H,{text:d.$t("payment_methods"),href:"https://yardim.gurmehub.com/docs/pos-entegrator/odeme-yontemleri/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"},{default:p(()=>[_(w)?(a(),b(Z,{key:0,class:"p-4 mb-4"},{content:p(()=>[m(o(d.$t("test_mode_content")),1)]),default:p(()=>[m(o(d.$t("test_mode_title")),1)]),_:1})):g("",!0),_(h).length===0?(a(),b(We,{key:1},{content:p(()=>[m(o(d.$t("empty_gateway_content")),1)]),default:p(()=>[m(o(d.$t("empty_gateway_title")),1)]),_:1})):g("",!0),e("div",Xe,[u(ee),u(Ae)]),u(Ke),Ye]),_:1},8,["text"]))}},et=O({locale:"default",messages:window.gpos.strings,legacy:!1}),T=Q(Ze);T.use(U);T.use(et);T.mount("#app");
