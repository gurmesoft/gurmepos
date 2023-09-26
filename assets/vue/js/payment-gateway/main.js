import{j as T,S as B,o as n,c as l,g as u,a as s,u as t,P as M,f as g,t as c,r as V,s as $,d as v,e as w,q as f,F as x,m as b,w as k,p as S,n as U,l as D,Q as F,i as j,R as N,T as R,U as G,M as q,V as E,W as P,D as Q,E as z}from"../vendor/main.js";import{a as y,p as L}from"../ajax/main.js";import{u as I,_ as W}from"../Page/main.js";import{a as H,_ as J}from"../Warning/main.js";import{_ as A}from"../PrimaryButton/main.js";import{_ as K}from"../Switch/main.js";/* empty css              */const m=T("GatewayAccount",{state:()=>({gatewayAccount:window.gpos.gateway_account||{},assetsUrl:window.gpos.assets_url||"/"}),actions:{async updateAccountSettings(){await y.post("update_account_settings",{id:this.gatewayAccount.id,settings:this.gatewayAccount.gateway_settings}),this.swal(window.gpos.alert_texts.setting_saved)},async updateInstallments(){await y.post("update_installments",{id:this.gatewayAccount.id,installments:this.gatewayAccount.installments}),this.swal(window.gpos.alert_texts.setting_saved)},async resetInstallments(){await y.post("update_installments",{id:this.gatewayAccount.id,installments:!1}),this.swal(window.gpos.alert_texts.setting_saved,"success",()=>{window.location.reload()})},async getInstallments(){const i=await y.post("get_installments_from_api",{id:this.gatewayAccount.id});let e={};i.result==="success"?(this.gatewayAccount.installments=i.installments,e={text:window.gpos.alert_texts.installments_applied,icon:"success"}):e={text:`${window.gpos.alert_texts.installments_get_error} : ${i.installments}`,icon:"error"},this.swal(e.text,e.icon)},async updateInstallmentStatus(){await y.post("update_installment_status",{id:this.gatewayAccount.id,status:this.gatewayAccount.is_installments_active})},async testConnection(){const i=await y.post("check_connection",{id:this.gatewayAccount.id,settings:this.gatewayAccount.gateway_settings});this.swal(i.message,i.result)},async deleteAccount(){await y.post("remove_gateway_account",{id:this.gatewayAccount.id}),this.swal(window.gpos.alert_texts.deletion_completed,"success",()=>{window.location.href="/wp-admin/admin.php?page=gpos-payment-gateways"})},swal(i,e="success",o){B.fire({text:i,icon:e,confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#1A56DB"}).then(o)}}}),X={class:"w-full flex justify-between items-center border border-gray-100 rounded-lg p-5 bg-white shadow-md"},Y={__name:"TestDelete",setup(i){const{deleteAccount:e}=m();return(o,_)=>(n(),l("div",X,[u(H),s("button",{class:"text-xs text-red-600 flex gap-1 items-center font-medium",onClick:_[0]||(_[0]=(...r)=>t(e)&&t(e)(...r))},[u(t(M),{class:"w-5 h-5"}),g(c(o.$t("delete_gateway")),1)])]))}},Z=["href"],O={key:1,type:"button",class:"!text-blue-700 border border-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"},tt={__name:"OutlineButton",props:["href"],setup(i){return(e,o)=>i.href?(n(),l("a",{key:0,href:i.href,class:"!text-blue-700 border border-blue-700 !focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2"},[V(e.$slots,"default")],8,Z)):(n(),l("button",O,[V(e.$slots,"default")]))}},et={class:"w-full flex flex-wrap"},st={class:"flex gap-1 items-center mb-2"},at={class:"block text-sm font-medium text-gray-900"},nt=["onUpdate:modelValue","placeholder"],ot=["onUpdate:modelValue"],lt=["value"],rt={__name:"ApiFieldCreator",setup(i){const{isTestMode:e}=$(I()),{gatewayAccount:o}=$(m());return(_,r)=>(n(),l("div",et,[t(e)?(n(),v(J,{key:0,class:"m-2 p-2 w-full"},{content:w(()=>[g(c(_.$t("test_mode_content")),1)]),default:w(()=>[g(c(_.$t("test_mode_title"))+" ",1)]),_:1})):f("",!0),(n(!0),l(x,null,b(t(o).gateway_property.fields,(a,p)=>(n(),l("div",{key:p,class:"w-1/2 p-2"},[s("div",st,[s("label",at,c(t(e)?"Test":"")+" "+c(a.label),1)]),a.type==="text"?k((n(),l("input",{key:0,"onUpdate:modelValue":d=>t(o).gateway_settings[t(e)?`test_${a.model}`:a.model]=d,type:"text",class:U(`!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3 ${t(e)?"placeholder:text-gray-300":"placeholder:text-gray-600"}`),placeholder:a.label,required:""},null,10,nt)),[[S,t(o).gateway_settings[t(e)?`test_${a.model}`:a.model]]]):f("",!0),a.type==="select"?k((n(),l("select",{key:1,"onUpdate:modelValue":d=>t(o).gateway_settings[t(e)?`test_${a.model}`:a.model]=d,class:"!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3"},[(n(!0),l(x,null,b(a.options,(d,h)=>(n(),l("option",{key:h,value:h},c(d),9,lt))),128))],8,ot)),[[D,t(o).gateway_settings[t(e)?`test_${a.model}`:a.model]]]):f("",!0)]))),128))]))}},ct={class:"w-full flex gap-10 bg-white p-6 rounded-lg shadow-md"},it={class:"w-3/5 flex flex-col gap-6"},dt={class:"flex w-full justify-start gap-2 p-2"},ut={class:"w-2/5"},_t={class:"w-full flex flex-col gap-2"},pt={class:"flex justify-between items-start"},mt=["src"],gt={class:"text-lg text-gray-500"},wt=["href"],yt={__name:"ApiFields",setup(i){const{testConnection:e,updateAccountSettings:o}=m(),{gatewayAccount:_}=m();return(r,a)=>(n(),l("div",ct,[s("div",it,[u(rt),s("div",dt,[u(tt,{onClick:t(e)},{default:w(()=>[u(t(F),{class:"w-4 h-4 mr-2"}),g(c(r.$t("connect_test")),1)]),_:1},8,["onClick"]),u(A,{onClick:t(o)},{default:w(()=>[u(t(j),{class:"w-4 h-4 mr-2"}),g(c(r.$t("save_settings")),1)]),_:1},8,["onClick"])])]),s("div",ut,[s("div",_t,[s("div",pt,[s("img",{class:"w-1/4",src:t(_).gateway_property.logo},null,8,mt)]),s("p",gt,c(r.$t(`${t(_).gateway_id}.description`)),1),s("a",{href:t(_).gateway_property.merchant_panel,target:"_blank",class:"mt-2 text-blue-700 text-sm flex gap-1 items-center"},[g(c(r.$t("gateway_screen")),1),u(t(N),{class:"w-3 h-3 text-blue-700"})],8,wt)])])]))}},ft={__name:"AutoFill",setup(i){const{getInstallments:e,gatewayAccount:o}=m();return(_,r)=>t(o).gateway_property.supports.includes("installment_api")?(n(),v(A,{key:0,onClick:r[0]||(r[0]=a=>t(e)())},{default:w(()=>[g(c(_.$t("get_installment_rates")),1)]),_:1})):f("",!0)}};const ht={class:"w-full text-sm text-gray-500"},xt={class:"text-xs text-gray-700 bg-gray-50"},bt=["textContent"],$t={class:"py-2 font-medium text-gray-900 whitespace-nowrap"},vt=["src"],kt={class:"flex items-center"},At=["onUpdate:modelValue"],Ct=s("div",{class:"!bg-gray-200 !border !border-r-0 !border-gray-300 !text-gray-900 !text-md !rounded-l-md p-1"}," % ",-1),Vt=["onUpdate:modelValue","disabled"],St={__name:"RateTable",setup(i){const{gatewayAccount:e,assetsUrl:o}=$(m());return(_,r)=>(n(),l("table",ht,[s("thead",xt,[s("tr",null,[(n(),l(x,null,b(["#","2","3","4","5","6","7","8","9","10","11","12"],a=>s("th",{key:a,scope:"col",class:"py-2",textContent:c(a)},null,8,bt)),64))])]),s("tbody",null,[(n(!0),l(x,null,b(t(e).installments,(a,p)=>(n(),l("tr",{key:p,class:"bg-white border-b cursor-pointer"},[s("th",$t,[s("img",{src:`${t(o)}/images/card/${p}.svg`,class:"rounded-lg"},null,8,vt)]),(n(!0),l(x,null,b(a,d=>(n(),l("td",{key:d.number,class:"font-medium text-gray-900 whitespace-nowrap text-center p-1"},[s("div",kt,[k(s("input",{"onUpdate:modelValue":h=>d.enabled=h,type:"checkbox",class:"text-blue-600 bg-gray-100 border-gray-300 rounded"},null,8,At),[[R,d.enabled]]),Ct,k(s("input",{"onUpdate:modelValue":h=>d.rate=h,disabled:!d.enabled,type:"text",class:U(`!border !border-l-0 !border-gray-300 !text-gray-900 !text-sm !rounded-r-md w-full ${d.enabled?"!bg-white":"!bg-gray-200"}`)},null,10,Vt),[[S,d.rate]])])]))),128))]))),128))])]))}},Ut={class:"w-full flex flex-col gap-6 bg-white p-6 rounded-lg shadow-md"},jt={class:"text-2xl w-full font-bold text-[#111928]"},It={class:"w-full flex items-center justify-between"},Tt={key:1,class:"flex gap-2 justify-between items-end"},Bt={__name:"Installments",setup(i){const{gatewayAccount:e}=$(m()),{updateInstallmentStatus:o,updateInstallments:_,resetInstallments:r}=m();return(a,p)=>(n(),l("div",Ut,[s("div",jt,c(a.$t("installment_options")),1),s("div",It,[u(K,{modelValue:t(e).is_installments_active,"onUpdate:modelValue":p[0]||(p[0]=d=>t(e).is_installments_active=d),onChange:p[1]||(p[1]=d=>t(o)())},{default:w(()=>[g(c(a.$t("activate_installment")),1)]),_:1},8,["modelValue"]),t(e).is_installments_active?(n(),v(ft,{key:0})):f("",!0)]),t(e).is_installments_active?(n(),v(St,{key:0})):f("",!0),t(e).is_installments_active?(n(),l("div",Tt,[u(A,{class:"w-max",onClick:p[2]||(p[2]=d=>t(_)())},{default:w(()=>[u(t(j),{class:"w-4 h-4 mr-2"}),g(" "+c(a.$t("save_settings")),1)]),_:1}),s("span",{class:"text-red-600 underline cursor-pointer",onClick:p[3]||(p[3]=d=>t(r)())},c(a.$t("reset_settings")),1)])):f("",!0)]))}},Mt={class:"bg-white p-6 rounded-lg shadow-md flex flex-col gap-3"},Dt={class:"text-2xl font-bold text-[#111928]"},Ft={class:"w-full flex flex-wrap gap-5 mt-4"},Nt={class:"text-base"},Rt={class:"text-2xl font-bold text-[#111928]"},Gt={class:"flex items-center flex-wrap break-words bg-gray-50 rounded-lg py-4 px-3"},qt={class:"flex gap-2 items-center"},Et={class:"text-xs text-gray-900 font-medium"},Pt={__name:"Supports",setup(i){const{gatewayAccount:e}=m();return(o,_)=>(n(),l("div",Mt,[s("span",Dt,c(o.$t("supports_features")),1),s("div",Ft,[(n(!0),l(x,null,b(t(e).gateway_property.supports,(r,a)=>(n(),l("div",{key:a,class:"w-72 flex justify-between py-4 px-3 bg-gray-50 rounded-lg items-center"},[s("span",Nt,c(o.$t(r)),1),u(t(G),{class:"w-6 h-6 text-green-300"})]))),128))]),s("span",Rt,c(o.$t("supports_currency")),1),s("div",Gt,[s("div",qt,[u(t(q),{class:"w-5 h-5 text-gray-900"}),s("span",Et,c(t(e).gateway_property.currencies.join(", ")),1)])])]))}},Qt={class:"text-blue-600 text-md"},zt={class:"w-full flex flex-col gap-6"},Lt={__name:"App",setup(i){const{gatewayAccount:e}=$(m()),{paymentGateways:o}=I();E(()=>{e.value.gateway_property=o.find(a=>a.id===e.value.gateway_id);const r=window.jQuery;r("#toplevel_page_gurmepos").addClass("wp-has-current-submenu"),r(".toplevel_page_gurmepos").addClass("wp-has-current-submenu"),r("a[href='admin.php?page=gpos-payment-gateways']").parent("li").addClass("current")});const _=()=>{window.history.back()};return(r,a)=>(n(),v(W,{text:t(e).gateway_property.title,href:`https://yardim.gurmehub.com/docs/pos-entegrator/odeme-yontemleri/${t(e).gateway_property.id}-sanal-pos-ayarlar/`},{default:w(()=>[s("span",{class:"w-max flex gap-1 items-center my-4 cursor-pointer",onClick:_},[u(t(P),{class:"text-blue-600 w-6 h-6"}),s("span",Qt,c(r.$t("back_to")),1)]),s("div",zt,[u(Y),u(yt),u(Bt),u(Pt)])]),_:1},8,["text","href"]))}},Wt=Q({locale:"default",messages:window.gpos.strings,legacy:!1}),C=z(Lt);C.use(L);C.use(Wt);C.mount("#app");
