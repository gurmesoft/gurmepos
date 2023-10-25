import{j as I,S as T,o as n,c as r,g as _,a as s,u as t,D as B,f as m,t as c,s as v,d as b,e as y,l as w,F as f,x as $,w as k,p as V,n as S,q as M,Y as D,i as U,Z as F,C as N,_ as G,V as L,$ as q,a0 as H,O as P,P as R}from"./vendor-3-6-0.js";import{a as h,p as z}from"./ajax-3-6-0.js";import{u as j,_ as E}from"./Page-3-6-0.js";import{a as Q,_ as Y}from"./Warning-3-6-0.js";import{a as Z,_ as J}from"./OutlineButton-3-6-0.js";import{_ as A}from"./PrimaryButton-3-6-0.js";/* empty css           */const g=I("GatewayAccount",{state:()=>({gatewayAccount:window.gpos.gateway_account||{},assetsUrl:window.gpos.assets_url||"/"}),actions:{async updateAccountSettings(){await h.post("update_account_settings",{id:this.gatewayAccount.id,settings:this.gatewayAccount.gateway_settings}),this.swal(window.gpos.alert_texts.setting_saved)},async updateInstallments(){await h.post("update_installments",{id:this.gatewayAccount.id,installments:this.gatewayAccount.installments}),this.swal(window.gpos.alert_texts.setting_saved)},async resetInstallments(){await h.post("update_installments",{id:this.gatewayAccount.id,installments:!1}),this.swal(window.gpos.alert_texts.setting_saved,"success",()=>{window.location.reload()})},async getInstallments(){const u=await h.post("get_installments_from_api",{id:this.gatewayAccount.id});let e={};u.result==="success"?(this.gatewayAccount.installments=u.installments,e={text:window.gpos.alert_texts.installments_applied,icon:"success"}):e={text:`${window.gpos.alert_texts.installments_get_error} : ${u.installments}`,icon:"error"},this.swal(e.text,e.icon)},async updateInstallmentStatus(){await h.post("update_installment_status",{id:this.gatewayAccount.id,status:this.gatewayAccount.is_installments_active})},async testConnection(){const u=await h.post("check_connection",{id:this.gatewayAccount.id,settings:this.gatewayAccount.gateway_settings});this.swal(u.message,u.result)},async deleteAccount(){await h.post("remove_gateway_account",{id:this.gatewayAccount.id}),this.swal(window.gpos.alert_texts.deletion_completed,"success",()=>{window.location.href="/wp-admin/admin.php?page=gpos-payment-gateways"})},swal(u,e="success",o){T.fire({text:u,icon:e,confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#1A56DB"}).then(o)}}}),K={class:"w-full flex justify-between items-center border border-gray-100 rounded-lg p-5 bg-white shadow-md"},W={__name:"TestDelete",setup(u){const{deleteAccount:e}=g();return(o,i)=>(n(),r("div",K,[_(Q),s("button",{class:"text-xs text-red-600 flex gap-1 items-center font-medium",onClick:i[0]||(i[0]=(...l)=>t(e)&&t(e)(...l))},[_(t(B),{class:"w-5 h-5"}),m(c(o.$t("delete_gateway")),1)])]))}},X={class:"w-full flex flex-wrap"},O={class:"flex gap-1 items-center mb-2"},tt={class:"block text-sm font-medium text-gray-900"},et=["onUpdate:modelValue","placeholder"],st=["onUpdate:modelValue"],at=["value"],nt={__name:"ApiFieldCreator",setup(u){const{isTestMode:e}=v(j()),{gatewayAccount:o}=v(g());return(i,l)=>(n(),r("div",X,[t(e)?(n(),b(Y,{key:0,class:"m-2 p-2 w-full"},{content:y(()=>[m(c(i.$t("test_mode_content")),1)]),default:y(()=>[m(c(i.$t("test_mode_title"))+" ",1)]),_:1})):w("",!0),(n(!0),r(f,null,$(t(o).gateway_property.fields,(a,p)=>(n(),r("div",{key:p,class:"w-1/2 p-2"},[s("div",O,[s("label",tt,c(t(e)?"Test":"")+" "+c(a.label),1)]),a.type==="text"?k((n(),r("input",{key:0,"onUpdate:modelValue":d=>t(o).gateway_settings[t(e)?`test_${a.model}`:a.model]=d,type:"text",class:S(`!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3 ${t(e)?"placeholder:text-gray-300":"placeholder:text-gray-600"}`),placeholder:a.label,required:""},null,10,et)),[[V,t(o).gateway_settings[t(e)?`test_${a.model}`:a.model]]]):w("",!0),a.type==="select"?k((n(),r("select",{key:1,"onUpdate:modelValue":d=>t(o).gateway_settings[t(e)?`test_${a.model}`:a.model]=d,class:"!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"},[(n(!0),r(f,null,$(a.options,(d,x)=>(n(),r("option",{key:x,value:x},c(d),9,at))),128))],8,st)),[[M,t(o).gateway_settings[t(e)?`test_${a.model}`:a.model]]]):w("",!0)]))),128))]))}},ot={class:"w-full flex gap-10 bg-white p-6 rounded-lg shadow-md"},lt={class:"w-3/5 flex flex-col gap-6"},rt={class:"flex w-full justify-start gap-2 p-2"},ct={class:"w-2/5"},it={class:"w-full flex flex-col gap-2"},dt={class:"flex justify-between items-start"},_t=["src"],ut=["innerHTML"],pt=["href"],gt={__name:"ApiFields",setup(u){const{testConnection:e,updateAccountSettings:o}=g(),{gatewayAccount:i}=g();return(l,a)=>(n(),r("div",ot,[s("div",lt,[_(nt),s("div",rt,[t(i).gateway_property.check_connection_is_available?(n(),b(Z,{key:0,onClick:t(e)},{default:y(()=>[_(t(D),{class:"w-4 h-4 mr-2"}),m(c(l.$t("connect_test")),1)]),_:1},8,["onClick"])):w("",!0),_(A,{onClick:t(o)},{default:y(()=>[_(t(U),{class:"w-4 h-4 mr-2"}),m(c(l.$t("save_settings")),1)]),_:1},8,["onClick"])])]),s("div",ct,[s("div",it,[s("div",dt,[s("img",{class:"w-1/4",src:t(i).gateway_property.logo},null,8,_t)]),s("p",{class:"text-lg text-gray-500",innerHTML:l.$t(`${t(i).gateway_id}.description`)},null,8,ut),s("a",{href:t(i).gateway_property.merchant_panel,target:"_blank",class:"mt-2 text-blue-700 text-sm flex gap-1 items-center"},[m(c(l.$t("gateway_screen")),1),_(t(F),{class:"w-3 h-3 text-blue-700"})],8,pt)])])]))}},mt={__name:"AutoFill",setup(u){const{getInstallments:e,gatewayAccount:o}=g();return(i,l)=>t(o).gateway_property.supports.includes("installment_api")?(n(),b(A,{key:0,onClick:l[0]||(l[0]=a=>t(e)())},{default:y(()=>[m(c(i.$t("get_installment_rates")),1)]),_:1})):w("",!0)}},wt={class:"w-full text-sm text-gray-500"},yt={class:"text-xs text-gray-700 bg-gray-50"},ht=["textContent"],xt={class:"py-2 font-medium text-gray-900 whitespace-nowrap"},ft=["src"],$t={class:"flex items-center"},bt=["onUpdate:modelValue"],vt=s("div",{class:"!bg-gray-200 !border !border-r-0 !border-gray-300 !text-gray-900 !text-md !rounded-l-md p-1"}," % ",-1),kt=["onUpdate:modelValue","disabled"],At={__name:"RateTable",setup(u){const{gatewayAccount:e,assetsUrl:o}=v(g());return(i,l)=>(n(),r("table",wt,[s("thead",yt,[s("tr",null,[(n(),r(f,null,$(["#","2","3","4","5","6","7","8","9","10","11","12"],a=>s("th",{key:a,scope:"col",class:"py-2",textContent:c(a)},null,8,ht)),64))])]),s("tbody",null,[(n(!0),r(f,null,$(t(e).installments,(a,p)=>(n(),r("tr",{key:p,class:"bg-white border-b cursor-pointer"},[s("th",xt,[s("img",{src:`${t(o)}/images/card/${p}.svg`,class:"rounded-lg"},null,8,ft)]),(n(!0),r(f,null,$(a,d=>(n(),r("td",{key:d.number,class:"font-medium text-gray-900 whitespace-nowrap text-center p-1"},[s("div",$t,[k(s("input",{"onUpdate:modelValue":x=>d.enabled=x,type:"checkbox",class:"text-blue-600 bg-gray-100 border-gray-300 rounded"},null,8,bt),[[N,d.enabled]]),vt,k(s("input",{"onUpdate:modelValue":x=>d.rate=x,disabled:!d.enabled,type:"text",style:{"border-radius":"0 !important"},class:S(`!border !border-l-0 !border-gray-300 !text-gray-900 !text-sm !rounded-r-md w-full ${d.enabled?"!bg-white":"!bg-gray-200"}`)},null,10,kt),[[V,d.rate]])])]))),128))]))),128))])]))}},Ct={class:"w-full flex flex-col gap-6 bg-white p-6 rounded-lg shadow-md"},Vt={class:"text-2xl w-full font-bold text-[#111928]"},St={class:"w-full flex items-center justify-between"},Ut={key:1,class:"flex gap-2 justify-between items-end"},jt={__name:"Installments",setup(u){const{gatewayAccount:e}=v(g()),{updateInstallmentStatus:o,updateInstallments:i,resetInstallments:l}=g();return(a,p)=>(n(),r("div",Ct,[s("div",Vt,c(a.$t("installment_options")),1),s("div",St,[_(J,{modelValue:t(e).is_installments_active,"onUpdate:modelValue":p[0]||(p[0]=d=>t(e).is_installments_active=d),onChange:p[1]||(p[1]=d=>t(o)())},{default:y(()=>[m(c(a.$t("activate_installment")),1)]),_:1},8,["modelValue"]),t(e).is_installments_active?(n(),b(mt,{key:0})):w("",!0)]),t(e).is_installments_active?(n(),b(At,{key:0})):w("",!0),t(e).is_installments_active?(n(),r("div",Ut,[_(A,{class:"w-max",onClick:p[2]||(p[2]=d=>t(i)())},{default:y(()=>[_(t(U),{class:"w-4 h-4 mr-2"}),m(" "+c(a.$t("save_settings")),1)]),_:1}),s("span",{class:"text-red-600 underline cursor-pointer",onClick:p[3]||(p[3]=d=>t(l)())},c(a.$t("reset_settings")),1)])):w("",!0)]))}},It={class:"bg-white p-6 rounded-lg shadow-md flex flex-col gap-3"},Tt={class:"text-2xl font-bold text-[#111928]"},Bt={class:"w-full flex flex-wrap gap-5 mt-4"},Mt={class:"text-base"},Dt={class:"text-2xl font-bold text-[#111928]"},Ft={class:"flex items-center flex-wrap break-words bg-gray-50 rounded-lg py-4 px-3"},Nt={class:"flex gap-2 items-center"},Gt={class:"text-xs text-gray-900 font-medium"},Lt={__name:"Supports",setup(u){const{gatewayAccount:e}=g();return(o,i)=>(n(),r("div",It,[s("span",Tt,c(o.$t("supports_features")),1),s("div",Bt,[(n(!0),r(f,null,$(t(e).gateway_property.supports,(l,a)=>(n(),r("div",{key:a,class:"w-72 flex justify-between py-4 px-3 bg-gray-50 rounded-lg items-center"},[s("span",Mt,c(o.$t(l)),1),_(t(G),{class:"w-6 h-6 text-green-300"})]))),128))]),s("span",Dt,c(o.$t("supports_currency")),1),s("div",Ft,[s("div",Nt,[_(t(L),{class:"w-5 h-5 text-gray-900"}),s("span",Gt,c(t(e).gateway_property.currencies.join(", ")),1)])])]))}},qt={class:"text-blue-600 text-md"},Ht={class:"w-full flex flex-col gap-6"},Pt={__name:"App",setup(u){const{gatewayAccount:e}=v(g()),{paymentGateways:o}=j();q(()=>{e.value.gateway_property=o.find(a=>a.id===e.value.gateway_id);const l=window.jQuery;l("#toplevel_page_gurmepos").addClass("wp-has-current-submenu"),l(".toplevel_page_gurmepos").addClass("wp-has-current-submenu"),l("a[href='admin.php?page=gpos-payment-gateways']").parent("li").addClass("current")});const i=()=>{window.history.back()};return(l,a)=>(n(),b(E,{text:t(e).gateway_property.title,href:`https://yardim.gurmehub.com/docs/pos-entegrator/odeme-yontemleri/${t(e).gateway_property.id}-sanal-pos-ayarlar/`},{default:y(()=>[s("span",{class:"w-max flex gap-1 items-center my-4 cursor-pointer",onClick:i},[_(t(H),{class:"text-blue-600 w-6 h-6"}),s("span",qt,c(l.$t("back_to")),1)]),s("div",Ht,[_(W),_(gt),_(jt),_(Lt)])]),_:1},8,["text","href"]))}},Rt=P({locale:"default",messages:window.gpos.strings,legacy:!1}),C=R(Pt);C.use(z);C.use(Rt);C.mount("#app");
