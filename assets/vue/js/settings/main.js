import{o as p,c as _,a as r,r as w,b as V,w as T,v as z,n as x,d as f,e as s,f as m,t as d,g as i,u as c,h as J,i as L,S as H,s as j,j as I,k as K,F as C,l as U,m as O,p as M,q as Q,x as X,y as h,z as N,A as Y,B as Z,C as ee}from"../vendor/main.js";import{a as F,_ as te,p as le}from"../tailwind/main.js";import{_ as k}from"../_plugin-vue_export-helper/main.js";import{_ as P}from"../Switch/main.js";import{_ as se}from"../PrimaryButton/main.js";const oe={},ae={class:"w-full flex flex-col"},ne={class:"w-full flex flex-wrap"},ue={class:"w-full pt-8 px-3"};function re(n,u){return p(),_("div",ae,[r("div",ne,[w(n.$slots,"default")]),r("div",ue,[w(n.$slots,"action")])])}const q=k(oe,[["render",re]]),de={},ie={class:"flex flex-col gap-2 m-1 p-2 w-full"},me={class:"w-full text-blue-600 font-bold text-md"},pe=r("div",{class:"border border-gray-100 mb-2"},null,-1);function ce(n,u){return p(),_("div",ie,[r("span",me,[w(n.$slots,"header")]),pe,r("div",null,[w(n.$slots,"default")]),r("div",null,[w(n.$slots,"footer")])])}const b=k(de,[["render",ce]]),_e={class:"flex"},fe={class:"flex items-center"},ge=["id","name","value","disabled"],ve={class:"ml-2 text-sm"},$e=["for"],be={id:"helper-radio-text",class:"text-xs font-normal text-gray-400"},y={__name:"RadioButton",props:{modelValue:{type:String,required:!0},name:{type:String,required:!0},disabled:{type:Boolean,default:!1},value:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=V({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_("div",_e,[r("div",fe,[T(r("input",{id:n.value,"onUpdate:modelValue":t[0]||(t[0]=a=>l.value=a),name:n.name,value:n.value,"aria-describedby":"helper-radio-text",type:"radio",class:"!w-4 !h-4 !text-blue-600 !bg-gray-100 !border-gray-300 !focus:ring-blue-500",disabled:n.disabled},null,8,ge),[[z,l.value]])]),r("div",ve,[r("label",{for:n.value,class:x(`font-medium ${n.disabled?"text-gray-300":"text-gray-900"} flex items-center gap-2`)},[w(e.$slots,"default")],10,$e),r("p",be,[w(e.$slots,"subtitle")])])]))}},Ve={class:"flex flex-col gap-3"},we={class:"p-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full"},ye={__name:"ThreeD",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=V({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),f(b,null,{header:s(()=>[m(d(e.$t("3d_settings")),1)]),footer:s(()=>[r("div",we,d(e.$t("3d_settings_note")),1)]),default:s(()=>[r("div",Ve,[i(y,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=a=>l.value=a),value:"none_threed",name:"3dsettings"},{subtitle:s(()=>[m(d(e.$t("not_3d_subtitle")),1)]),default:s(()=>[m(d(e.$t("not_3d")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:l.value,"onUpdate:modelValue":t[1]||(t[1]=a=>l.value=a),value:"optional_threed",name:"3dsettings"},{subtitle:s(()=>[m(d(e.$t("optional_3d_subtitle")),1)]),default:s(()=>[m(d(e.$t("optional_3d")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:l.value,"onUpdate:modelValue":t[2]||(t[2]=a=>l.value=a),value:"threed",name:"3dsettings"},{subtitle:s(()=>[m(d(e.$t("forced_3d_subtitle")),1)]),default:s(()=>[m(d(e.$t("forced_3d")),1)]),_:1},8,["modelValue"])])]),_:1}))}},he={__name:"Other",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=V({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),f(b,null,{header:s(()=>[m(d(e.$t("other_settings")),1)]),default:s(()=>[i(P,{modelValue:l.value.form_user_name,"onUpdate:modelValue":t[0]||(t[0]=a=>l.value.form_user_name=a),value:"form_user_name"},{subtitle:s(()=>[m(d(e.$t("form_name_settings_subtitle")),1)]),default:s(()=>[m(d(e.$t("form_name_settings")),1)]),_:1},8,["modelValue"])]),_:1}))}},Se={},xe={class:"bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-lg flex gap-1 items-center h-6 max-h-max"};function Ce(n,u){return p(),_("span",xe,d(n.$t("soon")),1)}const W=k(Se,[["render",Ce]]),Ue={class:"flex w-full gap-6"},ke={class:"flex w-1/3 flex-col gap-3"},qe={class:"flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"},Fe=["src"],Te={__name:"Display",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=window.gpos.assets_url,e=V({get(){return o.modelValue},set(t){u("update:modelValue",t)}});return(t,a)=>(p(),f(b,null,{header:s(()=>[m(d(t.$t("view_settings")),1)]),default:s(()=>[r("div",Ue,[r("div",ke,[i(y,{modelValue:e.value,"onUpdate:modelValue":a[0]||(a[0]=g=>e.value=g),name:"display_type",value:"standart_form"},{subtitle:s(()=>[m(d(t.$t("standart_form_settings_subtitle")),1)]),default:s(()=>[m(d(t.$t("standart_form_settings")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:e.value,"onUpdate:modelValue":a[1]||(a[1]=g=>e.value=g),disabled:"",name:"display_type",value:"oneline_form"},{subtitle:s(()=>[m(d(t.$t("online_form_settings_subtitle")),1)]),default:s(()=>[m(d(t.$t("oneline_form_settings"))+" ",1),i(W)]),_:1},8,["modelValue"])]),r("div",qe,[r("img",{src:`${c(l)}/images/settings/${e.value}.png`,class:"object-cover scale-75",alt:""},null,8,Fe)])])]),_:1}))}},je={class:"flex w-full gap-6"},Ae={class:"flex w-1/3 flex-col gap-3"},Be={class:"flex w-2/3 items-center justify-center border-2 rounded-lg border-dashed border-gray-200 bg-gray-50"},We=["src"],De={__name:"Installment",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=window.gpos.assets_url,e=V({get(){return o.modelValue},set(t){u("update:modelValue",t)}});return(t,a)=>(p(),f(b,null,{header:s(()=>[m(d(t.$t("table_view_settings")),1)]),default:s(()=>[r("div",je,[r("div",Ae,[i(y,{modelValue:e.value,"onUpdate:modelValue":a[0]||(a[0]=g=>e.value=g),name:"installment_table_settings",value:"table_view"},{subtitle:s(()=>[m(d(t.$t("table_view_desc")),1)]),default:s(()=>[m(d(t.$t("table_view")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:e.value,"onUpdate:modelValue":a[1]||(a[1]=g=>e.value=g),name:"installment_table_settings",value:"row_view"},{subtitle:s(()=>[m(d(t.$t("row_view_desc")),1)]),default:s(()=>[m(d(t.$t("row_view")),1)]),_:1},8,["modelValue"])]),r("div",Be,[r("img",{src:`${c(l)}/images/settings/${e.value}.png`,class:"object-cover scale-75",alt:""},null,8,We)])])]),_:1}))}},Ne={type:"button",class:"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"},A={__name:"SaveButton",setup(n){return(u,o)=>(p(),_("button",Ne,[i(c(J),{class:"w-4 h-4 mr-2"}),m(" "+d(u.$t("save_settings")),1)]))}},B=L("SettingsStore",{state:()=>({wooCommerceSettings:window.gpos.woocommerce_settings||[],giveWpSettings:window.gpos.givewp_settings||[],formSettings:window.gpos.form_settings||[],cardSave:window.gpos.card_save_settings||[]}),actions:{async updateWooCommerceSettings(){await F.post("update_woocommerce_settings",{settings:this.wooCommerceSettings}),this.swalFire()},async updateFormSettings(){await F.post("update_form_settings",{settings:this.formSettings}),this.swalFire()},async updateGiveWpSettings(){await F.post("update_givewp_settings",{settings:this.giveWpSettings}),this.swalFire()},async updateCardSaveSettings(){await F.post("update_card_save_settings",{settings:this.cardSave}),this.swalFire()},swalFire(){H.fire({text:window.gpos.alert_texts.setting_saved,icon:"success",confirmButtonText:window.gpos.alert_texts.ok,confirmButtonColor:"#1A56DB"})}}}),Re={class:"w-1/2"},Ee={class:"w-1/2"},Oe={class:"w-full"},Me={class:"w-full"},R={__name:"FormSettings",setup(n){const u=B(),{formSettings:o}=j(u);return(l,e)=>(p(),f(q,null,{action:s(()=>[i(A,{onClick:e[4]||(e[4]=t=>c(u).updateFormSettings())})]),default:s(()=>[r("div",Re,[i(ye,{modelValue:c(o).threed,"onUpdate:modelValue":e[0]||(e[0]=t=>c(o).threed=t)},null,8,["modelValue"])]),r("div",Ee,[i(he,{modelValue:c(o),"onUpdate:modelValue":e[1]||(e[1]=t=>I(o)?o.value=t:null)},null,8,["modelValue"])]),r("div",Oe,[i(Te,{modelValue:c(o).display_type,"onUpdate:modelValue":e[2]||(e[2]=t=>c(o).display_type=t)},null,8,["modelValue"])]),r("div",Me,[i(De,{modelValue:c(o).installment_wiev,"onUpdate:modelValue":e[3]||(e[3]=t=>c(o).installment_wiev=t)},null,8,["modelValue"])])]),_:1}))}},Pe=["value","selected"],Ge={__name:"SuccessStatus",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=window.gpos.wc_order_statuses,e=V({get(){return o.modelValue},set(t){u("update:modelValue",t)}});return(t,a)=>(p(),_("label",null,[m(d(t.$t("pay_to_status"))+" ",1),T(r("select",{id:"countries","onUpdate:modelValue":a[0]||(a[0]=g=>e.value=g),class:"!bg-gray-50 border !border-gray-300 !text-gray-900 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !max-w-none !w-full !p-2.5"},[(p(!0),_(C,null,U(c(l),(g,v)=>(p(),_("option",{key:v,value:g.value,selected:g.value===e.value.success_status,class:"w-full"},d(t.$t(g.text)),9,Pe))),128))],512),[[K,e.value]])]))}},ze=["for"],Je=["id","placeholder","required"],$={__name:"TextField",props:{modelValue:{type:String,required:!0},placeholder:{type:String,default:""},required:{type:Boolean,default:!1},id:{type:[String,Number],default:""},label:{type:String,default:""}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=V({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),_("label",{for:n.id},[m(d(n.label)+" ",1),T(r("input",{id:n.id,"onUpdate:modelValue":t[0]||(t[0]=a=>l.value=a),type:"text",class:"!bg-gray-50 !border !border-gray-300 !text-gray-900 !text-sm !rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full !p-3",placeholder:n.placeholder,required:n.required},null,8,Je),[[O,l.value]])],8,ze))}},Le={class:"grid w-full grid-cols-2 gap-3"},He=["placeholder"],Ie={__name:"WooCommerce",setup(n){const u=B(),{wooCommerceSettings:o}=j(u);return(l,e)=>(p(),f(q,null,{action:s(()=>[i(A,{onClick:e[5]||(e[5]=t=>c(u).updateWooCommerceSettings())})]),default:s(()=>[i(b,null,{header:s(()=>[m(d(l.$t("form_texts")),1)]),default:s(()=>[r("div",Le,[i($,{modelValue:c(o).title,"onUpdate:modelValue":e[0]||(e[0]=t=>c(o).title=t),label:l.$t("method_name"),placeholder:l.$t("your_method_name")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:c(o).button_text,"onUpdate:modelValue":e[1]||(e[1]=t=>c(o).button_text=t),label:l.$t("pay_button_value"),placeholder:l.$t("pay_button_value")},null,8,["modelValue","label","placeholder"]),i(Ge,{modelValue:c(o).success_status,"onUpdate:modelValue":e[2]||(e[2]=t=>c(o).success_status=t)},null,8,["modelValue"]),i($,{modelValue:c(o).icon,"onUpdate:modelValue":e[3]||(e[3]=t=>c(o).icon=t),label:l.$t("icon"),placeholder:l.$t("icon")},null,8,["modelValue","label","placeholder"]),r("label",null,[m(d(l.$t("pay_form_desc"))+" ",1),T(r("textarea",{id:"message","onUpdate:modelValue":e[4]||(e[4]=t=>c(o).description=t),rows:"6",class:"block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500",placeholder:l.$t("enter_desc")},null,8,He),[[O,c(o).description]])])])]),_:1})]),_:1}))}},Ke={class:"grid w-full grid-cols-2 gap-3"},Qe={class:"p-4 text-blue-600 border border-blue-200 rounded-lg bg-blue-50 w-full"},Xe={__name:"DefaultCustomer",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=V({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),f(b,null,{header:s(()=>[m(d(e.$t("default_donator")),1)]),footer:s(()=>[r("div",Qe,d(e.$t("default_donator_desc")),1)]),default:s(()=>[r("div",Ke,[i($,{modelValue:l.value.first_name,"onUpdate:modelValue":t[0]||(t[0]=a=>l.value.first_name=a),label:e.$t("first_name"),placeholder:e.$t("first_name")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.last_name,"onUpdate:modelValue":t[1]||(t[1]=a=>l.value.last_name=a),label:e.$t("last_name"),placeholder:e.$t("last_name")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.phone,"onUpdate:modelValue":t[2]||(t[2]=a=>l.value.phone=a),label:e.$t("phone"),placeholder:e.$t("phone")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.email,"onUpdate:modelValue":t[3]||(t[3]=a=>l.value.email=a),label:e.$t("email"),placeholder:e.$t("email")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.address,"onUpdate:modelValue":t[4]||(t[4]=a=>l.value.address=a),label:e.$t("address"),placeholder:e.$t("address")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.state,"onUpdate:modelValue":t[5]||(t[5]=a=>l.value.state=a),label:e.$t("state"),placeholder:e.$t("state")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.city,"onUpdate:modelValue":t[6]||(t[6]=a=>l.value.city=a),label:e.$t("city"),placeholder:e.$t("city")},null,8,["modelValue","label","placeholder"]),i($,{modelValue:l.value.country,"onUpdate:modelValue":t[7]||(t[7]=a=>l.value.country=a),label:e.$t("country"),placeholder:e.$t("country")},null,8,["modelValue","label","placeholder"])])]),_:1}))}},Ye={class:"w-full"},Ze={__name:"GiveWp",setup(n){const u=B(),{giveWpSettings:o}=j(u);return(l,e)=>(p(),f(q,null,{action:s(()=>[i(A,{onClick:e[1]||(e[1]=t=>c(u).updateGiveWpSettings())})]),default:s(()=>[r("div",Ye,[i(Xe,{modelValue:c(o).default_customer,"onUpdate:modelValue":e[0]||(e[0]=t=>c(o).default_customer=t)},null,8,["modelValue"])])]),_:1}))}},et={},tt={class:"w-full h-full flex items-center justify-center text-[5rem] text-blue-600"};function lt(n,u){return p(),_("div",tt," Coming Soon ")}const st=k(et,[["render",lt]]),ot={__name:"Active",props:{modelValue:{type:Object,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=V({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),f(b,null,{header:s(()=>[m(d(e.$t("saved_card")),1)]),default:s(()=>[i(P,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=a=>l.value=a)},{subtitle:s(()=>[m(d(e.$t("saved_card_active")),1)]),default:s(()=>[m(d(e.$t("activate")),1)]),_:1},8,["modelValue"])]),_:1}))}},at={class:"flex flex-col gap-3"},nt={__name:"SaveStep",props:{modelValue:{type:String,required:!0}},emits:["update:modelValue"],setup(n,{emit:u}){const o=n,l=V({get(){return o.modelValue},set(e){u("update:modelValue",e)}});return(e,t)=>(p(),f(b,null,{header:s(()=>[m(d(e.$t("save_step")),1)]),default:s(()=>[r("div",at,[i(y,{modelValue:l.value,"onUpdate:modelValue":t[0]||(t[0]=a=>l.value=a),value:"at_payment",name:"save_step"},{subtitle:s(()=>[m(d(e.$t("at_payment_desc")),1)]),default:s(()=>[m(d(e.$t("at_payment")),1)]),_:1},8,["modelValue"]),i(y,{modelValue:l.value,"onUpdate:modelValue":t[1]||(t[1]=a=>l.value=a),value:"after_payment",name:"save_step",disabled:""},{subtitle:s(()=>[m(d(e.$t("after_payment_desc")),1)]),default:s(()=>[m(d(e.$t("after_payment")),1),i(W)]),_:1},8,["modelValue"])])]),_:1}))}},ut={class:"flex justify-between w-full border-2 rounded-lg border-dashed border-gray-200 bg-gray-50 p-3"},rt=r("span",null," [gpos_saved_cards] ",-1),dt={key:1,class:"text-blue-600",textContent:"copied !"},it={__name:"ShortCode",setup(n){let u=M(!0);const o=async l=>{await navigator.clipboard.writeText(l),u.value=!1,setTimeout(()=>{u.value=!0},1e3)};return(l,e)=>(p(),f(b,null,{header:s(()=>[m(d(l.$t("short_code")),1)]),footer:s(()=>[m(d(l.$t("save_card_short_code_desc")),1)]),default:s(()=>[r("div",ut,[rt,r("span",{class:"cursor-pointer",onClick:e[0]||(e[0]=t=>o("[gpos_saved_cards]"))},[c(u)?(p(),f(c(Q),{key:0,class:"w-4 h-4 text-blue-600"})):(p(),_("span",dt))])])]),_:1}))}},mt={class:"w-1/2"},pt={class:"w-1/2"},ct={class:"w-1/2"},_t={__name:"CardSave",setup(n){const u=B(),{cardSave:o}=j(u);return(l,e)=>(p(),f(q,null,{action:s(()=>[i(A,{onClick:e[2]||(e[2]=t=>c(u).updateCardSaveSettings())})]),default:s(()=>[r("div",mt,[i(ot,{modelValue:c(o).active,"onUpdate:modelValue":e[0]||(e[0]=t=>c(o).active=t)},null,8,["modelValue"])]),r("div",pt,[i(nt,{modelValue:c(o).save_step,"onUpdate:modelValue":e[1]||(e[1]=t=>c(o).save_step=t)},null,8,["modelValue"])]),r("div",ct,[i(it)])]),_:1}))}},ft=["textContent"],gt=["textContent"],vt={__name:"WordPress",setup(n){const u=window.gpos.status.wordpress;return(o,l)=>(p(),f(b,null,{header:s(()=>[m(" WordPress ")]),default:s(()=>[(p(!0),_(C,null,U(c(u),(e,t)=>(p(),_("div",{key:t,class:x(`flex flex-row items-center justify-between p-2 ${t%2===0?"bg-gray-100":""}`)},[r("span",{textContent:d(e.label)},null,8,ft),r("span",{textContent:d(e.value)},null,8,gt)],2))),128))]),_:1}))}},$t=["textContent"],bt=["textContent"],Vt={__name:"Server",setup(n){const u=window.gpos.status.server;return(o,l)=>(p(),f(b,null,{header:s(()=>[m(" Server ")]),default:s(()=>[(p(!0),_(C,null,U(c(u),(e,t)=>(p(),_("div",{key:t,class:x(`flex flex-row items-center justify-between p-2 ${t%2===0?"bg-gray-100":""}`)},[r("span",{textContent:d(e.label)},null,8,$t),r("span",{textContent:d(e.value)},null,8,bt)],2))),128))]),_:1}))}},wt={class:"w-full"},yt={class:"w-full"},ht={__name:"Status",setup(n){const u=()=>{X(JSON.stringify(window.gpos.status),"status.json","text/json")};return(o,l)=>(p(),f(q,null,{action:s(()=>[i(se,{onClick:l[0]||(l[0]=e=>u())},{default:s(()=>[m(d(o.$t("export")),1)]),_:1})]),default:s(()=>[r("div",wt,[i(vt)]),r("div",yt,[i(Vt)])]),_:1}))}},St={},xt={class:"pl-8 py-1 text-[10px] font-[700] uppercase"};function Ct(n,u){return p(),_("div",xt,[w(n.$slots,"default")])}const Ut=k(St,[["render",Ct]]),kt=["src"],E={__name:"NavElement",props:{active:{type:Boolean,default:!1},icon:{type:String,required:!0}},setup(n){const u=window.gpos.assets_url;return(o,l)=>(p(),_("div",{class:x(`py-4 pl-8 border-l-4 cursor-pointer flex items-center font-medium text-sm
   ${n.active?" bg-white border-blue-800":"border-[#FAFAFA] bg-[#FAFAFA]"} `)},[r("img",{class:"w-5 h-5 mr-3 text-blue-600",src:`${c(u)}/images/settings/${n.icon}.svg`,alt:""},null,8,kt),r("div",{class:x(`${n.active?"text-black":"text-[#6E778A]"} flex gap-2 items-center`)},[w(o.$slots,"default")],2)],2))}},qt={class:"w-full flex"},Ft={class:"w-1/5 flex flex-col bg-[#FAFAFA] py-8 rounded-l-lg space-y-8"},Tt={key:0,href:"https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=documents",target:"_blank"},jt={class:"w-4/5 flex flex-col bg-white rounded-r-lg p-8"},At={__name:"App",setup(n){const u=window.gpos.integrations,o=window.gpos.is_pro_active,l=h(R),e=M([{sectionTitle:"general_settings",sections:[{title:"form_settings",icon:"queue-list-icon",active:!0,component:h(R)}]},{sectionTitle:"integration_settings",sections:[{title:"woocommerce",active:!1,component:h(Ie)},{title:"givewp",active:!1,component:h(Ze)}]},{sectionTitle:"payment_settings",sections:[{title:"installment_rules",active:!1,component:h(st),soon:!0},{title:"card_save",active:!1,component:h(_t),soon:!0}]},{sectionTitle:"other",sections:[{title:"status",active:!1,component:h(ht)}]}]);e.value[1].sections=e.value[1].sections.filter(a=>u[a.title]?u[a.title]:!1),e.value=e.value.filter(a=>a.sectionTitle==="payment_settings"?o:!0);const t=a=>{e.value.forEach(g=>{g.sections.forEach(v=>{v.active=v.title===a,v.title===a&&(l.value=v.component)})})};return(a,g)=>(p(),f(te,{text:a.$t("settings"),href:"https://yardim.gurmehub.com/docs/pos-entegrator/?utm_source=wp_plugin&utm_medium=referal&utm_campaign=footer"},{default:s(()=>[r("div",qt,[r("div",Ft,[(p(!0),_(C,null,U(e.value,v=>(p(),_("div",{key:v.sectionTitle},[i(Ut,null,{default:s(()=>[m(d(a.$t(v.sectionTitle)),1)]),_:2},1024),(p(!0),_(C,null,U(v.sections,(S,G)=>(p(),f(E,{key:G,icon:S.title,active:S.active,onClick:Wt=>S.soon?!1:t(S.title)},{default:s(()=>[m(d(a.$t(S.title))+" ",1),S.soon?(p(),f(W,{key:0})):N("",!0)]),_:2},1032,["icon","active","onClick"]))),128)),v.sectionTitle==="other"?(p(),_("a",Tt,[i(E,{icon:"documents",active:!1},{default:s(()=>[m(d(a.$t("documents")),1)]),_:1})])):N("",!0)]))),128))]),r("div",jt,[(p(),f(Y(l.value)))])])]),_:1},8,["text"]))}},Bt=Z({locale:"default",messages:window.gpos.strings,legacy:!1}),D=ee(At);D.use(le);D.use(Bt);D.mount("#app");
